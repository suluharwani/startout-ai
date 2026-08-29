<?php
/** Service detail page */
$other = $other ?? [];
$faqs  = $faqs ?? [];
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
                    <a href="<?= e(wa_link(setting('schedule_wa_message', 'Hi Motrive, I would like to schedule a consultation.'))) ?>" target="_blank" rel="noopener" class="btn btn-primary btn-lg px-4 py-3">
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
                        <a href="<?= e(wa_link('Hi Motrive, I have a question about ' . $service['name'] . '.')) ?>" target="_blank" rel="noopener" class="btn btn-primary w-100">
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

