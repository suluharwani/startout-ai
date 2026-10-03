<?php
/**
 * Site footer.
 * Twitter logo replaced with X, LinkedIn → company page, email icon → hi@motrive.com
 */
$navServices = \App\Models\Service::active();
$year        = date('Y');
$copyright   = str_replace('{year}', (string) $year, setting('copyright_text', '© {year} Motrive. All rights reserved.'));
?>
<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">
            <!-- Brand -->
            <div class="footer-brand">
                <a class="brand footer-brand-logo" href="<?= url('/') ?>">
                    <?= brand_logo() ?>
                </a>
                <p><?= e(setting('footer_about')) ?></p>
                <div class="social-row">
                    <a href="<?= e(setting('company_linkedin', 'https://www.linkedin.com/company/motrive/')) ?>" target="_blank" rel="noopener" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
                    <a href="<?= e(setting('company_x', 'https://x.com/motrive')) ?>" target="_blank" rel="noopener" aria-label="X (Twitter)"><i class="fa-brands fa-x-twitter"></i></a>
                    <a href="<?= e(setting('company_facebook', '#')) ?>" target="_blank" rel="noopener" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="<?= e(setting('company_instagram', '#')) ?>" target="_blank" rel="noopener" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                </div>
            </div>

            <!-- Services -->
            <div class="footer-col">
                <h5>Services</h5>
                <ul>
                    <?php foreach ($navServices as $svc): ?>
                    <li><a href="<?= url('/services/' . $svc['slug']) ?>"><?= e($svc['name']) ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Company -->
            <div class="footer-col">
                <h5>Company</h5>
                <ul>
                    <li><a href="<?= url('/about') ?>">About us</a></li>
                    <li><a href="<?= url('/careers') ?>">Careers</a></li>
                    <li><a href="<?= url('/resources') ?>">Resources</a></li>
                    <li><a href="<?= url('/contact') ?>">Contact</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div class="footer-col footer-contact">
                <h5>Get in touch</h5>
                <ul>
                    <li>
                        <a href="<?= e(wa_link()) ?>" target="_blank" rel="noopener">
                            <i class="fa-solid fa-phone"></i> <?= e('+' . preg_replace('/[^0-9]/', '', company_phone())) ?>
                        </a>
                    </li>
                    <li>
                        <a href="mailto:<?= e(company_email()) ?>">
                            <i class="fa-solid fa-envelope"></i> <?= e(company_email()) ?>
                        </a>
                    </li>
                    <li>
                        <a href="https://maps.google.com/?q=<?= e(rawurlencode(setting('company_address'))) ?>" target="_blank" rel="noopener">
                            <i class="fa-solid fa-location-dot"></i> <?= e(setting('company_city') . ', ' . setting('company_country')) ?>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <span><?= e($copyright) ?></span>
        </div>
    </div>
</footer>
