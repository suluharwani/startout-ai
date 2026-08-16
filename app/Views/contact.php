<?php
/** Contact page with CSRF-protected form */
$sent   = isset($_GET['sent']);
$errors = $_SESSION['_errors'] ?? [];
unset($_SESSION['_errors']);
?>
<section class="page-hero">
    <div class="container">
        <div class="breadcrumbs">
            <a href="<?= url('/') ?>">Home</a><i class="fa-solid fa-chevron-right"></i><span>Contact</span>
        </div>
        <span class="eyebrow">Contact us</span>
        <h1>Let's talk about your needs</h1>
        <p class="lead mb-0" style="max-width:640px">Send us a message or reach us directly — our team is ready to help you transform your customer interactions.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="row g-5">
            <!-- Form -->
            <div class="col-lg-7">
                <div class="form-card reveal">
                    <h3 class="mb-1">Send us a message</h3>
                    <p class="text-muted mb-4">Complete the form and our team will get back to you within 24 hours.</p>

                    <?php if ($sent): ?>
                    <div class="alert alert-success d-flex align-items-center gap-3">
                        <i class="fa-solid fa-circle-check fa-lg"></i>
                        <div>
                            <strong>Thank you!</strong> Your message has been sent. We'll get back to you shortly.
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if (!empty($errors['consent'])): ?>
                    <div class="alert alert-danger"><?= e($errors['consent']) ?></div>
                    <?php endif; ?>

                    <form method="post" action="<?= url('/contact') ?>" novalidate>
                        <?= csrf_field() ?>
                        <input type="text" name="website" value="" tabindex="-1" autocomplete="off" style="position:absolute;left:-9999px" aria-hidden="true">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="first_name">First Name *</label>
                                <input type="text" class="form-control <?= error_for('first_name') ? 'is-invalid' : '' ?>" id="first_name" name="first_name" value="<?= e(old('first_name')) ?>" required>
                                <?php if (error_for('first_name')): ?><div class="invalid-feedback"><?= e(error_for('first_name')) ?></div><?php endif; ?>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="last_name">Last Name *</label>
                                <input type="text" class="form-control <?= error_for('last_name') ? 'is-invalid' : '' ?>" id="last_name" name="last_name" value="<?= e(old('last_name')) ?>" required>
                                <?php if (error_for('last_name')): ?><div class="invalid-feedback"><?= e(error_for('last_name')) ?></div><?php endif; ?>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="email">Email Address *</label>
                            <input type="email" class="form-control <?= error_for('email') ? 'is-invalid' : '' ?>" id="email" name="email" value="<?= e(old('email')) ?>" required>
                            <?php if (error_for('email')): ?><div class="invalid-feedback"><?= e(error_for('email')) ?></div><?php endif; ?>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="company">Company Name</label>
                                <input type="text" class="form-control" id="company" name="company" value="<?= e(old('company')) ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="phone">Phone Number</label>
                                <input type="tel" class="form-control" id="phone" name="phone" value="<?= e(old('phone')) ?>">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="service">Service Interest *</label>
                            <select class="form-select <?= error_for('service') ? 'is-invalid' : '' ?>" id="service" name="service" required>
                                <option value="" selected disabled>Select a service</option>
                                <?php foreach ($services as $svc): ?>
                                <option value="<?= e($svc['name']) ?>" <?= old('service') === $svc['name'] ? 'selected' : '' ?>><?= e($svc['name']) ?></option>
                                <?php endforeach; ?>
                                <option value="Other" <?= old('service') === 'Other' ? 'selected' : '' ?>>Other</option>
                            </select>
                            <?php if (error_for('service')): ?><div class="invalid-feedback"><?= e(error_for('service')) ?></div><?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="message">Your Message *</label>
                            <textarea class="form-control <?= error_for('message') ? 'is-invalid' : '' ?>" id="message" name="message" rows="5" required><?= e(old('message')) ?></textarea>
                            <?php if (error_for('message')): ?><div class="invalid-feedback"><?= e(error_for('message')) ?></div><?php endif; ?>
                        </div>

                        <div class="mb-4 form-check">
                            <input type="checkbox" class="form-check-input" id="consent" name="consent" <?= isset($_POST['consent']) ? 'checked' : '' ?> required>
                            <label class="form-check-label small" for="consent">I agree to the privacy policy and consent to <?= e(setting('company_name')) ?> contacting me about my inquiry. *</label>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100 py-3">
                            <i class="fa-solid fa-paper-plane me-2"></i>Send Message
                        </button>
                    </form>
                </div>
            </div>

            <!-- Contact info -->
            <div class="col-lg-5">
                <div class="form-card reveal">
                    <h5 class="mb-4"><i class="fa-solid fa-circle-info me-2" style="color:var(--primary)"></i> Other ways to reach us</h5>

                    <div class="side-card">
                        <h5><i class="fa-solid fa-location-dot me-2" style="color:var(--primary)"></i> Location</h5>
                        <p class="mb-0"><?= e(setting('company_city') . ', ' . setting('company_country')) ?></p>
                    </div>

                    <div class="side-card">
                        <h5><i class="fa-solid fa-phone me-2" style="color:var(--primary)"></i> WhatsApp</h5>
                        <p class="mb-0"><a href="<?= e(wa_link()) ?>" target="_blank" rel="noopener">+<?= e(preg_replace('/[^0-9]/', '', company_phone())) ?></a></p>
                    </div>

                    <div class="side-card">
                        <h5><i class="fa-solid fa-envelope me-2" style="color:var(--primary)"></i> Email</h5>
                        <p class="mb-0"><a href="mailto:<?= e(company_email()) ?>"><?= e(company_email()) ?></a></p>
                    </div>

                    <div class="side-card">
                        <h5><i class="fa-brands fa-linkedin me-2" style="color:var(--primary)"></i> LinkedIn</h5>
                        <p class="mb-0"><a href="<?= e(setting('company_linkedin')) ?>" target="_blank" rel="noopener"><?= e(setting('company_name')) ?> on LinkedIn</a></p>
                    </div>

                    <a href="<?= e(wa_link(setting('schedule_wa_message', 'Hi Startout AI, I would like to schedule a consultation.'))) ?>" target="_blank" rel="noopener" class="btn btn-primary w-100 btn-lg">
                        <i class="fa-brands fa-whatsapp fa-lg me-2"></i>Schedule Consultation
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
