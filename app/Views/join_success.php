<?= $this->include('templates/header') ?>

<!-- Success Hero Section -->
<section class="success-hero bg-primary text-white">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8 py-5">
                <div class="success-icon bg-white text-primary rounded-circle mx-auto mb-4 d-flex align-items-center justify-content-center" style="width: 100px; height: 100px;">
                    <i class="fas fa-check fa-3x"></i>
                </div>
                <h1 class="display-4 fw-bold mb-3">Application Submitted!</h1>
                <p class="lead mb-4">Thank you for your interest in joining Startout AI. We have received your application and will review it carefully.</p>
                <div class="d-flex flex-wrap gap-3 justify-content-center">
                    <a href="<?= base_url() ?>" class="btn btn-light btn-lg px-4 py-3">Back to Home</a>
                    <a href="<?= base_url('careers') ?>" class="btn btn-outline-light btn-lg px-4 py-3">View Other Positions</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- What's Next Section -->
<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center mb-5">
                <h2 class="section-title">What Happens Next?</h2>
                <p class="lead">Here's what you can expect in our hiring process</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="process-step text-center p-4 h-100">
                    <div class="process-number bg-primary text-white rounded-circle mx-auto mb-4">1</div>
                    <h4 class="mb-3">Application Review</h4>
                    <p>Our recruitment team will review your application within 3-5 business days.</p>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="process-step text-center p-4 h-100">
                    <div class="process-number bg-primary text-white rounded-circle mx-auto mb-4">2</div>
                    <h4 class="mb-3">Initial Screening</h4>
                    <p>If there's a match, we'll contact you for an initial phone screening.</p>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="process-step text-center p-4 h-100">
                    <div class="process-number bg-primary text-white rounded-circle mx-auto mb-4">3</div>
                    <h4 class="mb-3">Interview Process</h4>
                    <p>Successful candidates will be invited for interviews with our team.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Info -->
<section class="section bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h3 class="mb-4">Have Questions?</h3>
                <p class="lead mb-4">Feel free to reach out to our recruitment team if you have any questions about your application.</p>
                <a href="<?= base_url('contact') ?>" class="btn btn-primaryMenu btn-lg px-4 py-3">Contact Recruitment</a>
            </div>
        </div>
    </div>
</section>

<?= $this->include('templates/footer') ?>