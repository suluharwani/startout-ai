<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\User;

/**
 * Admin authentication.
 */
final class AuthController extends Controller
{
    public function showLogin(): void
    {
        if (auth_check()) {
            redirect('/admin');
        }

        $this->view('auth/login', [
            'pageTitle'   => 'Admin Login',
            'canRegister' => User::count() === 0,
        ], 'admin-guest');
    }

    /**
     * First-run registration — only available while no admin user exists.
     */
    public function showRegister(): void
    {
        if (auth_check()) {
            redirect('/admin');
        }

        if (User::count() > 0) {
            redirect('/admin/login');
        }

        $this->view('auth/register', [
            'pageTitle' => 'Create Admin Account',
        ], 'admin-guest');
    }

    public function register(): void
    {
        csrf_guard();

        if (auth_check()) {
            redirect('/admin');
        }

        // Only the very first account can be created this way.
        if (User::count() > 0) {
            flash('error', 'An admin account already exists. Please sign in.');
            redirect('/admin/login');
        }

        $name     = request_input('name');
        $email    = request_input('email');
        $password = (string) ($_POST['password'] ?? '');
        $confirm  = (string) ($_POST['confirm_password'] ?? '');
        $errors   = [];

        if ($name === '') {
            $errors['name'] = 'Name is required.';
        }
        if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'A valid email address is required.';
        }
        if (strlen($password) < 8) {
            $errors['password'] = 'Password must be at least 8 characters.';
        }
        if ($password !== $confirm) {
            $errors['confirm_password'] = 'Passwords do not match.';
        }

        if (!empty($errors)) {
            $_SESSION['_old'] = ['name' => $name, 'email' => $email];
            flash_errors($errors);
            redirect('/admin/register');
        }

        // Re-check to guard against a race condition.
        if (User::count() > 0) {
            flash('error', 'An admin account already exists. Please sign in.');
            redirect('/admin/login');
        }

        $id = User::create([
            'name'     => $name,
            'email'    => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role'     => 'super_admin',
            'is_active'=> 1,
        ]);

        $user = User::find($id);
        unset($user['password']);

        session_regenerate_id(true);
        $_SESSION['admin_id']   = $id;
        $_SESSION['admin_user'] = $user;

        flash('success', 'Welcome! Your admin account is ready.');
        redirect('/admin');
    }

    public function login(): void
    {
        csrf_guard();

        if (auth_check()) {
            redirect('/admin');
        }

        $email    = request_input('email');
        $password = (string) ($_POST['password'] ?? '');
        $errors   = [];

        if ($email === '' || $password === '') {
            $errors['auth'] = 'Please enter your email and password.';
        } else {
            // Minimal brute-force throttling.
            $now = time();
            $last = (int) ($_SESSION['_login_attempt'] ?? 0);
            if ($now - $last < 2) {
                $errors['auth'] = 'Too many attempts. Please wait a moment.';
            }

            $user = empty($errors) ? User::attempt($email, $password) : null;

            if ($user === null) {
                $errors['auth'] = 'Invalid email or password.';
            } else {
                session_regenerate_id(true);
                $_SESSION['admin_id']   = (int) $user['id'];
                $_SESSION['admin_user'] = $user;
                unset($_SESSION['_login_attempt']);

                $redirect = $_SESSION['_redirect'] ?? '/admin';
                unset($_SESSION['_redirect']);
                redirect($redirect);
            }
        }

        $_SESSION['_login_attempt'] = $now ?? time();
        $_SESSION['_old'] = ['email' => $email];
        flash_errors($errors);
        redirect('/admin/login');
    }

    public function logout(): void
    {
        csrf_guard();
        admin_logout();
        redirect('/admin/login');
    }
}
