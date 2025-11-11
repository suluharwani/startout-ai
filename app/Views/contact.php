<?= $this->include('templates/header') ?>

<!-- Contact Hero Section -->
<section class="contact-hero bg-dark text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 py-5">
                <h1 class="display-4 fw-bold mb-3">Let's talk about your customer experience needs</h1>
                <p class="lead mb-4">Our team is ready to help you transform your customer interactions with intelligent AI solutions.</p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="#contact-form" class="btn btn-primaryMenu btn-lg px-4 py-3">Send us a message</a>
                    <a href="#contact-info" class="btn btn-outline-light btn-lg px-4 py-3">Contact information</a>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block">
                <div class="dummy-img dummy-img-lg">Contact Us Illustration</div>
            </div>
        </div>
    </div>
</section>

<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="bg-light py-3">
    <div class="container">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
        </ol>
    </div>
</nav>

<!-- Contact Form Section -->
<section id="contact-form" class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-5">
                        <h2 class="text-center mb-4">Send us a message</h2>
                        <p class="text-center text-muted mb-5">Complete the form below and our team will get back to you within 24 hours.</p>
                        
                        <?php if (session()->getFlashdata('errors')): ?>
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                        <li><?= $error ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger">
                                <?= session()->getFlashdata('error') ?>
                            </div>
                        <?php endif; ?>
                        
                        <form action="<?= base_url('contact/submit') ?>" method="post">
                            <?= csrf_field() ?>
                            
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="firstName" class="form-label">First Name *</label>
                                    <input type="text" class="form-control" id="firstName" name="first_name" required>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="lastName" class="form-label">Last Name *</label>
                                    <input type="text" class="form-control" id="lastName" name="last_name" required>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="email" class="form-label">Email Address *</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            
                            <div class="mb-4">
                                <label for="company" class="form-label">Company Name</label>
                                <input type="text" class="form-control" id="company" name="company">
                            </div>
                            
                            <div class="mb-4">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" id="phone" name="phone">
                            </div>
                            
                            <div class="mb-4">
                                <label for="service" class="form-label">Service Interest *</label>
                                <select class="form-select" id="service" name="service_interest" required>
                                    <option value="" selected disabled>Select a service</option>
                                    <option value="customer-support">Customer Support</option>
                                    <option value="ai-automation">AI & Automation</option>
                                    <option value="content-moderation">Content Moderation</option>
                                    <option value="technical-support">Technical Support</option>
                                    <option value="crm-integration">CRM Integration</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            
                            <div class="mb-4">
                                <label for="message" class="form-label">Your Message *</label>
                                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                            </div>
                            
                            <div class="mb-4 form-check">
                                <input type="checkbox" class="form-check-input" id="consent" name="privacy_consent" required>
                                <label class="form-check-label" for="consent">I agree to the privacy policy and consent to Startout AI contacting me about my inquiry. *</label>
                            </div>
                            
                            <div class="text-center">
                                <button type="submit" class="btn btn-primaryMenu btn-lg px-5 py-3">Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Info Section -->
<section id="contact-info" class="section bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center mb-5">
                <h2 class="mb-3">Other ways to reach us</h2>
                <p class="lead">We're available through multiple channels to serve you better.</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="contact-method text-center p-4 h-100">
                    <div class="contact-icon bg-primary text-white rounded-circle mx-auto mb-4">
                        <i class="fas fa-map-marker-alt fa-lg"></i>
                    </div>
                    <h4 class="mb-3">Our Headquarters</h4>
                    <p class="mb-0"><?= $settings['company_address'] ?? '123 AI Boulevard, San Francisco, CA 94107, United States' ?></p>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="contact-method text-center p-4 h-100">
                    <div class="contact-icon bg-primary text-white rounded-circle mx-auto mb-4">
                        <i class="fas fa-phone-alt fa-lg"></i>
                    </div>
                    <h4 class="mb-3">Call Us</h4>
                    <p class="mb-2"><strong>Sales:</strong> <?= $settings['phone_sales'] ?? '+1 (800) 123-4567' ?></p>
                    <p class="mb-0"><strong>Support:</strong> <?= $settings['phone_support'] ?? '+1 (800) 987-6543' ?></p>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="contact-method text-center p-4 h-100">
                    <div class="contact-icon bg-primary text-white rounded-circle mx-auto mb-4">
                        <i class="fas fa-envelope fa-lg"></i>
                    </div>
                    <h4 class="mb-3">Email Us</h4>
                    <p class="mb-2"><strong>General:</strong> <?= $settings['company_email'] ?? 'info@startoutai.com' ?></p>
                    <p class="mb-0"><strong>Support:</strong> <?= $settings['support_email'] ?? 'support@startoutai.com' ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center mb-5">
                <h2 class="mb-3">Meet our leadership team</h2>
                <p class="lead">Get to know the experts behind Startout AI's innovative solutions.</p>
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
                <p class="lead mb-5">Schedule a consultation with our experts today and discover how Startout AI can help your business.</p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="#contact-form" class="btn btn-light btn-lg px-4 py-3 fw-bold">Get Started</a>
                    <a href="tel:<?= preg_replace('/[^0-9+]/', '', $settings['phone_sales'] ?? '+18001234567') ?>" class="btn btn-outline-light btn-lg px-4 py-3 fw-bold">
                        <i class="fas fa-phone-alt me-2"></i> Call Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->include('templates/footer') ?>