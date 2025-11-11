    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <div class="fw-bold fs-3 mb-3">Startout AI</div>
                    <p><?= $settings['site_description'] ?? 'Intelligent customer experience solutions powered by the perfect blend of humans and technology.' ?></p>
                </div>
                <div class="col-lg-2 col-md-4 mb-4 mb-md-0">
                    <h5 class="text-white mb-3">Services</h5>
                    <ul class="list-unstyled">
                        <?php foreach ($services as $service): ?>
                        <li class="mb-2"><a href="<?= base_url('services/' . $service['slug']) ?>" class="text-white-50 text-decoration-none"><?= $service['name'] ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-4 mb-4 mb-md-0">
                    <h5 class="text-white mb-3">Industries</h5>
                    <ul class="list-unstyled">
                        <?php foreach ($industries as $industry): ?>
                        <li class="mb-2"><a href="<?= base_url('industries/' . $industry['slug']) ?>" class="text-white-50 text-decoration-none"><?= $industry['name'] ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-4 mb-4 mb-md-0">
                    <h5 class="text-white mb-3">Company</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="<?= base_url('about') ?>" class="text-white-50 text-decoration-none">About</a></li>
                        <li class="mb-2"><a href="<?= base_url('careers') ?>" class="text-white-50 text-decoration-none">Careers</a></li>
                        <li class="mb-2"><a href="<?= base_url('contact') ?>" class="text-white-50 text-decoration-none">Contact</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-12">
                    <h5 class="text-white mb-3">Connect</h5>
                    <div class="d-flex gap-3 mb-3">
                        <?php if (!empty($settings['social_linkedin'])): ?>
                        <a href="<?= $settings['social_linkedin'] ?>" class="text-white"><i class="fab fa-linkedin fa-lg"></i></a>
                        <?php endif; ?>
                        <?php if (!empty($settings['social_twitter'])): ?>
                        <a href="<?= $settings['social_twitter'] ?>" class="text-white"><i class="fab fa-twitter fa-lg"></i></a>
                        <?php endif; ?>
                        <?php if (!empty($settings['social_facebook'])): ?>
                        <a href="<?= $settings['social_facebook'] ?>" class="text-white"><i class="fab fa-facebook fa-lg"></i></a>
                        <?php endif; ?>
                    </div>
                    <a href="<?= base_url('contact') ?>" class="btn btn-primaryMenu">Get in Touch</a>
                </div>
            </div>
            <hr class="my-4 bg-secondary">
            <div class="row">
                <div class="col-md-6 mb-3 mb-md-0">
                    <p class="small mb-0">©2025 <?= $settings['company_name'] ?? 'Startout AI, Inc.' ?>. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="small mb-0">To ensure you get the best experience, we use cookies on our website.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Chat Widget Script -->
    <script>
        // Simple chat widget implementation
        document.addEventListener('DOMContentLoaded', function() {
            // Chat widget functionality can be added here
            console.log('Startout AI website loaded successfully');
        });
    </script>
</body>
</html>