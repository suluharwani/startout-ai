<?= $this->include('templates/header') ?>

<!-- Industries Hero Section -->
<section class="industries-hero bg-dark text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 py-5">
                <h1 class="display-4 fw-bold mb-3">Industries We Serve</h1>
                <p class="lead mb-4">Specialized solutions tailored to your industry's unique challenges and opportunities.</p>
                <a href="#industries-list" class="btn btn-primaryMenu btn-lg px-4 py-3">Explore Industries</a>
            </div>
            <div class="col-lg-6 d-none d-lg-block">
                <div class="dummy-img dummy-img-lg">Industries Illustration</div>
            </div>
        </div>
    </div>
</section>

<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="bg-light py-3">
    <div class="container">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Industries</li>
        </ol>
    </div>
</nav>

<!-- Industries List -->
<section id="industries-list" class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center mb-5">
                <h2 class="section-title">Our Industry Expertise</h2>
                <p class="lead">We have deep experience across multiple sectors, delivering tailored solutions for each industry's unique needs.</p>
            </div>
        </div>
        
        <div class="row g-4">
            <?php foreach ($industries as $industry): ?>
            <div class="col-md-6 col-lg-4">
                <div class="industry-card h-100 p-4 text-center">
                    <h3 class="mb-3"><?= $industry['name'] ?></h3>
                    <p class="mb-4"><?= $industry['description'] ?></p>
                    <a href="<?= base_url('industries/' . $industry['slug']) ?>" class="btn btn-outline-primary">Learn More</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="section bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center mb-5">
                <h2 class="section-title">Our Services Across Industries</h2>
                <p class="lead">Comprehensive solutions that work for every sector</p>
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
                    <h4 class="mb-3"><?= $service['name'] ?></h4>
                    <p class="mb-4"><?= $service['description'] ?></p>
                    <a href="<?= base_url('services/' . $service['slug']) ?>" class="btn btn-outline-primary btn-sm">Learn More</a>
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
                <h2 class="mb-4">Ready to Transform Your Industry Experience?</h2>
                <p class="lead mb-5">Contact us to discuss how we can help your specific industry needs.</p>
                <a href="<?= base_url('contact') ?>" class="btn btn-light btn-lg px-4 py-3">Get Industry Solution</a>
            </div>
        </div>
    </div>
</section>

<?= $this->include('templates/footer') ?>