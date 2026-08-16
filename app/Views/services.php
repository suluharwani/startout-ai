<?php /** Services overview */ ?>
<section class="page-hero">
    <div class="container">
        <div class="breadcrumbs">
            <a href="<?= url('/') ?>">Home</a><i class="fa-solid fa-chevron-right"></i><span>Services</span>
        </div>
        <span class="eyebrow">What we do</span>
        <h1>Services designed for modern operations</h1>
        <p class="lead mb-0" style="max-width:640px">From training data to trust &amp; safety, talent and automation — every service is built on the same human-in-the-loop operating model.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="row g-4">
            <?php foreach ($services as $i => $svc): ?>
            <div class="col-md-6 col-lg-4 reveal">
                <a class="service-card" href="<?= url('/services/' . $svc['slug']) ?>">
                    <span class="sc-icon"><i class="<?= e($svc['icon'] ?: 'fa-solid fa-briefcase') ?>"></i></span>
                    <span class="eyebrow" style="margin-bottom:0"><?= e($svc['tagline']) ?></span>
                    <h3><?= e($svc['name']) ?></h3>
                    <p><?= e($svc['short_description']) ?></p>
                    <span class="sc-link">Explore service <i class="fa-solid fa-arrow-right"></i></span>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section section-alt">
    <div class="container">
        <div class="cta-banner reveal">
            <div class="container">
                <h2 class="mb-3">Not sure where to start?</h2>
                <p class="mx-auto mb-4" style="max-width:560px">Tell us what you're trying to achieve and we'll recommend the right combination of services.</p>
                <a href="<?= e(wa_link(setting('schedule_wa_message', 'Hi Startout AI, I would like to schedule a consultation.'))) ?>" target="_blank" rel="noopener" class="btn btn-light-solid btn-lg px-4 py-3">
                    <i class="fa-solid fa-calendar-check me-2"></i>Schedule Consultation
                </a>
            </div>
        </div>
    </div>
</section>
