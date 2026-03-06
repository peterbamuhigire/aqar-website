<?php
$page_title = t('meta.terms_title');
$page_description = 'Terms and Conditions for using Aqar Property Management Software.';
$page_og_image = 'photos/AQAR-PROPERTY-01.jpg';
$body_class = 'page-terms';

require_once __DIR__ . '/../includes/header.php';
?>

<section class="hero section-dark" style="position: relative; overflow: hidden; padding-bottom: var(--space-2xl);">
    <div style="position: absolute; inset: 0; background: url('<?= img('photos/AQAR-PROPERTY-09.jpg') ?>') center/cover; opacity: 0.15;"></div>
    <div class="container" style="position: relative; z-index: 1;">
        <h1 class="reveal"><?= t('footer.terms') ?></h1>
        <p class="reveal" style="color: var(--color-text-light-muted);">Last updated: March 2026</p>
    </div>
</section>

<section class="section section-light">
    <div class="container">
        <div class="prose">
            <h2>1. Introduction</h2>
            <p>These Terms and Conditions govern your use of the Aqar Property Management Software platform ("the Service") provided by <?= COMPANY_NAME ?>, registered in Kampala, Uganda ("the Company", "we", "us").</p>
            <p>By accessing or using the Service, you agree to be bound by these Terms. If you do not agree, please do not use the Service.</p>

            <h2>2. Service Description</h2>
            <p>Aqar is a cloud-based property management software platform that provides tools for rent collection, tenant management, maintenance tracking, financial reporting, and lease management. The Service is accessible via web browser on any internet-connected device.</p>

            <h2>3. Account Registration</h2>
            <p>To use the Service, you must create an account with accurate and complete information. You are responsible for maintaining the confidentiality of your account credentials and for all activities that occur under your account.</p>
            <p>You must notify us immediately of any unauthorised use of your account.</p>

            <h2>4. Demo Access</h2>
            <p>We provide a live demonstration environment at <?= DEMO_URL ?> for evaluation purposes. Demo data is shared and should not be used for real property management. We reserve the right to reset demo data at any time.</p>

            <h2>5. Acceptable Use</h2>
            <p>You agree not to:</p>
            <ul>
                <li>Use the Service for any unlawful purpose</li>
                <li>Attempt to gain unauthorised access to any part of the Service</li>
                <li>Interfere with or disrupt the Service's infrastructure</li>
                <li>Upload malicious code or content</li>
                <li>Resell or redistribute the Service without our written consent</li>
            </ul>

            <h2>6. Data Ownership</h2>
            <p>You retain ownership of all data you input into the Service. We do not claim any ownership rights over your data. You grant us a limited licence to process your data solely for the purpose of providing the Service.</p>

            <h2>7. Data Security</h2>
            <p>We implement industry-standard security measures including data encryption in transit and at rest, server firewall protection, and encrypted backup options. However, no method of electronic transmission or storage is 100% secure, and we cannot guarantee absolute security.</p>

            <h2>8. Payment Terms</h2>
            <p>Service fees are based on your subscription plan and the number of properties managed. Fees are communicated during the onboarding process and confirmed in your service agreement. Payment terms are net 30 days unless otherwise agreed.</p>

            <h2>9. Service Availability</h2>
            <p>We strive to maintain 99.5% uptime. However, we may occasionally need to perform maintenance or updates that temporarily affect availability. We will provide reasonable notice of planned maintenance where possible.</p>

            <h2>10. Limitation of Liability</h2>
            <p>To the maximum extent permitted by law, the Company shall not be liable for any indirect, incidental, special, consequential, or punitive damages, or any loss of profits or revenues, whether incurred directly or indirectly, or any loss of data, use, goodwill, or other intangible losses resulting from your use of the Service.</p>

            <h2>11. Termination</h2>
            <p>Either party may terminate the service agreement with 30 days' written notice. Upon termination, we will provide you with a copy of your data in a standard format within 14 days of your request.</p>

            <h2>12. Governing Law</h2>
            <p>These Terms shall be governed by and construed in accordance with the laws of the Republic of Uganda. Any disputes arising from these Terms shall be resolved through the courts of Kampala, Uganda.</p>

            <h2>13. Changes to Terms</h2>
            <p>We reserve the right to modify these Terms at any time. We will notify registered users of significant changes via email. Continued use of the Service after changes constitutes acceptance of the modified Terms.</p>

            <h2>14. Contact</h2>
            <p>For questions about these Terms, contact us at:</p>
            <p><?= COMPANY_NAME ?><br><?= ADDRESS ?><br>Email: <?= EMAIL ?><br>Phone: <?= WHATSAPP_NUMBER ?></p>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
