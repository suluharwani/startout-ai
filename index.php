<?php
declare(strict_types=1);

/**
 * Startout AI — Front Controller
 * All requests are routed through this file.
 */

require __DIR__ . '/config/bootstrap.php';

use App\Core\Router;
use App\Controllers\PageController;
use App\Controllers\ContactController;
use App\Controllers\AuthController;
use App\Controllers\AdminController;

$router = new Router();

/* ──────────────────────────── Public routes ──────────────────────────── */
$router->get('/', 'PageController@home');
$router->get('/home', 'PageController@home');

$router->get('/about', 'PageController@about');

$router->get('/services', 'PageController@servicesIndex');
$router->get('/services/{slug}', 'PageController@serviceShow');

$router->get('/start-journey', 'PageController@startJourney');

$router->get('/resources', 'PageController@resources');

$router->get('/careers', 'PageController@careers');
$router->get('/join', 'PageController@join');

$router->get('/contact', 'ContactController@show');
$router->post('/contact', 'ContactController@store');

/* ──────────────────────────── SEO ──────────────────────────── */
$router->get('/robots.txt', 'SeoController@robots');
$router->get('/sitemap.xml', 'SeoController@sitemap');

/* ──────────────────────────── Auth ──────────────────────────── */
$router->get('/admin/login', 'AuthController@showLogin');
$router->post('/admin/login', 'AuthController@login');
$router->post('/admin/logout', 'AuthController@logout');
$router->get('/admin/register', 'AuthController@showRegister');
$router->post('/admin/register', 'AuthController@register');

/* ──────────────────────────── Admin panel ──────────────────────────── */
$router->get('/admin', 'AdminController@dashboard');
$router->get('/admin/dashboard', 'AdminController@dashboard');

$router->get('/admin/settings', 'AdminController@settings');
$router->post('/admin/settings', 'AdminController@saveSettings');

$router->get('/admin/services', 'AdminController@servicesIndex');
$router->get('/admin/services/create', 'AdminController@serviceCreate');
$router->post('/admin/services/create', 'AdminController@serviceStore');
$router->get('/admin/services/{id}/edit', 'AdminController@serviceEdit');
$router->post('/admin/services/{id}/edit', 'AdminController@serviceUpdate');
$router->post('/admin/services/{id}/delete', 'AdminController@serviceDestroy');

$router->get('/admin/testimonials', 'AdminController@testimonialsIndex');
$router->get('/admin/testimonials/create', 'AdminController@testimonialCreate');
$router->post('/admin/testimonials/create', 'AdminController@testimonialStore');
$router->get('/admin/testimonials/{id}/edit', 'AdminController@testimonialEdit');
$router->post('/admin/testimonials/{id}/edit', 'AdminController@testimonialUpdate');
$router->post('/admin/testimonials/{id}/delete', 'AdminController@testimonialDestroy');

$router->get('/admin/team', 'AdminController@teamIndex');
$router->get('/admin/team/create', 'AdminController@teamCreate');
$router->post('/admin/team/create', 'AdminController@teamStore');
$router->get('/admin/team/{id}/edit', 'AdminController@teamEdit');
$router->post('/admin/team/{id}/edit', 'AdminController@teamUpdate');
$router->post('/admin/team/{id}/delete', 'AdminController@teamDestroy');

$router->get('/admin/jobs', 'AdminController@jobsIndex');
$router->get('/admin/jobs/create', 'AdminController@jobCreate');
$router->post('/admin/jobs/create', 'AdminController@jobStore');
$router->get('/admin/jobs/{id}/edit', 'AdminController@jobEdit');
$router->post('/admin/jobs/{id}/edit', 'AdminController@jobUpdate');
$router->post('/admin/jobs/{id}/delete', 'AdminController@jobDestroy');

$router->get('/admin/faqs', 'AdminController@faqsIndex');
$router->get('/admin/faqs/create', 'AdminController@faqCreate');
$router->post('/admin/faqs/create', 'AdminController@faqStore');
$router->get('/admin/faqs/{id}/edit', 'AdminController@faqEdit');
$router->post('/admin/faqs/{id}/edit', 'AdminController@faqUpdate');
$router->post('/admin/faqs/{id}/delete', 'AdminController@faqDestroy');

$router->get('/admin/messages', 'AdminController@messagesIndex');
$router->get('/admin/messages/{id}', 'AdminController@messageShow');
$router->post('/admin/messages/{id}/delete', 'AdminController@messageDestroy');

$router->get('/admin/pages', 'AdminController@pagesIndex');
$router->get('/admin/pages/{id}/edit', 'AdminController@pageEdit');
$router->post('/admin/pages/{id}/edit', 'AdminController@pageUpdate');

$router->get('/admin/profile', 'AdminController@profile');
$router->post('/admin/profile', 'AdminController@updateProfile');

$router->dispatch();
