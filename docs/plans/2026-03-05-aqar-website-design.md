# Aqar Property Management Software — Website Design

**Date:** 2026-03-05
**Status:** Approved
**Repo:** https://github.com/peterbamuhigire/aqar-website

## Product

Aqar is a cloud-based property management software built by Chwezi Core Systems (Kampala, Uganda). It handles rent collection, tenant management, maintenance tracking, financial reporting, and lease management. Lead developer: Peter Bamuhigire (techguypeter.com). Live demo at property.chwezi.co.za.

## Design Decisions

| Decision | Choice |
|----------|--------|
| Languages | English (primary) + French |
| Pages | Home, Features, Blog, About, Contact, Demo, Terms, Privacy |
| Sector strategy | Hybrid corporate + professional services |
| Design direction | Product-Led Beauty — dashboard screenshots in device mockups, glass morphism, dark/light alternating sections |
| Colour palette | "Kampala Dusk" — Deep Teal #0D7377, Warm Amber #E8913A, Charcoal #1A1F2E, Warm White #FAFAF7 |
| Typography | Plus Jakarta Sans (headings) + Source Sans 3 (body), self-hosted |
| Primary CTA | "Try Demo" (links to property.chwezi.co.za) |
| Secondary CTA | WhatsApp (+256784464178) on every page |
| Pricing | No pricing page — "Contact us" model |
| Trust signals | 36 clients, since 2018, East Africa & the world, live demo access |

## Approach: Product-Led Beauty

The website's job is to make visitors think: "If the website is this polished, the software must be incredible." Dashboard screenshots presented in elegant device mockups with soft shadows. Clean whitespace. Real UI as proof. African identity in colour accents and photography.

No stock illustrations. No abstract SaaS blobs. Real screenshots + real photography only.

## Design System

### Colour Palette — "Kampala Dusk"

| Role | Colour | Usage |
|------|--------|-------|
| Primary | Deep Teal #0D7377 | Headers, primary CTAs, navigation |
| Secondary | Warm Amber #E8913A | Accent CTAs (WhatsApp), highlights, badges |
| Dark | Charcoal #1A1F2E | Hero backgrounds, footer, dark sections |
| Light | Warm White #FAFAF7 | Page backgrounds, cards |
| Success | Soft Green #34A853 | Status indicators, checkmarks |
| Text | Near Black #2D2D2D on light, #F5F5F0 on dark | Body copy |

Deep teal = trust + property (not generic blue). Warm amber = African warmth + energy. Charcoal hero sections make dashboard screenshots pop.

### Typography

| Element | Font | Weight | Why |
|---------|------|--------|-----|
| Headings | Plus Jakarta Sans | 700, 800 | Geometric, modern, premium SaaS feel |
| Body | Source Sans 3 | 400, 600 | Readable, professional, excellent French support |
| Code/Data | JetBrains Mono | 400 | Technical credibility in UI labels |

### Visual Language

- Dashboard screenshots in floating device mockups with soft shadows and 2-4 degree tilt
- Glass morphism cards (backdrop-blur, subtle borders) for feature highlights
- Alternating dark/light sections to prevent false bottoms
- Subtle GSAP scroll reveals — elements fade up, screenshots slide in
- No stock illustrations. Real screenshots + real photography only.

## Page Architecture

### Home

1. **NAV** — Logo | Features | Blog | About | Contact | [Try Demo] [WhatsApp]
2. **HERO** (dark charcoal bg) — Left: headline + subheadline + dual CTAs. Right: dashboard screenshot in laptop mockup
3. **TRUST BAR** — "36 Clients" + "East Africa & The World" + "Since 2018"
4. **FEATURES PREVIEW** (light bg) — 3-column grid: Rent Collection, Tenant Management, Financials. Each: icon + title + 1 line + screenshot
5. **PRODUCT SHOWCASE** (dark bg) — Full-width dashboard screenshot, "See everything in one place"
6. **WHY AQAR** (light bg) — 4 benefit cards: Cloud-based, No Install, Encrypted, Mobile-ready
7. **SOCIAL PROOF** (light bg) — Client count + testimonial quotes
8. **CTA BANNER** (teal bg) — "Ready to simplify?" + [Try Demo] [WhatsApp]
9. **FOOTER** — Company info, nav, contact, socials. Partners: Chwezi Core Systems | techguypeter

### Features

6 sections, alternating left/right layout. Each: headline + 3-4 bullet benefits + screenshot.

1. Rent Collection & Reconciliation
2. Tenant Management & Communication
3. Maintenance Tracking
4. Financial Reports & Landlord Remittances
5. Lease Agreement Management
6. Mobile Access & Security

### About

- Chwezi Core Systems story — founded in Kampala, serving East Africa & the world
- Peter Bamuhigire profile — 15+ years, 10+ African countries, bilingual
- Product family context (Maduuka, Aqar, Longhorn ERP)
- "Built in Africa, for Africa" narrative

### Blog

- Card grid index (featured image + title + excerpt)
- 3 migrated articles from current site
- Each post gets its own OG image from photo-bank HD images

### Contact

- Contact form (PHP + PHPMailer via email-sender skill)
- WhatsApp button (prominent)
- Phone, email, Bukoto/Kampala address
- Embedded map (Leaflet, self-hosted tiles)

### Demo

- What the demo includes
- Direct link to property.chwezi.co.za
- "No installation, no signup required"
- Screenshot preview

### Terms & Privacy

- Generated via policy-pages skill, both languages

## Content Structure

```
docs/
  i18n-config.md
  en/
    company-profile.md
    pages.md
    services.md
    style-brief.md
    about-story.md
    contact.md
    faq.md
    blog/
      marketing-rental-properties.md
      property-management-agreement.md
      choosing-property-management-company.md
  fr/
    (mirrors en/ — formal West African French)
```

## Photo-Bank Requirements

```
photo-bank/
  Logo-Aqar-Light.png
  Logo-Aqar-Dark.png
  Logo-Chwezi.png
  Dashboard-Overview-HD.jpg      <- hero + OG image
  Dashboard-Tenants-HD.jpg       <- features
  Dashboard-Rent-HD.jpg          <- features
  Dashboard-Reports-HD.jpg       <- features
  Dashboard-Maintenance-HD.jpg   <- features
  Dashboard-Mobile-HD.jpg        <- mobile section
  Peter-Headshot.jpg             <- about page
  Hero-Kampala-Office.jpg        <- optional about hero
  Blog-Marketing-Rentals-HD.jpg  <- blog OG
  Blog-Management-Agreement-HD.jpg
  Blog-Choosing-Company-HD.jpg
```

`*-HD.jpg` naming ensures photo-manager flags them as OG image candidates.

## Sector Brief

Hybrid corporate + professional services. Trust signals:
- Years in market (since 2018)
- Client count (36)
- Geographic reach (East Africa & the world)
- Live demo (nothing to hide)
- Developer credibility (Peter, 15+ years, 10+ countries)
