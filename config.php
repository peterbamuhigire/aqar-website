<?php
define('SITE_NAME', 'Aqar Property Management Software');
define('SITE_URL', 'https://aqarproperty.co.uk');
define('BASE_PATH', '/aqar-website/');
define('DEMO_URL', 'https://property.chwezi.co.za');
define('WHATSAPP_URL', 'https://wa.me/256784464178');
define('WHATSAPP_NUMBER', '+256 784 464178');
define('PHONE_ALT', '+256 741 430561');
define('EMAIL', 'info@aqarproperty.co.uk');
define('ADDRESS', 'Sserumaga Road, Bukoto, Kampala, Uganda');
define('COMPANY_NAME', 'Chwezi Core Systems Limited');
define('YEAR_FOUNDED', '2018');
define('CLIENT_COUNT', '36');

// Supported languages
define('LANGUAGES', ['en', 'fr']);
define('DEFAULT_LANG', 'en');

// Page route mappings per language
define('ROUTES', [
    'en' => [
        '' => 'home',
        'features' => 'features',
        'about' => 'about',
        'blog' => 'blog',
        'contact' => 'contact',
        'demo' => 'demo',
        'terms' => 'terms',
        'privacy' => 'privacy',
    ],
    'fr' => [
        '' => 'home',
        'fonctionnalites' => 'features',
        'a-propos' => 'about',
        'blog' => 'blog',
        'contact' => 'contact',
        'demo' => 'demo',
        'conditions' => 'terms',
        'confidentialite' => 'privacy',
    ],
]);

// Reverse routes (page name => localized slug) for URL generation
define('REVERSE_ROUTES', [
    'en' => [
        'home' => '',
        'features' => 'features',
        'about' => 'about',
        'blog' => 'blog',
        'contact' => 'contact',
        'demo' => 'demo',
        'terms' => 'terms',
        'privacy' => 'privacy',
    ],
    'fr' => [
        'home' => '',
        'features' => 'fonctionnalites',
        'about' => 'a-propos',
        'blog' => 'blog',
        'contact' => 'contact',
        'demo' => 'demo',
        'terms' => 'conditions',
        'privacy' => 'confidentialite',
    ],
]);
