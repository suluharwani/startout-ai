<?php
/**
 * Company profile settings editor.
 * $settings: key → value map. $keys: whitelisted keys.
 */
$val = fn (string $k): string => (string) ($settings[$k] ?? '');
?>
<form method="post" action="<?= url('/admin/settings') ?>" enctype="multipart/form-data" class="adm-form">
    <?= csrf_field() ?>

    <!-- Branding: logo & favicon -->
    <div class="adm-card mb-3">
        <div class="card-head"><h3><i class="fa-solid fa-image me-2" style="color:var(--adm-primary)"></i>Logo &amp; Favicon</h3></div>
        <div class="card-body">
            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label">Company logo</label>
                    <div class="branding-preview" style="margin-bottom:.6rem">
                        <?php if ($val('company_logo')): ?>
                            <img src="<?= e(asset($val('company_logo'))) ?>" alt="Logo">
                        <?php else: ?>
                            <span class="branding-empty">No logo uploaded — showing the default text logo</span>
                        <?php endif; ?>
                    </div>
                    <input type="file" class="form-control" name="company_logo_file" accept="image/*">
                    <div class="form-text">PNG / JPG / SVG / WebP, max 5MB. Shown in the header, footer and admin panel.</div>
                    <?php if ($val('company_logo')): ?>
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" name="remove_logo" id="remove_logo">
                        <label class="form-check-label" for="remove_logo">Remove current logo</label>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Favicon</label>
                    <div class="branding-preview branding-preview-fav" style="margin-bottom:.6rem">
                        <?php if ($val('company_favicon')): ?>
                            <img src="<?= e(asset($val('company_favicon'))) ?>" alt="Favicon">
                        <?php else: ?>
                            <span class="branding-empty">No favicon uploaded — using the default icon</span>
                        <?php endif; ?>
                    </div>
                    <input type="file" class="form-control" name="company_favicon_file" accept="image/*,.ico">
                    <div class="form-text">Small icon shown in the browser tab. PNG / ICO / JPG / SVG.</div>
                    <?php if ($val('company_favicon')): ?>
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" name="remove_favicon" id="remove_favicon">
                        <label class="form-check-label" for="remove_favicon">Remove current favicon</label>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- General -->
    <div class="adm-card mb-3">
        <div class="card-head"><h3><i class="fa-solid fa-building me-2" style="color:var(--adm-primary)"></i>General</h3></div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Company name</label>
                    <input type="text" class="form-control" name="company_name" value="<?= e($val('company_name')) ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Logo text (shown in navbar/footer)</label>
                    <input type="text" class="form-control" name="company_logo_text" value="<?= e($val('company_logo_text')) ?>">
                </div>
                <div class="col-md-12">
                    <label class="form-label">Tagline</label>
                    <input type="text" class="form-control" name="company_tagline" value="<?= e($val('company_tagline')) ?>">
                </div>
                <div class="col-md-12">
                    <label class="form-label">Meta description (SEO)</label>
                    <textarea class="form-control" name="company_description" rows="3"><?= e($val('company_description')) ?></textarea>
                </div>
            </div>
        </div>
    </div>

    <!-- Hero -->
    <div class="adm-card mb-3">
        <div class="card-head"><h3><i class="fa-solid fa-wand-magic-sparkles me-2" style="color:var(--adm-primary)"></i>Homepage hero</h3></div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-12">
                    <label class="form-label">Hero title</label>
                    <input type="text" class="form-control" name="hero_title" value="<?= e($val('hero_title')) ?>">
                </div>
                <div class="col-md-12">
                    <label class="form-label">Hero subtitle</label>
                    <textarea class="form-control" name="hero_subtitle" rows="2"><?= e($val('hero_subtitle')) ?></textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Primary button text</label>
                    <input type="text" class="form-control" name="hero_button_text" value="<?= e($val('hero_button_text')) ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Primary button link</label>
                    <input type="text" class="form-control" name="hero_button_link" value="<?= e($val('hero_button_link')) ?>" placeholder="/contact">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Intro kicker</label>
                    <input type="text" class="form-control" name="home_intro_kicker" value="<?= e($val('home_intro_kicker')) ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Intro title</label>
                    <input type="text" class="form-control" name="home_intro_title" value="<?= e($val('home_intro_title')) ?>">
                </div>
                <div class="col-md-12">
                    <label class="form-label">Intro text</label>
                    <textarea class="form-control" name="home_intro_text" rows="2"><?= e($val('home_intro_text')) ?></textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label">About heading</label>
                    <input type="text" class="form-control" name="about_heading" value="<?= e($val('about_heading')) ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label">About text</label>
                    <input type="text" class="form-control" name="about_text" value="<?= e($val('about_text')) ?>">
                </div>
            </div>
        </div>
    </div>

    <!-- Contact -->
    <div class="adm-card mb-3">
        <div class="card-head"><h3><i class="fa-solid fa-address-book me-2" style="color:var(--adm-primary)"></i>Contact</h3></div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Email (public)</label>
                    <input type="text" class="form-control" name="company_email" value="<?= e($val('company_email')) ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Phone / WhatsApp number</label>
                    <input type="text" class="form-control" name="company_phone" value="<?= e($val('company_phone')) ?>" placeholder="628602268666">
                    <div class="form-text">International format, e.g. 628602268666</div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">WhatsApp (for schedule buttons)</label>
                    <input type="text" class="form-control" name="company_whatsapp" value="<?= e($val('company_whatsapp')) ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Pre-filled WhatsApp message</label>
                    <input type="text" class="form-control" name="schedule_wa_message" value="<?= e($val('schedule_wa_message')) ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">City</label>
                    <input type="text" class="form-control" name="company_city" value="<?= e($val('company_city')) ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Country</label>
                    <input type="text" class="form-control" name="company_country" value="<?= e($val('company_country')) ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Full address (maps link)</label>
                    <input type="text" class="form-control" name="company_address" value="<?= e($val('company_address')) ?>">
                </div>
            </div>
        </div>
    </div>

    <!-- Social -->
    <div class="adm-card mb-3">
        <div class="card-head"><h3><i class="fa-solid fa-share-nodes me-2" style="color:var(--adm-primary)"></i>Social links</h3></div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">LinkedIn</label>
                    <input type="text" class="form-control" name="company_linkedin" value="<?= e($val('company_linkedin')) ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label">X (Twitter)</label>
                    <input type="text" class="form-control" name="company_x" value="<?= e($val('company_x')) ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Facebook</label>
                    <input type="text" class="form-control" name="company_facebook" value="<?= e($val('company_facebook')) ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Instagram</label>
                    <input type="text" class="form-control" name="company_instagram" value="<?= e($val('company_instagram')) ?>">
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="adm-card mb-3">
        <div class="card-head"><h3><i class="fa-solid fa-shoe-prints me-2" style="color:var(--adm-primary)"></i>Footer</h3></div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-12">
                    <label class="form-label">Footer about text</label>
                    <textarea class="form-control" name="footer_about" rows="2"><?= e($val('footer_about')) ?></textarea>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Copyright text <span class="form-text">(use {year} for the current year)</span></label>
                    <input type="text" class="form-control" name="copyright_text" value="<?= e($val('copyright_text')) ?>">
                </div>
            </div>
        </div>
    </div>

    <!-- Jobs / ATS feed -->
    <div class="adm-card mb-3">
        <div class="card-head"><h3><i class="fa-solid fa-briefcase me-2" style="color:var(--adm-primary)"></i>Jobs &amp; ATS feed</h3></div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-12">
                    <label class="form-label">External jobs feed URL</label>
                    <input type="text" class="form-control" name="jobs_feed_url" value="<?= e($val('jobs_feed_url')) ?>" placeholder="https://boards-api.greenhouse.io/v1/boards/{company}/jobs">
                    <div class="form-text">
                        Optional. Paste the public JSON feed from your recruiting system (Greenhouse, Lever, Workable,
                        Recruitee, etc.) so new job postings appear on the Careers page automatically. Leave blank to use
                        the jobs managed in the admin panel.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <button type="submit" class="btn-adm btn-lg px-4 py-2"><i class="fa-solid fa-floppy-disk me-2"></i>Save company profile</button>
</form>
