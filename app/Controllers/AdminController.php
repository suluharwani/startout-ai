<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\ContactMessage;
use App\Models\Faq;
use App\Models\Job;
use App\Models\Page;
use App\Models\Service;
use App\Models\Setting;
use App\Models\TeamMember;
use App\Models\Testimonial;
use App\Models\User;

/**
 * Admin panel controller. Every route here is guarded by require_admin()
 * and every POST is protected by CSRF.
 */
final class AdminController extends Controller
{
    private const ALLOWED_EXT = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg', 'avif'];

    /* ── Dashboard ──────────────────────────────────────────────── */

    public function dashboard(): void
    {
        require_admin();

        $this->adminView('dashboard', [
            'stats' => [
                'messages'    => ContactMessage::count(),
                'unread'      => ContactMessage::unreadCount(),
                'services'    => Service::count(),
                'testimonials'=> Testimonial::count(),
                'team'        => TeamMember::count(),
                'jobs'        => Job::count(),
                'faqs'        => Faq::count(),
            ],
            'recentMessages' => array_slice(ContactMessage::all('id DESC'), 0, 6),
        ]);
    }

    /* ── Company settings ───────────────────────────────────────── */

    private const SETTING_KEYS = [
        'company_name', 'company_logo_text', 'company_tagline',
        'company_email', 'company_phone', 'company_whatsapp',
        'company_address', 'company_city', 'company_country',
        'company_linkedin', 'company_x', 'company_facebook', 'company_instagram',
        'company_description',
        'hero_title', 'hero_subtitle', 'hero_button_text', 'hero_button_link',
        'home_intro_kicker', 'home_intro_title', 'home_intro_text',
        'about_heading', 'about_text',
        'footer_about', 'copyright_text',
        'schedule_wa_message',
        'jobs_feed_url',
    ];

    public function settings(): void
    {
        require_admin();
        $this->adminView('settings', [
            'settings' => all_settings(),
            'keys'     => self::SETTING_KEYS,
        ]);
    }

    public function saveSettings(): void
    {
        require_admin();
        csrf_guard();

        foreach (self::SETTING_KEYS as $key) {
            $value = isset($_POST[$key]) ? (string) $_POST[$key] : '';
            Setting::set($key, $value);
        }

        // ── Branding uploads: company logo + favicon ──
        $logo = $this->handleUpload('company_logo_file', setting('company_logo'));
        if ($logo !== '') {
            Setting::set('company_logo', $logo);
        }
        if (isset($_POST['remove_logo'])) {
            Setting::set('company_logo', '');
        }

        $favicon = $this->handleUpload('company_favicon_file', setting('company_favicon'));
        if ($favicon !== '') {
            Setting::set('company_favicon', $favicon);
        }
        if (isset($_POST['remove_favicon'])) {
            Setting::set('company_favicon', '');
        }

        flash('success', 'Company profile updated successfully.');
        redirect('/admin/settings');
    }

    /* ── Services CRUD ──────────────────────────────────────────── */

    public function servicesIndex(): void
    {
        require_admin();
        $this->adminView('services/index', ['items' => Service::all('sort_order ASC, id ASC')]);
    }

    public function serviceCreate(): void
    {
        require_admin();
        $this->adminView('services/form', ['item' => null]);
    }

    public function serviceStore(): void
    {
        require_admin();
        csrf_guard();

        $data = $this->servicePayload();
        $this->validateService($data);

        if (Service::existsSlug($data['slug'])) {
            flash('error', 'A service with that slug already exists.');
            redirect('/admin/services/create');
        }

        $data['image'] = $this->handleUpload('image', $data['image'] ?? '');
        Service::create($data);

        flash('success', 'Service created successfully.');
        redirect('/admin/services');
    }

    public function serviceEdit(string $id): void
    {
        require_admin();
        $item = Service::find((int) $id);
        if ($item === null) {
            redirect('/admin/services');
        }
        $this->adminView('services/form', ['item' => $item]);
    }

