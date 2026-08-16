<?php
/** About us */
$page = $page ?? null;
$team = $team ?? [];
?>
<section class="page-hero">
    <div class="container">
        <div class="breadcrumbs">
            <a href="<?= url('/') ?>">Home</a><i class="fa-solid fa-chevron-right"></i><span>About Us</span>
        </div>
        <span class="eyebrow">Who we are</span>
        <h1><?= e($page['title'] ?? setting('about_heading', 'Pioneering Intelligent Customer Experiences')) ?></h1>
        <p class="lead mb-0" style="max-width:660px"><?= e($page['subtitle'] ?? setting('about_text')) ?></p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 reveal">
                <span class="eyebrow">Our story</span>
                <h2 class="mb-4">Orchestrating people and AI since day one</h2>
                <?php if ($page && !empty($page['content'])): ?>
                    <?= $page['content'] /* trusted admin HTML */ ?>
                <?php else: ?>
                    <p>Startout AI combines cutting-edge artificial intelligence with deep human expertise to transform how businesses connect with their customers, communities and teams.</p>
                    <p>From a small team of specialists in Yogyakarta, Indonesia, we've grown into a trusted partner for brands that care deeply about how they show up online — at any scale, in any timezone.</p>
                <?php endif; ?>
            </div>
            <div class="col-lg-6 reveal">
                <div class="form-card">
                    <h5 class="mb-4">Our milestones</h5>
                    <div class="timeline">
                        <div class="timeline-item">
                            <span class="tl-year">Founded</span>
                            <h5>Startout AI is born</h5>
                            <p>Launched in Yogyakarta, Indonesia with a focus on AI-powered customer experience.</p>
                        </div>
                        <div class="timeline-item">
                            <span class="tl-year">Scale</span>
                            <h5>Trust &amp; safety at scale</h5>
                            <p>Built the operating model that now powers content moderation for global platforms.</p>
                        </div>
                        <div class="timeline-item">
                            <span class="tl-year">Today</span>
                            <h5>A harmonized AI partner</h5>
                            <p>Data annotation, talent, social, industries and automation — all under one roof.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section section-alt">
    <div class="container">
        <div class="section-head text-center mb-5 reveal">
            <span class="eyebrow" style="justify-content:center">Our values</span>
            <h2>What guides every decision</h2>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-3 reveal">
                <div class="value-card">
                    <div class="vc-icon"><i class="fa-solid fa-lightbulb"></i></div>
                    <h4>Innovation</h4>
                    <p>We constantly push boundaries to build smarter operating models.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 reveal">
                <div class="value-card">
                    <div class="vc-icon"><i class="fa-solid fa-handshake"></i></div>
                    <h4>Integrity</h4>
                    <p>We build trust through transparency, honesty and ethical practice.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 reveal">
                <div class="value-card">
                    <div class="vc-icon"><i class="fa-solid fa-users"></i></div>
                    <h4>Collaboration</h4>
                    <p>The best solutions come from working closely with our clients.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 reveal">
                <div class="value-card">
                    <div class="vc-icon"><i class="fa-solid fa-award"></i></div>
                    <h4>Excellence</h4>
                    <p>We're committed to exceptional quality in everything we do.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php if (!empty($team)): ?>
<section class="section">
    <div class="container">
        <div class="section-head text-center mb-5 reveal">
            <span class="eyebrow" style="justify-content:center">Leadership</span>
            <h2>Meet the team</h2>
            <p class="sub mx-auto">The people steering Startout AI forward.</p>
        </div>
        <div class="row g-4">
            <?php foreach ($team as $member): ?>
            <div class="col-md-6 col-lg-3 reveal">
                <div class="team-card">
                    <div class="t-photo"><?= e(strtoupper(mb_substr($member['name'], 0, 1))) ?></div>
                    <h4><?= e($member['name']) ?></h4>
                    <div class="role"><?= e($member['position']) ?></div>
                    <p><?= e($member['bio']) ?></p>
                    <div class="t-social">
                        <a href="<?= e($member['linkedin'] ?: setting('company_linkedin')) ?>" target="_blank" rel="noopener" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
                        <a href="mailto:<?= e(company_email()) ?>" aria-label="Email"><i class="fa-solid fa-envelope"></i></a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<section class="section section-alt">
    <div class="container">
        <div class="cta-banner reveal">
            <div class="container">
                <h2 class="mb-3">Let's build something that truly matters</h2>
                <p class="mx-auto mb-4" style="max-width:560px">Schedule a consultation and see how we can help your business thrive.</p>
                <a href="<?= url('/start-journey') ?>" class="btn btn-light-solid btn-lg px-4 py-3">
                    <i class="fa-solid fa-arrow-right me-2"></i>Start Your Journey
                </a>
            </div>
        </div>
    </div>
</section>
