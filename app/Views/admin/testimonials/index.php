<?php /** Admin testimonials list */ ?>
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <p class="mb-0" style="color:var(--adm-muted)">Customer testimonials shown on the homepage and service pages.</p>
    <a href="<?= url('/admin/testimonials/create') ?>" class="btn-adm"><i class="fa-solid fa-plus me-1"></i>New testimonial</a>
</div>

<div class="adm-card">
    <div class="table-responsive">
        <table class="adm-table">
            <thead>
                <tr><th>Name</th><th>Role</th><th>Company</th><th>Status</th><th>Order</th><th class="text-end">Actions</th></tr>
            </thead>
            <tbody>
                <?php if (empty($items)): ?>
                <tr><td colspan="6"><div class="empty-state"><i class="fa-solid fa-quote-left"></i><p class="mb-0">No testimonials yet.</p></div></td></tr>
                <?php else: foreach ($items as $item): ?>
                <tr>
                    <td><strong><?= e($item['name']) ?></strong></td>
                    <td><?= e($item['role']) ?></td>
                    <td><?= e($item['company']) ?></td>
                    <td><?= $item['is_active'] ? '<span class="adm-badge green">Active</span>' : '<span class="adm-badge gray">Hidden</span>' ?></td>
                    <td><?= (int) $item['sort_order'] ?></td>
                    <td class="actions">
                        <a href="<?= url('/admin/testimonials/' . $item['id'] . '/edit') ?>" title="Edit"><i class="fa-solid fa-pen"></i></a>
                        <form method="post" action="<?= url('/admin/testimonials/' . $item['id'] . '/delete') ?>" onsubmit="return confirm('Delete this testimonial?')">
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
