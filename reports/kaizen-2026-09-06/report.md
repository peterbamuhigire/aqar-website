# AQAR Website Kaizen Evidence Report

**Date:** 2026-09-06
**Scope:** `C:\wamp64\www\aqar-website` only
**Operator:** Codex (bounded implementation worker)
**Review owner:** Parent orchestrator
**Re-audit date:** 2026-10-04, or sooner after production analytics and browser evidence are available

## Frame

The primary journey is: a landlord or property manager enters through a search/social link, understands that AQAR is property-management operations software rather than a listing marketplace, checks a real product screen, opens the live demo or starts a contact conversation, and can recover from failed network/form states.

The site is bilingual (`en` and `fr`) and must remain honest about the supplied product, company, contact, legal, and market facts. No new listings, reviews, client names, certifications, prices, legal conclusions, or market statistics are introduced in this operation.

## Observe

### Existing type and visual rationale (recorded before visual edits)

The existing design brief chooses **Plus Jakarta Sans** for headings at weights 700/800 and **Source Sans 3** for body text at weights 400/600, both self-hosted through Fontsource ([`docs/en/style-brief.md`](../../docs/en/style-brief.md)). This is an intentional display/body pairing for a product-led property-operations site: the display face gives the product headings a firm, contemporary silhouette while Source Sans 3 keeps longer English and French operational copy readable. The implementation retains this pairing; no replacement is justified by the evidence inspected. The brief also defines the `Kampala Dusk` teal/amber/charcoal palette, real product screens, and warm-white surfaces.

The visual direction has one useful authored choice: product screenshots and property photography are the primary proof material. The implementation should reduce convergence risks around blur, repeated cards, and decorative motion while preserving those real assets.

### Evidence inventory

| Area | Observation | Evidence mode | Status |
|---|---|---|---|
| Build | `npm run build` completed successfully and generated the multilingual static route set. | `cli` | PASS |
| Metadata | Canonical and `en`/`fr`/`x-default` alternates are emitted by the shared layout; route mapping is centralized. | `cli`, source review | PASS with regression coverage needed |
| Schema | Homepage and features include FAQPage; homepage includes SearchAction without a site search UI; SoftwareApplication has a zero-price Offer. | `cli`, source review | FAIL |
| Content truth | Homepage currently exposes `78+` clients while the supplied company profile records `36 clients`; the conflicting figure is not traceable. | source review | FAIL |
| Crawler access | `robots.txt` allows common crawlers but had no explicit `OAI-SearchBot` rule. `llms.txt` is a supplementary index; the redundant `llms-full.txt` was not needed for the human journey. | source review; parent currentness update | IMPROVED; live crawler behavior NOT_ASSESSED |
| Accessibility | Native labels exist on the contact form, but the mobile menu, lightbox trigger, lightbox focus return, and FAQ disclosure relationships are incomplete. | source review | FAIL / manual verification pending |
| Motion / resilience | Scroll-reveal rules begin at `opacity: 0`; there is no explicit no-JavaScript fallback, and `x-cloak` has no CSS definition. | source review | FAIL |
| Form security | Contact API exposes wildcard CORS even though the form is same-origin; rate-limit storage is under the project web root when runtime-created. | source review | FAIL |
| Render / field data | No browser renderer, screenshot harness, Search Console, analytics/RUM, or production endpoint evidence is available in this worker context. | capability check | NOT_ASSESSED |

## Baseline

The initial analysis is published below the required 65/100 ceiling. Scoring follows the weighted ten-dimension rubric in the design-system audit reference ([`audit-rubric.md`](../../../../design-system-skills/skills/00-cross-cutting-ops-qa-a11y/design-audit/references/audit-rubric.md)). The raw score is an internal diagnostic, not a claim of user satisfaction or WCAG conformance.

| Dimension | Weight | Score (0–4) | Weighted |
|---|---:|---:|---:|
| Accessibility | 20% | 2 | 10.00 |
| Visual hierarchy | 15% | 3 | 11.25 |
| Interaction states | 12% | 2 | 6.00 |
| Content and microcopy | 12% | 2 | 6.00 |
| Typography | 10% | 3 | 7.50 |
| Colour | 8% | 3 | 6.00 |
| Layout and spacing | 8% | 2 | 4.00 |
| Performance | 6% | 2 | 3.00 |
| Motion | 5% | 2 | 2.50 |
| AI-slop resistance | 4% | 3 | 3.00 |
| **Raw total** | **100%** |  | **59.25/100** |
| **Published baseline** |  |  | **59/100** |

