# Aqar Website Implementation Plan

> **For Claude:** REQUIRED SUB-SKILL: Use superpowers:executing-plans to implement this plan task-by-task.

**Goal:** Build the complete Aqar Property Management marketing website with English/French i18n, GSAP animations, device mockups, and PHPMailer contact form.

**Architecture:** PHP-based static marketing site running on WAMP/Apache. Shared components via PHP includes. i18n via PHP translation arrays loaded per-language. URL routing via .htaccess rewrite rules. No build step, no npm.

**Tech Stack:** PHP 8+, vanilla CSS (custom properties), GSAP 3 (CDN), PHPMailer (Composer), self-hosted Google Fonts (Plus Jakarta Sans, Source Sans 3).

---

## Photo Bank Mapping

| Usage | File |
|-------|------|
| Hero dashboard mockup | `SCREENSHOT-PROPERTIES-LIST.jpg` |
| Home features: Rent | `SCREENSHOT-RENT-DUE.jpg` |
| Home features: Tenants | `SCREENSHOT-LANDLORDS-LIST.jpg` |
| Home features: Financials | `SCREENSHOT-INCOME-EXPENSES-FOR-THE-PROPERTY-MANAGEMENT-COMPANY.jpg` |
| Product showcase full-width | `SCREENSHOT-LANDLORDS-LIST.jpg` |
| Features: Rent Collection | `SCREENSHOT-RENT-PAYMENT.jpg` |
| Features: Tenant Management | `SCREENSHOT-LANDLORDS-LIST.jpg` |
| Features: Maintenance | `SCREENSHOT-ADD-MAINTENANCE-RECORD.jpg` |
| Features: Financial Reports | `SCREENSHOT-MONTHLY-REPORT-REMMITANCE-DETAILS-FOR-LANDLORD-WITH-COMMISION-DUE-TO-COMPANY.jpg` |
| Features: Lease Management | `SCREENSHOT-INSPECTION-TEMPLATES.jpg` |
| Features: Mobile/Security | `SCREENSHOT-LOGIN.jpg` |
| About hero background | `AQAR-PROPERTY-08.jpg` (woman with tablet + building models) |
| About developer section | `AQAR-PROPERTY-05.jpg` (man pointing at tablet data) |
| Blog OG: Marketing Rentals | `AQAR-PROPERTY-01.jpg` (hands on laptop) |
| Blog OG: Management Agreement | `AQAR-PROPERTY-09.jpg` (building model + contract) |
| Blog OG: Choosing Company | `AQAR-PROPERTY-04.jpg` (contract + house model) |
| Contact page accent | `AQAR-PROPERTY-06.jpg` (tablet on blueprints) |
| Demo page screenshot | `SCREENSHOT-LOGIN.jpg` |
| Homepage OG image | `AQAR-PROPERTY-01.jpg` |
| Security/RBAC secondary | `SCREENSHOT-PERMISSIONS-ROLES-MANAGEMENT-RBAC.jpg` |
| Occupancy charts | `SCREENSHOT-OCCUPANCY-RATES.jpg` |

---

## Task 1: Project Scaffolding & .htaccess Routing

**Files:**
- Create: `.htaccess`
- Create: `index.php` (root redirect)
- Create: `config.php`

**Step 1: Create root .htaccess with rewrite rules**

```apache
RewriteEngine On
RewriteBase /aqar-website/

# Root → English
RewriteRule ^$ en/ [R=302,L]

# Language folders — route to PHP files
# /en/ → /en/index.php, /en/features/ → /en/features/index.php, etc.
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(en|fr)/(.*)$ router.php?lang=$1&path=$2 [L,QSA]
```

**Step 2: Create config.php with site-wide constants**

Define base URL, supported languages, site name, contact details, demo URL, WhatsApp URL — all referenced from `docs/en/company-profile.md`.

**Step 3: Create router.php**

Simple PHP router that maps URL paths to page files. Loads the correct language, includes the correct page template.

**Step 4: Verify in browser**

Visit `http://localhost/aqar-website/` — should redirect to `/aqar-website/en/`.

**Step 5: Commit**

```bash
git add .htaccess index.php config.php router.php
git commit -m "feat: project scaffolding with Apache rewrite routing and i18n config"
```

