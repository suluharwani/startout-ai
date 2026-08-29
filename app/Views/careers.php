<?php
/** Careers — openings via ATS feed or local database */
$jobs    = $jobs ?? [];
$feedUrl = $feedUrl ?? '';
$linkedin = setting('company_linkedin', 'https://www.linkedin.com/company/motrive/');
?>
<section class="page-hero">
    <div class="container">
        <div class="breadcrumbs">
            <a href="<?= url('/') ?>">Home</a><i class="fa-solid fa-chevron-right"></i><span>Careers</span>
        </div>
        <span class="eyebrow">Careers</span>
        <h1>Grow your career with Motrive</h1>
        <p class="lead mb-0" style="max-width:640px">Join our remote team and deliver meaningful work for ambitious brands around the world.</p>
        <div class="hero-cta">
            <a href="#open-positions" class="btn btn-primary btn-lg px-4 py-3">View open positions</a>
            <a href="<?= e($linkedin) ?>" target="_blank" rel="noopener" class="btn btn-outline btn-lg px-4 py-3">
                <i class="fa-brands fa-linkedin me-2"></i>Follow us on LinkedIn
            </a>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-head text-center mb-5 reveal">
            <span class="eyebrow" style="justify-content:center">Why join us</span>
            <h2>Work that matters, culture that supports you</h2>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-3 reveal">
                <div class="value-card">
                    <div class="vc-icon"><i class="fa-solid fa-earth-asia"></i></div>
                    <h4>Remote-first</h4>
                    <p>Work from anywhere with a team built around flexibility, trust and clear communication.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 reveal">
                <div class="value-card">
                    <div class="vc-icon"><i class="fa-solid fa-globe"></i></div>
                    <h4>Global impact</h4>
                    <p>Your work directly supports customers and brands around the world.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 reveal">
                <div class="value-card">
                    <div class="vc-icon"><i class="fa-solid fa-users"></i></div>
                    <h4>Talented team</h4>
                    <p>Collaborate with skilled, motivated people who care about doing great work.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 reveal">
                <div class="value-card">
                    <div class="vc-icon"><i class="fa-solid fa-chart-line"></i></div>
                    <h4>Growth opportunities</h4>
                    <p>We invest in your development with training, mentorship and clear career paths.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php if (!empty($jobs)): ?>
<section id="open-positions" class="section section-alt">
    <div class="container">
        <div class="section-head text-center mb-5 reveal">
            <span class="eyebrow" style="justify-content:center">Open positions</span>
            <h2>Explore current openings</h2>
            <p class="sub mx-auto">Openings are updated automatically from our recruiting system. Click Apply to see details and submit your application.</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-9">
                <?php foreach ($jobs as $job): ?>
                <?php
                $applyHref = !empty($job['apply_url']) ? $job['apply_url'] : $linkedin;
                $applyText = !empty($job['apply_url']) ? 'Apply now' : 'Apply on LinkedIn';
                $applyIcon = !empty($job['apply_url']) ? 'fa-paper-plane' : 'fa-brands fa-linkedin';
                ?>
                <div class="job-card reveal">
                    <div>
                        <h4><?= e($job['title']) ?></h4>
                        <div class="job-meta">
                            <span class="job-badge cat"><i class="fa-solid fa-layer-group"></i><?= e($job['category'] ?? 'Openings') ?></span>
                            <span class="job-badge"><i class="fa-solid fa-location-dot"></i><?= e($job['location']) ?></span>
                            <span class="job-badge"><i class="fa-solid fa-clock"></i><?= e($job['type']) ?></span>
                        </div>
                        <?php if (!empty($job['description'])): ?>
                        <p class="mb-0 mt-2 small"><?= e($job['description']) ?></p>
                        <?php endif; ?>
                    </div>
                    <a href="<?= e($applyHref) ?>" target="_blank" rel="noopener" class="btn btn-primary">
                        <i class="<?= $applyIcon ?> me-2"></i><?= $applyText ?>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<section class="section">
    <div class="container">
        <div class="cta-banner reveal">
            <div class="container">
                <h2 class="mb-3">Don't see your dream role?</h2>
                <p class="mx-auto mb-4" style="max-width:560px">We're always looking for talented people. Follow us on LinkedIn for the latest openings.</p>
                <a href="<?= e($linkedin) ?>" target="_blank" rel="noopener" class="btn btn-light-solid btn-lg px-4 py-3">
                    <i class="fa-brands fa-linkedin me-2"></i>Check our LinkedIn
                </a>
            </div>
        </div>
    </div>
</section>