The accessibility gate is not passed: source inspection identifies incomplete keyboard/focus state coverage, while manual keyboard and screen-reader evidence is unavailable. The performance gate is `NOT_ASSESSED` for field p75 and Lighthouse; the AI-slop gate is conditional rather than failed because the site uses a deliberate teal/amber palette and real product assets, but repeated cards, blur, and decorative scroll reveals remain review targets.

### Baseline findings

1. **High — unsupported/conflicting proof figure.** `78+` appeared in the baseline homepage content while the supplied company profile says `36 clients`; no source was found for the `78+` figure in the supplied project corpus. Remove the untraceable figure; do not silently choose a number as if it were independently verified ([`docs/en/company-profile.md:29`](../../docs/en/company-profile.md:29)).
2. **High — schema describes unavailable or misleading affordances.** Baseline SearchAction pointed at a query URL despite no rendered search control; the SoftwareApplication advertised `price: 0` and `InStock`; FAQPage was emitted from visible FAQs on the homepage and features page. These baseline observations are recorded in the initial build/source review; current schema is reduced to supported visible entities ([`BaseLayout.astro`](../../src/layouts/BaseLayout.astro), [`HomePage.astro`](../../src/components/pages/HomePage.astro), [`FeaturesPage.astro`](../../src/components/pages/FeaturesPage.astro)).
3. **High — contact API cross-origin exposure.** Wildcard CORS was enabled for the PHP API; same-origin browser submission does not require it. Rate-limit data was created below the project root, which is a web-root exposure risk on some Apache configurations (inference). Current API policy and storage path are in [`public/api/.htaccess`](../../public/api/.htaccess) and [`public/api/contact.php`](../../public/api/contact.php).
4. **High — interactive state semantics are incomplete.** Baseline mobile menu, lightbox, and FAQ disclosure controls lacked complete relationships/focus behavior. Current implementations are in [`Header.astro`](../../src/components/Header.astro), [`Lightbox.astro`](../../src/components/Lightbox.astro), [`AboutPage.astro`](../../src/components/pages/AboutPage.astro), [`DemoPage.astro`](../../src/components/pages/DemoPage.astro), and [`HomePage.astro`](../../src/components/pages/HomePage.astro).
5. **Medium — script failure can hide content.** Baseline `.animate-on-scroll` started hidden and had no explicit no-JavaScript fallback; `x-cloak` was used without a CSS definition. The progressive-enhancement implementation is in [`global.css`](../../src/styles/global.css) and [`BaseLayout.astro`](../../src/layouts/BaseLayout.astro).
6. **Medium — crawler policy is incomplete and AI reference is duplicated.** Baseline `robots.txt` lacked an explicit OAI-SearchBot line ([`public/robots.txt`](../../public/robots.txt)). `llms.txt` already acts as a concise supplementary index ([`public/llms.txt`](../../public/llms.txt)); the redundant baseline `public/llms-full.txt` repeated broader claims without being needed by the human journey. No file is treated as a Google ranking control.

## Select

The next slices are selected by red-route impact, reversibility, and evidence gain:

| Slice | Root cause | Experiment | Guardrails |
|---|---|---|---|
| Discoverability and schema | Structured data contains unavailable search/pricing affordances and FAQ markup whose rich-result purpose is obsolete. | Remove only unsupported schema fields, remove FAQPage emission, add explicit OAI-SearchBot access, and keep visible FAQs. | Markup matches visible content; no AI-specific ranking promise; canonical/hreflang regression check. |
| Contact journey | Same-origin form has incomplete status semantics and API wildcard CORS. | Add accessible status/error associations and same-origin API policy; move runtime rate-limit storage to a non-public temp location. | No secrets in source; preserve server-side validation, CSRF, honeypot, timing, rate limit, and bilingual fallback. |
| Navigation / proof states | Keyboard and no-script paths are under-specified. | Add menu relationships/Escape close, real button lightbox trigger with focus return, FAQ panel relationships, `x-cloak`, and a no-script-safe reveal class. Remove the conflicting client figure. | Preserve existing type pairing, palette, product assets, responsive DOM order, and reduced-motion handling. |

## Experiment

Implementation was performed as small patches in the owning source files. The change is reversible: revert the named files, restore the prior schema and UI state, and rebuild. Generated `dist/` and dependency trees remain uncommitted.

Completed slices:

