<?php
/**
 * Site header / navigation.
 */
$navServices  = \App\Models\Service::active();
$navFeatured  = \App\Models\Service::featured();
$active       = current_path();
?>
<header class="site-header">
    <div class="container header-inner">
        <!-- Brand -->
        <a class="brand" href="<?= url('/') ?>">
            <?php if (setting('company_logo')): ?>
                <img class="brand-img" src="<?= e(asset(setting('company_logo'))) ?>" alt="<?= e(setting('company_name')) ?>">
            <?php else: ?>
                <span class="brand-mark"><?= e(mb_substr(setting('company_logo_text', setting('company_name', 'S')), 0, 1)) ?></span>
            <?php endif; ?>
            <span class="brand-text"><?= e(setting('company_logo_text', setting('company_name'))) ?></span>
        </a>

        <!-- Desktop nav -->
        <nav class="main-nav" id="mainNav" aria-label="Main navigation">
            <ul class="nav-list">
                <li><a class="nav-link <?= $active === '/' ? 'is-active' : '' ?>" href="<?= url('/') ?>">Home</a></li>

                <li class="has-dropdown">
                    <a class="nav-link" href="<?= url('/services') ?>">Services <i class="fa-solid fa-chevron-down chev"></i></a>
                    <div class="dropdown-panel services-panel">
                        <div class="dp-head">
                            <span class="dp-title">What we do</span>
                            <a class="dp-all" href="<?= url('/services') ?>">All services <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                        <div class="dp-grid">
                            <?php foreach ($navServices as $svc): ?>
                            <a class="dp-item" href="<?= url('/services/' . $svc['slug']) ?>">
                                <span class="dp-icon"><i class="<?= e($svc['icon'] ?: 'fa-solid fa-briefcase') ?>"></i></span>
                                <span>
                                    <span class="dp-name"><?= e($svc['name']) ?></span>
                                    <span class="dp-desc"><?= e(truncate($svc['short_description'] ?? '', 62)) ?></span>
                                </span>
                            </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </li>

                <li class="has-dropdown">
                    <a class="nav-link" href="#">Industries <i class="fa-solid fa-chevron-down chev"></i></a>
                    <div class="dropdown-panel industries-panel">
                        <span class="dp-title">Areas of specialization</span>
                        <div class="dp-list">
                            <?php foreach ($navFeatured as $ind): ?>
                            <a class="dp-item" href="<?= url('/services/' . $ind['slug']) ?>">
                                <span class="dp-icon"><i class="<?= e($ind['icon'] ?: 'fa-solid fa-industry') ?>"></i></span>
                                <span class="dp-name"><?= e($ind['name']) ?></span>
                            </a>
                            <?php endforeach; ?>
                            <a class="dp-item" href="<?= url('/services') ?>">
                                <span class="dp-icon"><i class="fa-solid fa-layer-group"></i></span>
                                <span class="dp-name">View all services</span>
                            </a>
                        </div>
                    </div>
                </li>

                <li><a class="nav-link <?= $active === '/resources' ? 'is-active' : '' ?>" href="<?= url('/resources') ?>">Resources</a></li>

                <li class="has-dropdown">
                    <a class="nav-link" href="#">Company <i class="fa-solid fa-chevron-down chev"></i></a>
                    <div class="dropdown-panel company-panel">
                        <div class="dp-list">
                            <a class="dp-item" href="<?= url('/about') ?>"><span class="dp-icon"><i class="fa-solid fa-building"></i></span><span class="dp-name">About us</span></a>
                            <a class="dp-item" href="<?= url('/careers') ?>"><span class="dp-icon"><i class="fa-solid fa-briefcase"></i></span><span class="dp-name">Careers</span></a>
                            <a class="dp-item" href="<?= url('/join') ?>"><span class="dp-icon"><i class="fa-solid fa-user-plus"></i></span><span class="dp-name">Join us</span></a>
                            <a class="dp-item" href="<?= url('/contact') ?>"><span class="dp-icon"><i class="fa-solid fa-envelope"></i></span><span class="dp-name">Contact</span></a>
                        </div>
                    </div>
                </li>
            </ul>
        </nav>

        <!-- Header actions -->
        <div class="header-actions">
            <button class="theme-toggle" id="themeToggle" type="button" aria-label="Toggle dark mode">
                <i class="fa-solid fa-moon icon-moon"></i>
                <i class="fa-solid fa-sun icon-sun"></i>
            </button>
            <a href="<?= e(wa_link(setting('schedule_wa_message', 'Hi Startout AI, I would like to schedule a consultation.'))) ?>"
               target="_blank" rel="noopener" class="btn btn-primary btn-sm-cta d-none d-md-inline-flex">
                <i class="fa-solid fa-calendar-check me-2"></i> Schedule Consultation
            </a>
            <button class="hamburger" id="hamburger" type="button" aria-label="Open menu" aria-expanded="false">
                <span></span><span></span><span></span>
            </button>
        </div>
    </div>

    <!-- Mobile menu -->
    <div class="mobile-menu" id="mobileMenu">
        <div class="mm-head">
            <span class="brand-text"><?= e(setting('company_logo_text', setting('company_name'))) ?></span>
            <button class="mm-close" id="mmClose" type="button" aria-label="Close menu"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <nav>
            <a href="<?= url('/') ?>">Home</a>
            <div class="mm-group">
                <span class="mm-label">Services</span>
                <?php foreach ($navServices as $svc): ?>
                <a href="<?= url('/services/' . $svc['slug']) ?>"><i class="<?= e($svc['icon'] ?: 'fa-solid fa-briefcase') ?> me-2"></i><?= e($svc['name']) ?></a>
                <?php endforeach; ?>
            </div>
            <div class="mm-group">
                <span class="mm-label">Company</span>
                <a href="<?= url('/about') ?>">About us</a>
                <a href="<?= url('/careers') ?>">Careers</a>
                <a href="<?= url('/join') ?>">Join us</a>
                <a href="<?= url('/contact') ?>">Contact</a>
                <a href="<?= url('/resources') ?>">Resources</a>
            </div>
        </nav>
        <div class="mm-cta">
            <a href="<?= e(wa_link(setting('schedule_wa_message', 'Hi Startout AI, I would like to schedule a consultation.'))) ?>" target="_blank" rel="noopener" class="btn btn-primary w-100">
                <i class="fa-solid fa-calendar-check me-2"></i> Schedule Consultation
            </a>
        </div>
    </div>
    <div class="mobile-overlay" id="mobileOverlay"></div>
</header>
