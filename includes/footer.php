    <footer class="section-dark" style="padding-top: var(--space-3xl); padding-bottom: var(--space-lg);">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <a href="<?= url('home') ?>" class="footer-logo"><span>A</span>QAR</a>
                    <p class="footer-desc"><?= t('footer.description') ?></p>
                    <p class="footer-address"><?= ADDRESS ?></p>
                </div>

                <div class="footer-col">
                    <h4><?= t('footer.nav_title') ?></h4>
                    <ul>
                        <li><a href="<?= url('home') ?>"><?= t('nav.home') ?></a></li>
                        <li><a href="<?= url('features') ?>"><?= t('nav.features') ?></a></li>
                        <li><a href="<?= url('about') ?>"><?= t('nav.about') ?></a></li>
                        <li><a href="<?= url('blog') ?>"><?= t('nav.blog') ?></a></li>
                        <li><a href="<?= url('contact') ?>"><?= t('nav.contact') ?></a></li>
                        <li><a href="<?= url('demo') ?>"><?= t('nav.demo') ?></a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4><?= t('footer.contact_title') ?></h4>
                    <ul>
                        <li><a href="tel:<?= str_replace(' ', '', WHATSAPP_NUMBER) ?>"><?= WHATSAPP_NUMBER ?></a></li>
                        <li><a href="tel:<?= str_replace(' ', '', PHONE_ALT) ?>"><?= PHONE_ALT ?></a></li>
                        <li><a href="mailto:<?= EMAIL ?>"><?= EMAIL ?></a></li>
                        <li><a href="<?= WHATSAPP_URL ?>" target="_blank" rel="noopener"><?= t('contact.whatsapp_cta') ?></a></li>
                    </ul>

                    <h4 style="margin-top: var(--space-md);"><?= t('footer.legal_title') ?></h4>
                    <ul>
                        <li><a href="<?= url('terms') ?>"><?= t('footer.terms') ?></a></li>
                        <li><a href="<?= url('privacy') ?>"><?= t('footer.privacy') ?></a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p><?= t('footer.copyright', ['year' => date('Y')]) ?></p>
                <p class="footer-partners" style="display: flex; align-items: center; justify-content: center; gap: 0.5rem; flex-wrap: wrap;">
                    <?= t('footer.powered_by') ?>
                    <a href="https://chwezi.co.za" target="_blank" rel="noopener" style="display: inline-flex; align-items: center; gap: 0.35rem;">
                        <img src="<?= img('photos/CoreLogoLightEdition.png') ?>" alt="Chwezi" style="height: 20px; width: auto;">
                        <?= COMPANY_NAME ?>
                    </a>
                    &middot; <?= t('footer.partner_dev') ?>: <a href="https://techguypeter.com" target="_blank" rel="noopener">Peter Bamuhigire</a>
                </p>
            </div>
        </div>
    </footer>

    <!-- GSAP -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
    <script src="<?= asset('js/nav.js') ?>"></script>
    <script src="<?= asset('js/main.js') ?>"></script>
</body>
</html>
