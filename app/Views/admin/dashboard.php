<?php /** Admin dashboard */ ?>
<div class="adm-welcome">
    <h2>Welcome back, <?= e(auth_user()['name'] ?? 'Admin') ?> 👋</h2>
    <p>Here's what's happening across your website — <?= date('l, d F Y') ?>.</p>
</div>

<div class="row g-3 mb-4">
    <div class="col-6 col-lg-3">
        <div class="adm-stat">
            <div class="stat-icon"><i class="fa-solid fa-envelope"></i></div>
            <div><h3><?= (int) $stats['messages'] ?></h3><p>Total messages</p></div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="adm-stat">
            <div class="stat-icon red"><i class="fa-solid fa-inbox"></i></div>
            <div><h3><?= (int) $stats['unread'] ?></h3><p>Unread</p></div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="adm-stat">
            <div class="stat-icon blue"><i class="fa-solid fa-briefcase"></i></div>
            <div><h3><?= (int) $stats['services'] ?></h3><p>Services</p></div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="adm-stat">
            <div class="stat-icon green"><i class="fa-solid fa-circle-check"></i></div>
            <div><h3><?= (int) $stats['testimonials'] + (int) $stats['team'] + (int) $stats['jobs'] + (int) $stats['faqs'] ?></h3><p>Content items</p></div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-lg-7">
        <div class="adm-card">
            <div class="card-head">
                <h3><i class="fa-solid fa-inbox me-2" style="color:var(--adm-primary)"></i>Recent messages</h3>
                <a href="<?= url('/admin/messages') ?>" class="btn-outline-adm" style="padding:.45rem .9rem;font-size:.82rem">View all</a>
            </div>
            <div class="table-responsive">
                <table class="adm-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Service</th>
                            <th>Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($recentMessages)): ?>
                        <tr><td colspan="5"><div class="empty-state"><i class="fa-solid fa-envelope-open-text"></i><p class="mb-0">No messages yet.</p></div></td></tr>
                        <?php else: foreach ($recentMessages as $m): ?>
                        <tr>
                            <td>
                                <?= e(trim($m['first_name'] . ' ' . $m['last_name'])) ?>
                                <?php if (!$m['is_read']): ?><span class="adm-badge orange ms-1">New</span><?php endif; ?>
                            </td>
                            <td><?= e($m['email']) ?></td>
                            <td><?= e($m['service']) ?></td>
                            <td style="white-space:nowrap"><?= e(format_date($m['created_at'], 'd M Y H:i')) ?></td>
                            <td class="actions">
                                <a href="<?= url('/admin/messages/' . $m['id']) ?>" title="View"><i class="fa-solid fa-eye"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="adm-card mb-3">
            <div class="card-head"><h3><i class="fa-solid fa-rocket me-2" style="color:var(--adm-primary)"></i>Quick actions</h3></div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="<?= url('/admin/settings') ?>" class="btn-adm">Edit company profile</a>
                    <a href="<?= url('/admin/services/create') ?>" class="btn-outline-adm">Add a service</a>
                    <a href="<?= url('/admin/jobs/create') ?>" class="btn-outline-adm">Post a job</a>
                </div>
            </div>
        </div>

        <div class="adm-card mb-3">
            <div class="card-head"><h3><i class="fa-solid fa-magnifying-glass-chart me-2" style="color:var(--adm-primary)"></i>SEO</h3></div>
            <div class="card-body">
                <p class="small text-muted mb-2">Your site is search-engine friendly. Verify these URLs:</p>
                <div class="d-grid gap-2">
                    <a href="<?= e(url('/sitemap.xml')) ?>" target="_blank" rel="noopener" class="btn-outline-adm"><i class="fa-solid fa-sitemap me-2"></i>sitemap.xml</a>
                    <a href="<?= e(url('/robots.txt')) ?>" target="_blank" rel="noopener" class="btn-outline-adm"><i class="fa-solid fa-robot me-2"></i>robots.txt</a>
                    <a href="<?= e(url('/')) ?>" target="_blank" rel="noopener" class="btn-outline-adm"><i class="fa-solid fa-globe me-2"></i>View public site</a>
                </div>
            </div>
        </div>

        <div class="adm-card">
            <div class="card-head"><h3><i class="fa-solid fa-circle-info me-2" style="color:var(--adm-primary)"></i>Security tip</h3></div>
            <div class="card-body" style="font-size:.88rem">
                <p class="mb-2">Keep your admin password strong and unique. On first launch the admin account is created via the registration screen at <code>/admin/register</code>.</p>
                <p class="mb-0"><a href="<?= url('/admin/profile') ?>"><i class="fa-solid fa-key me-1"></i>Change password</a></p>
            </div>
        </div>
    </div>
</div>
