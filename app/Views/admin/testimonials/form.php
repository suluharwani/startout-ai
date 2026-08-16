<?php
$isEdit = $item !== null;
$action = $isEdit ? url('/admin/testimonials/' . $item['id'] . '/edit') : url('/admin/testimonials/create');
$name = $isEdit ? $item['name'] : old('name');
$role = $isEdit ? $item['role'] : '';
$company = $isEdit ? $item['company'] : '';
$content = $isEdit ? $item['content'] : '';
$active = $isEdit ? (bool) $item['is_active'] : true;
$sort = $isEdit ? (int) $item['sort_order'] : 0;
?>
<div class="adm-card">
    <div class="card-head">
        <h3><?= $isEdit ? 'Edit testimonial' : 'New testimonial' ?></h3>
        <a href="<?= url('/admin/testimonials') ?>" class="btn-outline-adm" style="padding:.45rem .9rem;font-size:.82rem"><i class="fa-solid fa-arrow-left me-1"></i>Back</a>
    </div>
    <div class="card-body">
        <form method="post" action="<?= $action ?>" enctype="multipart/form-data" class="adm-form">
            <?= csrf_field() ?>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Name *</label>
                    <input type="text" class="form-control" name="name" value="<?= e($name) ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Role</label>
                    <input type="text" class="form-control" name="role" value="<?= e($role) ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Company</label>
                    <input type="text" class="form-control" name="company" value="<?= e($company) ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Sort order</label>
                    <input type="number" class="form-control" name="sort_order" value="<?= $sort ?>">
                </div>
                <div class="col-md-12">
                    <label class="form-label">Testimonial content *</label>
                    <textarea class="form-control" name="content" rows="4" required><?= e($content) ?></textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Photo (optional)</label>
                    <input type="file" class="form-control" name="image" accept="image/*">
                </div>
                <div class="col-md-6">
                    <label class="form-label d-block">Status</label>
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active" <?= $active ? 'checked' : '' ?>>
                        <label class="form-check-label" for="is_active">Active</label>
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn-adm btn-lg px-4 py-2"><i class="fa-solid fa-floppy-disk me-2"></i><?= $isEdit ? 'Update' : 'Create' ?></button>
            </div>
        </form>
    </div>
</div>
