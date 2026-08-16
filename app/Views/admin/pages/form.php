<?php /** Admin static page edit */ ?>
<div class="adm-card">
    <div class="card-head">
        <h3>Edit page: <?= e($item['title']) ?></h3>
        <a href="<?= url('/admin/pages') ?>" class="btn-outline-adm" style="padding:.45rem .9rem;font-size:.82rem"><i class="fa-solid fa-arrow-left me-1"></i>Back</a>
    </div>
    <div class="card-body">
        <form method="post" action="<?= url('/admin/pages/' . $item['id'] . '/edit') ?>" class="adm-form">
            <?= csrf_field() ?>
            <div class="row g-3">
                <div class="col-md-8">
                    <label class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" value="<?= e($item['title']) ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Status</label>
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active" <?= $item['is_active'] ? 'checked' : '' ?>>
                        <label class="form-check-label" for="is_active">Active</label>
                    </div>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Subtitle</label>
                    <input type="text" class="form-control" name="subtitle" value="<?= e($item['subtitle']) ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Meta title</label>
                    <input type="text" class="form-control" name="meta_title" value="<?= e($item['meta_title']) ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Meta description</label>
                    <input type="text" class="form-control" name="meta_description" value="<?= e($item['meta_description']) ?>">
                </div>
                <div class="col-md-12">
                    <label class="form-label">Content (HTML)</label>
                    <textarea class="form-control" name="content" rows="16"><?= e($item['content']) ?></textarea>
                    <div class="form-text">For the Resources page, use &lt;h3&gt;Heading&lt;/h3&gt;&lt;p&gt;Summary…&lt;/p&gt; blocks — they become resource cards automatically.</div>
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn-adm btn-lg px-4 py-2"><i class="fa-solid fa-floppy-disk me-2"></i>Save page</button>
            </div>
        </form>
    </div>
</div>
