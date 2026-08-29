<?php
/**
 * Main site layout.
 * Expected variables: $content (string), $pageTitle, $pageMeta.
 */
$company         = setting('company_name', 'Motrive');
$pageTitleTmp    = (string) ($pageTitle ?? '');
$siteTitle       = ($pageTitleTmp === '' || $pageTitleTmp === $company)
    ? $company
    : $pageTitleTmp . ' | ' . $company;
$metaDescription = $pageMeta ?? setting('company_description');
$canonical       = url(current_path());
$ogImage         = setting('company_logo') ? asset(setting('company_logo')) : '';
$favicon         = setting('company_favicon') ? asset(setting('company_favicon')) : '';
$faviconTouch    = $favicon ? preg_replace('/\.svg$/i', '.png', $favicon) : '';
?>
<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($siteTitle) ?></title>
    <meta name="description" content="<?= e($metaDescription) ?>">
    <meta name="robots" content="index, follow, max-image-preview:large">

    <!-- Canonical -->
    <link rel="canonical" href="<?= e($canonical) ?>">

    <!-- Open Graph -->
    <meta property="og:site_name" content="<?= e($company) ?>">
    <meta property="og:title" content="<?= e($siteTitle) ?>">
    <meta property="og:description" content="<?= e($metaDescription) ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= e($canonical) ?>">
    <?php if ($ogImage): ?><meta property="og:image" content="<?= e($ogImage) ?>"><?php endif; ?>

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= e($siteTitle) ?>">
    <meta name="twitter:description" content="<?= e($metaDescription) ?>">
    <?php if ($ogImage): ?><meta name="twitter:image" content="<?= e($ogImage) ?>"><?php endif; ?>

    <!-- Favicon -->
    <?php if ($favicon): ?>
        <link rel="icon" href="<?= e($favicon) ?>" type="image/svg+xml">
        <link rel="apple-touch-icon" href="<?= e($faviconTouch ?: $favicon) ?>" sizes="180x180">
    <?php else: ?>
        <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><rect width='100' height='100' rx='24' fill='%23ff6a00'/><text x='50' y='68' font-size='52' font-family='Arial' font-weight='bold' text-anchor='middle' fill='white'>M</text></svg>">
    <?php endif; ?>

    <!-- Structured data (Organization) -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": <?= json_encode($company, JSON_UNESCAPED_SLASHES) ?>,
        "url": <?= json_encode(url('/'), JSON_UNESCAPED_SLASHES) ?>,
        <?php if ($ogImage): ?>"logo": <?= json_encode($ogImage, JSON_UNESCAPED_SLASHES) ?>,<?php endif; ?>
        "description": <?= json_encode($metaDescription, JSON_UNESCAPED_SLASHES) ?>,
        "email": <?= json_encode(company_email(), JSON_UNESCAPED_SLASHES) ?>,
        "telephone": <?= json_encode('+' . preg_replace('/[^0-9]/', '', company_phone()), JSON_UNESCAPED_SLASHES) ?>,
        "address": {
            "@type": "PostalAddress",
            "addressLocality": <?= json_encode(setting('company_city'), JSON_UNESCAPED_SLASHES) ?>,
            "addressCountry": <?= json_encode(setting('company_country'), JSON_UNESCAPED_SLASHES) ?>
        },
        "sameAs": [
            <?= json_encode(setting('company_linkedin'), JSON_UNESCAPED_SLASHES) ?>,
            <?= json_encode(setting('company_x'), JSON_UNESCAPED_SLASHES) ?>,
            <?= json_encode(setting('company_facebook'), JSON_UNESCAPED_SLASHES) ?>,
            <?= json_encode(setting('company_instagram'), JSON_UNESCAPED_SLASHES) ?>
        ]
    }
    </script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- App styles -->
    <link rel="stylesheet" href="<?= asset('/assets/css/style.css') ?>">

    <script>
        // Apply saved theme before paint to avoid flash.
        (function () {
            var stored = null;
            try { stored = localStorage.getItem('motrive-theme'); } catch (e) {}
            var theme = stored || (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
            document.documentElement.setAttribute('data-theme', theme);
        })();
    </script>
</head>
<body>
    <?php require __DIR__ . '/header.php'; ?>

    <main class="site-main">
        <?= $content ?>
    </main>

    <?php require __DIR__ . '/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= asset('/assets/js/script.js') ?>"></script>
</body>
</html>
