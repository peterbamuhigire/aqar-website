<?php
$ogLocale = lang() === 'fr' ? 'fr_FR' : 'en_GB';
$ogLocaleAlt = lang() === 'fr' ? 'en_GB' : 'fr_FR';
$canonicalUrl = SITE_URL . $_SERVER['REQUEST_URI'];
$ogImageUrl = SITE_URL . BASE_PATH . 'assets/img/' . ($page_og_image ?? 'photos/AQAR-PROPERTY-01.jpg');
?>
<!DOCTYPE html>
<html lang="<?= lang() ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($page_title ?? t('site_name')) ?></title>
    <meta name="description" content="<?= htmlspecialchars($page_description ?? '') ?>">

    <!-- Open Graph -->
    <meta property="og:title" content="<?= htmlspecialchars($page_title ?? t('site_name')) ?>">
    <meta property="og:description" content="<?= htmlspecialchars($page_description ?? '') ?>">
    <meta property="og:image" content="<?= $ogImageUrl ?>">
    <meta property="og:url" content="<?= $canonicalUrl ?>">
    <meta property="og:type" content="<?= ($currentPage === 'blog-post') ? 'article' : 'website' ?>">
    <meta property="og:locale" content="<?= $ogLocale ?>">
    <meta property="og:locale:alternate" content="<?= $ogLocaleAlt ?>">
    <meta property="og:site_name" content="Aqar Property Management Software">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= htmlspecialchars($page_title ?? t('site_name')) ?>">
    <meta name="twitter:description" content="<?= htmlspecialchars($page_description ?? '') ?>">
    <meta name="twitter:image" content="<?= $ogImageUrl ?>">

    <!-- Canonical + hreflang -->
    <link rel="canonical" href="<?= $canonicalUrl ?>">
    <?php
    if (($currentPage ?? 'home') === 'blog-post' && !empty($blogSlug)) {
        $hreflangEn = SITE_URL . blogUrl($blogSlug, 'en');
        $hreflangFr = SITE_URL . blogUrl($blogSlug, 'fr');
    } else {
        $hreflangEn = SITE_URL . url($currentPage ?? 'home', 'en');
        $hreflangFr = SITE_URL . url($currentPage ?? 'home', 'fr');
    }
    ?>
    <link rel="alternate" hreflang="en" href="<?= $hreflangEn ?>">
    <link rel="alternate" hreflang="fr" href="<?= $hreflangFr ?>">
    <link rel="alternate" hreflang="x-default" href="<?= $hreflangEn ?>">

    <!-- CSS -->
    <link rel="stylesheet" href="<?= asset('css/fonts.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/variables.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/base.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/components.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/layout.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/nav.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/animations.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/responsive.css') ?>">

    <!-- Favicon (text-based for now) -->
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🏠</text></svg>">
</head>
