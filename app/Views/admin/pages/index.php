<?php /** Admin static pages list */ ?>
<p class="mb-3" style="color:var(--adm-muted)">Static content pages (About, Resources) — edit the HTML content shown on each page.</p>

<div class="adm-card">
    <div class="table-responsive">
        <table class="adm-table">
            <thead>
                <tr><th>Page</th><th>Slug</th><th>Status</th><th class="text-end">Actions</th></tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                <tr>
                    <td><strong><?= e($item['title']) ?></strong></td>
                    <td><code>/<?= e($item['slug']) ?></code></td>
                    <td><?= $item['is_active'] ? '<span class="adm-badge green">Active</span>' : '<span class="adm-badge gray">Hidden</span>' ?></td>
                    <td class="actions">
                        <a href="<?= url('/admin/pages/' . $item['id'] . '/edit') ?>" title="Edit"><i class="fa-solid fa-pen"></i></a>
                        <a href="<?= url('/' . $item['slug']) ?>" target="_blank" title="View"><i class="fa-solid fa-eye"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
