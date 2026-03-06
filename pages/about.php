<?php
$page_title = t('meta.about_title');
$page_description = t('meta.about_desc');
$page_og_image = 'photos/AQAR-PROPERTY-08.jpg';
$body_class = 'page-about';

require_once __DIR__ . '/../includes/header.php';
?>

<!-- About Hero -->
<section class="hero section-dark" style="position: relative; overflow: hidden;">
    <div style="position: absolute; inset: 0; background: url('<?= img('photos/AQAR-PROPERTY-08.jpg') ?>') center/cover; opacity: 0.15;"></div>
    <div class="container" style="position: relative; z-index: 1;">
        <div style="max-width: 700px;">
            <h1 class="reveal"><?= t('about.hero_headline') ?></h1>
            <p class="reveal" style="font-size: var(--text-xl);"><?= t('about.hero_subheadline') ?></p>
        </div>
    </div>
</section>

<!-- The Problem -->
<section class="section section-light">
    <div class="container" style="max-width: var(--container-narrow);">
        <h2 class="reveal"><?= t('about.problem_title') ?></h2>
        <p class="reveal" style="font-size: var(--text-lg); line-height: 1.8;"><?= t('about.problem_text') ?></p>
        <p class="reveal" style="font-size: var(--text-lg); line-height: 1.8;"><?= t('about.problem_text_2') ?></p>
    </div>
</section>

<!-- What We Built -->
<section class="section section-dark">
    <div class="container">
        <div class="feature-row">
            <div class="feature-row-content reveal-left">
                <h2><?= t('about.solution_title') ?></h2>
                <p style="font-size: var(--text-lg); line-height: 1.8;"><?= t('about.solution_text') ?></p>
                <p style="font-size: var(--text-lg); line-height: 1.8; font-weight: 600;"><?= t('about.solution_text_2') ?></p>
                <div style="margin-top: var(--space-lg);">
                    <a href="<?= DEMO_URL ?>" target="_blank" rel="noopener" class="btn btn-primary btn-lg"><?= t('hero.cta_demo') ?></a>
                </div>
            </div>
            <div class="reveal-right">
                <div class="device-mockup device-laptop">
                    <img src="<?= img('screenshots/SCREENSHOT-PROPERTIES-LIST.jpg') ?>" alt="Aqar Dashboard" loading="lazy" width="600" height="375">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Peter Bamuhigire -->
<section class="section section-light">
    <div class="container">
        <div class="feature-row">
            <div class="reveal-left" style="text-align: center;">
                <div style="width: 280px; height: 280px; border-radius: 50%; overflow: hidden; margin: 0 auto; box-shadow: var(--shadow-lg); border: 4px solid var(--color-primary);">
                    <img src="<?= img('photos/PETER-PHOTO.jpg') ?>" alt="<?= t('about.peter_title') ?>" style="width: 100%; height: 100%; object-fit: cover;" loading="lazy">
                </div>
            </div>
            <div class="reveal-right">
                <h2><?= t('about.peter_title') ?></h2>
                <p style="color: var(--color-primary); font-weight: 600; font-size: var(--text-lg); margin-bottom: var(--space-md);"><?= t('about.peter_role') ?></p>
                <p><?= t('about.peter_bio') ?></p>
                <p><?= t('about.peter_bio_2') ?></p>
                <p><?= t('about.peter_bio_3') ?></p>
                <a href="https://techguypeter.com" target="_blank" rel="noopener" class="btn btn-outline" style="margin-top: var(--space-md); color: var(--color-primary); border-color: var(--color-primary);">techguypeter.com &rarr;</a>
            </div>
        </div>
    </div>
</section>

<!-- Chwezi Core Systems -->
<section class="section section-dark">
    <div class="container" style="max-width: var(--container-narrow);">
        <div class="reveal text-center" style="margin-bottom: var(--space-lg);">
            <img src="<?= img('photos/CoreLogoLightEdition.png') ?>" alt="Chwezi Core Systems" style="height: 60px; width: auto;" loading="lazy">
        </div>
        <h2 class="reveal text-center"><?= t('about.chwezi_title') ?></h2>
        <p class="reveal text-center" style="font-size: var(--text-lg); line-height: 1.8; margin-bottom: var(--space-2xl);"><?= t('about.chwezi_text') ?></p>

        <h3 class="reveal text-center" style="color: var(--color-text-light); margin-bottom: var(--space-lg);"><?= t('about.products_title') ?></h3>
        <div class="grid-3 reveal-stagger">
            <?php foreach (t('about.products') as $product): ?>
            <div class="glass-card text-center">
                <h4 style="color: var(--color-primary-light); font-family: var(--font-heading); font-weight: 800; font-size: var(--text-xl); margin-bottom: 0.5rem;"><?= $product['name'] ?></h4>
                <p style="color: var(--color-text-light-muted); font-size: var(--text-sm);"><?= $product['desc'] ?></p>
            </div>
            <?php endforeach; ?>
        </div>
        <p class="reveal text-center" style="margin-top: var(--space-lg); color: var(--color-text-light-muted); font-style: italic;"><?= t('about.products_coming') ?></p>
    </div>
</section>

<!-- CTA Banner -->
<?php require_once __DIR__ . '/../includes/cta-banner.php'; ?>

<!-- Footer -->
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
