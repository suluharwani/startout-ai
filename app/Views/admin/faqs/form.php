<?php
$isEdit = $item !== null;
$action = $isEdit ? url('/admin/faqs/' . $item['id'] . '/edit') : url('/admin/faqs/create');
$question = $isEdit ? $item['question'] : '';
$answer = $isEdit ? $item['answer'] : '';
$active = $isEdit ? (bool) $item['is_active'] : true;
$sort = $isEdit ? (int) $item['sort_order'] : 0;
?>
<div class="adm-card">
    <div class="card-head">
        <h3><?= $isEdit ? 'Edit FAQ' : 'New FAQ' ?></h3>
        <a href="<?= url('/admin/faqs') ?>" class="btn-outline-adm" style="padding:.45rem .9rem;font-size:.82rem"><i class="fa-solid fa-arrow-left me-1"></i>Back</a>
    </div>
    <div class="card-body">
        <form method="post" action="<?= $action ?>" class="adm-form">
            <?= csrf_field() ?>
            <div class="row g-3">
                <div class="col-md-12">
                    <label class="form-label">Question *</label>
                    <input type="text" class="form-control" name="question" value="<?= e($question) ?>" required>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Answer *</label>
                    <textarea class="form-control" name="answer" rows="4" required><?= e($answer) ?></textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Sort order</label>
                    <input type="number" class="form-control" name="sort_order" value="<?= $sort ?>">
                </div>
                <div class="col-md-6">
                    <div class="form-check mt-4">
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
