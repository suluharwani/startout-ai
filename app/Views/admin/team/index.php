<?php /** Admin team list */ ?>
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <p class="mb-0" style="color:var(--adm-muted)">Leadership team shown on the About page.</p>
    <a href="<?= url('/admin/team/create') ?>" class="btn-adm"><i class="fa-solid fa-plus me-1"></i>New member</a>
</div>

<div class="adm-card">
    <div class="table-responsive">
        <table class="adm-table">
            <thead>
                <tr><th>Name</th><th>Position</th><th>Status</th><th>Order</th><th class="text-end">Actions</th></tr>
            </thead>
            <tbody>
                <?php if (empty($items)): ?>
                <tr><td colspan="5"><div class="empty-state"><i class="fa-solid fa-user-group"></i><p class="mb-0">No team members yet.</p></div></td></tr>
                <?php else: foreach ($items as $item): ?>
                <tr>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <span style="width:32px;height:32px;border-radius:50%;display:grid;place-items:center;background:linear-gradient(135deg,#ff6a00,#7b2ff7);color:#fff;font-size:.75rem;font-weight:700"><?= e(strtoupper(mb_substr($item['name'], 0, 1))) ?></span>
                            <strong><?= e($item['name']) ?></strong>
                        </div>
                    </td>
                    <td><?= e($item['position']) ?></td>
                    <td><?= $item['is_active'] ? '<span class="adm-badge green">Active</span>' : '<span class="adm-badge gray">Hidden</span>' ?></td>
                    <td><?= (int) $item['sort_order'] ?></td>
                    <td class="actions">
                        <a href="<?= url('/admin/team/' . $item['id'] . '/edit') ?>" title="Edit"><i class="fa-solid fa-pen"></i></a>
                        <form method="post" action="<?= url('/admin/team/' . $item['id'] . '/delete') ?>" onsubmit="return confirm('Remove this team member?')">
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
