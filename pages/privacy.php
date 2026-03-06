<?php
$page_title = t('meta.privacy_title');
$page_description = 'Privacy Policy for Aqar Property Management Software.';
$page_og_image = 'photos/AQAR-PROPERTY-01.jpg';
$body_class = 'page-privacy';

require_once __DIR__ . '/../includes/header.php';
?>

<section class="hero section-dark" style="position: relative; overflow: hidden; padding-bottom: var(--space-2xl);">
    <div style="position: absolute; inset: 0; background: url('<?= img('photos/AQAR-PROPERTY-04.jpg') ?>') center/cover; opacity: 0.15;"></div>
    <div class="container" style="position: relative; z-index: 1;">
        <h1 class="reveal"><?= t('footer.privacy') ?></h1>
        <p class="reveal" style="color: var(--color-text-light-muted);">Last updated: March 2026</p>
    </div>
</section>

<section class="section section-light">
    <div class="container">
        <div class="prose">
            <h2>1. Introduction</h2>
            <p>This Privacy Policy explains how <?= COMPANY_NAME ?> ("we", "us", "our") collects, uses, and protects your personal information when you use the Aqar Property Management Software platform ("the Service") and our website at aqarproperty.co.uk.</p>

            <h2>2. Information We Collect</h2>
            <h3>Information You Provide</h3>
            <ul>
                <li><strong>Contact Form:</strong> Name, email address, phone number (optional), and message content when you contact us through our website.</li>
                <li><strong>Account Registration:</strong> Name, email, phone number, and company details when you register for the Service.</li>
                <li><strong>Property Data:</strong> Property details, tenant information, financial records, and other data you input into the Service.</li>
            </ul>
            <h3>Information Collected Automatically</h3>
            <ul>
                <li><strong>Usage Data:</strong> Pages visited, features used, and general interaction patterns with the Service.</li>
                <li><strong>Technical Data:</strong> Browser type, device type, IP address, and operating system.</li>
            </ul>

            <h2>3. How We Use Your Information</h2>
            <ul>
                <li>To provide and maintain the Service</li>
                <li>To respond to your enquiries and support requests</li>
                <li>To send service-related notifications</li>
                <li>To improve and develop the Service</li>
                <li>To comply with legal obligations</li>
            </ul>

            <h2>4. Data Storage and Security</h2>
            <p>Your data is stored on secure servers with the following protections:</p>
            <ul>
                <li>Encryption in transit (TLS/SSL) and at rest</li>
                <li>Server firewall protection</li>
                <li>Regular encrypted backups</li>
                <li>Access controls and authentication</li>
            </ul>

            <h2>5. Data Sharing</h2>
            <p>We do not sell, trade, or rent your personal information to third parties. We may share data only in the following circumstances:</p>
            <ul>
                <li>With your explicit consent</li>
                <li>To comply with legal obligations or court orders</li>
                <li>With service providers who assist in operating the Service (e.g., email delivery), bound by confidentiality agreements</li>
            </ul>

            <h2>6. Data Retention</h2>
            <p>We retain your data for as long as your account is active or as needed to provide the Service. Contact form submissions are retained for 12 months. Upon account termination, data is retained for 30 days before permanent deletion, during which time you may request an export.</p>

            <h2>7. Your Rights</h2>
            <p>You have the right to:</p>
            <ul>
                <li>Access your personal data</li>
                <li>Request correction of inaccurate data</li>
                <li>Request deletion of your data</li>
                <li>Export your data in a standard format</li>
                <li>Withdraw consent for optional data processing</li>
            </ul>

            <h2>8. Cookies</h2>
            <p>Our website uses essential session cookies for functionality (e.g., CSRF protection, form submission tracking). We do not use advertising or tracking cookies.</p>

            <h2>9. Children's Privacy</h2>
            <p>The Service is not intended for use by individuals under the age of 18. We do not knowingly collect personal information from children.</p>

            <h2>10. Changes to This Policy</h2>
            <p>We may update this Privacy Policy from time to time. We will notify registered users of significant changes via email. The "Last updated" date at the top of this page indicates when this policy was last revised.</p>

            <h2>11. Contact Us</h2>
            <p>For privacy-related enquiries, contact us at:</p>
            <p><?= COMPANY_NAME ?><br><?= ADDRESS ?><br>Email: <?= EMAIL ?><br>Phone: <?= WHATSAPP_NUMBER ?></p>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
