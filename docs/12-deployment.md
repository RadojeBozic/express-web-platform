# Express Web Platform — Deployment and Release Procedure

**Status:** Baseline; exact commands and infrastructure must be verified.

## Principles
Deploy reviewed code from a known commit, back up before destructive work, avoid undocumented production edits, verify immediately and keep rollback possible.

## Environments
Document local, CI/test, staging and production URL, branch, hosting, database type and owner without credentials. Production is `https://www.express-web.express`; other details are TBD by audit.

## Pre-release
Acceptance criteria, tests, production build, migrations, environment changes, secrets, backup need, rollback, release note and SEO/analytics impact are reviewed.

## Git checks
```bash
git status
git diff
git diff --staged
git log --oneline -n 10
```
Confirm correct branch, intended files, no secrets/noise and traceable task ID.

## Frontend/backend commands
The audit must replace examples with commands verified from `package.json`, `composer.json` and deployment workflows. Never claim lint/test/build success unless run.

## Migrations
Assess reversibility, locks, compatibility during rollout, backup, failure after migration, backfill and rollback. Use expand/migrate/contract for destructive changes where practical.

## Cloudways audit
Document deployment method, webroot, PHP/Node versions, scheduler, queue worker, SSL/redirect, backup, logs, restarts, permissions and DNS ownership without secret values.

## Smoke test
Homepage, navigation, languages, projects, pricing, service/blog/contact, newsletter when changed, chatbot when enabled, primary CTAs, metadata/canonical, mobile and console/network/backend errors.

## Rollback
Previous commit/tag/assets, revert, reversible migration, DB restore, feature flag or queue pause. Data-changing migrations require special care.

## Hotfix
Document impact, branch from production baseline, smallest safe fix, targeted/regression tests, deploy/verify, merge back and record release/incident note.

## Release notes
Store under `docs/releases/` with version/date, commit/tag, tasks, visible/technical changes, migrations, config, tests, known issues and rollback notes.
