<?php
$page_title = t('meta.contact_title');
$page_description = t('meta.contact_desc');
$page_og_image = 'photos/AQAR-PROPERTY-06.jpg';
$body_class = 'page-contact';

// Generate CSRF token
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

require_once __DIR__ . '/../includes/header.php';
?>

<section class="hero section-dark" style="position: relative; overflow: hidden; padding-bottom: var(--space-2xl);">
    <div style="position: absolute; inset: 0; background: url('<?= img('photos/AQAR-PROPERTY-06.jpg') ?>') center/cover; opacity: 0.15;"></div>
    <div class="container text-center" style="position: relative; z-index: 1;">
        <h1 class="reveal"><?= t('contact.headline') ?></h1>
        <p class="reveal" style="font-size: var(--text-xl); max-width: 600px; margin: 0 auto;"><?= t('contact.subheadline') ?></p>
    </div>
</section>

<section class="section section-light">
    <div class="container">
        <div class="grid-2" style="gap: var(--space-2xl);">
            <!-- Contact Form -->
            <div class="reveal-left">
                <form id="contact-form" action="<?= BASE_PATH ?>includes/contact-handler.php" method="POST">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

                    <div class="form-group">
                        <label for="name"><?= t('contact.form_name') ?> *</label>
                        <input type="text" id="name" name="name" required minlength="2" placeholder="<?= t('contact.form_name') ?>">
                    </div>

                    <div class="form-group">
                        <label for="email"><?= t('contact.form_email') ?> *</label>
                        <input type="email" id="email" name="email" required placeholder="<?= t('contact.form_email') ?>">
                    </div>

                    <div class="form-group">
                        <label for="phone"><?= t('contact.form_phone') ?></label>
                        <input type="tel" id="phone" name="phone" placeholder="<?= t('contact.form_phone') ?>">
                    </div>

                    <div class="form-group">
                        <label for="message"><?= t('contact.form_message') ?> *</label>
                        <textarea id="message" name="message" rows="5" required minlength="10" placeholder="<?= t('contact.form_message') ?>"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg" id="submit-btn"><?= t('contact.form_submit') ?></button>
                </form>
                <div id="form-status" style="margin-top: var(--space-md); display: none;"></div>
            </div>

            <!-- Contact Info -->
            <div class="reveal-right">
                <!-- WhatsApp CTA -->
                <div style="background: var(--color-secondary); color: white; border-radius: var(--radius-lg); padding: var(--space-lg); margin-bottom: var(--space-lg);">
                    <h3 style="color: white; margin-bottom: 0.5rem;"><?= t('contact.whatsapp_cta') ?></h3>
                    <p style="color: rgba(255,255,255,0.9); margin-bottom: var(--space-md);"><?= t('contact.whatsapp_desc') ?></p>
                    <a href="<?= WHATSAPP_URL ?>" target="_blank" rel="noopener" class="btn" style="background: white; color: var(--color-secondary);">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.625.846 5.059 2.284 7.034L.789 23.492a.5.5 0 00.611.611l4.458-1.495A11.96 11.96 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-2.339 0-4.508-.748-6.276-2.018l-.358-.266-3.535 1.185 1.185-3.535-.266-.358A9.956 9.956 0 012 12C2 6.486 6.486 2 12 2s10 4.486 10 10-4.486 10-10 10z"/></svg>
                        <?= WHATSAPP_NUMBER ?>
                    </a>
                </div>

                <!-- Contact Details -->
                <div style="margin-bottom: var(--space-lg);">
                    <h3><?= t('contact.phone_label') ?></h3>
                    <p><a href="tel:<?= str_replace(' ', '', WHATSAPP_NUMBER) ?>"><?= WHATSAPP_NUMBER ?></a></p>
                    <p><a href="tel:<?= str_replace(' ', '', PHONE_ALT) ?>"><?= PHONE_ALT ?></a></p>
                </div>

                <div style="margin-bottom: var(--space-lg);">
                    <h3><?= t('contact.email_label') ?></h3>
                    <p><a href="mailto:<?= EMAIL ?>"><?= EMAIL ?></a></p>
                </div>

                <div style="margin-bottom: var(--space-lg);">
                    <h3><?= t('contact.address_label') ?></h3>
                    <p><?= ADDRESS ?></p>
                </div>

                <div style="margin-bottom: var(--space-lg);">
                    <h3><?= t('contact.hours_label') ?></h3>
                    <p><?= t('contact.hours_weekday') ?></p>
                    <p><?= t('contact.hours_saturday') ?></p>
                </div>

                <!-- Map -->
                <div style="border-radius: var(--radius-lg); overflow: hidden; box-shadow: var(--shadow-md);">
                    <iframe src="https://www.openstreetmap.org/export/embed.html?bbox=32.590%2C0.343%2C32.602%2C0.352&layer=mapnik&marker=0.3476%2C32.5960" width="100%" height="250" style="border: 0;" loading="lazy" title="Aqar Office Location"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../includes/cta-banner.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>

<script>
document.getElementById('contact-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const btn = document.getElementById('submit-btn');
    const status = document.getElementById('form-status');
    const form = this;

    btn.disabled = true;
    btn.textContent = '<?= t('contact.form_sending') ?>';

    fetch(form.action, {
        method: 'POST',
        body: new FormData(form)
    })
    .then(r => r.json())
    .then(data => {
        status.style.display = 'block';
        if (data.success) {
            status.innerHTML = '<div style="background: rgba(52,168,83,0.1); color: #34A853; padding: 1rem; border-radius: 8px; border: 1px solid rgba(52,168,83,0.2);">' + data.message + '</div>';
            form.reset();
        } else {
            status.innerHTML = '<div style="background: rgba(234,67,53,0.1); color: #EA4335; padding: 1rem; border-radius: 8px; border: 1px solid rgba(234,67,53,0.2);">' + data.message + '</div>';
        }
        btn.disabled = false;
        btn.textContent = '<?= t('contact.form_submit') ?>';
    })
    .catch(() => {
        status.style.display = 'block';
        status.innerHTML = '<div style="background: rgba(234,67,53,0.1); color: #EA4335; padding: 1rem; border-radius: 8px;"><?= t('contact.form_error') ?></div>';
        btn.disabled = false;
        btn.textContent = '<?= t('contact.form_submit') ?>';
    });
});
</script>