    public function serviceUpdate(string $id): void
    {
        require_admin();
        csrf_guard();

        $item = Service::find((int) $id);
        if ($item === null) {
            redirect('/admin/services');
        }

        $data = $this->servicePayload();
        $this->validateService($data);

        if (Service::existsSlug($data['slug'], (int) $id)) {
            flash('error', 'A service with that slug already exists.');
            redirect('/admin/services/' . $id . '/edit');
        }

        $data['image'] = $this->handleUpload('image', $item['image'] ?? '');
        Service::update((int) $id, $data);

        flash('success', 'Service updated successfully.');
        redirect('/admin/services');
    }

    public function serviceDestroy(string $id): void
    {
        require_admin();
        csrf_guard();
        Service::delete((int) $id);
        flash('success', 'Service deleted.');
        redirect('/admin/services');
    }

    private function servicePayload(): array
    {
        $name = request_input('name');
        return [
            'name'              => $name,
            'slug'              => request_input('slug') !== '' ? slugify(request_input('slug')) : slugify($name),
            'tagline'           => request_input('tagline'),
            'short_description' => request_input('short_description'),
            'description'       => (string) ($_POST['description'] ?? ''),
            'icon'              => request_input('icon'),
            'featured'          => isset($_POST['featured']) ? 1 : 0,
            'is_active'         => isset($_POST['is_active']) ? 1 : 0,
            'sort_order'        => (int) request_input('sort_order', '0'),
        ];
    }

    private function validateService(array $data): void
    {
        if ($data['name'] === '') {
            flash('error', 'Service name is required.');
            redirect('/admin/services');
        }
        if ($data['slug'] === '') {
            flash('error', 'A valid slug is required.');
            redirect('/admin/services');
        }
    }

    /* ── Testimonials CRUD ──────────────────────────────────────── */

    public function testimonialsIndex(): void
    {
        require_admin();
        $this->adminView('testimonials/index', ['items' => Testimonial::all('sort_order ASC, id ASC')]);
    }

    public function testimonialCreate(): void
    {
        require_admin();
        $this->adminView('testimonials/form', ['item' => null]);
    }

    public function testimonialStore(): void
    {
        require_admin();
        csrf_guard();
        $data = $this->testimonialPayload();
        $data['image'] = $this->handleUpload('image', '');
        Testimonial::create($data);
        flash('success', 'Testimonial created.');
        redirect('/admin/testimonials');
    }

    public function testimonialEdit(string $id): void
    {
        require_admin();
        $item = Testimonial::find((int) $id);
        $item === null ? redirect('/admin/testimonials') : $this->adminView('testimonials/form', ['item' => $item]);
    }

    public function testimonialUpdate(string $id): void
    {
        require_admin();
        csrf_guard();
        $item = Testimonial::find((int) $id);
        if ($item === null) {
            redirect('/admin/testimonials');
        }
        $data = $this->testimonialPayload();
        $data['image'] = $this->handleUpload('image', $item['image'] ?? '');
        Testimonial::update((int) $id, $data);
        flash('success', 'Testimonial updated.');
        redirect('/admin/testimonials');
    }

    public function testimonialDestroy(string $id): void
    {
        require_admin();
        csrf_guard();
        Testimonial::delete((int) $id);
        flash('success', 'Testimonial deleted.');
        redirect('/admin/testimonials');
    }

    private function testimonialPayload(): array
    {
        return [
            'name'       => request_input('name'),
            'role'       => request_input('role'),
            'company'    => request_input('company'),
            'content'    => request_input('content'),
            'is_active'  => isset($_POST['is_active']) ? 1 : 0,
            'sort_order' => (int) request_input('sort_order', '0'),
        ];
    }

    /* ── Team CRUD ──────────────────────────────────────────────── */

    public function teamIndex(): void
    {
        require_admin();
        $this->adminView('team/index', ['items' => TeamMember::all('sort_order ASC, id ASC')]);
    }

    public function teamCreate(): void
    {
        require_admin();
        $this->adminView('team/form', ['item' => null]);
    }

    public function teamStore(): void
    {
        require_admin();
        csrf_guard();
        $data = $this->teamPayload();
        $data['photo'] = $this->handleUpload('photo', '');
        TeamMember::create($data);
        flash('success', 'Team member added.');
        redirect('/admin/team');
    }

    public function teamEdit(string $id): void
    {
        require_admin();
        $item = TeamMember::find((int) $id);
        $item === null ? redirect('/admin/team') : $this->adminView('team/form', ['item' => $item]);
    }

