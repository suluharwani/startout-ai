<?php /** Admin messages inbox */ ?>
<p class="mb-3" style="color:var(--adm-muted)">Messages submitted through the contact form.</p>

<div class="adm-card">
    <div class="table-responsive">
        <table class="adm-table">
            <thead>
                <tr><th>Name</th><th>Email</th><th>Service</th><th>Date</th><th></th><th class="text-end">Actions</th></tr>
            </thead>
            <tbody>
                <?php if (empty($items)): ?>
                <tr><td colspan="6"><div class="empty-state"><i class="fa-solid fa-envelope-open-text"></i><p class="mb-0">No messages yet.</p></div></td></tr>
                <?php else: foreach ($items as $item): ?>
                <tr style="<?= $item['is_read'] ? '' : 'font-weight:600' ?>">
                    <td>
                        <?= e(trim($item['first_name'] . ' ' . $item['last_name'])) ?>
                        <?php if (!$item['is_read']): ?><span class="adm-badge orange ms-1">New</span><?php endif; ?>
                    </td>
                    <td><?= e($item['email']) ?></td>
                    <td><?= e($item['service']) ?></td>
                    <td style="white-space:nowrap"><?= e(format_date($item['created_at'], 'd M Y H:i')) ?></td>
                    <td></td>
                    <td class="actions">
                        <a href="<?= url('/admin/messages/' . $item['id']) ?>" title="View"><i class="fa-solid fa-eye"></i></a>
                        <form method="post" action="<?= url('/admin/messages/' . $item['id'] . '/delete') ?>" onsubmit="return confirm('Delete this message?')">
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
