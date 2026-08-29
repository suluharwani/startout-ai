<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\Service;

/**
 * Search-engine endpoints: robots.txt and sitemap.xml.
 */
final class SeoController extends Controller
{
    public function robots(): void
    {
        header('Content-Type: text/plain; charset=utf-8');

        echo "User-agent: *\n";
        echo "Allow: /\n";
        echo "Disallow: /admin\n";
        echo "Disallow: /admin/\n";
        echo "\n";
        echo "Sitemap: " . url('/sitemap.xml') . "\n";
    }

    public function sitemap(): void
    {
        header('Content-Type: application/xml; charset=utf-8');

        $static = [
            '', '/about', '/services', '/start-journey',
            '/resources', '/careers', '/contact',
        ];

        $urls = $static;
        foreach (Service::active() as $svc) {
            $urls[] = '/services/' . $svc['slug'];
        }

        echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($urls as $path) {
            echo '  <url>' . "\n";
            echo '    <loc>' . e(url($path)) . '</loc>' . "\n";
            echo '    <changefreq>monthly</changefreq>' . "\n";
            echo '    <priority>' . ($path === '' ? '1.0' : '0.8') . '</priority>' . "\n";
            echo '  </url>' . "\n";
        }

        echo '</urlset>' . "\n";
    }
}
