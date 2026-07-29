# Express Web Platform — Coding Standards

## General
Prefer clarity over cleverness. Make the smallest safe change. Do not refactor unrelated code. Validate untrusted input. Avoid duplication. Never commit secrets. Treat AI-generated code as untrusted until reviewed.

## Vue
- Vue 3 Composition API and `<script setup>` for new components unless documented otherwise.
- PascalCase component names; composables prefixed with `use`.
- Explicit props/emits and stable list keys.
- Semantic HTML before ARIA.
- Explicit loading, empty, success and error states.
- Keep local state local; derive rather than duplicate state.
- Preserve keyboard focus, mobile behaviour and i18n.

## Laravel/PHP
- PSR-12/project formatter.
- Form Requests for non-trivial validation.
- Policies/Gates for authorisation.
- Thin controllers and injected dependencies.
- Queued jobs for slow external operations.
- Transactions for atomic multi-step writes.
- Reversible migrations where practical; indexes and foreign keys by need.
- Consistent API responses and intentional status codes.

## Internationalisation
User-visible strings belong in approved i18n/content sources. Keep semantic keys, preserve placeholders, avoid sentence-fragment concatenation and verify Serbian, English and German layouts.

## Accessibility
Keyboard operation, labels, understandable errors, visible focus, colour-independent state, correct alt text, focus-managed dialogs and reduced-motion support. Target WCAG 2.2 AA where practical.

## Testing
Use unit tests for domain logic, feature tests for backend workflows, component tests for complex UI and end-to-end/manual checks for critical journeys. Always record what was tested.

## Git
Branches: `feature/EW-123-name`, `fix/EW-123-name`, `docs/EW-123-name`, `security/EW-123-name`.

Commit example:
```text
feat(newsletter): add verified subscriber workflow

Refs: EW-123
```

## Codex rules
Every prompt must state task ID, goal, context, scope, non-goals, constraints, acceptance criteria, tests and response format. Codex must inspect before editing, avoid unrelated changes, list changed files and report only commands actually run.

## Review questions
Does the change satisfy the task, handle edge cases, preserve validation/authorisation/privacy, complete translations, maintain accessibility/performance and update tests/documentation?
