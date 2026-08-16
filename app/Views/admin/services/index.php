<?php /** Admin services list */ ?>
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <p class="mb-0" style="color:var(--adm-muted)">Manage the services shown on your website.</p>
    <a href="<?= url('/admin/services/create') ?>" class="btn-adm"><i class="fa-solid fa-plus me-1"></i>New service</a>
</div>

<div class="adm-card">
    <div class="table-responsive">
        <table class="adm-table">
            <thead>
                <tr>
                    <th>Service</th>
                    <th>Slug</th>
                    <th>Featured</th>
                    <th>Status</th>
                    <th>Order</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($items)): ?>
                <tr><td colspan="6"><div class="empty-state"><i class="fa-solid fa-briefcase"></i><p class="mb-0">No services yet.</p></div></td></tr>
                <?php else: foreach ($items as $item): ?>
                <tr>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <span class="dp-icon" style="width:32px;height:32px;flex:0 0 32px;display:grid;place-items:center;border-radius:9px;background:rgba(255,106,0,.12);color:#ff6a00"><i class="<?= e($item['icon'] ?: 'fa-solid fa-briefcase') ?>"></i></span>
                            <strong><?= e($item['name']) ?></strong>
                        </div>
                    </td>
                    <td><code>/services/<?= e($item['slug']) ?></code></td>
                    <td><?= $item['featured'] ? '<span class="adm-badge orange">Industry</span>' : '<span class="adm-badge gray">—</span>' ?></td>
                    <td><?= $item['is_active'] ? '<span class="adm-badge green">Active</span>' : '<span class="adm-badge gray">Hidden</span>' ?></td>
                    <td><?= (int) $item['sort_order'] ?></td>
                    <td class="actions">
                        <a href="<?= url('/admin/services/' . $item['id'] . '/edit') ?>" title="Edit"><i class="fa-solid fa-pen"></i></a>
                        <a href="<?= url('/services/' . $item['slug']) ?>" target="_blank" title="View"><i class="fa-solid fa-eye"></i></a>
                        <form method="post" action="<?= url('/admin/services/' . $item['id'] . '/delete') ?>" onsubmit="return confirm('Delete this service?')">
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
