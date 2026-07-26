# ADR-0001

## Title

Git is the single source of truth.

## Status

Accepted

## Date

2026-07-26

## Context

Historically the project evolved through multiple local copies and production changes.

This caused divergence between frontend and backend source code.

## Decision

GitHub becomes the only authoritative source of the project.

All development is performed locally.

Production receives deployments only.

## Consequences

- safer deployments

- reproducible builds

- complete history

- easier collaboration

- easier rollback