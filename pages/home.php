<?php
// Page meta
$page_title = t('meta.home_title');
$page_description = t('meta.home_desc');
$page_og_image = 'photos/AQAR-PROPERTY-01.jpg';
$body_class = 'page-home';

require_once __DIR__ . '/../includes/header.php';

// Helper function for inline SVG icons — must be defined before first use
function getIcon($name) {
    $icons = [
        'currency' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>',
        'people' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>',
        'chart' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>',
        'cloud' => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 10h-1.26A8 8 0 1 0 9 20h9a5 5 0 0 0 0-10z"/></svg>',
        'download-off' => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/><line x1="2" y1="2" x2="22" y2="22"/></svg>',
        'lock' => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>',
        'smartphone' => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg>',
    ];
    return $icons[$name] ?? '';
}
?>

<!-- ============ HERO ============ -->
<section class="hero section-dark" style="position: relative; overflow: hidden;">
    <div style="position: absolute; inset: 0; background: url('<?= img('photos/AQAR-PROPERTY-01.jpg') ?>') center/cover; opacity: 0.15;"></div>
    <div class="container" style="position: relative; z-index: 1;">
        <div class="hero-grid">
            <div class="hero-content">
                <h1 class="reveal"><?= t('hero.headline') ?></h1>
                <p class="reveal"><?= t('hero.subheadline') ?></p>
                <div class="hero-ctas reveal">
                    <a href="<?= DEMO_URL ?>" target="_blank" rel="noopener" class="btn btn-primary btn-lg"><?= t('hero.cta_demo') ?></a>
                    <a href="<?= WHATSAPP_URL ?>" target="_blank" rel="noopener" class="btn btn-secondary btn-lg">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.625.846 5.059 2.284 7.034L.789 23.492a.5.5 0 00.611.611l4.458-1.495A11.96 11.96 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-2.339 0-4.508-.748-6.276-2.018l-.358-.266-3.535 1.185 1.185-3.535-.266-.358A9.956 9.956 0 012 12C2 6.486 6.486 2 12 2s10 4.486 10 10-4.486 10-10 10z"/></svg>
                        <?= t('hero.cta_whatsapp') ?>
                    </a>
                </div>
            </div>
            <div class="hero-mockup reveal-right">
                <div class="device-mockup device-laptop">
                    <img src="<?= img('screenshots/SCREENSHOT-PROPERTIES-LIST.jpg') ?>" alt="Aqar Dashboard" width="800" height="500">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============ TRUST BAR ============ -->
<section class="section-light" style="padding: var(--space-xl) 0;">
    <div class="container">
        <div class="trust-bar reveal-stagger">
            <div class="trust-stat">
                <div class="trust-stat-number" data-count="36" data-suffix="+">0</div>
                <div class="trust-stat-label"><?= t('trust.clients_label') ?></div>
            </div>
            <div class="trust-stat">
                <div class="trust-stat-number"><?= t('trust.since') ?></div>
                <div class="trust-stat-label"><?= t('trust.since_label') ?></div>
            </div>
            <div class="trust-stat">
                <div class="trust-stat-number" style="font-size: var(--text-xl);"><?= t('trust.reach') ?></div>
                <div class="trust-stat-label"><?= t('trust.reach_label') ?></div>
            </div>
        </div>
    </div>
</section>

<!-- ============ FEATURES PREVIEW ============ -->
<section class="section section-light">
    <div class="container">
        <div class="section-header">
            <h2 class="reveal"><?= t('features_page.headline') ?></h2>
            <p class="reveal"><?= t('features_page.subheadline') ?></p>
        </div>
        <div class="grid-3 reveal-stagger">
            <?php
            $previewImages = [
                'screenshots/SCREENSHOT-RENT-DUE.jpg',
                'screenshots/SCREENSHOT-LANDLORDS-LIST.jpg',
                'screenshots/SCREENSHOT-INCOME-EXPENSES-FOR-THE-PROPERTY-MANAGEMENT-COMPANY.jpg'
            ];
            foreach (t('features_preview') as $i => $feature): ?>
            <div class="feature-card">
                <div class="feature-card-icon">
                    <?php echo getIcon($feature['icon']); ?>
                </div>
                <h3 class="feature-card-title"><?= $feature['title'] ?></h3>
                <p><?= $feature['desc'] ?></p>
                <img src="<?= img($previewImages[$i]) ?>" alt="<?= $feature['title'] ?>" loading="lazy" width="400" height="250">
            </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center reveal" style="margin-top: var(--space-xl);">
            <a href="<?= url('features') ?>" class="btn btn-primary"><?= t('nav.features') ?> &rarr;</a>
        </div>
    </div>
</section>

<!-- ============ PRODUCT SHOWCASE ============ -->
<section class="section section-dark">
    <div class="container text-center">
        <div class="section-header">
            <h2 class="reveal"><?= t('showcase.headline') ?></h2>
            <p class="reveal"><?= t('showcase.subheadline') ?></p>
        </div>
        <div class="reveal-scale" style="max-width: 960px; margin: 0 auto;">
            <div class="device-mockup device-laptop" style="transform: perspective(1200px) rotateY(0deg) rotateX(2deg);">
                <img src="<?= img('screenshots/SCREENSHOT-LANDLORDS-LIST.jpg') ?>" alt="Aqar Property Dashboard" width="960" height="600">
            </div>
        </div>
    </div>
</section>

<!-- ============ WHY AQAR ============ -->
<section class="section" style="background: linear-gradient(135deg, var(--color-dark) 0%, #1e2940 50%, var(--color-dark) 100%);">
    <div class="container">
        <div class="section-header">
            <h2 class="reveal" style="color: var(--color-text-light);"><?= t('why.headline') ?></h2>
        </div>
        <div class="grid-4 reveal-stagger">
            <?php foreach (t('why.cards') as $card): ?>
            <div class="glass-card text-center">
                <div style="font-size: 2.5rem; margin-bottom: var(--space-sm); color: var(--color-primary-light);">
                    <?php echo getIcon($card['icon']); ?>
                </div>
                <h3 style="color: white; font-size: var(--text-lg); margin-bottom: 0.5rem;"><?= $card['title'] ?></h3>
                <p style="color: var(--color-text-light-muted); font-size: var(--text-sm);"><?= $card['desc'] ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ============ SOCIAL PROOF ============ -->
<section class="section section-light">
    <div class="container text-center">
        <div class="reveal">
            <div style="font-family: var(--font-heading); font-weight: 800; font-size: var(--text-5xl); color: var(--color-primary); line-height: 1;">36+</div>
            <p style="font-size: var(--text-xl); margin-top: var(--space-sm); max-width: 500px; margin-left: auto; margin-right: auto;"><?= t('proof.headline') ?></p>
            <p style="color: var(--color-text-muted); margin-top: var(--space-xs);"><?= t('proof.subheadline') ?></p>
        </div>
    </div>
</section>

<!-- ============ FAQ ============ -->
<section class="section section-light" style="padding-top: 0;">
    <div class="container" style="max-width: var(--container-narrow);">
        <div class="section-header">
            <h2 class="reveal"><?= t('faq.title') ?></h2>
        </div>
        <div class="reveal">
            <?php foreach (t('faq.items') as $item): ?>
            <div class="faq-item">
                <button class="faq-question"><?= $item['q'] ?></button>
                <div class="faq-answer">
                    <p><?= $item['a'] ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ============ CTA BANNER ============ -->
<?php require_once __DIR__ . '/../includes/cta-banner.php'; ?>

<!-- ============ FOOTER ============ -->
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
