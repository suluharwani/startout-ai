<?php /** Admin jobs list */ ?>
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <p class="mb-0" style="color:var(--adm-muted)">Job openings shown on the Careers page.</p>
    <a href="<?= url('/admin/jobs/create') ?>" class="btn-adm"><i class="fa-solid fa-plus me-1"></i>New job</a>
</div>

<div class="adm-card">
    <div class="table-responsive">
        <table class="adm-table">
            <thead>
                <tr><th>Title</th><th>Category</th><th>Location</th><th>Type</th><th>Status</th><th class="text-end">Actions</th></tr>
            </thead>
            <tbody>
                <?php if (empty($items)): ?>
                <tr><td colspan="6"><div class="empty-state"><i class="fa-solid fa-briefcase"></i><p class="mb-0">No jobs yet.</p></div></td></tr>
                <?php else: foreach ($items as $item): ?>
                <tr>
                    <td><strong><?= e($item['title']) ?></strong></td>
                    <td><span class="adm-badge blue"><?= e($item['category']) ?></span></td>
                    <td><?= e($item['location']) ?></td>
                    <td><?= e($item['type']) ?></td>
                    <td><?= $item['is_active'] ? '<span class="adm-badge green">Active</span>' : '<span class="adm-badge gray">Hidden</span>' ?></td>
                    <td class="actions">
                        <a href="<?= url('/admin/jobs/' . $item['id'] . '/edit') ?>" title="Edit"><i class="fa-solid fa-pen"></i></a>
                        <form method="post" action="<?= url('/admin/jobs/' . $item['id'] . '/delete') ?>" onsubmit="return confirm('Delete this job?')">
                            <?= csrf_field() ?>
                            <button type="submit" title="Delete"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
</div>