    public function teamUpdate(string $id): void
    {
        require_admin();
        csrf_guard();
        $item = TeamMember::find((int) $id);
        if ($item === null) {
            redirect('/admin/team');
        }
        $data = $this->teamPayload();
        $data['photo'] = $this->handleUpload('photo', $item['photo'] ?? '');
        TeamMember::update((int) $id, $data);
        flash('success', 'Team member updated.');
        redirect('/admin/team');
    }

    public function teamDestroy(string $id): void
    {
        require_admin();
        csrf_guard();
        TeamMember::delete((int) $id);
        flash('success', 'Team member removed.');
        redirect('/admin/team');
    }

    private function teamPayload(): array
    {
        return [
            'name'       => request_input('name'),
            'position'   => request_input('position'),
            'bio'        => request_input('bio'),
            'linkedin'   => request_input('linkedin'),
            'is_active'  => isset($_POST['is_active']) ? 1 : 0,
            'sort_order' => (int) request_input('sort_order', '0'),
        ];
    }

    /* ── Jobs CRUD ──────────────────────────────────────────────── */

    public function jobsIndex(): void
    {
        require_admin();
        $this->adminView('jobs/index', ['items' => Job::all('sort_order ASC, id ASC')]);
    }

    public function jobCreate(): void
    {
        require_admin();
        $this->adminView('jobs/form', ['item' => null]);
    }

    public function jobStore(): void
    {
        require_admin();
        csrf_guard();
        Job::create($this->jobPayload());
        flash('success', 'Job added.');
        redirect('/admin/jobs');
    }

    public function jobEdit(string $id): void
    {
        require_admin();
        $item = Job::find((int) $id);
        $item === null ? redirect('/admin/jobs') : $this->adminView('jobs/form', ['item' => $item]);
    }

    public function jobUpdate(string $id): void
    {
        require_admin();
        csrf_guard();
        Job::update((int) $id, $this->jobPayload());
        flash('success', 'Job updated.');
        redirect('/admin/jobs');
    }

    public function jobDestroy(string $id): void
    {
        require_admin();
        csrf_guard();
        Job::delete((int) $id);
        flash('success', 'Job deleted.');
        redirect('/admin/jobs');
    }

    private function jobPayload(): array
    {
        return [
            'title'       => request_input('title'),
            'category'    => request_input('category'),
            'location'    => request_input('location'),
            'type'        => request_input('type'),
            'description' => request_input('description'),
            'is_active'   => isset($_POST['is_active']) ? 1 : 0,
            'sort_order'  => (int) request_input('sort_order', '0'),
        ];
    }

    /* ── FAQs CRUD ──────────────────────────────────────────────── */

    public function faqsIndex(): void
    {
        require_admin();
        $this->adminView('faqs/index', ['items' => Faq::all('sort_order ASC, id ASC')]);
    }

    public function faqCreate(): void
    {
        require_admin();
        $this->adminView('faqs/form', ['item' => null]);
    }

    public function faqStore(): void
    {
        require_admin();
        csrf_guard();
        Faq::create($this->faqPayload());
        flash('success', 'FAQ added.');
        redirect('/admin/faqs');
    }

    public function faqEdit(string $id): void
    {
        require_admin();
        $item = Faq::find((int) $id);
        $item === null ? redirect('/admin/faqs') : $this->adminView('faqs/form', ['item' => $item]);
    }

    public function faqUpdate(string $id): void
    {
        require_admin();
        csrf_guard();
        Faq::update((int) $id, $this->faqPayload());
        flash('success', 'FAQ updated.');
        redirect('/admin/faqs');
    }

    public function faqDestroy(string $id): void
    {
        require_admin();
        csrf_guard();
        Faq::delete((int) $id);
        flash('success', 'FAQ deleted.');
        redirect('/admin/faqs');
    }

    private function faqPayload(): array
    {
        return [
            'question'   => request_input('question'),
            'answer'     => request_input('answer'),
            'is_active'  => isset($_POST['is_active']) ? 1 : 0,
            'sort_order' => (int) request_input('sort_order', '0'),
        ];
    }

    /* ── Contact messages ───────────────────────────────────────── */

    public function messagesIndex(): void
    {
        require_admin();
        $this->adminView('messages/index', ['items' => ContactMessage::all('id DESC')]);
    }

