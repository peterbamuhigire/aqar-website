<nav class="nav" id="main-nav">
    <div class="container">
        <div class="nav-inner">
            <a href="<?= url('home') ?>" class="nav-logo">
                <span>A</span>QAR
            </a>

            <button class="nav-hamburger" id="nav-hamburger" aria-label="Menu">
                <span></span><span></span><span></span>
            </button>

            <ul class="nav-links" id="nav-links">
                <li><a href="<?= url('home') ?>" <?= isCurrentPage('home') ? 'class="active"' : '' ?>><?= t('nav.home') ?></a></li>
                <li><a href="<?= url('features') ?>" <?= isCurrentPage('features') ? 'class="active"' : '' ?>><?= t('nav.features') ?></a></li>
                <li><a href="<?= url('about') ?>" <?= isCurrentPage('about') ? 'class="active"' : '' ?>><?= t('nav.about') ?></a></li>
                <li><a href="<?= url('blog') ?>" <?= isCurrentPage('blog') || isCurrentPage('blog-post') ? 'class="active"' : '' ?>><?= t('nav.blog') ?></a></li>
                <li><a href="<?= url('contact') ?>" <?= isCurrentPage('contact') ? 'class="active"' : '' ?>><?= t('nav.contact') ?></a></li>
            </ul>

            <div class="nav-actions">
                <a href="<?= langSwitchUrl() ?>" class="nav-lang"><?= t('nav.language') ?></a>
                <a href="<?= DEMO_URL ?>" target="_blank" rel="noopener" class="btn btn-primary btn-sm"><?= t('nav.demo') ?></a>
                <a href="<?= WHATSAPP_URL ?>" target="_blank" rel="noopener" class="btn btn-secondary btn-sm nav-whatsapp">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.625.846 5.059 2.284 7.034L.789 23.492a.5.5 0 00.611.611l4.458-1.495A11.96 11.96 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-2.339 0-4.508-.748-6.276-2.018l-.358-.266-3.535 1.185 1.185-3.535-.266-.358A9.956 9.956 0 012 12C2 6.486 6.486 2 12 2s10 4.486 10 10-4.486 10-10 10z"/></svg>
                    <span class="nav-whatsapp-text"><?= t('nav.whatsapp') ?></span>
                </a>
            </div>
        </div>
    </div>
</nav>
