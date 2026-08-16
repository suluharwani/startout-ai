<?php
/** Service detail page */
$other = $other ?? [];
$faqs  = $faqs ?? [];
$testimonials = $testimonials ?? [];
?>
<section class="service-hero">
    <div class="container">
        <div class="breadcrumbs">
            <a href="<?= url('/') ?>">Home</a><i class="fa-solid fa-chevron-right"></i>
            <a href="<?= url('/services') ?>">Services</a><i class="fa-solid fa-chevron-right"></i>
            <span><?= e($service['name']) ?></span>
        </div>
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="sh-icon"><i class="<?= e($service['icon'] ?: 'fa-solid fa-briefcase') ?>"></i></div>
                <h1><?= e($service['name']) ?></h1>
                <p class="lead"><?= e($service['tagline'] ?? $service['short_description']) ?></p>
                <div class="d-flex flex-wrap gap-3 mt-4">
                    <a href="<?= e(wa_link(setting('schedule_wa_message', 'Hi Startout AI, I would like to schedule a consultation.'))) ?>" target="_blank" rel="noopener" class="btn btn-primary btn-lg px-4 py-3">
                        <i class="fa-solid fa-calendar-check me-2"></i>Schedule Consultation
                    </a>
                    <a href="<?= url('/start-journey') ?>" class="btn btn-outline btn-lg px-4 py-3">
                        <i class="fa-solid fa-arrow-right me-2"></i>Start Your Journey
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <article class="service-content reveal">
                    <?= $service['description'] /* trusted admin HTML */ ?>
                </article>

                <?php if (!empty($faqs)): ?>
                <div class="mt-5">
                    <h2 class="h3 mb-4">Common questions</h2>
                    <div class="d-flex flex-column gap-3">
                        <?php foreach ($faqs as $faq): ?>
                        <div class="faq-item">
                            <button type="button" class="faq-q"><?= e($faq['question']) ?><i class="fa-solid fa-plus"></i></button>
                            <div class="faq-a"><p><?= e($faq['answer']) ?></p></div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <div class="col-lg-4">
                <aside class="reveal">
                    <div class="side-card">
                        <h5><i class="fa-solid fa-headset me-2" style="color:var(--primary)"></i> Talk to a specialist</h5>
                        <p class="small">Chat with our team on WhatsApp — we usually reply within minutes.</p>
                        <a href="<?= e(wa_link('Hi Startout AI, I have a question about ' . $service['name'] . '.')) ?>" target="_blank" rel="noopener" class="btn btn-primary w-100">
                            <i class="fa-brands fa-whatsapp me-2"></i>WhatsApp us
                        </a>
                    </div>
                    <div class="side-card">
                        <h5>Contact</h5>
                        <div class="contact-line"><i class="fa-solid fa-envelope"></i><a href="mailto:<?= e(company_email()) ?>"><?= e(company_email()) ?></a></div>
                        <div class="contact-line"><i class="fa-solid fa-phone"></i><a href="<?= e(tel_link()) ?>">+<?= e(preg_replace('/[^0-9]/', '', company_phone())) ?></a></div>
                        <div class="contact-line"><i class="fa-solid fa-location-dot"></i><span><?= e(setting('company_city') . ', ' . setting('company_country')) ?></span></div>
                    </div>
                    <div class="side-card">
                        <h5>More services</h5>
                        <?php foreach ($other as $osvc): ?>
                            <?php if ($osvc['id'] === $service['id']) continue; ?>
                            <a class="other-service" href="<?= url('/services/' . $osvc['slug']) ?>">
                                <span class="dp-icon"><i class="<?= e($osvc['icon'] ?: 'fa-solid fa-briefcase') ?>"></i></span>
                                <span><?= e($osvc['name']) ?></span>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</section>

<?php if (!empty($testimonials)): ?>
<section class="section section-alt">
    <div class="container">
        <div class="section-head text-center mb-5 reveal">
            <span class="eyebrow" style="justify-content:center">Results</span>
            <h2>What partners say</h2>
        </div>
        <div class="row g-4">
            <?php foreach (array_slice($testimonials, 0, 3) as $t): ?>
            <div class="col-md-4 reveal">
                <div class="testimonial-card">
                    <div class="stars">★★★★★</div>
                    <p class="quote">“<?= e($t['content']) ?>”</p>
                    <div class="d-flex align-items-center gap-3">
                        <div class="t-avatar"><?= e(strtoupper(mb_substr($t['name'], 0, 1))) ?></div>
                        <div class="t-meta">
                            <h6><?= e($t['name']) ?></h6>
                            <span><?= e(trim(($t['role'] ?? '') . ($t['company'] ? ' · ' . $t['company'] : ''))) ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>
