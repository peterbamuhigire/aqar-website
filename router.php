<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/i18n.php';

// Get language and path from query params (set by .htaccess)
$lang = $_GET['lang'] ?? DEFAULT_LANG;
$path = trim($_GET['path'] ?? '', '/');

// Validate language
if (!in_array($lang, LANGUAGES)) {
    $lang = DEFAULT_LANG;
}

// Set current language for i18n
setLanguage($lang);

// Parse path - handle blog posts specially
$routes = ROUTES[$lang];
$segments = explode('/', $path);
$firstSegment = $segments[0] ?? '';

// Check for blog post: blog/slug-name
if ($firstSegment === 'blog' && isset($segments[1]) && $segments[1] !== '') {
    $page = 'blog-post';
    $blogSlug = $segments[1];
} elseif (isset($routes[$firstSegment])) {
    $page = $routes[$firstSegment];
    $blogSlug = null;
} else {
    // 404
    http_response_code(404);
    $page = '404';
    $blogSlug = null;
}

// Set page variables available to templates
$currentPage = $page;
$currentLang = $lang;

// Include page template
$pageFile = __DIR__ . '/pages/' . $page . '.php';
if (file_exists($pageFile)) {
    require $pageFile;
} else {
    // Fallback: show simple 404
    http_response_code(404);
    echo '<!DOCTYPE html><html><head><title>404</title></head><body><h1>Page Not Found</h1><p><a href="' . BASE_PATH . $lang . '/">Return Home</a></p></body></html>';
}
