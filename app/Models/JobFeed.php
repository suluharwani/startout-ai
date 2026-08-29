<?php
declare(strict_types=1);

namespace App\Models;

/**
 * Fetches and normalises job listings from an external ATS feed
 * (e.g. Greenhouse, Lever, Workable or any JSON jobs API).
 *
 * The careers page uses the DB `jobs` table as the source of truth by
 * default. If a `jobs_feed_url` is configured in the admin panel, this
 * class fetches that feed (with a short cache) and merges the results,
 * so openings published through the ATS appear on the site in near
 * real time.
 */
final class JobFeed
{
    /** Cache TTL for fetched feeds (seconds). */
    private const CACHE_TTL = 300;

    /** How long to wait for the remote feed before giving up (seconds). */
    private const TIMEOUT = 6;

    /**
     * Return the list of jobs to display.
     *
     * If a feed URL is configured and reachable, its jobs are merged on
     * top of the local jobs. Otherwise the local jobs are returned as-is.
     *
     * @return list<array<string, mixed>>
     */
    public static function jobs(): array
    {
        $local = Job::active();
        $url   = trim(setting('jobs_feed_url', ''));

        if ($url === '') {
            return $local;
        }

        $remote = self::fetch($url);

        if (empty($remote)) {
            return $local;
        }

        // Merge: remote (ATS) jobs first, local DB jobs after.
        return array_values(array_merge($remote, $local));
    }

    /**
     * Whether an external feed is configured and returned results.
     */
    public static function hasFeed(): bool
    {
        return trim(setting('jobs_feed_url', '')) !== '';
    }

    /**
     * Fetch and parse a jobs feed, normalising several common formats.
     *
     * Supported shapes:
     *   - Greenhouse board:  {"jobs": [{ "title": ..., "location": {"name": ...}, ... }]}
     *   - Lever:             [{ "text": ..., "categories": {"location": ..., "commitment": ...}, "hostedUrl": ... }]
     *   - Generic:           { "data": [...] } or a plain array of objects
     *
     * @return list<array<string, mixed>>
     */
    private static function fetch(string $url): array
    {
        $cacheFile = sys_get_temp_dir() . '/motrive_jobfeed_' . md5($url) . '.json';

        if (is_file($cacheFile) && (time() - filemtime($cacheFile)) < self::CACHE_TTL) {
            $cached = @file_get_contents($cacheFile);
            if ($cached !== false) {
                return self::parse($cached);
            }
        }

        $body = self::httpGet($url);
        if ($body === null) {
            return [];
        }

        @file_put_contents($cacheFile, $body);

        return self::parse($body);
    }

    private static function httpGet(string $url): ?string
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            return null;
        }

        $context = stream_context_create([
            'http' => [
                'timeout'       => self::TIMEOUT,
                'ignore_errors' => true,
                'user_agent'    => 'MotriveJobsBot/1.0 (+' . (string) setting('company_url', '') . ')',
                'header'        => "Accept: application/json\r\n",
            ],
            'ssl'  => [
                'verify_peer'      => true,
                'verify_peer_name' => true,
            ],
        ]);

        $body = @file_get_contents($url, false, $context);
        if ($body === false) {
            return null;
        }

        return $body;
    }

    /**
     * @return list<array<string, mixed>>
     */
    private static function parse(string $body): array
    {
        $data = json_decode($body, true);
        if (!is_array($data)) {
            return [];
        }

        // Greenhouse-style: {"jobs": [...]}
        if (isset($data['jobs']) && is_array($data['jobs'])) {
            $data = $data['jobs'];
        }
        // Generic wrapper: {"data": [...]} or {"results": [...]}
        elseif (isset($data['data']) && is_array($data['data'])) {
            $data = $data['data'];
        } elseif (isset($data['results']) && is_array($data['results'])) {
            $data = $data['results'];
        }

        $jobs = [];
        foreach ($data as $item) {
            if (!is_array($item)) {
                continue;
            }
            $normalised = self::normaliseItem($item);
            if ($normalised !== null) {
                $jobs[] = $normalised;
            }
        }

        return $jobs;
    }

    /**
     * Normalise a single feed item into the shape the careers view expects.
     *
     * @param array<string, mixed> $item
     * @return array<string, mixed>|null
     */
    private static function normaliseItem(array $item): ?array
    {
        $title = self::firstString($item, ['title', 'text', 'name', 'job_title']);
        if ($title === '') {
            return null;
        }

        $location = self::locationFrom($item);
        $type     = self::firstString($item, ['type', 'employment_type', 'commitment']);

        if ($type === '' && isset($item['categories']) && is_array($item['categories'])) {
            $type = self::firstString($item['categories'], ['commitment', 'type']);
        }

        $apply = self::firstString($item, ['hostedUrl', 'apply_url', 'applyUrl', 'url', 'absolute_url']);
        $desc  = self::firstString($item, ['description', 'content', 'summary', 'intro']);

        return [
            'title'      => $title,
            'category'   => 'Openings',
            'location'   => $location !== '' ? $location : 'Remote',
            'type'       => $type !== '' ? $type : 'Full-time',
            'description'=> $desc,
            'apply_url'  => $apply,
            'is_feed'    => true,
        ];
    }

    /**
     * Best-effort location extraction across ATS formats.
     *
     * @param array<string, mixed> $item
     */
    private static function locationFrom(array $item): string
    {
        // Greenhouse: {"location": {"name": "Remote"}}
        if (isset($item['location']) && is_array($item['location'])) {
            $name = self::firstString($item['location'], ['name', 'city', 'country']);
            if ($name !== '') {
                return $name;
            }
        }

        // Lever: {"categories": {"location": "Remote"}}
        if (isset($item['categories']) && is_array($item['categories'])) {
            $loc = self::firstString($item['categories'], ['location', 'team']);
            if ($loc !== '') {
                return $loc;
            }
        }

        return self::firstString($item, ['location', 'office', 'city']);
    }

    /**
     * Return the first non-empty string value for any of the given keys.
     *
     * @param array<string, mixed> $item
     * @param list<string> $keys
     */
    private static function firstString(array $item, array $keys): string
    {
        foreach ($keys as $key) {
            if (isset($item[$key]) && is_string($item[$key]) && trim($item[$key]) !== '') {
                return trim((string) $item[$key]);
            }
        }
        return '';
    }
}
