<?php
/** Admin login */
$errors      = $_SESSION['_errors'] ?? [];
unset($_SESSION['_errors']);
$canRegister = $canRegister ?? false;
?>
<div class="adm-login-wrap">
    <div class="adm-login-card">
        <div class="brand">
            <a href="<?= url('/') ?>" class="motrive-logo">
                <?= brand_logo() ?>
            </a>
        </div>
        <h1>Admin Login</h1>
        <p class="sub">Sign in to manage your website</p>

        <?php if ($canRegister): ?>
        <div class="adm-alert info mb-3">
            <i class="fa-solid fa-circle-plus me-2"></i>
            No admin account yet — <a href="<?= url('/admin/register') ?>" style="font-weight:700;color:var(--adm-primary)">create one here</a>.
        </div>
        <?php endif; ?>

        <?php if (!empty($errors['auth'])): ?>
            <div class="adm-alert error"><i class="fa-solid fa-triangle-exclamation me-2"></i><?= e($errors['auth']) ?></div>
        <?php endif; ?>

        <form method="post" action="<?= url('/admin/login') ?>" class="adm-form">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label class="form-label" for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= e(old('email')) ?>" required autofocus>
            </div>
            <div class="mb-4">
                <label class="form-label" for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <button type="submit" class="btn-adm w-100 py-2">Sign in <i class="fa-solid fa-arrow-right ms-2"></i></button>
        </form>

        <div class="text-center mt-4">
            <a href="<?= url('/') ?>" style="font-size:.82rem;color:var(--adm-muted)"><i class="fa-solid fa-house me-1"></i>Back to website</a>
        </div>
    </div>
</div>
