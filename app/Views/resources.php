<?php
/** Resources — no subscription form per revision */
$page = $page ?? null;
$faqs = $faqs ?? [];
?>
<section class="page-hero">
    <div class="container">
        <div class="breadcrumbs">
            <a href="<?= url('/') ?>">Home</a><i class="fa-solid fa-chevron-right"></i><span>Resources</span>
        </div>
        <span class="eyebrow">Resources</span>
        <h1><?= e($page['title'] ?? 'Guides, Insights & Case Studies') ?></h1>
        <p class="lead mb-0" style="max-width:640px"><?= e($page['subtitle'] ?? '') ?></p>
    </div>
</section>

<section class="section">
    <div class="container">
        <?php if ($page && !empty($page['content'])): ?>
            <?php
            // Convert HTML heading blocks into resource cards for a clean layout.
            $content = $page['content'];
            ?>
            <div class="row g-4 mb-5">
                <?php
                // Split content by <h3> headings to build cards.
                preg_match_all('/<h3>(.*?)<\/h3>\s*<p>(.*?)<\/p>/s', $content, $matches, PREG_SET_ORDER);
                if (!empty($matches)):
                ?>
                <?php foreach ($matches as $i => $m): ?>
                <div class="col-md-6 col-lg-4 reveal">
                    <a class="resource-card" href="<?= url('/contact') ?>">
                        <span class="rc-tag"><?= e(str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT)) ?> · Read</span>
                        <h3><?= e(trim(strip_tags($m[1]))) ?></h3>
                        <p><?= e(truncate(trim(strip_tags($m[2])), 140)) ?></p>
                    </a>
                </div>
                <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12">
                        <div class="form-card">
                            <?= $content /* trusted admin HTML */ ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-head text-center mb-5 reveal">
                    <span class="eyebrow" style="justify-content:center">FAQ</span>
                    <h2>Frequently asked questions</h2>
                </div>
                <div class="d-flex flex-column gap-3 reveal">
                    <?php foreach ($faqs as $faq): ?>
                    <div class="faq-item">
                        <button type="button" class="faq-q"><?= e($faq['question']) ?><i class="fa-solid fa-plus"></i></button>
                        <div class="faq-a"><p><?= e($faq['answer']) ?></p></div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section section-alt">
    <div class="container">
        <div class="cta-banner reveal">
            <div class="container">
                <h2 class="mb-3">Want the full playbook for your team?</h2>
                <p class="mx-auto mb-4" style="max-width:560px">Let's talk about your operation — we'll share tailored examples and benchmarks from our work.</p>
                <a href="<?= url('/start-journey') ?>" class="btn btn-light-solid btn-lg px-4 py-3">
                    <i class="fa-solid fa-arrow-right me-2"></i>Start Your Journey
                </a>
            </div>
        </div>
    </div>
</section>
