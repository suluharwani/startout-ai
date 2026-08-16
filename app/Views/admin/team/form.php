<?php
$isEdit = $item !== null;
$action = $isEdit ? url('/admin/team/' . $item['id'] . '/edit') : url('/admin/team/create');
$name = $isEdit ? $item['name'] : old('name');
$position = $isEdit ? $item['position'] : '';
$bio = $isEdit ? $item['bio'] : '';
$linkedin = $isEdit ? $item['linkedin'] : '';
$active = $isEdit ? (bool) $item['is_active'] : true;
$sort = $isEdit ? (int) $item['sort_order'] : 0;
?>
<div class="adm-card">
    <div class="card-head">
        <h3><?= $isEdit ? 'Edit team member' : 'New team member' ?></h3>
        <a href="<?= url('/admin/team') ?>" class="btn-outline-adm" style="padding:.45rem .9rem;font-size:.82rem"><i class="fa-solid fa-arrow-left me-1"></i>Back</a>
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
                    <label class="form-label">Position</label>
                    <input type="text" class="form-control" name="position" value="<?= e($position) ?>">
                </div>
                <div class="col-md-12">
                    <label class="form-label">Short bio</label>
                    <textarea class="form-control" name="bio" rows="3"><?= e($bio) ?></textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label">LinkedIn URL</label>
                    <input type="text" class="form-control" name="linkedin" value="<?= e($linkedin) ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Photo (optional)</label>
                    <input type="file" class="form-control" name="photo" accept="image/*">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Sort order</label>
                    <input type="number" class="form-control" name="sort_order" value="<?= $sort ?>">
                </div>
                <div class="col-md-12">
                    <div class="form-check">
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
