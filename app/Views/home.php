<?= $this->include('templates/header') ?>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container text-center">
            <h1 class="fw-bold mb-4 display-4">Harmonized AI for What Truly Matters</h1>
            <p class="lead mb-5 fs-5">Achieve KPIs, scale support, nurture trust, and unify communities, while trimming costs. Startout AI makes it effortless</p>
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <a href="<?= base_url('contact') ?>" class="btn btn-outline-light btn-lg px-4 py-3 fw-bold">Let's talk</a>
                <a href="<?= base_url('services') ?>" class="btn btn-light btn-lg px-4 py-3 fw-bold">Our Services</a>
            </div>
        </div>
    </section>

    <!-- Intro Section -->
    <section class="section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h2 class="section-title display-5">Hybrid by Design. Intelligent by Nature</h2>
                    <p class="lead fs-6">Startout AI isn't just about outsourcing, it's about orchestrating people and AI for maximum impact</p>
                    <p>From day one, we've helped businesses thrive. Innovation leads the way, but our mission stays true.</p>
                </div>
                <div class="col-lg-6">
                    <div class="dummy-img dummy-img-lg">Team Collaboration</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="section bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center mb-5">
                    <h2 class="section-title">Our Services</h2>
                    <p class="lead">Comprehensive AI-powered solutions for modern businesses</p>
                </div>
            </div>
            <div class="row g-4">
                <?php foreach ($services as $service): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="service-card text-center">
                        <?php if ($service['icon_class']): ?>
                        <div class="service-icon bg-primary text-white rounded-circle mb-4 mx-auto">
                            <i class="<?= $service['icon_class'] ?>"></i>
                        </div>
                        <?php endif; ?>
                        <h3 class="mb-3"><?= $service['name'] ?></h3>
                        <p class="mb-4"><?= $service['description'] ?></p>
                        <a href="<?= base_url('services/' . $service['slug']) ?>" class="btn btn-outline-primary">Learn More</a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Data Driven Section -->
    <section class="section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 order-lg-2 mb-4 mb-lg-0">
                    <h2 class="section-title">Insight-Led</h2>
                    <p class="lead">Results that matter begin with understanding.</p>
                    <p>At Startout AI, every decision stems from data. We calibrate your project with precision, forecast impact, and scale dynamically. From CX excellence to moderation mastery, continuous refinement is what sets us apart.</p>
                </div>
                <div class="col-lg-6 order-lg-1">
                    <div class="dummy-img dummy-img-lg">Data Analytics Dashboard</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Industries Section -->
    <section class="section bg-primary text-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center mb-5">
                    <h2 class="section-title text-white">Industries We Serve</h2>
                    <p class="lead">Specialized solutions for diverse business sectors</p>
                </div>
            </div>
            <div class="row g-4">
                <?php foreach ($industries as $industry): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="service-card bg-white text-dark">
                        <h4 class="mb-3"><?= $industry['name'] ?></h4>
                        <p class="mb-0"><?= $industry['description'] ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center mb-5">
                    <h2 class="section-title">Meet Our Leadership</h2>
                    <p class="lead">The experts driving Startout AI forward</p>
                </div>
            </div>
            <div class="row g-4">
                <?php foreach ($teamMembers as $member): ?>
                <div class="col-md-4">
                    <div class="team-card text-center">
                        <div class="team-img mb-4">
                            <div class="dummy-img dummy-img-sm rounded-circle mx-auto">
                                <?= substr($member['first_name'], 0, 1) . substr($member['last_name'], 0, 1) ?>
                            </div>
                        </div>
                        <h4 class="mb-2"><?= $member['first_name'] ?> <?= $member['last_name'] ?></h4>
                        <p class="text-muted mb-3"><?= $member['position'] ?></p>
                        <p class="small"><?= $member['bio'] ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section bg-dark text-white">
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h2 class="mb-4">Ready to experience the Startout AI difference?</h2>
                    <p class="lead mb-5">Contact us today to learn how we can transform your customer experience.</p>
                    <a href="<?= base_url('contact') ?>" class="btn btn-primaryMenu btn-lg px-4 py-3">Get in Touch</a>
                </div>
            </div>
        </div>
    </section>

<?= $this->include('templates/footer') ?>