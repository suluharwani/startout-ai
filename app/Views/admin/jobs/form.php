<?php
$isEdit = $item !== null;
$action = $isEdit ? url('/admin/jobs/' . $item['id'] . '/edit') : url('/admin/jobs/create');
$title = $isEdit ? $item['title'] : old('title');
$category = $isEdit ? $item['category'] : 'Operations';
$location = $isEdit ? $item['location'] : 'Yogyakarta, Indonesia';
$type = $isEdit ? $item['type'] : 'Full-time';
$description = $isEdit ? $item['description'] : '';
$active = $isEdit ? (bool) $item['is_active'] : true;
$sort = $isEdit ? (int) $item['sort_order'] : 0;
?>
<div class="adm-card">
    <div class="card-head">
        <h3><?= $isEdit ? 'Edit job' : 'New job' ?></h3>
        <a href="<?= url('/admin/jobs') ?>" class="btn-outline-adm" style="padding:.45rem .9rem;font-size:.82rem"><i class="fa-solid fa-arrow-left me-1"></i>Back</a>
    </div>
    <div class="card-body">
        <form method="post" action="<?= $action ?>" class="adm-form">
            <?= csrf_field() ?>
            <div class="row g-3">
                <div class="col-md-12">
                    <label class="form-label">Title *</label>
                    <input type="text" class="form-control" name="title" value="<?= e($title) ?>" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Category</label>
                    <input type="text" class="form-control" name="category" value="<?= e($category) ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Location</label>
                    <input type="text" class="form-control" name="location" value="<?= e($location) ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Type</label>
                    <select class="form-select" name="type">
                        <?php foreach (['Full-time', 'Part-time', 'Contract', 'Internship'] as $t): ?>
                        <option value="<?= $t ?>" <?= $type === $t ? 'selected' : '' ?>><?= $t ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-10">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" name="description" rows="3"><?= e($description) ?></textarea>
                </div>
                <div class="col-md-2">
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
