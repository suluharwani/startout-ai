<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\Faq;
use App\Models\Job;
use App\Models\Page;
use App\Models\Service;
use App\Models\TeamMember;
use App\Models\Testimonial;

/**
 * Public page controller.
 */
final class PageController extends Controller
{
    public function home(): void
    {
        $this->view('home', [
            'pageTitle'    => setting('company_name', 'Startout AI'),
            'pageMeta'     => setting('company_description'),
            'hero'         => [
                'title'    => setting('hero_title', 'Harmonized AI for What Truly Matters'),
                'subtitle' => setting('hero_subtitle'),
                'button'   => setting('hero_button_text', 'Start Your Journey'),
                'link'     => setting('hero_button_link', '/start-journey'),
            ],
            'services'     => Service::active(),
            'testimonials' => Testimonial::active(),
            'team'         => TeamMember::active(),
            'faqs'         => Faq::active(),
            'industries'   => Service::featured(),
        ]);
    }

    public function about(): void
    {
        $page = Page::bySlug('about');

        $this->view('about', [
            'pageTitle'    => 'About Us',
            'pageMeta'     => 'Learn about ' . setting('company_name') . ' — our story, mission, values and leadership team.',
            'page'         => $page,
            'team'         => TeamMember::active(),
            'testimonials' => Testimonial::active(),
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
            'testimonials'=> Testimonial::active(),
            'faqs'        => Faq::active(),
        ]);
    }

    public function startJourney(): void
    {
        $this->view('start-journey', [
            'pageTitle' => 'Start Your Journey',
            'pageMeta'  => 'Schedule a consultation with ' . setting('company_name') . ' — based in Yogyakarta, Indonesia.',
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
            'pageMeta'  => 'Join the team at ' . setting('company_name') . '. Explore open positions in Yogyakarta, Indonesia.',
            'jobs'      => Job::active(),
        ]);
    }

    public function join(): void
    {
        $this->view('join', [
            'pageTitle' => 'Join Us',
            'pageMeta'  => 'Be part of the customer experience revolution at ' . setting('company_name') . '.',
            'jobs'      => Job::active(),
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
