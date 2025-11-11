<?= $this->include('templates/header') ?>

<!-- Services Hero Section -->
<section class="services-hero bg-dark text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 py-5">
                <h1 class="display-4 fw-bold mb-3">Intelligent Customer Experience Solutions</h1>
                <p class="lead mb-4">Transform your customer interactions with our AI-powered services designed to deliver exceptional experiences at scale.</p>
                <a href="#our-services" class="btn btn-primaryMenu btn-lg px-4 py-3">Explore Our Services</a>
            </div>
            <div class="col-lg-6 d-none d-lg-block">
                <div class="dummy-img dummy-img-lg">AI Customer Service Illustration</div>
            </div>
        </div>
    </div>
</section>

<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="bg-light py-3">
    <div class="container">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Services</li>
        </ol>
    </div>
</nav>

<!-- Services Overview Section -->
<section id="our-services" class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center mb-5">
                <h2 class="section-title">Our Comprehensive Service Portfolio</h2>
                <p class="lead">From AI-powered automation to human-centered support, we offer a full spectrum of customer experience solutions tailored to your business needs.</p>
            </div>
        </div>
        
        <div class="row g-4">
            <?php foreach ($services as $service): ?>
            <div class="col-md-6 col-lg-4">
                <div class="service-card h-100 text-center">
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

<!-- CTA Section -->
<section class="section bg-primary text-white">
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h2 class="mb-4">Ready to transform your customer experience?</h2>
                <p class="lead mb-5">Our team is ready to help you find the perfect solution for your business needs.</p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="<?= base_url('contact') ?>" class="btn btn-light btn-lg px-4 py-3">Contact Us</a>
                    <a href="<?= base_url('contact') ?>" class="btn btn-outline-light btn-lg px-4 py-3">Request Demo</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->include('templates/footer') ?>