---

## Task 2: i18n Translation System

**Files:**
- Create: `lang/en.php`
- Create: `lang/fr.php`
- Create: `includes/i18n.php`

**Step 1: Create English translation array**

All UI strings: nav labels, CTA text, section headings, trust bar numbers, footer text, form labels, meta descriptions. Source from `docs/en/pages.md`, `docs/en/company-profile.md`, `docs/en/services.md`, `docs/en/contact.md`, `docs/en/faq.md`.

Key sections in the array:
- `nav` — Home, Features, Blog, About, Contact, Try Demo, WhatsApp Us
- `hero` — headline, subheadline, cta_demo, cta_whatsapp
- `trust` — clients count, since year, reach
- `features_preview` — 3 items with title + description
- `features_page` — 6 modules with title, description, bullets
- `why_aqar` — 4 benefit cards
- `about` — story sections, Peter bio, Chwezi story
- `blog` — index title, read more, article metadata
- `contact` — form labels, address, hours
- `demo` — heading, description, features list
- `faq` — all 10 Q&A pairs
- `footer` — company info, links, copyright
- `meta` — per-page titles and descriptions

**Step 2: Create French translation array**

Mirror the English structure. Source from `docs/fr/` files. Use formal West African French.

**Step 3: Create i18n helper**

`includes/i18n.php` — function `t($key)` that returns the translation for the current language. Dot-notation: `t('nav.home')`. Function `lang()` returns current language code. Function `url($path)` returns language-prefixed URL.

**Step 4: Test translations load**

Add a temporary echo in router.php to verify `t('nav.home')` returns "Home" for /en/ and "Accueil" for /fr/.

**Step 5: Commit**

```bash
git add lang/ includes/i18n.php
git commit -m "feat: bilingual i18n system with EN/FR translation arrays"
```

---

## Task 3: CSS Design System & Fonts

**Files:**
- Create: `assets/css/variables.css`
- Create: `assets/css/base.css`
- Create: `assets/css/components.css`
- Create: `assets/css/layout.css`
- Create: `assets/css/animations.css`
- Create: `assets/css/responsive.css`
- Create: `assets/fonts/` (download font files)

**Step 1: Download and self-host fonts**

Download from Google Fonts API:
- Plus Jakarta Sans: 700, 800 weights (woff2)
- Source Sans 3: 400, 600 weights (woff2)

Place in `assets/fonts/`. Create `@font-face` declarations in `variables.css`.

**Step 2: Create CSS custom properties (variables.css)**

```css
:root {
  /* Kampala Dusk palette */
  --color-primary: #0D7377;      /* Deep Teal */
  --color-secondary: #E8913A;    /* Warm Amber */
  --color-dark: #1A1F2E;         /* Charcoal */
  --color-light: #FAFAF7;        /* Warm White */
  --color-success: #34A853;      /* Soft Green */
  --color-text: #2D2D2D;         /* Near Black */
  --color-text-light: #F5F5F0;   /* Off White */

  /* Typography */
  --font-heading: 'Plus Jakarta Sans', sans-serif;
  --font-body: 'Source Sans 3', sans-serif;

  /* Spacing scale */
  --space-xs: 0.5rem;
  --space-sm: 1rem;
  --space-md: 2rem;
  --space-lg: 4rem;
  --space-xl: 6rem;
  --space-2xl: 8rem;

  /* Container */
  --container-max: 1280px;
  --container-padding: 1.5rem;

  /* Shadows */
  --shadow-card: 0 4px 24px rgba(0,0,0,0.08);
  --shadow-mockup: 0 25px 60px rgba(0,0,0,0.3);

  /* Glass morphism */
  --glass-bg: rgba(255,255,255,0.08);
  --glass-border: rgba(255,255,255,0.15);
  --glass-blur: 12px;

  /* Border radius */
  --radius-sm: 8px;
  --radius-md: 12px;
  --radius-lg: 16px;
  --radius-xl: 24px;
}
```

**Step 3: Create base.css**

Reset, body styles, heading hierarchy (h1-h6 with Plus Jakarta Sans), body text (Source Sans 3), link styles, `.container` utility.

**Step 4: Create components.css**

