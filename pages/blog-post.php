<?php
// $blogSlug is set by router.php
$posts = require __DIR__ . '/../content/blog/' . lang() . '.php';

if (!isset($posts[$blogSlug])) {
    http_response_code(404);
    echo '<h1>Post Not Found</h1>';
    exit;
}

$post = $posts[$blogSlug];

$page_title = $post['title'] . ' — Aqar Blog';
$page_description = $post['excerpt'];
$page_og_image = $post['og_image'];
$body_class = 'page-blog-post';

require_once __DIR__ . '/../includes/header.php';
?>

<!-- Post Hero -->
<section class="hero section-dark" style="position: relative; overflow: hidden;">
    <div style="position: absolute; inset: 0; background: url('<?= img($post['og_image']) ?>') center/cover; opacity: 0.2;"></div>
    <div class="container" style="position: relative; z-index: 1; max-width: var(--container-narrow);">
        <a href="<?= url('blog') ?>" style="color: var(--color-primary-light); text-decoration: none; font-size: var(--text-sm); display: inline-block; margin-bottom: var(--space-md);"><?= t('blog.back_to_blog') ?></a>
        <h1 class="reveal"><?= $post['title'] ?></h1>
        <p class="reveal" style="color: var(--color-text-light-muted);">
            <?= t('blog.by') ?> <?= $post['author'] ?> &middot; <?= date('F j, Y', strtotime($post['date'])) ?>
        </p>
    </div>
</section>

<!-- Post Content -->
<section class="section section-light">
    <div class="container">
        <article class="prose reveal">
            <?= $post['content'] ?>
        </article>
    </div>
</section>

<?php require_once __DIR__ . '/../includes/cta-banner.php'; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
