<?php
/**
 * Service create/edit form.
 * $item is null for create, or an array for edit.
 */
$isEdit = $item !== null;
$action = $isEdit ? url('/admin/services/' . $item['id'] . '/edit') : url('/admin/services/create');
$name = $isEdit ? $item['name'] : old('name');
$slug = $isEdit ? $item['slug'] : old('slug');
$tagline = $isEdit ? $item['tagline'] : old('tagline');
$short = $isEdit ? $item['short_description'] : old('short_description');
$desc = $isEdit ? $item['description'] : '';
$icon = $isEdit ? $item['icon'] : 'fa-solid fa-briefcase';
$featured = $isEdit ? (bool) $item['featured'] : false;
$active = $isEdit ? (bool) $item['is_active'] : true;
$sort = $isEdit ? (int) $item['sort_order'] : 0;
$image = $isEdit ? ($item['image'] ?? '') : '';
?>
<div class="adm-card">
    <div class="card-head">
        <h3><?= $isEdit ? 'Edit service' : 'New service' ?></h3>
        <a href="<?= url('/admin/services') ?>" class="btn-outline-adm" style="padding:.45rem .9rem;font-size:.82rem"><i class="fa-solid fa-arrow-left me-1"></i>Back</a>
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
                    <label class="form-label">Slug</label>
                    <input type="text" class="form-control" name="slug" value="<?= e($slug) ?>" placeholder="auto-generated from name">
                    <div class="form-text">Used in the URL: /services/&lt;slug&gt;</div>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Tagline</label>
                    <input type="text" class="form-control" name="tagline" value="<?= e($tagline) ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Short description (cards)</label>
                    <textarea class="form-control" name="short_description" rows="3"><?= e($short) ?></textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Icon (Font Awesome class)</label>
                    <input type="text" class="form-control" name="icon" value="<?= e($icon) ?>" placeholder="fa-solid fa-briefcase">
                    <div class="form-text">Pick from <a href="https://fontawesome.com/icons" target="_blank" rel="noopener">fontawesome.com</a></div>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Full description (HTML allowed)</label>
                    <textarea class="form-control" name="description" rows="12"><?= e($desc) ?></textarea>
                    <div class="form-text">Use &lt;p&gt;, &lt;ul&gt;&lt;li&gt; and &lt;h3&gt; tags for a nicely formatted service page.</div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Image (optional, URL or upload)</label>
                    <input type="file" class="form-control" name="image" accept="image/*">
                    <?php if ($image): ?><div class="form-text">Current: <?= e($image) ?></div><?php endif; ?>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Sort order</label>
                    <input type="number" class="form-control" name="sort_order" value="<?= $sort ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label d-block">Options</label>
                    <div class="form-check form-check-inline mt-2">
                        <input class="form-check-input" type="checkbox" name="featured" id="featured" <?= $featured ? 'checked' : '' ?>>
                        <label class="form-check-label" for="featured">Featured (Industries)</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active" <?= $active ? 'checked' : '' ?>>
                        <label class="form-check-label" for="is_active">Active</label>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn-adm btn-lg px-4 py-2"><i class="fa-solid fa-floppy-disk me-2"></i><?= $isEdit ? 'Update service' : 'Create service' ?></button>
            </div>
        </form>
    </div>
</div>