Reusable components:
- `.btn-primary` (teal, rounded, hover glow)
- `.btn-secondary` (amber/WhatsApp, rounded)
- `.btn-outline` (ghost button variant)
- `.device-mockup-laptop` (CSS-only laptop frame with screenshot inside, 2-4 degree tilt, shadow)
- `.device-mockup-tablet`
- `.device-mockup-phone`
- `.glass-card` (backdrop-blur, border, subtle bg)
- `.section-dark` (charcoal bg, light text)
- `.section-light` (warm white bg, dark text)
- `.section-teal` (teal bg for CTA banner)
- `.trust-stat` (number + label stat block)
- `.feature-card` (icon + title + text + optional screenshot)

**Step 5: Create layout.css**

Grid utilities, flex utilities, section padding, alternating section styling, feature-row (left/right alternating with screenshot).

**Step 6: Create animations.css**

GSAP-ready classes:
- `.reveal` (opacity: 0, transform: translateY(30px) — GSAP will animate in)
- `.reveal-left` (translateX(-40px))
- `.reveal-right` (translateX(40px))
- `.reveal-scale` (scale(0.95))

**Step 7: Create responsive.css**

Breakpoints: 375px base (mobile), 768px (tablet), 1024px (small desktop), 1280px+ (large).
- Mobile: single column, stacked hero, smaller headings
- Tablet: 2-column features, side-by-side CTAs
- Desktop: full layout per design

**Step 8: Commit**

```bash
git add assets/css/ assets/fonts/
git commit -m "feat: Kampala Dusk design system — CSS variables, components, device mockups, responsive"
```

---

## Task 4: Shared PHP Includes (Header, Footer, Nav, CTA Banner)

**Files:**
- Create: `includes/header.php`
- Create: `includes/nav.php`
- Create: `includes/footer.php`
- Create: `includes/cta-banner.php`
- Create: `includes/head.php` (HTML <head> with meta, OG, hreflang, CSS)

**Step 1: Create head.php**

HTML `<head>` block with:
- charset, viewport meta
- Page title from `$page_title` variable
- Meta description from `$page_description`
- OG tags (title, description, image, locale)
- hreflang alternates for EN and FR
- Canonical URL
- CSS includes (variables.css, base.css, components.css, layout.css, animations.css, responsive.css)
- Google Fonts preconnect (removed — self-hosted)
- Favicon (use Aqar logo from screenshot — extract or use text placeholder)

**Step 2: Create nav.php**

Fixed top navigation:
- Logo (text "AQAR" styled in Plus Jakarta Sans 800, or the logo image if available)
- Links: Home, Features, Blog, About, Contact (using `t()` for labels, `url()` for hrefs)
- Language switcher (EN | FR) — toggles to same page in other language
- CTA buttons: [Try Demo] (teal) + [WhatsApp] (amber) — right-aligned
- Mobile hamburger menu (CSS + minimal JS toggle)
- Dark transparent bg that becomes solid on scroll

**Step 3: Create footer.php**

3-column footer on dark charcoal bg:
- Col 1: "AQAR" logo text + company description + Bukoto address
- Col 2: Navigation links + legal links (Terms, Privacy)
- Col 3: Contact info (phone, email, WhatsApp) + partner links (chwezi.co.za, techguypeter.com)
- Bottom bar: copyright + "Powered by Chwezi Core Systems"

**Step 4: Create cta-banner.php**

Reusable teal CTA section:
- Heading: "Ready to simplify your property management?" / FR equivalent
- Subtext: one line
- [Try Demo] + [WhatsApp Us] buttons

**Step 5: Create header.php**

Wrapper that includes head.php, opens `<body>`, includes nav.php. Accepts `$page_title`, `$page_description`, `$page_og_image`, `$body_class` variables.

**Step 6: Verify includes render**

Create a minimal test page at `/en/index.php` that includes header + "Hello" + cta-banner + footer. Visit in browser.

**Step 7: Commit**

```bash
git add includes/
git commit -m "feat: shared PHP includes — header, nav, footer, CTA banner with i18n"
```

---

## Task 5: Homepage (EN)

**Files:**
- Create: `pages/home.php`

**Step 1: Build hero section**