- Schema/crawler: changed the shared entity to `Organization`, removed unsupported area/coordinate fields, removed the unavailable SearchAction and zero-price Offer, removed FAQPage emission while retaining visible FAQs, added `OAI-SearchBot`, and removed redundant `public/llms-full.txt`.
- Navigation/progressive enhancement: added skip navigation, `aria-current`, menu relationships, Escape/outside close, `x-cloak`, no-script-safe reveal defaults, an IntersectionObserver fallback, and removal of decorative blur/glass utilities.
- Proof/lightbox: removed the conflicting `78+` figure, made the lightbox triggers native buttons, added a dialog name and focus return, and marked the above-the-fold product screenshots eager/high priority.
- Contact/security: removed wildcard CORS, disabled directory indexes for the API directory, moved rate-limit state to the protected API directory, fail-closed on persistence failure, returned field-keyed validation errors, and added status/error/live-region, autocomplete, and invalid-field semantics.

## Check

Checks to run after the patches:

```text
npm run build
npm run astro -- check                  # if the installed Astro CLI supports check
php -l public/api/contact.php
php -l public/api/csrf-token.php
static metadata/schema/link assertions # route-by-route, source-backed
dependency audit                        # only if package-manager/network access allows
browser screenshots at 375/768/1280     # required if renderer becomes available
keyboard, focus, reduced-motion, and form failure checks
```

The final record separates structural, behavioural, render, system/production, and handoff evidence. Missing browser, field, production, or stakeholder evidence remains `NOT_ASSESSED`.

### Completed check results

| Check | Result | Evidence / limitation |
|---|---|---|
| `npm run build` | PASS | Astro static build completed and generated the locale route set; generated `dist/` is ignored and not a source deliverable. |
| `php -l public/api/contact.php` | PASS | No PHP syntax errors. |
| `php -l public/api/csrf-token.php` | PASS | No PHP syntax errors. |
| `git diff --check` | PASS | Only line-ending normalization warnings were reported by Git; no whitespace errors. |
| Static route/SEO/schema assertions | PASS | 22 generated locale documents checked for one H1, one canonical, three hreflang links, parseable JSON-LD, no FAQPage/SearchAction/zero-price tokens, no `78+`, resolving locale links, sitemap/robots/OAI-SearchBot, protected rate-limit path, and absence of `llms-full.txt`. |
| `npm run astro -- check` | `NOT_ASSESSED` | Installed CLI prompted to install missing `@astrojs/check` and `typescript`; no package or lockfile change was authorised in the time-box. |
| `npm audit --omit=dev --audit-level=high` | FAIL / follow-up blocker | Audit completed with 9 vulnerabilities (8 high, 1 low) across Astro and transitive packages; remediation recommends a breaking Astro 7 upgrade. No forced audit fix or lockfile rewrite was performed. |
| Browser screenshots / keyboard / screen reader / reduced motion | `NOT_ASSESSED` | No browser renderer, Playwright package, or screen-reader harness is available in this worker context. Static semantics were improved but do not certify WCAG 2.2 conformance. |
| Lighthouse / field CWV / production headers / live form delivery | `NOT_ASSESSED` | No Lighthouse/RUM/Search Console/production endpoint evidence is available. |

## Standardise

The structural checks support standardising schema rules that represent visible content; same-origin API defaults; native interactive controls with explicit state relationships; and a script-failure-safe reveal pattern. The dependency, browser, field, and production gates remain open, so no ranking benefit, conversion uplift, WCAG conformance, or production security guarantee is inferred from these checks alone.

## Teach

The durable lesson for this repository is: do not use a number as proof when the supplied source conflicts, do not advertise interactions that the UI does not provide, and keep visual motion progressively enhanced. This report is the handoff record; the parent orchestrator owns Git commit/push and any production decision.

## Re-measure

Re-run the route/schema/link checks immediately after implementation. Re-run browser keyboard and screenshot checks when tooling is available. Re-audit on **2026-10-04** with Search Console/analytics, field CWV, production endpoint, screen-reader, and stakeholder proof. A future score of 95/100 is a target, not a current result.

## Currentness and evidence register

The following current platform guidance was supplied by the parent orchestrator and marked verified there on 2026-09-06. This worker records it as the source basis for implementation decisions; archive snapshots and independent live verification are `NOT_ASSESSED` in this worker.

