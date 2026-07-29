# Express Web Platform — Performance Checklist

## Goal
Fast, stable and responsive pages on realistic mobile devices and networks.

## Baseline per key page
Record URL, date/commit, mobile/desktop profile, Lighthouse/Core Web Vitals indicators, LCP element, CLS sources, transfer size, JS/images and third-party impact.

## Images
Correct dimensions, modern formats, responsive sources, mobile-sized delivery, lazy loading below fold, intentional LCP loading, compression, reserved space and useful alt text.

## JavaScript/CSS
Route splitting, remove unused dependencies, defer non-critical/third-party scripts, avoid duplicate analytics/chat code, inspect bundle output, verify Tailwind production scanning and avoid obsolete global CSS.

## Fonts
Limit families/weights, modern formats, critical preload only, fallback stack, appropriate `font-display` and verified multilingual glyphs.

## Network/cache
Compression, long cache for fingerprinted assets, safe HTML/API caching, documented CDN, reduced requests and verified invalidation.

## Backend/API
Avoid N+1, add indexes, paginate, cache stable expensive data, queue slow work, enforce timeouts, monitor slow requests and return only required fields.

## Third parties
Document owner, purpose, loading, data/performance cost, failure impact and removal criteria.

## Release checks
Production build, bundle size, key mobile pages, LCP/CLS, images, duplicate requests, scripts, caching and console/network errors.

## Budgets
After audit define template budgets for JS, CSS, images, third parties, LCP, CLS and API response. Material regressions require a fix, flag or explicit approved exception.
