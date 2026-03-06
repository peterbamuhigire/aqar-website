<?php
$page_title = t('meta.blog_title');
$page_description = t('meta.blog_desc');
$page_og_image = 'photos/AQAR-PROPERTY-01.jpg';
$body_class = 'page-blog';

require_once __DIR__ . '/../includes/header.php';

// Load blog posts for current language
$posts = require __DIR__ . '/../content/blog/' . lang() . '.php';
?>

<section class="hero section-dark" style="position: relative; overflow: hidden; padding-bottom: var(--space-2xl);">
    <div style="position: absolute; inset: 0; background: url('<?= img('photos/AQAR-PROPERTY-03.jpg') ?>') center/cover; opacity: 0.15;"></div>
    <div class="container text-center" style="position: relative; z-index: 1;">
        <h1 class="reveal"><?= t('blog.title') ?></h1>
        <p class="reveal" style="font-size: var(--text-xl); max-width: 600px; margin: 0 auto;"><?= t('blog.subtitle') ?></p>
    </div>
</section>

<section class="section section-light">
    <div class="container">
        <div class="grid-3 reveal-stagger">
            <?php foreach ($posts as $post): ?>
            <article class="blog-card">
                <a href="<?= blogUrl($post['slug']) ?>" class="blog-card-image">
                    <img src="<?= img($post['og_image']) ?>" alt="<?= htmlspecialchars($post['title']) ?>" loading="lazy" width="400" height="225">
                </a>
                <div class="blog-card-body">
                    <time class="blog-card-date"><?= date('F j, Y', strtotime($post['date'])) ?></time>
                    <h3><a href="<?= blogUrl($post['slug']) ?>"><?= $post['title'] ?></a></h3>
                    <p><?= $post['excerpt'] ?></p>
                    <a href="<?= blogUrl($post['slug']) ?>" class="blog-card-link"><?= t('blog.read_more') ?> &rarr;</a>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../includes/cta-banner.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
