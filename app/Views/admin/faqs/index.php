<?php /** Admin FAQs list */ ?>
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <p class="mb-0" style="color:var(--adm-muted)">Frequently asked questions shown across the site.</p>
    <a href="<?= url('/admin/faqs/create') ?>" class="btn-adm"><i class="fa-solid fa-plus me-1"></i>New FAQ</a>
</div>

<div class="adm-card">
    <div class="table-responsive">
        <table class="adm-table">
            <thead>
                <tr><th>Question</th><th>Status</th><th>Order</th><th class="text-end">Actions</th></tr>
            </thead>
            <tbody>
                <?php if (empty($items)): ?>
                <tr><td colspan="4"><div class="empty-state"><i class="fa-solid fa-circle-question"></i><p class="mb-0">No FAQs yet.</p></div></td></tr>
                <?php else: foreach ($items as $item): ?>
                <tr>
                    <td><strong><?= e(truncate($item['question'], 70)) ?></strong></td>
                    <td><?= $item['is_active'] ? '<span class="adm-badge green">Active</span>' : '<span class="adm-badge gray">Hidden</span>' ?></td>
                    <td><?= (int) $item['sort_order'] ?></td>
                    <td class="actions">
                        <a href="<?= url('/admin/faqs/' . $item['id'] . '/edit') ?>" title="Edit"><i class="fa-solid fa-pen"></i></a>
                        <form method="post" action="<?= url('/admin/faqs/' . $item['id'] . '/delete') ?>" onsubmit="return confirm('Delete this FAQ?')">
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