    public function messageShow(string $id): void
    {
        require_admin();
        $item = ContactMessage::find((int) $id);
        if ($item === null) {
            redirect('/admin/messages');
        }
        ContactMessage::markRead((int) $id);
        $item['is_read'] = 1;
        $this->adminView('messages/show', ['item' => $item]);
    }

    public function messageDestroy(string $id): void
    {
        require_admin();
        csrf_guard();
        ContactMessage::delete((int) $id);
        flash('success', 'Message deleted.');
        redirect('/admin/messages');
    }

    /* ── Static pages ───────────────────────────────────────────── */

    public function pagesIndex(): void
    {
        require_admin();
        $this->adminView('pages/index', ['items' => Page::all('id ASC')]);
    }

    public function pageEdit(string $id): void
    {
        require_admin();
        $item = Page::find((int) $id);
        $item === null ? redirect('/admin/pages') : $this->adminView('pages/form', ['item' => $item]);
    }

    public function pageUpdate(string $id): void
    {
        require_admin();
        csrf_guard();
        $item = Page::find((int) $id);
        if ($item === null) {
            redirect('/admin/pages');
        }

        Page::update((int) $id, [
            'title'            => request_input('title'),
            'subtitle'         => request_input('subtitle'),
            'content'          => (string) ($_POST['content'] ?? ''),
            'meta_title'       => request_input('meta_title'),
            'meta_description' => request_input('meta_description'),
            'is_active'        => isset($_POST['is_active']) ? 1 : 0,
        ]);

        flash('success', 'Page updated successfully.');
        redirect('/admin/pages');
    }

    /* ── Profile / password ─────────────────────────────────────── */

    public function profile(): void
    {
        require_admin();
        $this->adminView('profile', ['user' => auth_user()]);
    }

    public function updateProfile(): void
    {
        require_admin();
        csrf_guard();

        $user    = auth_user();
        $current = (string) ($_POST['current_password'] ?? '');
        $new     = (string) ($_POST['new_password'] ?? '');
        $confirm = (string) ($_POST['confirm_password'] ?? '');

        $record = User::find((int) ($user['id'] ?? 0));

        if ($record === null || !password_verify($current, (string) $record['password'])) {
            flash('error', 'Your current password is incorrect.');
            redirect('/admin/profile');
        }

        if (strlen($new) < 8) {
            flash('error', 'New password must be at least 8 characters.');
            redirect('/admin/profile');
        }

        if ($new !== $confirm) {
            flash('error', 'New passwords do not match.');
            redirect('/admin/profile');
        }

        User::changePassword((int) $record['id'], $new);
        flash('success', 'Password updated successfully.');
        redirect('/admin/profile');
    }

    /* ── Shared helpers ─────────────────────────────────────────── */

    private function adminView(string $view, array $data = []): void
    {
        $data['pageTitle'] = $data['pageTitle'] ?? 'Admin';
        $this->view('admin/' . $view, $data, 'admin');
    }

    /**
     * Handle an optional image upload. Returns the public URL path
     * (or the existing value when no new file was uploaded).
     */
    private function handleUpload(string $field, string $existing = ''): string
    {
        if (empty($_FILES[$field]) || ($_FILES[$field]['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) {
            return $existing;
        }

        $file = $_FILES[$field];

        if ($file['error'] !== UPLOAD_ERR_OK) {
            flash('error', 'There was a problem uploading the file.');
            return $existing;
        }

        if ($file['size'] > 5 * 1024 * 1024) {
            flash('error', 'Uploaded file must be smaller than 5MB.');
            return $existing;
        }

        $ext = strtolower(pathinfo((string) $file['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, self::ALLOWED_EXT, true)) {
            flash('error', 'Invalid file type. Allowed: ' . implode(', ', self::ALLOWED_EXT));
            return $existing;
        }

        if (!is_dir(UPLOAD_PATH)) {
            mkdir(UPLOAD_PATH, 0775, true);
        }

        $name = bin2hex(random_bytes(8)) . '.' . $ext;
        $target = UPLOAD_PATH . DIRECTORY_SEPARATOR . $name;

        if (!move_uploaded_file($file['tmp_name'], $target)) {
            flash('error', 'Could not save the uploaded file.');
            return $existing;
        }

        return UPLOAD_URL . '/' . $name;
    }
}
