<?php
$page_title = t('meta.demo_title');
$page_description = t('meta.demo_desc');
$page_og_image = 'screenshots/SCREENSHOT-LOGIN.jpg';
$body_class = 'page-demo';

require_once __DIR__ . '/../includes/header.php';
?>

<section class="hero section-dark" style="position: relative; overflow: hidden;">
    <div style="position: absolute; inset: 0; background: url('<?= img('photos/AQAR-PROPERTY-07.jpg') ?>') center/cover; opacity: 0.15;"></div>
    <div class="container text-center" style="position: relative; z-index: 1;">
        <h1 class="reveal"><?= t('demo.headline') ?></h1>
        <p class="reveal" style="font-size: var(--text-xl); max-width: 600px; margin: 0 auto; margin-bottom: var(--space-xl);"><?= t('demo.subheadline') ?></p>

        <div class="reveal-scale" style="max-width: 700px; margin: 0 auto var(--space-2xl);">
            <div class="device-mockup device-laptop">
                <img src="<?= img('screenshots/SCREENSHOT-LOGIN.jpg') ?>" alt="Aqar Login Screen" width="700" height="438">
            </div>
        </div>
    </div>
</section>

<section class="section section-light">
    <div class="container" style="max-width: var(--container-narrow);">
        <div class="text-center">
            <h2 class="reveal"><?= t('demo.features_title') ?></h2>
            <ul class="reveal" style="list-style: none; padding: 0; margin: var(--space-lg) auto; max-width: 500px; text-align: left;">
                <?php foreach (t('demo.features') as $feature): ?>
                <li style="padding: 0.75rem 0 0.75rem 2.5rem; position: relative; font-size: var(--text-lg); border-bottom: 1px solid var(--color-border);">
                    <span style="position: absolute; left: 0; color: var(--color-success); font-size: 1.25rem;">&#10003;</span>
                    <?= $feature ?>
                </li>
                <?php endforeach; ?>
            </ul>

            <div class="reveal" style="margin-top: var(--space-xl);">
                <a href="<?= DEMO_URL ?>" target="_blank" rel="noopener" class="btn btn-primary btn-lg" style="font-size: var(--text-lg); padding: 1.25rem 3rem;"><?= t('demo.cta') ?></a>
                <p style="margin-top: var(--space-sm); color: var(--color-text-muted); font-size: var(--text-sm);"><?= t('demo.cta_note') ?></p>
            </div>

            <div class="reveal" style="margin-top: var(--space-2xl); padding: var(--space-lg); background: rgba(232,145,58,0.08); border-radius: var(--radius-lg); border: 1px solid rgba(232,145,58,0.15);">
                <p style="font-size: var(--text-lg); font-weight: 600; margin-bottom: var(--space-sm);"><?= t('demo.questions') ?></p>
                <a href="<?= WHATSAPP_URL ?>" target="_blank" rel="noopener" class="btn btn-secondary"><?= t('demo.questions_cta') ?></a>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
