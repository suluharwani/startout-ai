<?= $this->include('templates/header') ?>

<!-- About Hero Section -->
<section class="about-hero bg-dark text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 py-5">
                <h1 class="display-4 fw-bold mb-3">Pioneering Intelligent Customer Experiences</h1>
                <p class="lead mb-4">Startout AI combines cutting-edge artificial intelligence with deep human expertise to transform how businesses connect with their customers.</p>
                <a href="#our-story" class="btn btn-primaryMenu btn-lg px-4 py-3">Our Story</a>
            </div>
            <div class="col-lg-6 d-none d-lg-block">
                <div class="dummy-img dummy-img-lg">About Us Illustration</div>
            </div>
        </div>
    </div>
</section>

<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="bg-light py-3">
    <div class="container">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">About Us</li>
        </ol>
    </div>
</nav>

<!-- Our Story Section -->
<section id="our-story" class="section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <h2 class="section-title mb-4">Our Story</h2>
                <p class="lead">Founded in 2015, Startout AI began with a simple mission: to revolutionize customer experience through intelligent technology.</p>
                <p>What started as a small team of AI enthusiasts has grown into an industry leader serving global brands across multiple sectors. Our journey has been marked by continuous innovation, from developing our first natural language processing algorithms to creating our patent-pending Cubeless security platform.</p>
                <p>Today, we're proud to support over 200 clients worldwide, helping them deliver exceptional customer experiences while optimizing their operations.</p>
            </div>
            <div class="col-lg-6">
                <?php if (!empty($milestones)): ?>
                <div class="timeline">
                    <?php foreach ($milestones as $milestone): ?>
                    <div class="timeline-item mb-4">
                        <div class="timeline-year bg-primary text-white rounded-pill px-3 py-1 d-inline-block mb-2">
                            <?= $milestone['year'] ?>
                        </div>
                        <div class="timeline-content">
                            <h5 class="mb-2"><?= $milestone['title'] ?></h5>
                            <p class="mb-0"><?= $milestone['description'] ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php else: ?>
                <div class="dummy-img dummy-img-lg">Company Timeline</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="section bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center mb-5">
                <h2 class="section-title">Meet Our Leadership Team</h2>
                <p class="lead">The visionaries driving Startout AI forward</p>
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
<section class="section bg-primary text-white">
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h2 class="mb-4">Ready to experience the Startout AI difference?</h2>
                <p class="lead mb-5">Contact us today to learn how we can transform your customer experience.</p>
                <a href="<?= base_url('contact') ?>" class="btn btn-light btn-lg px-4 py-3">Get in Touch</a>
            </div>
        </div>
    </div>
</section>

<?= $this->include('templates/footer') ?>