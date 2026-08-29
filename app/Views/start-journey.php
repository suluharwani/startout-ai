<?php /** Start Your Journey — consultation landing */ ?>
<section class="page-hero">
    <div class="container">
        <div class="breadcrumbs">
            <a href="<?= url('/') ?>">Home</a><i class="fa-solid fa-chevron-right"></i><span>Start Your Journey</span>
        </div>
        <span class="eyebrow">Start your journey</span>
        <h1>Let's build what truly matters</h1>
        <p class="lead mb-0" style="max-width:640px">Schedule a free consultation with our team. We'll map your goals to the right remote operations model — no pressure, no jargon.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="row g-5">
            <!-- How it works -->
            <div class="col-lg-7">
                <span class="eyebrow">How it works</span>
                <h2 class="mb-4">A simple path from hello to launch</h2>
                <div class="timeline">
                    <div class="timeline-item reveal">
                        <span class="tl-year">Step 01</span>
                        <h5>Schedule a consultation</h5>
                        <p>Reach us on WhatsApp or email and tell us what you're trying to achieve. We'll arrange a call that fits your timezone.</p>
                    </div>
                    <div class="timeline-item reveal">
                        <span class="tl-year">Step 02</span>
                        <h5>Discovery &amp; scoping</h5>
                        <p>We map your current operations, goals and constraints — then recommend the right blend of people, process and technology.</p>
                    </div>
                    <div class="timeline-item reveal">
                        <span class="tl-year">Step 03</span>
                        <h5>Proposal &amp; pilot</h5>
                        <p>You receive a clear proposal with a small pilot so you can see results before you commit to scale.</p>
                    </div>
                    <div class="timeline-item reveal">
                        <span class="tl-year">Step 04</span>
                        <h5>Launch &amp; optimize</h5>
                        <p>We launch, measure and continuously refine. Your operations keep getting better over time.</p>
                    </div>
                </div>
            </div>

            <!-- Contact card -->
            <div class="col-lg-5">
                <div class="form-card reveal">
                    <h3 class="mb-1">Schedule your consultation</h3>
                    <p class="text-muted mb-4">Choose whichever channel is easiest for you.</p>

                    <a href="<?= e(wa_link(setting('schedule_wa_message', 'Hi Motrive, I would like to schedule a consultation.'))) ?>" target="_blank" rel="noopener" class="btn btn-primary w-100 btn-lg mb-3">
                        <i class="fa-brands fa-whatsapp fa-lg me-2"></i> Chat on WhatsApp
                    </a>
                    <a href="mailto:<?= e(company_email()) ?>" class="btn btn-outline w-100 btn-lg mb-4">
                        <i class="fa-solid fa-envelope me-2"></i> Email <?= e(company_email()) ?>
                    </a>

                    <div class="side-card mb-0">
                        <h5><i class="fa-solid fa-circle-info me-2" style="color:var(--primary)"></i> Direct contact</h5>
                        <div class="contact-line"><i class="fa-solid fa-phone"></i><a href="<?= e(wa_link()) ?>" target="_blank" rel="noopener">+<?= e(preg_replace('/[^0-9]/', '', company_phone())) ?></a></div>
                        <div class="contact-line"><i class="fa-solid fa-envelope"></i><a href="mailto:<?= e(company_email()) ?>"><?= e(company_email()) ?></a></div>
                        <div class="contact-line"><i class="fa-solid fa-location-dot"></i><span><?= e(setting('company_city') . ', ' . setting('company_country')) ?></span></div>
                        <div class="contact-line"><i class="fa-solid fa-clock"></i><span>Available 24/7</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section section-alt">
    <div class="container">
        <div class="row g-4 text-center">
            <div class="col-md-4 reveal">
                <div class="value-card">
                    <div class="vc-icon"><i class="fa-solid fa-comment-dots"></i></div>
                    <h4>Free consultation</h4>
                    <p>No cost, no commitment — just honest advice on the best way forward.</p>
                </div>
            </div>
            <div class="col-md-4 reveal">
                <div class="value-card">
                    <div class="vc-icon"><i class="fa-solid fa-bolt"></i></div>
                    <h4>Fast response</h4>
                    <p>We usually reply within minutes on WhatsApp during business hours.</p>
                </div>
            </div>
            <div class="col-md-4 reveal">
                <div class="value-card">
                    <div class="vc-icon"><i class="fa-solid fa-lock"></i></div>
                    <h4>Confidential</h4>
                    <p>Your goals and data stay private. We sign NDA-friendly engagements.</p>
                </div>
            </div>
        </div>
    </div>
</section>
