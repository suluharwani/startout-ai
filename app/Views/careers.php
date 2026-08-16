<?php
/** Careers — applications via LinkedIn per revision */
$jobs = $jobs ?? [];
$linkedin = setting('company_linkedin', 'https://www.linkedin.com/company/startout-ai/');
?>
<section class="page-hero">
    <div class="container">
        <div class="breadcrumbs">
            <a href="<?= url('/') ?>">Home</a><i class="fa-solid fa-chevron-right"></i><span>Careers</span>
        </div>
        <span class="eyebrow">Careers</span>
        <h1>Build the future of customer experience</h1>
        <p class="lead mb-0" style="max-width:640px">Join our team in Yogyakarta, Indonesia — working at the intersection of AI and human-centered design.</p>
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
                    <div class="vc-icon"><i class="fa-solid fa-brain"></i></div>
                    <h4>Cutting-edge AI</h4>
                    <p>Work with the latest AI technologies and help shape the future of customer experience.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 reveal">
                <div class="value-card">
                    <div class="vc-icon"><i class="fa-solid fa-globe"></i></div>
                    <h4>Global impact</h4>
                    <p>Your work directly impacts customers and brands around the world.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 reveal">
                <div class="value-card">
                    <div class="vc-icon"><i class="fa-solid fa-users"></i></div>
                    <h4>Talented team</h4>
                    <p>Collaborate with some of the brightest minds in AI and customer experience.</p>
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
            <p class="sub mx-auto">All roles are based in Yogyakarta, Indonesia. Apply through our LinkedIn page.</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-9">
                <?php foreach ($jobs as $job): ?>
                <div class="job-card reveal">
                    <div>
                        <h4><?= e($job['title']) ?></h4>
                        <div class="job-meta">
                            <span class="job-badge cat"><i class="fa-solid fa-layer-group"></i><?= e($job['category']) ?></span>
                            <span class="job-badge"><i class="fa-solid fa-location-dot"></i><?= e($job['location']) ?></span>
                            <span class="job-badge"><i class="fa-solid fa-clock"></i><?= e($job['type']) ?></span>
                        </div>
                        <p class="mb-0 mt-2 small"><?= e($job['description']) ?></p>
                    </div>
                    <a href="<?= e($linkedin) ?>" target="_blank" rel="noopener" class="btn btn-primary">
                        <i class="fa-brands fa-linkedin me-2"></i>Apply on LinkedIn
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
