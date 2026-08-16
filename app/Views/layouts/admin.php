<?php
/**
 * Admin layout — sidebar + topbar shell.
 * Expected: $content, $pageTitle, $user (via auth_user()).
 */
$adminUser = auth_user();
$unread    = \App\Models\ContactMessage::unreadCount();
$cp = current_path();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle) ?> · Admin · <?= e(setting('company_name')) ?></title>
    <meta name="robots" content="noindex, nofollow">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><rect width='100' height='100' rx='24' fill='%23ff6a00'/><text x='50' y='68' font-size='52' font-family='Arial' font-weight='bold' text-anchor='middle' fill='white'>A</text></svg>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="<?= asset('/assets/css/admin.css') ?>">
</head>
<body>
<div class="adm-shell">

    <aside class="adm-sidebar">
        <a class="adm-brand" href="<?= url('/admin') ?>">
            <?php if (setting('company_logo')): ?>
                <img class="adm-brand-img" src="<?= e(asset(setting('company_logo'))) ?>" alt="<?= e(setting('company_name')) ?>">
            <?php else: ?>
                <span class="adm-brand-mark"><?= e(mb_substr(setting('company_name', 'S'), 0, 1)) ?></span>
            <?php endif; ?>
            <span><?= e(setting('company_name')) ?> <span style="opacity:.5;font-size:.7rem;display:block">Admin</span></span>
        </a>

        <nav class="adm-nav">
            <div class="adm-nav-label">Overview</div>
            <a href="<?= url('/admin') ?>" class="<?= $cp === '/admin' || $cp === '/admin/dashboard' ? 'active' : '' ?>"><i class="fa-solid fa-gauge"></i><span>Dashboard</span></a>

            <div class="adm-nav-label">Content</div>
            <a href="<?= url('/admin/settings') ?>" class="<?= str_starts_with($cp, '/admin/settings') ? 'active' : '' ?>"><i class="fa-solid fa-gear"></i><span>Company Profile</span></a>
            <a href="<?= url('/admin/services') ?>" class="<?= str_starts_with($cp, '/admin/services') ? 'active' : '' ?>"><i class="fa-solid fa-briefcase"></i><span>Services</span></a>
            <a href="<?= url('/admin/testimonials') ?>" class="<?= str_starts_with($cp, '/admin/testimonials') ? 'active' : '' ?>"><i class="fa-solid fa-quote-left"></i><span>Testimonials</span></a>
            <a href="<?= url('/admin/team') ?>" class="<?= str_starts_with($cp, '/admin/team') ? 'active' : '' ?>"><i class="fa-solid fa-user-group"></i><span>Team</span></a>
            <a href="<?= url('/admin/jobs') ?>" class="<?= str_starts_with($cp, '/admin/jobs') ? 'active' : '' ?>"><i class="fa-solid fa-briefcase"></i><span>Jobs</span></a>
            <a href="<?= url('/admin/faqs') ?>" class="<?= str_starts_with($cp, '/admin/faqs') ? 'active' : '' ?>"><i class="fa-solid fa-circle-question"></i><span>FAQs</span></a>
            <a href="<?= url('/admin/pages') ?>" class="<?= str_starts_with($cp, '/admin/pages') ? 'active' : '' ?>"><i class="fa-solid fa-file-lines"></i><span>Pages</span></a>

            <div class="adm-nav-label">Inbox</div>
            <a href="<?= url('/admin/messages') ?>" class="<?= str_starts_with($cp, '/admin/messages') ? 'active' : '' ?>">
                <i class="fa-solid fa-envelope"></i><span>Messages</span>
                <?php if ($unread > 0): ?><span class="badge bg-danger"><?= $unread ?></span><?php endif; ?>
            </a>
        </nav>

        <div class="adm-sidefoot">
            <a href="<?= url('/admin/profile') ?>" class="<?= str_starts_with($cp, '/admin/profile') ? 'active' : '' ?>"><i class="fa-solid fa-key"></i><span>Change Password</span></a>
            <form method="post" action="<?= url('/admin/logout') ?>" class="mt-1">
                <?= csrf_field() ?>
                <button type="submit" style="display:flex;align-items:center;gap:.7rem;width:100%;background:none;border:none;color:#cfd5ec;font-size:.88rem;padding:.55rem .5rem;border-radius:10px;cursor:pointer"><i class="fa-solid fa-right-from-bracket" style="width:18px"></i><span>Logout</span></button>
            </form>
        </div>
    </aside>

    <div class="adm-main">
        <div class="adm-topbar">
            <h1><?= e($pageTitle) ?></h1>
            <div class="adm-user">
                <a href="<?= url('/') ?>" class="btn-outline-adm" style="display:inline-block;padding:.5rem .9rem;font-size:.82rem"><i class="fa-solid fa-globe me-1"></i>View site</a>
                <div class="adm-avatar"><?= e(strtoupper(mb_substr($adminUser['name'] ?? 'A', 0, 1))) ?></div>
                <div style="line-height:1.2">
                    <strong style="font-size:.85rem"><?= e($adminUser['name'] ?? '') ?></strong><br>
                    <span style="font-size:.72rem;color:var(--adm-muted)"><?= e($adminUser['email'] ?? '') ?></span>
                </div>
            </div>
        </div>
        <div class="adm-content">
            <?php if ($msg = flash('success')): ?>
                <div class="adm-alert success"><i class="fa-solid fa-circle-check me-2"></i><?= e($msg) ?></div>
            <?php endif; ?>
            <?php if ($msg = flash('error')): ?>
                <div class="adm-alert error"><i class="fa-solid fa-triangle-exclamation me-2"></i><?= e($msg) ?></div>
            <?php endif; ?>

            <?= $content ?>
        </div>
    </div>
</div>
</body>
</html>
