<?php /** Admin profile / password change */ ?>
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="adm-card">
            <div class="card-head"><h3><i class="fa-solid fa-key me-2" style="color:var(--adm-primary)"></i>Change password</h3></div>
            <div class="card-body">
                <form method="post" action="<?= url('/admin/profile') ?>" class="adm-form">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label class="form-label">Current password *</label>
                        <input type="password" class="form-control" name="current_password" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">New password *</label>
                        <input type="password" class="form-control" name="new_password" minlength="8" required>
                        <div class="form-text">At least 8 characters.</div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Confirm new password *</label>
                        <input type="password" class="form-control" name="confirm_password" required>
                    </div>
                    <button type="submit" class="btn-adm"><i class="fa-solid fa-floppy-disk me-2"></i>Update password</button>
                </form>
            </div>
        </div>
    </div>
</div>
