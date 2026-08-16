<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\ContactMessage;

/**
 * Contact form handling (CSRF-protected, SQL-injection safe).
 */
final class ContactController extends Controller
{
    public function show(): void
    {
        $services = \App\Models\Service::active();

        $this->view('contact', [
            'pageTitle' => 'Contact Us',
            'pageMeta'  => 'Get in touch with ' . setting('company_name') . ' — schedule a consultation today.',
            'services'  => $services,
        ]);
    }

    public function store(): void
    {
        csrf_guard();

        $firstName = request_input('first_name');
        $lastName  = request_input('last_name');
        $email     = request_input('email');
        $company   = request_input('company');
        $phone     = request_input('phone');
        $service   = request_input('service');
        $message   = request_input('message');
        $consent   = isset($_POST['consent']);

        $errors = [];

        if ($firstName === '') {
            $errors['first_name'] = 'First name is required.';
        }
        if ($lastName === '') {
            $errors['last_name'] = 'Last name is required.';
        }
        if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'A valid email address is required.';
        }
        if ($service === '') {
            $errors['service'] = 'Please select a service.';
        }
        if ($message === '') {
            $errors['message'] = 'Please write a message.';
        }
        if (!$consent) {
            $errors['consent'] = 'You must agree to the privacy policy.';
        }

        // Basic honeypot anti-spam.
        if (request_input('website') !== '') {
            // Pretend success.
            redirect('/contact?sent=1');
        }

        if (!empty($errors)) {
            $_SESSION['_old'] = [
                'first_name' => $firstName,
                'last_name'  => $lastName,
                'email'      => $email,
                'company'    => $company,
                'phone'      => $phone,
                'service'    => $service,
                'message'    => $message,
            ];
            flash_errors($errors);
            redirect('/contact');
        }

        ContactMessage::create([
            'first_name' => $firstName,
            'last_name'  => $lastName,
            'email'      => $email,
            'company'    => $company,
            'phone'      => $phone,
            'service'    => $service,
            'message'    => $message,
            'is_read'    => 0,
        ]);

        unset($_SESSION['_old']);
        redirect('/contact?sent=1');
    }
}
