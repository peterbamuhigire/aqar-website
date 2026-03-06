<?php
$page_title = t('meta.features_title');
$page_description = t('meta.features_desc');
$page_og_image = 'screenshots/SCREENSHOT-PROPERTIES-LIST.jpg';
$body_class = 'page-features';

require_once __DIR__ . '/../includes/header.php';

// Screenshots for each feature module (in order matching features_page.modules)
$featureScreenshots = [
    'screenshots/SCREENSHOT-RENT-PAYMENT.jpg',
    'screenshots/SCREENSHOT-LANDLORDS-LIST.jpg',
    'screenshots/SCREENSHOT-ADD-MAINTENANCE-RECORD.jpg',
    'screenshots/SCREENSHOT-MONTHLY-REPORT-REMMITANCE-DETAILS-FOR-LANDLORD-WITH-COMMISION-DUE-TO-COMPANY.jpg',
    'screenshots/SCREENSHOT-INSPECTION-TEMPLATES.jpg',
    'screenshots/SCREENSHOT-LOGIN.jpg',
];
?>

<!-- Features Hero -->
<section class="hero section-dark" style="position: relative; overflow: hidden; padding-bottom: var(--space-2xl);">
    <div style="position: absolute; inset: 0; background: url('<?= img('photos/AQAR-PROPERTY-05.jpg') ?>') center/cover; opacity: 0.15;"></div>
    <div class="container text-center" style="position: relative; z-index: 1;">
        <h1 class="reveal"><?= t('features_page.headline') ?></h1>
        <p class="reveal" style="font-size: var(--text-xl); max-width: 600px; margin: 0 auto;"><?= t('features_page.subheadline') ?></p>
    </div>
</section>

<!-- Feature Sections (alternating) -->
<?php
$modules = t('features_page.modules');
foreach ($modules as $i => $module):
    $isEven = ($i % 2 === 0);
    $bgClass = $isEven ? 'section-light' : 'section-dark';
    $reversed = $isEven ? '' : 'feature-row-reversed';
    $textAnim = $isEven ? 'reveal-left' : 'reveal-right';
    $imgAnim = $isEven ? 'reveal-right' : 'reveal-left';
?>
<section class="section <?= $bgClass ?>" id="feature-<?= $i ?>">
    <div class="container">
        <div class="feature-row <?= $reversed ?>">
            <div class="feature-row-content <?= $textAnim ?>">
                <h2><?= $module['title'] ?></h2>
                <p><?= $module['desc'] ?></p>
                <ul>
                    <?php foreach ($module['bullets'] as $bullet): ?>
                    <li><?= $bullet ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="<?= $imgAnim ?>">
                <div class="device-mockup device-laptop">
                    <img src="<?= img($featureScreenshots[$i]) ?>" alt="<?= strip_tags($module['title']) ?>" loading="lazy" width="600" height="375">
                </div>
            </div>
        </div>
    </div>
</section>
<?php endforeach; ?>

<!-- CTA Banner -->
<?php require_once __DIR__ . '/../includes/cta-banner.php'; ?>

<!-- Footer -->
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
