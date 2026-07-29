# Express Web Platform — Architecture

**Status:** Initial baseline; repository audit required.

## Architectural goals
- fast, accessible and multilingual public frontend;
- reliable backend APIs and business workflows;
- clear separation of content, presentation and infrastructure;
- safe newsletter and contact processing;
- gradual introduction of analytics, chatbot and AI capabilities;
- maintainable deployment and rollback.

## Conceptual context
```text
Visitors
  -> Vue 3 frontend
       -> Laravel API
            -> Database
            -> Mail provider / queues
            -> Admin/content workflows
            -> Approved AI integrations
       -> Analytics
       -> Search engines
```

## Frontend responsibilities
Routing, responsive UI, i18n, forms, projects/blog presentation, metadata, analytics events and API integration. New Vue work should prefer Composition API and `<script setup>`, reusable components, explicit loading/error states and route-level lazy loading where appropriate.

## Backend responsibilities
Validation, contact and newsletter workflows, consent, queues, protected administration, rate limiting, storage, logging and external integrations. Controllers should coordinate requests; business logic belongs in application/service layers where complexity justifies it.

## Content ownership
The audit must identify the canonical source for UI strings, services, projects, blog posts, pricing, FAQ, newsletter templates and chatbot knowledge. Duplicate sources should be removed or generated from one approved source.

## Integrations
For every external service document: owner, purpose, data sent, credentials location, environment variables, rate limits, failure behaviour, privacy impact and exit strategy.

## Environments
Recommended: local, CI/test, staging and production. If staging does not exist, record this as a risk.

## Observability
Minimum baseline: structured logs, safe user errors, failed-job visibility, newsletter delivery failures, deployment record and production error monitoring.

## Audit deliverables
1. Repository tree summary.
2. Actual framework/package versions.
3. Route and module inventory.
4. Configuration inventory without secret values.
5. Database/migration inventory.
6. Integrations and third-party scripts.
7. Test inventory.
8. Deployment workflow.
9. Differences between documentation and repository reality.
10. Recommended documentation corrections before broad refactoring.
