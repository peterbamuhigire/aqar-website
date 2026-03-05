# Aqar Property Management Software — Website Build Prompt

## What To Build

Build a beautiful, modern website for **Aqar Property Management Software** (aqarproperty.co.uk). Aqar is a cloud-based property management platform built by Chwezi Core Systems in Kampala, Uganda. Lead developer: Peter Bamuhigire (techguypeter.com).

The website's purpose: **make visitors believe the software is beautiful and easy to use, then push them to try the demo or contact via WhatsApp.**

## Pre-Flight Checklist

Before starting the build, verify:

1. Skills submodule is installed at `.claude/skills/`
2. Required plugins are installed (superpowers + frontend-design)
3. `photo-bank/` contains dashboard screenshots named `*-HD.jpg` (these are mandatory for the hero and features pages, and will be used as OG images)
4. All content exists in `docs/en/` and `docs/fr/`

## Build Instructions

Run the **website-builder** skill, which orchestrates the full pipeline:

```
0. i18n           → Read docs/i18n-config.md (English + French)
0.5 design-ref    → Read docs/design-reference.md
1. sector-strat   → Hybrid corporate + professional services
2. design-system  → "Kampala Dusk" palette, Plus Jakarta Sans + Source Sans 3
3. photo-manager  → Process photo-bank/ screenshots, flag *-HD.jpg as OG candidates
4. page-builder   → Build all pages per docs/en/ and docs/fr/
5. seo            → hreflang, sitemaps, OG images per page
5.5 blog-writer   → Migrate 3 existing articles (already in docs/{lang}/blog/)
6. deploy         → Build, verify, nginx config
```

## Key Design Decisions

| Decision | Value |
|----------|-------|
| **Languages** | English (primary) + French |
| **Pages** | Home, Features, About, Blog, Contact, Demo, Terms, Privacy |
| **Design** | Product-Led Beauty — dashboard screenshots in device mockups |
| **Colours** | Deep Teal #0D7377, Warm Amber #E8913A, Charcoal #1A1F2E, Warm White #FAFAF7 |
| **Fonts** | Plus Jakarta Sans (headings) + Source Sans 3 (body) |
| **Primary CTA** | "Try Demo" → property.chwezi.co.za |
| **Secondary CTA** | "WhatsApp Us" → wa.me/256784464178 |
| **Trust signals** | 36 clients, since 2018, East Africa & the world, live demo |
| **No pricing page** | All pricing enquiries go to contact/WhatsApp |

## Home Page Structure

1. **HERO** (dark charcoal #1A1F2E background) — Left: headline + subheadline + [Try Demo] + [WhatsApp]. Right: dashboard screenshot in laptop mockup with soft shadow and 2-4 degree tilt
2. **TRUST BAR** — "36 Clients" | "Since 2018" | "East Africa & The World"
3. **FEATURES PREVIEW** (light #FAFAF7 background) — 3-column grid: Rent Collection, Tenant Management, Financials. Each with icon + title + one line + small screenshot
4. **PRODUCT SHOWCASE** (dark background) — Full-width dashboard screenshot, "See everything in one place"
5. **WHY AQAR** (light background) — 4 glass morphism cards: Cloud-Based, No Installation, Encrypted, Mobile-Ready
6. **SOCIAL PROOF** — Client count + any testimonials
7. **CTA BANNER** (teal #0D7377 background) — "Ready to simplify your property management?" + [Try Demo] + [WhatsApp]
8. **FOOTER** — Company info, navigation, contact, partners (Chwezi + techguypeter)

## Features Page Structure

6 alternating left/right sections. Each: headline + 3-4 bullet benefits + dashboard screenshot of that feature.

1. Rent Collection & Reconciliation
2. Tenant Management & Communication
3. Maintenance Tracking
4. Financial Reports & Landlord Remittances
5. Lease Agreement Management
6. Mobile Access & Security

## Visual Rules

- Dashboard screenshots in floating device mockups (laptop/tablet/phone) with soft drop shadows
- Glass morphism cards (backdrop-blur, subtle white borders) for feature highlights
- Alternating dark/light sections — no two consecutive sections with the same background
- GSAP scroll reveals — elements fade up, screenshots slide in from sides
- NO stock illustrations, NO abstract blobs, NO generic SaaS graphics
- Real screenshots and real photography ONLY
- Every page gets its own OG image from photo-bank *-HD.jpg files

## Content Source

All content is pre-written in `docs/en/` and `docs/fr/`. Do NOT fabricate any company information. The content files are:

- `company-profile.md` — company details, contact, key numbers
- `pages.md` — page structure and sections
- `services.md` — 6 feature modules with descriptions
- `style-brief.md` — full design direction
- `about-story.md` — Chwezi and Peter's story
- `contact.md` — all contact details
- `faq.md` — 10 frequently asked questions
- `blog/*.md` — 3 migrated blog articles

## Photo-Bank Expectations

The user will add these before the build starts:

```
Dashboard-Overview-HD.jpg       ← Hero section + homepage OG image
Dashboard-Tenants-HD.jpg        ← Tenant management feature
Dashboard-Rent-HD.jpg           ← Rent collection feature
Dashboard-Reports-HD.jpg        ← Financial reports feature
Dashboard-Maintenance-HD.jpg    ← Maintenance tracking feature
Dashboard-Mobile-HD.jpg         ← Mobile access section
Logo-Aqar-Light.png             ← Header logo (light mode)
Logo-Aqar-Dark.png              ← Footer/dark sections logo
Peter-Headshot.jpg              ← About page
Blog-*-HD.jpg                   ← One per blog post (OG images)
```
