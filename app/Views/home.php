<?php
/** Home page */
$industries = $industries ?? [];
?>
<!-- ══════════ Hero ══════════ -->
<section class="hero">
    <div class="container">
        <div class="reveal">
            <span class="hero-eyebrow"><i class="fa-solid fa-bolt"></i> <?= e(setting('company_tagline')) ?></span>
        </div>
        <h1 class="reveal"><?= e($hero['title']) ?></h1>
        <p class="lead reveal"><?= e($hero['subtitle']) ?></p>
        <div class="hero-cta reveal">
            <a href="<?= e(url($hero['link'])) ?>" class="btn btn-primary btn-lg px-4 py-3">
                <i class="fa-solid fa-arrow-right me-2"></i><?= e($hero['button']) ?>
            </a>
        </div>
        <div class="hero-trust reveal">
            <span><i class="fa-solid fa-circle-check"></i> Dedicated remote teams</span>
            <span><i class="fa-solid fa-circle-check"></i> 24/7 operations</span>
            <span><i class="fa-solid fa-circle-check"></i> Enterprise-grade security</span>
        </div>
    </div>
</section>

<!-- ══════════ Intro / bento ══════════ -->
<section class="section">
    <div class="container">
        <div class="row align-items-end mb-5">
            <div class="col-lg-7 reveal">
                <span class="eyebrow"><?= e(setting('home_intro_kicker', 'Who We Are')) ?></span>
                <h2><?= e(setting('home_intro_title')) ?></h2>
            </div>
            <div class="col-lg-5 reveal">
                <p class="mb-0"><?= e(setting('home_intro_text')) ?></p>
            </div>
        </div>

        <div class="bento-grid">
            <div class="bento-card span-6 reveal">
                <div class="bc-icon" style="background:var(--primary-soft);color:var(--primary)"><i class="fa-solid fa-arrows-spin"></i></div>
                <h3>Your operations, orchestrated</h3>
                <p>We manage the people, processes and performance end-to-end — so you get consistent, high-quality output without the overhead.</p>
            </div>
            <div class="bento-card span-6 reveal">
                <div class="bc-icon" style="background:rgba(123,47,247,.12);color:var(--accent)"><i class="fa-solid fa-shield-halved"></i></div>
                <h3>Trust &amp; safety by design</h3>
                <p>Moderation, community management and policy operations that protect your brand and your users — 24/7, around the clock.</p>
            </div>
            <div class="bento-card span-4 reveal">
                <div class="bc-icon" style="background:rgba(0,194,255,.12);color:var(--accent-2)"><i class="fa-solid fa-chart-line"></i></div>
                <h3>Insight-led</h3>
                <p>Every decision stems from data. We calibrate with precision, forecast impact and scale dynamically.</p>
            </div>
            <div class="bento-card span-4 reveal">
                <div class="bc-icon" style="background:var(--primary-soft);color:var(--primary)"><i class="fa-solid fa-globe"></i></div>
                <h3>Global reach</h3>
                <p>Multi-language, multi-timezone coverage from dedicated remote teams around the world.</p>
            </div>
            <div class="bento-card span-4 reveal">
                <div class="bc-icon" style="background:rgba(123,47,247,.12);color:var(--accent)"><i class="fa-solid fa-gauge-high"></i></div>
                <h3>At any scale</h3>
                <p>From launch teams to enterprise volumes — we scale quality, not just capacity.</p>
            </div>
        </div>
    </div>
</section>

<!-- ══════════ Services ══════════ -->
<section class="section section-alt">
    <div class="container">
        <div class="section-head text-center mb-5 reveal">
            <span class="eyebrow" style="justify-content:center">Our Services</span>
            <h2>Everything your operations need</h2>
            <p class="sub mx-auto">One partner for data, safety, talent and experience — orchestrated around your goals.</p>
        </div>

        <div class="row g-4">
            <?php foreach ($services as $svc): ?>
            <div class="col-md-6 col-lg-3 reveal">
                <a class="service-card" href="<?= url('/services/' . $svc['slug']) ?>">
                    <span class="sc-icon"><i class="<?= e($svc['icon'] ?: 'fa-solid fa-briefcase') ?>"></i></span>
                    <h3><?= e($svc['name']) ?></h3>
                    <p><?= e(truncate($svc['short_description'] ?? '', 100)) ?></p>
                    <span class="sc-link">Learn more <i class="fa-solid fa-arrow-right"></i></span>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ══════════ Industries ══════════ -->
<?php if (!empty($industries)): ?>
<section class="section">
    <div class="container">
        <div class="section-head text-center mb-5 reveal">
            <span class="eyebrow" style="justify-content:center">Industries</span>
            <h2>Built for your world</h2>
            <p class="sub mx-auto">Dedicated practices for the industries that move fast and care deeply.</p>
        </div>
        <div class="row g-4">
            <?php foreach ($industries as $ind): ?>
            <div class="col-md-4 reveal">
                <a class="industry-chip" href="<?= url('/services/' . $ind['slug']) ?>">
                    <i class="<?= e($ind['icon'] ?: 'fa-solid fa-industry') ?>"></i>
                    <?= e($ind['name']) ?>
                    <i class="fa-solid fa-arrow-right ms-auto" style="opacity:.5"></i>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- ══════════ FAQ ══════════ -->
<?php if (!empty($faqs)): ?>
<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-head text-center mb-5 reveal">
                    <span class="eyebrow" style="justify-content:center">FAQ</span>
                    <h2>Questions, answered</h2>
                </div>
                <div class="d-flex flex-column gap-3 reveal">
                    <?php foreach ($faqs as $faq): ?>
                    <div class="faq-item">
                        <button type="button" class="faq-q">
                            <?= e($faq['question']) ?>
                            <i class="fa-solid fa-plus"></i>
                        </button>
                        <div class="faq-a"><p><?= e($faq['answer']) ?></p></div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- ══════════ CTA ══════════ -->
<section class="section section-alt">
    <div class="container">
        <div class="cta-banner reveal">
            <div class="container">
                <span class="eyebrow" style="color:#ffb27a;justify-content:center">Ready when you are</span>
                <h2 class="mb-3">Let's build your remote operation</h2>
                <p class="mx-auto mb-4" style="max-width:620px">Talk to our team about your goals — we'll show you exactly how a dedicated remote team can support your business.</p>
                <div class="d-flex justify-content-center gap-3 flex-wrap">
                    <a href="<?= e(wa_link(setting('schedule_wa_message', 'Hi Motrive, I would like to schedule a consultation.'))) ?>" target="_blank" rel="noopener" class="btn btn-light-solid btn-lg px-4 py-3">
                        <i class="fa-solid fa-calendar-check me-2"></i>Schedule Consultation
                    </a>
                    <a href="<?= url('/contact') ?>" class="btn btn-ghost-light btn-lg px-4 py-3">
                        <i class="fa-solid fa-envelope me-2"></i>Contact us
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
