<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\Faq;
use App\Models\JobFeed;
use App\Models\Page;
use App\Models\Service;

/**
 * Public page controller.
 */
final class PageController extends Controller
{
    public function home(): void
    {
        $this->view('home', [
            'pageTitle'    => setting('company_name', 'Motrive'),
            'pageMeta'     => setting('company_description'),
            'hero'         => [
                'title'    => setting('hero_title', 'Remote Operations, Built Around You'),
                'subtitle' => setting('hero_subtitle'),
                'button'   => setting('hero_button_text', 'Start Your Journey'),
                'link'     => setting('hero_button_link', '/contact'),
            ],
            'services'     => Service::active(),
            'faqs'         => Faq::active(),
            'industries'   => Service::featured(),
        ]);
    }

    public function about(): void
    {
        $page = Page::bySlug('about');

        $this->view('about', [
            'pageTitle'    => 'About Us',
            'pageMeta'     => 'Learn about ' . setting('company_name') . ' — our story, mission and values.',
            'page'         => $page,
        ]);
    }

    public function servicesIndex(): void
    {
        $this->view('services', [
            'pageTitle' => 'Our Services',
            'pageMeta'  => 'Explore the services offered by ' . setting('company_name') . ': data annotation, trust & safety, talent, social media, automation and more.',
            'services'  => Service::active(),
        ]);
    }

    public function serviceShow(string $slug): void
    {
        $service = Service::bySlug($slug);

        if ($service === null) {
            $this->notFound();
            return;
        }

        $this->view('service', [
            'pageTitle'   => $service['name'],
            'pageMeta'    => $service['short_description'],
            'service'     => $service,
            'other'       => Service::active(),
            'faqs'        => Faq::active(),
        ]);
    }

    public function startJourney(): void
    {
        $this->view('start-journey', [
            'pageTitle' => 'Start Your Journey',
            'pageMeta'  => 'Schedule a consultation with ' . setting('company_name') . '.',
        ]);
    }

    public function resources(): void
    {
        $page = Page::bySlug('resources');

        $this->view('resources', [
            'pageTitle' => 'Resources',
            'pageMeta'  => 'Guides, case studies and insights from ' . setting('company_name') . '.',
            'page'      => $page,
            'faqs'      => Faq::active(),
        ]);
    }

    public function careers(): void
    {
        $this->view('careers', [
            'pageTitle' => 'Careers',
            'pageMeta'  => 'Join the team at ' . setting('company_name') . '. Explore current openings and how we work.',
            'jobs'      => JobFeed::jobs(),
            'feedUrl'   => JobFeed::hasFeed() ? setting('jobs_feed_url') : '',
        ]);
    }

    public function notFound(): void
    {
        http_response_code(404);
        $this->view('404', [
            'pageTitle' => 'Page Not Found',
        ]);
    }
}