Dark charcoal (#1A1F2E) background. Two-column layout:
- Left (60%): headline from `t('hero.headline')` ("Property Management, Simplified."), subheadline, [Try Demo] + [WhatsApp Us] buttons
- Right (40%): `SCREENSHOT-PROPERTIES-LIST.jpg` inside `.device-mockup-laptop` with 3-degree tilt and soft shadow
- Add `.reveal` classes to left content, `.reveal-right` to mockup

**Step 2: Build trust bar**

Thin section with light border top/bottom. Three inline stats:
- "36+" / "Clients" (with counter icon)
- "2018" / "Since" (with calendar icon)
- "East Africa & The World" / "Reach" (with globe icon)

Use inline SVG icons (simple, 24px). Apply `.reveal` on each stat.

**Step 3: Build features preview section**

Light bg (#FAFAF7). 3-column card grid:
1. Rent Collection — icon (currency) + title + one-line desc + small `SCREENSHOT-RENT-DUE.jpg` thumbnail
2. Tenant Management — icon (people) + title + one-line desc + small `SCREENSHOT-LANDLORDS-LIST.jpg` thumbnail
3. Financials — icon (chart) + title + one-line desc + small `SCREENSHOT-INCOME-EXPENSES...jpg` thumbnail

Each card links to the features page anchor. Apply `.reveal` with stagger.

**Step 4: Build product showcase section**

Dark bg. Full-width container with:
- Heading: "See everything in one place" / FR
- `SCREENSHOT-LANDLORDS-LIST.jpg` in a wide laptop mockup, centered, with glow shadow
- Apply `.reveal-scale`

**Step 5: Build Why Aqar section**

Light bg. 4-column grid of `.glass-card` elements on a subtle gradient bg:
1. Cloud-Based — cloud icon + title + "Access from anywhere, any device"
2. No Installation — download-off icon + title + "Log in and start managing"
3. Encrypted — lock icon + title + "Data encrypted in transit and at rest"
4. Mobile-Ready — smartphone icon + title + "Works on phone, tablet, desktop"

Apply `.reveal` with stagger.

**Step 6: Build social proof section**

Light bg. Centered layout:
- Large number "36+" with "property management clients trust Aqar"
- Optional: "Serving landlords across Uganda, Kenya, Tanzania, and beyond"
- No fabricated testimonials — just the factual trust stat

**Step 7: Include CTA banner + footer**

Include `cta-banner.php` and `footer.php`.

**Step 8: Wire up router**

Update router.php so `/en/` loads `pages/home.php` with the correct language.

**Step 9: Test in browser**

Visit `http://localhost/aqar-website/en/` — full homepage should render with all sections, correct images, styled per design system.

**Step 10: Commit**

```bash
git add pages/home.php
git commit -m "feat: complete homepage — hero, trust bar, features preview, product showcase, why aqar, social proof"
```

---

## Task 6: GSAP Scroll Animations

**Files:**
- Create: `assets/js/main.js`
- Create: `assets/js/nav.js`

**Step 1: Add GSAP CDN to head.php**

Add before closing `</body>` in footer.php:
```html
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
```

**Step 2: Create main.js with scroll reveal**

```javascript
gsap.registerPlugin(ScrollTrigger);

// Fade-up reveals
document.querySelectorAll('.reveal').forEach(el => {
  gsap.from(el, {
    scrollTrigger: { trigger: el, start: 'top 85%', toggleActions: 'play none none none' },
    opacity: 0, y: 30, duration: 0.8, ease: 'power2.out'
  });
});

// Slide from left
document.querySelectorAll('.reveal-left').forEach(el => {
  gsap.from(el, {
    scrollTrigger: { trigger: el, start: 'top 85%' },
    opacity: 0, x: -40, duration: 0.8, ease: 'power2.out'
  });
});

// Slide from right
document.querySelectorAll('.reveal-right').forEach(el => {
  gsap.from(el, {
    scrollTrigger: { trigger: el, start: 'top 85%' },
    opacity: 0, x: 40, duration: 0.8, ease: 'power2.out'
  });
});

// Scale reveals
document.querySelectorAll('.reveal-scale').forEach(el => {
  gsap.from(el, {
    scrollTrigger: { trigger: el, start: 'top 85%' },
    opacity: 0, scale: 0.95, duration: 1, ease: 'power2.out'
  });
});

// Stagger children with .reveal-stagger parent
document.querySelectorAll('.reveal-stagger').forEach(parent => {
  gsap.from(parent.children, {
    scrollTrigger: { trigger: parent, start: 'top 85%' },
    opacity: 0, y: 30, duration: 0.6, stagger: 0.15, ease: 'power2.out'
  });
});
```

**Step 3: Create nav.js**

- Navbar solid bg on scroll (add `.scrolled` class when scrollY > 50)
- Mobile hamburger toggle
- Active nav link highlighting based on current URL
- Smooth scroll to anchors on same page

**Step 4: Test animations in browser**

Scroll through homepage — elements should fade/slide in as they enter viewport.

**Step 5: Commit**

```bash
git add assets/js/
git commit -m "feat: GSAP scroll animations and responsive nav behavior"
```

---

## Task 7: Features Page

**Files:**
- Create: `pages/features.php`

**Step 1: Build features hero**

Dark bg mini-hero:
- Heading: "Everything You Need to Manage Properties" / FR
- Subheading: "Six powerful modules. One simple platform."

**Step 2: Build 6 alternating feature sections**

Each section alternates dark/light bg and screenshot left/right:

1. **Rent Collection & Reconciliation** (light bg, screenshot RIGHT)
   - `SCREENSHOT-RENT-PAYMENT.jpg` in laptop mockup
   - 4 bullet benefits from `docs/en/services.md`
   - `.reveal-left` on text, `.reveal-right` on mockup

2. **Tenant Management & Communication** (dark bg, screenshot LEFT)
   - `SCREENSHOT-LANDLORDS-LIST.jpg` in laptop mockup
   - 4 bullet benefits
   - `.reveal-right` on text, `.reveal-left` on mockup

3. **Maintenance Tracking** (light bg, screenshot RIGHT)
   - `SCREENSHOT-ADD-MAINTENANCE-RECORD.jpg` in laptop mockup
   - 4 bullet benefits

4. **Financial Reports & Landlord Remittances** (dark bg, screenshot LEFT)
   - `SCREENSHOT-MONTHLY-REPORT-REMMITANCE-DETAILS-FOR-LANDLORD-WITH-COMMISION-DUE-TO-COMPANY.jpg` in laptop mockup
   - 4 bullet benefits

5. **Lease Agreement Management** (light bg, screenshot RIGHT)
   - `SCREENSHOT-INSPECTION-TEMPLATES.jpg` in laptop mockup
   - 4 bullet benefits

6. **Mobile Access & Security** (dark bg, screenshot LEFT)
   - `SCREENSHOT-LOGIN.jpg` in laptop mockup + `SCREENSHOT-PERMISSIONS-ROLES-MANAGEMENT-RBAC.jpg` as secondary smaller image
   - 4 bullet benefits

**Step 3: Add CTA banner + footer**

**Step 4: Wire up router for /en/features/ and /fr/fonctionnalites/**

**Step 5: Test in browser**

All 6 sections render with alternating layout, screenshots load, animations fire.

**Step 6: Commit**

```bash
git add pages/features.php
git commit -m "feat: features page — 6 alternating sections with dashboard screenshots in device mockups"
```

---

## Task 8: About Page

**Files:**
- Create: `pages/about.php`

**Step 1: Build about hero**

Dark bg with `AQAR-PROPERTY-08.jpg` as subtle background overlay (opacity 0.2):
- Heading: "Built in Africa, for Africa"
- Subheading: story intro from `docs/en/about-story.md` "The Problem We Saw" section

**Step 2: Build "What We Built" section**

Light bg. Text section with the Aqar origin story. Include one inline screenshot of the dashboard.

**Step 3: Build Peter Bamuhigire profile section**

Light bg. Two-column:
- Left: `AQAR-PROPERTY-05.jpg` (placeholder — person with data tablet) in a rounded frame. Note below: "Photo placeholder — swap with Peter-Headshot.jpg when available"
- Right: Peter's bio from `docs/en/about-story.md`, credentials (15+ years, 10+ countries, bilingual), link to techguypeter.com

**Step 4: Build Chwezi Core Systems section**

Dark bg. Company story + product family:
- Aqar, Maduuka, Longhorn ERP — as a horizontal card row
- "Coming soon: Medic8, Kampus Pad"

**Step 5: Add CTA banner + footer**

**Step 6: Wire router for /en/about/ and /fr/a-propos/**

**Step 7: Commit**

```bash
git add pages/about.php
git commit -m "feat: about page — Chwezi story, Peter profile, product family"
```

---

## Task 9: Blog Index & Article Pages

**Files:**
- Create: `pages/blog.php` (index)
- Create: `pages/blog-post.php` (single post template)
- Create: `content/blog/en/` and `content/blog/fr/` (blog data arrays)

**Step 1: Create blog data arrays**

PHP arrays with blog post metadata and content. Each post:
- `slug`, `title`, `date`, `author`, `excerpt`, `og_image`, `content` (HTML from the markdown)

Source from `docs/en/blog/*.md` and `docs/fr/blog/*.md`. Convert markdown to HTML manually (these are static — no parser needed).

3 posts EN:
1. `marketing-rental-properties` — OG: `AQAR-PROPERTY-01.jpg`
2. `property-management-agreement` — OG: `AQAR-PROPERTY-09.jpg`
3. `choosing-property-management-company` — OG: `AQAR-PROPERTY-04.jpg`

3 posts FR (same slugs, French content).

**Step 2: Build blog index (blog.php)**

Light bg. Grid of 3 cards:
- Featured image (the OG image, cropped to 16:9)
- Title
- Date + author
- Excerpt (first 2 sentences)
- "Read more" link

**Step 3: Build blog post template (blog-post.php)**

- Hero section with featured image as full-width bg (darkened overlay)
- Title + date + author
- Article content (prose styling — max-width 720px, good line-height, styled headings/lists)
- "Back to blog" link
- CTA banner at bottom

**Step 4: Wire router**

- `/en/blog/` → blog index
- `/en/blog/marketing-rental-properties/` → single post
- `/fr/blog/` → French blog index
- etc.

**Step 5: Test all 3 posts render in both languages**

**Step 6: Commit**

```bash
git add pages/blog.php pages/blog-post.php content/blog/
git commit -m "feat: blog index and 3 article pages in EN/FR with OG images"
```

---

## Task 10: Contact Page with PHPMailer

**Files:**
- Create: `pages/contact.php`
- Create: `includes/contact-handler.php`
- Create: `composer.json` (PHPMailer dependency)
- Create: `config/mail.php` (SMTP config placeholder)

**Step 1: Install PHPMailer**

```bash
cd /c/wamp64/www/aqar-website && composer require phpmailer/phpmailer
```

Add `vendor/` to `.gitignore`.

**Step 2: Create mail config**

`config/mail.php`:
```php
<?php
return [
    'host' => 'smtp.example.com',     // TODO: Replace with real SMTP host
    'port' => 587,
    'username' => 'info@aqarproperty.co.uk',  // TODO: Replace
    'password' => '',                  // TODO: Replace with real password
    'from_email' => 'info@aqarproperty.co.uk',
    'from_name' => 'Aqar Property',
    'to_email' => 'info@aqarproperty.co.uk',
    'encryption' => 'tls',
];
```

Add `config/mail.php` to `.gitignore`. Create `config/mail.example.php` for reference.

**Step 3: Create contact-handler.php**

POST handler that:
1. Validates: name (required), email (valid email), phone (optional), message (required, min 10 chars)
2. Sanitizes all input with `htmlspecialchars()` and `filter_var()`
3. Rate limits by IP (simple session-based, 3 submissions per 15 minutes)
4. Sends via PHPMailer using config/mail.php credentials
5. Returns JSON `{ success: true/false, message: '...' }`
6. CSRF token validation

**Step 4: Build contact.php page**

Two-column layout on light bg:

- Left column (60%):
  - Heading: "Get in Touch" / FR
  - Contact form: Name, Email, Phone (optional), Message (textarea), Submit button
  - CSRF hidden input
  - Client-side validation (HTML5 required + JS)
  - SweetAlert2 for success/error feedback (CDN — one script tag)

- Right column (40%):
  - WhatsApp CTA (large amber button with WhatsApp icon)
  - Phone numbers
  - Email address
  - Address: Sserumaga Road, Bukoto, Kampala
  - Business hours
  - Embedded map: simple `<iframe>` OpenStreetMap embed for Bukoto, Kampala coordinates (0.3476, 32.5960)

**Step 5: Wire router for /en/contact/ and /fr/contact/**

**Step 6: Test form submission**

Submit the form — should fail gracefully with "SMTP not configured" message until real credentials are added. Validation should work client-side and server-side.

**Step 7: Commit**

```bash
git add pages/contact.php includes/contact-handler.php composer.json composer.lock config/mail.example.php .gitignore
git commit -m "feat: contact page with PHPMailer form, validation, CSRF, rate limiting"
```

---

## Task 11: Demo Page

**Files:**
- Create: `pages/demo.php`

**Step 1: Build demo page**

Simple, focused landing page:

- Hero: dark bg, heading "Try Aqar — Live Demo", subheading "No installation. No signup. Explore the full system."
- Screenshot preview: `SCREENSHOT-LOGIN.jpg` in laptop mockup
- What's included list: 6 bullet points (one per module from services)
- Large centered [Try Demo] button linking to `property.chwezi.co.za`
- Secondary: "Have questions? WhatsApp us first" with amber button
- CTA banner + footer

**Step 2: Wire router for /en/demo/ and /fr/demo/**

**Step 3: Commit**

```bash
git add pages/demo.php
git commit -m "feat: demo page with screenshot preview and direct demo link"
```

---

## Task 12: Terms & Privacy Pages

**Files:**
- Create: `pages/terms.php`
- Create: `pages/privacy.php`

**Step 1: Create Terms page**

Standard SaaS terms and conditions. Content specific to Aqar:
- Service provider: Chwezi Core Systems Limited
- Service: cloud-based property management software
- Demo access terms
- Data handling
- Limitation of liability
- Governing law: Uganda

Light bg, max-width prose styling, sectioned with headings.

**Step 2: Create Privacy page**

Standard privacy policy:
- What data is collected (contact form submissions, cookies)
- How data is used
- Data retention
- Third-party services (PHPMailer for email)
- User rights
- Contact for privacy queries

**Step 3: Wire router for all 4 URLs** (/en/terms/, /en/privacy/, /fr/conditions/, /fr/confidentialite/)

**Step 4: Commit**

```bash
git add pages/terms.php pages/privacy.php
git commit -m "feat: terms and conditions + privacy policy pages in EN/FR"
```

---

## Task 13: SEO — Sitemaps, Robots, OG Images

**Files:**
- Create: `sitemap.xml`
- Create: `robots.txt`
- Modify: `includes/head.php` (verify all OG tags are correct)

**Step 1: Create sitemap.xml**

List all pages in both languages with `<xhtml:link rel="alternate">` hreflang entries:
- /en/ and /fr/ (home)
- /en/features/ and /fr/fonctionnalites/
- /en/about/ and /fr/a-propos/
- /en/blog/ and /fr/blog/
- /en/blog/marketing-rental-properties/ (etc. — 3 posts x 2 languages)
- /en/contact/ and /fr/contact/
- /en/demo/ and /fr/demo/
- /en/terms/ and /fr/conditions/
- /en/privacy/ and /fr/confidentialite/

**Step 2: Create robots.txt**

```
User-agent: *
Allow: /
Sitemap: https://aqarproperty.co.uk/sitemap.xml
```

**Step 3: Verify OG tags in head.php**

Each page must set:
- `og:title` — page-specific title
- `og:description` — page-specific description
- `og:image` — page-specific OG image from photo-bank
- `og:locale` — `en_GB` or `fr_FR`
- `og:locale:alternate` — the other language
- `og:url` — canonical URL
- `og:type` — "website" for pages, "article" for blog posts
- Twitter card meta tags

**Step 4: Commit**

```bash
git add sitemap.xml robots.txt
git commit -m "feat: SEO — sitemap with hreflang, robots.txt, verified OG tags"
```

---

## Task 14: French Language Wiring & Testing

**Files:**
- Modify: router.php (ensure FR routes work)
- Verify: all pages render correctly in French

**Step 1: Verify all French routes**

Test each URL:
- `/fr/` — home in French
- `/fr/fonctionnalites/` — features
- `/fr/a-propos/` — about
- `/fr/blog/` — blog index + 3 articles
- `/fr/contact/` — contact
- `/fr/demo/` — demo
- `/fr/conditions/` — terms
- `/fr/confidentialite/` — privacy

**Step 2: Verify language switcher**

Click EN/FR toggle on every page — should navigate to the equivalent page in the other language.

**Step 3: Verify all translations render**

No English text should appear on French pages and vice versa.

**Step 4: Commit**

```bash
git commit -m "fix: verify and complete French language routing and translations"
```

---

## Task 15: Image Optimization & Asset Copying

**Files:**
- Create: `assets/img/` (optimized copies of photo-bank images)
- Create: `assets/img/screenshots/`
- Create: `assets/img/photos/`
- Create: `assets/img/og/`

**Step 1: Copy and organize images from photo-bank**

Copy from `photo-bank/` to `assets/img/`:
- `screenshots/` — all SCREENSHOT-*.jpg files
- `photos/` — all AQAR-PROPERTY-*.jpg files
- `og/` — designated OG images (same files, just organized for meta tags)

**Step 2: Verify all image paths in PHP templates match**

Grep all templates for image references and ensure paths are correct.

**Step 3: Add lazy loading**

Add `loading="lazy"` to all `<img>` tags except hero images (which should load eagerly).

**Step 4: Commit**

```bash
git add assets/img/
git commit -m "feat: organized image assets with lazy loading"
```

---

## Task 16: Final Polish & Cross-Browser Testing

**Step 1: Test on mobile viewport (375px)**

Check every page in Chrome DevTools mobile view. Fix any overflow, text wrapping, or layout breaks.

**Step 2: Test on tablet viewport (768px)**

Verify 2-column layouts collapse/expand correctly.

**Step 3: Test desktop (1280px+)**

Full layout review.

**Step 4: Check all links work**

- Demo button → property.chwezi.co.za
- WhatsApp button → wa.me/256784464178
- Nav links → correct pages
- Footer links → correct pages
- Language switcher → correct language

**Step 5: Verify dark/light section alternation**

No two consecutive sections should share the same background.

**Step 6: Fix any CSS issues found**

**Step 7: Final commit**

```bash
git add -A
git commit -m "fix: responsive polish, link verification, cross-browser fixes"
```

---

## Task 17: FAQ Section on Homepage (Optional Enhancement)

**Files:**
- Modify: `pages/home.php`

**Step 1: Add FAQ accordion**

After Social Proof, before CTA banner. Collapsible accordion with all 10 FAQ items from `docs/en/faq.md`. Pure CSS + minimal JS toggle. Schema.org FAQ structured data in head for SEO.

**Step 2: Commit**

```bash
git commit -m "feat: FAQ accordion on homepage with schema.org structured data"
```

---

## Summary of File Structure

```
aqar-website/
  .htaccess
  index.php                    (root redirect)
  config.php                   (site config)
  router.php                   (URL → page routing)
  composer.json
  sitemap.xml
  robots.txt
  config/
    mail.example.php           (SMTP config template)
  lang/
    en.php                     (English translations)
    fr.php                     (French translations)
  includes/
    i18n.php                   (translation helper)
    head.php                   (HTML <head>)
    header.php                 (opens body + nav)
    nav.php                    (navigation bar)
    footer.php                 (footer + scripts)
    cta-banner.php             (reusable CTA section)
    contact-handler.php        (form POST handler)
  pages/
    home.php
    features.php
    about.php
    blog.php
    blog-post.php
    contact.php
    demo.php
    terms.php
    privacy.php
  content/
    blog/
      en.php                   (English blog data)
      fr.php                   (French blog data)
  assets/
    css/
      variables.css
      base.css
      components.css
      layout.css
      animations.css
      responsive.css
    js/
      main.js                  (GSAP animations)
      nav.js                   (nav behavior)
    fonts/
      plus-jakarta-sans-700.woff2
      plus-jakarta-sans-800.woff2
      source-sans-3-400.woff2
      source-sans-3-600.woff2
    img/
      screenshots/             (dashboard screenshots)
      photos/                  (property photography)
      og/                      (OG images)
  docs/                        (unchanged — content source)
  photo-bank/                  (unchanged — original assets)
```
