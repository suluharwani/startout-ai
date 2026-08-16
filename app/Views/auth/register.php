<?php
/**
 * First-run admin registration (only shown when no admin user exists).
 */
$errors = $_SESSION['_errors'] ?? [];
unset($_SESSION['_errors']);
?>
<div class="adm-login-wrap">
    <div class="adm-login-card">
        <div class="brand">
            <a href="<?= url('/') ?>" class="brand">
                <?php if (setting('company_logo')): ?>
                    <img class="brand-img" src="<?= e(asset(setting('company_logo'))) ?>" alt="<?= e(setting('company_name')) ?>">
                <?php else: ?>
                    <span class="brand-mark"><?= e(mb_substr(setting('company_name', 'S'), 0, 1)) ?></span>
                    <span class="brand-text"><?= e(setting('company_name')) ?></span>
                <?php endif; ?>
            </a>
        </div>
        <h1>Create Admin Account</h1>
        <p class="sub">No administrator found — create the first account to manage this website.</p>

        <?php if ($msg = flash('error')): ?>
            <div class="adm-alert error"><i class="fa-solid fa-triangle-exclamation me-2"></i><?= e($msg) ?></div>
        <?php endif; ?>

        <form method="post" action="<?= url('/admin/register') ?>" class="adm-form">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label class="form-label" for="name">Full name *</label>
                <input type="text" class="form-control <?= error_for('name') ? 'is-invalid' : '' ?>" id="name" name="name" value="<?= e(old('name')) ?>" required autofocus>
                <?php if (error_for('name')): ?><div class="invalid-feedback"><?= e(error_for('name')) ?></div><?php endif; ?>
            </div>
            <div class="mb-3">
                <label class="form-label" for="email">Email address *</label>
                <input type="email" class="form-control <?= error_for('email') ? 'is-invalid' : '' ?>" id="email" name="email" value="<?= e(old('email')) ?>" required>
                <?php if (error_for('email')): ?><div class="invalid-feedback"><?= e(error_for('email')) ?></div><?php endif; ?>
            </div>
            <div class="mb-3">
                <label class="form-label" for="password">Password *</label>
                <input type="password" class="form-control <?= error_for('password') ? 'is-invalid' : '' ?>" id="password" name="password" minlength="8" required>
                <div class="form-text">At least 8 characters.</div>
                <?php if (error_for('password')): ?><div class="invalid-feedback"><?= e(error_for('password')) ?></div><?php endif; ?>
            </div>
            <div class="mb-4">
                <label class="form-label" for="confirm_password">Confirm password *</label>
                <input type="password" class="form-control <?= error_for('confirm_password') ? 'is-invalid' : '' ?>" id="confirm_password" name="confirm_password" required>
                <?php if (error_for('confirm_password')): ?><div class="invalid-feedback"><?= e(error_for('confirm_password')) ?></div><?php endif; ?>
            </div>

            <button type="submit" class="btn-adm w-100 py-2">Create account <i class="fa-solid fa-arrow-right ms-2"></i></button>
        </form>

        <div class="text-center mt-4">
            <a href="<?= url('/admin/login') ?>" style="font-size:.82rem;color:var(--adm-muted)"><i class="fa-solid fa-arrow-left me-1"></i>Back to sign in</a>
        </div>
    </div>
</div>