| ID | Claim used | Source / status |
|---|---|---|
| SRC-GOOGLE-AI-2026-05-15 | Core Search eligibility and useful, non-commodity content remain the basis for generative Search; no artificial chunking or special AI markup is required. | [Google Search AI features guidance](https://developers.google.com/search/docs/fundamentals/ai-optimization-guide), Tier 1, parent-verified 2026-09-06; archive `NOT_ASSESSED`. |
| SRC-GOOGLE-SD-2026 | Structured data must represent visible main content; JSON-LD is recommended but does not guarantee a rich result. | [Google structured data policies](https://developers.google.com/search/docs/appearance/structured-data/sd-policies), Tier 1, parent-verified 2026-09-06; archive `NOT_ASSESSED`. |
| SRC-GOOGLE-UPDATES-2026-05-07 | FAQ rich results stopped appearing from 2026-05-07; visible FAQs may remain useful without FAQPage being retained for that purpose. | [Google Search updates](https://developers.google.com/search/updates), Tier 1, parent-verified 2026-09-06; archive `NOT_ASSESSED`. |
| SRC-OPENAI-PUBLISHER-2026-09 | OAI-SearchBot is the crawler control relevant to ChatGPT Search discoverability; GPTBot is separately controllable. | [OpenAI publisher FAQ](https://help.openai.com/en/articles/12627856-publishers-and-developers-faq), Tier 1, parent-verified 2026-09-06; archive `NOT_ASSESSED`. |
| SRC-W3C-WCAG22 | WCAG 2.2 is the current accessibility target; full-page conformance cannot be inferred from automation alone. | [W3C WCAG 2.2 Recommendation](https://www.w3.org/TR/WCAG22/), Tier 1, parent-verified 2026-09-06; archive `NOT_ASSESSED`. |
| SRC-BING-AI-2026-02-10 | Bing AI Performance reports citations/cited URLs rather than rank or authority; IndexNow supports update discovery. | [Bing Webmaster Tools AI Performance preview](https://blogs.bing.com/webmaster/February-2026/Introducing-AI-Performance-in-Bing-Webmaster-Tools-Public-Preview), Tier 1, parent-verified 2026-09-06; archive `NOT_ASSESSED`. |
| SRC-PROJECT-PROFILE | Company/product facts used as supplied project content; not independently verified in this worker. | [`docs/en/company-profile.md`](../../docs/en/company-profile.md), first-party project source, support `partial`; review owner required. |
| SRC-PROJECT-CONTACT | Contact/address/hours facts used as supplied project content; not independently verified in this worker. | [`docs/en/contact.md`](../../docs/en/contact.md), first-party project source, support `partial`; review owner required. |
| SRC-PROJECT-DESIGN | Typeface, palette, and visual direction used as the existing design authority. | [`docs/en/style-brief.md`](../../docs/en/style-brief.md), first-party project source, support `supported` for design intent. |

## Post-change evidence log

This log records the implementation checks. Every row names the command, path, viewport/state where applicable, result, and unresolved limitation.

| Evidence type | Command / locator | Result |
|---|---|---|
| Structural | `npm run build` | PASS |
| Type / Astro | `npm run astro -- check` | `NOT_ASSESSED`: missing dependency prompt; no install performed |
| PHP syntax | `php -l public/api/contact.php`; `php -l public/api/csrf-token.php` | PASS |
| SEO/schema | route-by-route generated HTML assertions | PASS: metadata/schema/link assertions described above |
| Security | dependency audit and source review | Source review improved API policy; `npm audit` FAIL with 9 vulnerabilities; production headers `NOT_ASSESSED` |
| Behavioural | form failure, menu Escape, FAQ disclosure, lightbox focus | `NOT_ASSESSED` without browser; static semantics present |
| Render | screenshots at 375/768/1280 | `NOT_ASSESSED` unless renderer becomes available |
| Field/system | Search Console, RUM/CWV, production headers/endpoints | `NOT_ASSESSED` |

## Final verification addendum

- Final production build: **PASS**, 24 pages; both PHP endpoints pass syntax checks.
- Non-forced dependency remediation reduced the audit from 9 advisories to 3 (2 high, 1 low). Remaining Astro/Sharp remediation requires major-version migration and remains an open release risk.
- Initial rendered evidence exposed large blank sections caused by decorative IntersectionObserver reveal states. The hidden-before-scroll behaviour and observer were removed, the site rebuilt, and screenshots recaptured.
- Final render review: **PASS for the English homepage sample** at 1440×900 and 390×844; all sections are visible, the layout has no observed horizontal overflow, and the retained teal/amber property identity avoids banned glass/gradient defaults. Evidence: `rendered/home-desktop.png`, `rendered/home-mobile.png`. Lazy below-fold images were not treated as loaded-state proof.
- The API success copy no longer promises a 24-hour response without service-level evidence. Full keyboard/screen-reader/zoom testing, Lighthouse, field CWV, live mail delivery, and production search/header evidence remain `NOT_ASSESSED`.
