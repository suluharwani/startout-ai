<?= $this->include('templates/header') ?>

<!-- Careers Hero Section -->
<section class="careers-hero bg-primary text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 py-5">
                <h1 class="display-4 fw-bold mb-3">Build the Future of Customer Experience</h1>
                <p class="lead mb-4">Join our team of innovators working at the intersection of AI and human-centered design.</p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="#open-positions" class="btn btn-light btn-lg px-4 py-3">View Open Positions</a>
                    <a href="#why-join-us" class="btn btn-outline-light btn-lg px-4 py-3">Why Join Us</a>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block">
                <div class="dummy-img dummy-img-lg">Team Collaboration</div>
            </div>
        </div>
    </div>
</section>

<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="bg-light py-3">
    <div class="container">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Careers</li>
        </ol>
    </div>
</nav>

<!-- Open Positions Section -->
<section id="open-positions" class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center mb-5">
                <h2 class="section-title">Open Positions</h2>
                <p class="lead">Explore opportunities to join our growing team</p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <?php if (!empty($jobPositions)): ?>
                    <div class="position-list">
                        <?php foreach ($jobPositions as $job): ?>
                        <div class="position-card mb-4">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body p-4">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h4 class="mb-2"><?= $job['title'] ?></h4>
                                            <div class="d-flex flex-wrap gap-3 mb-3">
                                                <span class="badge bg-light text-dark">
                                                    <i class="fas fa-map-marker-alt me-2"></i>
                                                    <?= $job['is_remote'] ? 'Remote' : $job['location'] ?>
                                                </span>
                                                <span class="badge bg-light text-dark">
                                                    <i class="fas fa-briefcase me-2"></i>
                                                    <?= ucfirst(str_replace('-', ' ', $job['employment_type'])) ?>
                                                </span>
                                                <span class="badge bg-light text-dark">
                                                    <i class="fas fa-users me-2"></i>
                                                    <?= $job['department'] ?>
                                                </span>
                                            </div>
                                        </div>
                                        <span class="badge bg-primary"><?= ucfirst($job['department']) ?></span>
                                    </div>
                                    <p class="mb-4"><?= character_limiter($job['description'], 200) ?></p>
                                    <a href="<?= base_url('careers/apply/' . $job['slug']) ?>" class="btn btn-primaryMenu">Apply Now</a>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-5">
                        <h3 class="text-muted">No open positions at the moment</h3>
                        <p class="text-muted">Check back later for new opportunities or submit a general application.</p>
                        <a href="<?= base_url('join') ?>" class="btn btn-primaryMenu">Submit General Application</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section bg-dark text-white">
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h2 class="mb-4">Don't See Your Dream Role?</h2>
                <p class="lead mb-5">We're always looking for talented individuals. Send us your resume and we'll contact you when a matching position opens.</p>
                <a href="<?= base_url('join') ?>" class="btn btn-light btn-lg px-4 py-3">Submit General Application</a>
            </div>
        </div>
    </div>
</section>

<?= $this->include('templates/footer') ?>