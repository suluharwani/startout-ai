<?= $this->include('templates/header') ?>

<!-- Hero Section -->
<section class="service-hero bg-dark text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 py-5">
                <h1 class="display-4 fw-bold mb-3"><?= $service['name'] ?></h1>
                <p class="lead mb-4"><?= $service['description'] ?></p>
                <a href="<?= base_url('contact') ?>" class="btn btn-primaryMenu btn-lg px-4 py-3">Request Consultation</a>
            </div>
            <div class="col-lg-6 d-none d-lg-block">
                <div class="dummy-img dummy-img-lg"><?= $service['name'] ?> Illustration</div>
            </div>
        </div>
    </div>
</section>

<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="bg-light py-3">
    <div class="container">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('services') ?>">Services</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $service['name'] ?></li>
        </ol>
    </div>
</nav>

<!-- Service Details -->
<section class="service-details py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <?php if ($service['detailed_description']): ?>
                    <?= $service['detailed_description'] ?>
                <?php else: ?>
                    <div class="service-content">
                        <h2>About Our <?= $service['name'] ?> Service</h2>
                        <p><?= $service['description'] ?></p>
                        
                        <h3>Key Features</h3>
                        <ul>
                            <li>Customized solutions for your business needs</li>
                            <li>Expert team with industry experience</li>
                            <li>Proven track record of success</li>
                            <li>Continuous support and optimization</li>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- Related Services -->
<?php if (!empty($relatedServices)): ?>
<section class="section bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center mb-5">
                <h2 class="section-title">Other Services You Might Like</h2>
            </div>
        </div>
        <div class="row g-4">
            <?php foreach ($relatedServices as $related): ?>
            <div class="col-md-4">
                <div class="service-card h-100 text-center">
                    <?php if ($related['icon_class']): ?>
                    <div class="service-icon bg-primary text-white rounded-circle mb-4 mx-auto">
                        <i class="<?= $related['icon_class'] ?>"></i>
                    </div>
                    <?php endif; ?>
                    <h4 class="mb-3"><?= $related['name'] ?></h4>
                    <p class="mb-4"><?= $related['description'] ?></p>
                    <a href="<?= base_url('services/' . $related['slug']) ?>" class="btn btn-outline-primary btn-sm">Learn More</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- CTA Section -->
<section class="section bg-primary text-white">
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h2 class="mb-4">Interested in Our <?= $service['name'] ?> Service?</h2>
                <p class="lead mb-5">Contact us today to learn how we can help your business.</p>
                <a href="<?= base_url('contact') ?>" class="btn btn-light btn-lg px-4 py-3">Get Started Today</a>
            </div>
        </div>
    </div>
</section>

<?= $this->include('templates/footer') ?>