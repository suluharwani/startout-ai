<?php
/** Join Us — applications via LinkedIn per revision */
$jobs = $jobs ?? [];
$linkedin = setting('company_linkedin', 'https://www.linkedin.com/company/startout-ai/');
?>
<section class="page-hero">
    <div class="container">
        <div class="breadcrumbs">
            <a href="<?= url('/') ?>">Home</a><i class="fa-solid fa-chevron-right"></i><span>Join Us</span>
        </div>
        <span class="eyebrow">Join us</span>
        <h1>Shape the future of customer experience</h1>
        <p class="lead mb-0" style="max-width:640px">Be part of a movement transforming how businesses connect with their customers through intelligent AI solutions.</p>
        <div class="hero-cta">
            <a href="<?= e($linkedin) ?>" target="_blank" rel="noopener" class="btn btn-primary btn-lg px-4 py-3">
                <i class="fa-brands fa-linkedin me-2"></i>Apply on LinkedIn
            </a>
            <a href="<?= url('/careers') ?>" class="btn btn-outline btn-lg px-4 py-3">View open positions</a>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-head text-center mb-5 reveal">
            <span class="eyebrow" style="justify-content:center">Why join</span>
            <h2>More than a job — a movement</h2>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-4 reveal">
                <div class="value-card">
                    <div class="vc-icon"><i class="fa-solid fa-scale-balanced"></i></div>
                    <h4>Work-life balance</h4>
                    <p>Flexible schedules and remote options help you thrive professionally and personally.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 reveal">
                <div class="value-card">
                    <div class="vc-icon"><i class="fa-solid fa-rocket"></i></div>
                    <h4>Impactful work</h4>
                    <p>Your contributions shape how businesses interact with millions of customers worldwide.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 reveal">
                <div class="value-card">
                    <div class="vc-icon"><i class="fa-solid fa-heart"></i></div>
                    <h4>Great benefits</h4>
                    <p>Comprehensive coverage, generous time off and competitive compensation.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section section-alt">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center reveal">
                <span class="eyebrow" style="justify-content:center">Our culture</span>
                <h2 class="mb-3">Life at Startout AI</h2>
                <p class="mb-5">We've built a culture that values innovation, collaboration and fun — with regular learning sessions, social events and a supportive community that celebrates wins together.</p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-4 reveal">
                <div class="value-card">
                    <div class="vc-icon"><i class="fa-solid fa-lightbulb"></i></div>
                    <h4>Keep learning</h4>
                    <p>Regular trainings, mentorship and budgets for professional development.</p>
                </div>
            </div>
            <div class="col-md-4 reveal">
                <div class="value-card">
                    <div class="vc-icon"><i class="fa-solid fa-handshake"></i></div>
                    <h4>Collaborate</h4>
                    <p>Great ideas come from anywhere — we encourage everyone to share.</p>
                </div>
            </div>
            <div class="col-md-4 reveal">
                <div class="value-card">
                    <div class="vc-icon"><i class="fa-solid fa-people-group"></i></div>
                    <h4>Grow together</h4>
                    <p>Clear paths to grow your career while doing meaningful work.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="cta-banner reveal">
            <div class="container">
                <h2 class="mb-3">Ready to join the team?</h2>
                <p class="mx-auto mb-4" style="max-width:560px">Head over to our LinkedIn page to see openings, meet the team and apply.</p>
                <a href="<?= e($linkedin) ?>" target="_blank" rel="noopener" class="btn btn-light-solid btn-lg px-4 py-3">
                    <i class="fa-brands fa-linkedin me-2"></i>Visit Startout AI on LinkedIn
                </a>
            </div>
        </div>
    </div>
</section>
