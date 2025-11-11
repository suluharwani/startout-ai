<?php

use App\Controllers\Home;
use App\Controllers\Services;
use App\Controllers\Industries;
use App\Controllers\About;
use App\Controllers\Careers;
use App\Controllers\Contact;
use App\Controllers\Join;

// Home Page
$routes->get('/', [Home::class, 'index']);

// Services
$routes->get('services', [Services::class, 'index']);
$routes->get('services/(:segment)', [Services::class, 'show']);

// Industries
$routes->get('industries', [Industries::class, 'index']);
$routes->get('industries/(:segment)', [Industries::class, 'show']);

// About
$routes->get('about', [About::class, 'index']);

// Careers
$routes->get('careers', [Careers::class, 'index']);

// Contact
$routes->get('contact', [Contact::class, 'index']);
$routes->post('contact/submit', [Contact::class, 'submit']);
$routes->get('contact/success', [Contact::class, 'success']);

// Join Us
$routes->get('join', [Join::class, 'index']);
$routes->post('join/submit', [Join::class, 'submit']);
$routes->get('join/success', [Join::class, 'success']);