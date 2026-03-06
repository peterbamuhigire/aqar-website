<?php
$currentLanguage = 'en';
$translations = [];

function setLanguage($lang) {
    global $currentLanguage, $translations;
    $currentLanguage = $lang;
    $langFile = __DIR__ . '/../lang/' . $lang . '.php';
    if (file_exists($langFile)) {
        $translations = require $langFile;
    }
}

function t($key, $replacements = []) {
    global $translations;
    $keys = explode('.', $key);
    $value = $translations;
    foreach ($keys as $k) {
        if (is_array($value) && isset($value[$k])) {
            $value = $value[$k];
        } else {
            return $key; // Return key if translation not found
        }
    }
    foreach ($replacements as $placeholder => $replacement) {
        $value = str_replace(':' . $placeholder, $replacement, $value);
    }
    return $value;
}

function lang() {
    global $currentLanguage;
    return $currentLanguage;
}

function otherLang() {
    global $currentLanguage;
    return $currentLanguage === 'en' ? 'fr' : 'en';
}

function url($page, $lang = null) {
    global $currentLanguage;
    $lang = $lang ?? $currentLanguage;
    $slug = REVERSE_ROUTES[$lang][$page] ?? $page;
    $path = $slug === '' ? '' : $slug . '/';
    return BASE_PATH . $lang . '/' . $path;
}

function blogUrl($slug, $lang = null) {
    global $currentLanguage;
    $lang = $lang ?? $currentLanguage;
    return BASE_PATH . $lang . '/blog/' . $slug . '/';
}

function isCurrentPage($page) {
    global $currentPage;
    return $currentPage === $page;
}

function langSwitchUrl() {
    global $currentPage, $currentLang, $blogSlug;
    $other = otherLang();
    if ($currentPage === 'blog-post' && !empty($blogSlug)) {
        return blogUrl($blogSlug, $other);
    }
    return url($currentPage, $other);
}

function asset($path) {
    return BASE_PATH . 'assets/' . $path;
}

function img($path) {
    return BASE_PATH . 'assets/img/' . $path;
}
