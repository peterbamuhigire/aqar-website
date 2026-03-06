export type Language = 'en' | 'fr';
export const languages: Language[] = ['en', 'fr'];
export const defaultLang: Language = 'en';

// Labels for language switcher
export const languageLabels: Record<Language, string> = {
  en: 'English',
  fr: 'Fran\u00e7ais',
};

// OG locales
export const ogLocales: Record<Language, string> = {
  en: 'en_GB',
  fr: 'fr_FR',
};

// Route mapping: English slug -> French slug
const routeMap: Record<string, Record<Language, string>> = {
  features: { en: 'features', fr: 'fonctionnalites' },
  about: { en: 'about', fr: 'a-propos' },
  blog: { en: 'blog', fr: 'blog' },
  contact: { en: 'contact', fr: 'contact' },
  demo: { en: 'demo', fr: 'demo' },
  terms: { en: 'terms', fr: 'conditions' },
  privacy: { en: 'privacy', fr: 'confidentialite' },
};

// Get the localized path for a given page and language
export function getLocalizedPath(page: string, lang: Language): string {
  if (page === '' || page === '/') return `/${lang}/`;
  const route = routeMap[page];
  if (route) return `/${lang}/${route[lang]}/`;
  return `/${lang}/${page}/`;
}

// Get the path for hreflang from a page key
export function getHrefLangPath(lang: Language, pageKey: string): string {
  return getLocalizedPath(pageKey, lang);
}

// Get the alternate language
export function getAlternateLang(lang: Language): Language {
  return lang === 'en' ? 'fr' : 'en';
}

// Validate language
export function isValidLang(lang: string): lang is Language {
  return languages.includes(lang as Language);
}
