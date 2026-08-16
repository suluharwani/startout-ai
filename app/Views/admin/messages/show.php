<?php /** Admin message detail */ ?>
<div class="adm-card">
    <div class="card-head">
        <h3>Message from <?= e(trim($item['first_name'] . ' ' . $item['last_name'])) ?></h3>
        <a href="<?= url('/admin/messages') ?>" class="btn-outline-adm" style="padding:.45rem .9rem;font-size:.82rem"><i class="fa-solid fa-arrow-left me-1"></i>Back to inbox</a>
    </div>
    <div class="card-body">
        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="adm-stat">
                    <div class="stat-icon"><i class="fa-solid fa-user"></i></div>
                    <div>
                        <p>Name</p>
                        <h3 style="font-size:1rem"><?= e(trim($item['first_name'] . ' ' . $item['last_name'])) ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="adm-stat">
                    <div class="stat-icon"><i class="fa-solid fa-envelope"></i></div>
                    <div>
                        <p>Email</p>
                        <h3 style="font-size:1rem"><a href="mailto:<?= e($item['email']) ?>"><?= e($item['email']) ?></a></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="adm-stat">
                    <div class="stat-icon"><i class="fa-solid fa-clock"></i></div>
                    <div>
                        <p>Received</p>
                        <h3 style="font-size:1rem"><?= e(format_date($item['created_at'], 'd M Y H:i')) ?></h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-4">
                <label class="form-label">Company</label>
                <div class="form-control bg-light"><?= e($item['company'] ?: '—') ?></div>
            </div>
            <div class="col-md-4">
                <label class="form-label">Phone</label>
                <div class="form-control bg-light"><?= e($item['phone'] ?: '—') ?></div>
            </div>
            <div class="col-md-4">
                <label class="form-label">Service interest</label>
                <div class="form-control bg-light"><?= e($item['service'] ?: '—') ?></div>
            </div>
        </div>

        <label class="form-label">Message</label>
        <div class="form-control bg-light" style="white-space:pre-wrap;min-height:140px"><?= e($item['message']) ?></div>

        <div class="mt-4 d-flex gap-2">
            <a href="mailto:<?= e($item['email']) ?>" class="btn-adm"><i class="fa-solid fa-reply me-2"></i>Reply by email</a>
            <a href="<?= e(wa_link('Hi ' . e($item['first_name']) . ', we received your message via ' . setting('company_name') . '...')) ?>" target="_blank" rel="noopener" class="btn-outline-adm"><i class="fa-brands fa-whatsapp me-2"></i>WhatsApp</a>
            <form method="post" action="<?= url('/admin/messages/' . $item['id'] . '/delete') ?>" onsubmit="return confirm('Delete this message?')" class="ms-auto">
                <?= csrf_field() ?>
                <button type="submit" class="btn-danger-adm"><i class="fa-solid fa-trash me-1"></i>Delete</button>
            </form>
        </div>
    </div>
</div>
