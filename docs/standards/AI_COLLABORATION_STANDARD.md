# AI Collaboration Standard

- **Version:** 0.1
- **Status:** Draft
- **Scope:** Cross-project engineering practice
- **Validation projects:**
  - GBS Core
  - Express Web Platform
- **Last updated:** 2026-07-30

## 1. Purpose

This standard defines the AI-assisted engineering practices that have been used and accepted across GBS Core and Express Web Platform. Its purpose is to make collaboration between a human project owner, ChatGPT, Codex, and the Git repository clear, reviewable, and repeatable.

The standard does not treat AI output as authoritative. It defines how AI may assist while human judgment, repository evidence, review, and Git history remain the basis for engineering decisions.

### Non-goals

This document does not:

- replace project-specific architecture, security, coding, or deployment rules;
- define corporate governance, legal compliance, or management structures;
- authorise autonomous merging, releasing, deployment, or production changes;
- require every available document type for every minor change;
- describe proposed tools or experimental practices as adopted standards.

## 2. Scope

This standard applies to analysis, planning, implementation, review, documentation, and production preparation where ChatGPT or Codex assists an engineering project.

It is technology-neutral. Each project must supply its own repository facts, supported commands, architecture constraints, security requirements, and deployment procedure.

The standard applies most directly to meaningful engineering work. Trivial corrections may use a lighter process when their risk and impact are low, provided scope, review, evidence, and security boundaries remain clear.

## 3. Standard maturity and evolution

Version 0.1 is a draft assembled from practices validated through active work on GBS Core and Express Web Platform. It is intentionally incomplete.

A practice may be promoted into this reusable standard when it has:

- been used successfully;
- solved a repeated problem;
- improved clarity, safety, quality, or traceability; or
- been explicitly accepted as a cross-project rule.

Project-specific practices should remain in project documentation until there is evidence that they are broadly reusable. Future possibilities must be labelled as such and must not be presented as current rules.

## 4. Core principles

1. **Human-led decisions.** The human project owner makes final product, architecture, merge, release, and production decisions.
2. **AI assistance, not authority.** AI may analyse, plan, implement, review, and document, but its output must be checked.
3. **Repository evidence over assumptions.** Actual files, versions, configuration, Git state, and command results take precedence over prompt assumptions.
4. **Documentation before meaningful implementation.** Work should be defined sufficiently to make its purpose, limits, and acceptance conditions reviewable.
5. **Inspect before editing.** Relevant repository state must be understood before changes are made.
6. **Small, controlled changes.** Tasks should have a single clear objective and avoid unrelated changes.
7. **Evidence-based completion.** A result is accepted on the basis of reviewed changes and recorded verification, not confident wording.
8. **Security and privacy boundaries.** Secrets, production credentials, and unapproved private data must not be exposed to AI systems.
9. **Git as the source of truth.** Branches, diffs, commits, and tags provide the durable record of accepted work.
10. **Production requires separate discipline.** Generated code or a successful local command does not by itself establish production readiness.

## 5. Roles and responsibilities

### Human project owner

The human project owner:

- defines or accepts objectives, constraints, priorities, and risk tolerance;
- makes final product and architecture decisions;
- approves the scope of implementation;
- reviews reports, diffs, important implementation details, and verification evidence;
- decides whether work may be committed, merged, released, or deployed;
- resolves material conflicts or ambiguities that cannot safely be answered from repository evidence.

Human review must not be replaced by an AI assertion that a result is correct.

### ChatGPT

ChatGPT is used to:

- discuss objectives, constraints, and trade-offs;
- decompose work into controlled tasks or analysis iterations;
- support architecture reasoning;
- prepare or refine documentation;
- draft task specifications and acceptance criteria;
- prepare precise Codex prompts;
- review Codex findings and implementation reports;
- identify unresolved questions and follow-up work.

ChatGPT should distinguish accepted project facts from assumptions, proposals, and future possibilities.

### Codex

Codex is used to:

- inspect the actual repository;
- perform factual repository analysis;
- implement approved, scoped tasks;
- run verification commands permitted by the task;
- report changed files and command or test results;
- identify mismatches between prompt assumptions and repository reality.

Codex must remain within the authorised scope. It must not force the repository to match an incorrect assumption, claim unexecuted verification, or deploy or alter production without a separately approved task that explicitly authorises that action.

### Git repository

The Git repository is the durable source of truth for code, project documentation, accepted changes, and traceable history.

Repository state must be checked at appropriate points so that pre-existing work is not mistaken for task output. Meaningful work should use a dedicated branch. Accepted changes should be represented by coherent commits, with task identifiers where practical.

## 6. Project lifecycle

AI-assisted project work follows a controlled progression:

```text
Understand objectives and constraints
  -> establish repository facts
  -> analyse and document
  -> define scoped tasks
  -> implement approved work
  -> verify and review
  -> commit and merge
  -> release or deploy when separately authorised
  -> record outcomes and lessons
```

The stages may be repeated. A project should return to analysis when repository evidence invalidates a plan or when risk is not sufficiently understood.

Large audits and stabilisation efforts should be divided into iterations. Proven examples include repository reconnaissance, architecture or module mapping, consistency review, approved documentation correction, validation, and implementation after sufficient understanding.

A single task should not combine broad analysis, redesign, implementation, testing, and deployment when those activities cannot be safely reviewed as one coherent unit.

## 7. Task lifecycle

The accepted primary statuses are:

```text
Proposed -> Planned -> Ready -> In Progress -> Review -> Done
```

Supporting statuses are:

- **Blocked:** progress cannot continue until a dependency or decision is resolved.
- **Deferred:** accepted work is intentionally postponed.
- **Cancelled:** the task is no longer required.

A task becomes **Ready** only when its scope, acceptance criteria, and execution prompt are sufficiently defined.

A task reaches **Review** when the requested output is available for human inspection. It becomes **Done** only after its acceptance criteria and required verification have been reviewed and satisfied. Deployment verification is part of completion only when deployment is within the task.

### Definition of a successful AI-assisted task

A successful AI-assisted task:

- stays within its approved scope;
- is based on inspected repository facts;
- satisfies its acceptance criteria;
- records changed files and verification honestly;
- preserves security and privacy boundaries;
- leaves unresolved risks and limitations visible;
- receives human review before acceptance;
- produces a traceable Git record when committed.

## 8. Analysis and audit workflow

For an unfamiliar, inherited, consolidated, or technically unclear repository, the first major audit must be read-only.

The initial audit should:

1. record the repository path, branch, and initial Git status;
2. inspect relevant structure, manifests, documentation, configuration, and source files without exposing secrets;
3. establish verified facts before proposing broad changes;
4. distinguish:
   - **verified facts**, supported directly by repository evidence;
   - **reasonable inferences**, supported indirectly but not conclusively;
   - **unknowns**, which require later investigation;
5. report paths supporting important findings;
6. avoid refactoring or correcting files during reconnaissance;
7. compare final Git status with the initial state and report whether it changed.

Later iterations may map architecture, review consistency, correct documentation, validate the revised baseline, and then implement approved changes. Each iteration should have its own scope and output.

An analysis document should not be treated as an implementation prompt. Analysis records current state, evidence, options, risks, open questions, and possible task breakdown; implementation requires a separately defined scope.

## 9. Prompt preparation standard

A Codex prompt for meaningful work should define:

- repository and current branch;
- task ID and title;
- goal;
- relevant context;
- files or areas to inspect;
- in-scope work;
- out-of-scope work;
- constraints and prohibited actions;
- acceptance criteria;
- verification requirements;
- required final response format.

Prompts should state whether the task is read-only, whether editing is authorised, and whether tests, builds, migrations, commits, pushes, or deployment are permitted.

Prompt assumptions should be explicit when they could affect implementation. A prompt must not contain secrets, passwords, API keys, tokens, production credentials, or unapproved private data.

## 10. Codex execution rules

Codex must:

- inspect relevant files and actual declared versions before editing;
- capture relevant pre-existing Git state;
- make only changes required by the task;
- preserve unrelated user changes;
- use repository-supported commands;
- respect explicit prohibitions on files, commands, dependencies, environments, and production systems;
- stop or report a conflict when proceeding would require materially different authority;
- report failures, partial results, and verification limitations.

When repository reality conflicts with the prompt, Codex must report the conflict. It should continue only when a safe interpretation remains within scope. It must not silently reshape the repository to satisfy an incorrect assumption.

Codex must not claim that a test, build, lint, migration, or other command passed unless that command was actually run successfully. Inspection does not imply runtime validation.

## 11. Review and acceptance workflow

After Codex completes a task, the human reviewer should:

1. read the report and inspect the relevant diff;
2. confirm that only authorised files and behaviours changed;
3. inspect important implementation and security details;
4. check the commands run and their actual results;
5. compare the result with the acceptance criteria;
6. identify unresolved risks, assumptions, failures, and follow-up work;
7. request corrections when required;
8. update project documentation and task status as appropriate;
9. decide whether to commit, merge, release, or deploy.

Acceptance must not rely only on generated summaries. The diff, repository state, and verification evidence remain primary.

## 12. Documentation requirements

Meaningful work should be prepared and recorded through the smallest useful combination of:

- project documentation;
- analysis documents;
- roadmap or task board entries;
- individual task files;
- acceptance criteria and test plans;
- Codex prompts;
- architecture decision records for significant technical decisions;
- release records where applicable.

Documentation depth must be proportional to impact, uncertainty, reversibility, security exposure, and production risk. A trivial correction does not require every document type.

Significant architecture decisions should be recorded with context, the decision, considered options, consequences, security or privacy impact, operational impact, and rollback or exit strategy.

Release records should include the version or date, commit or tag, included tasks, visible and technical changes, migrations, configuration changes, verification, known issues, and rollback notes when applicable.

## 13. Git and parallel-work rules

Validated Git practices are:

- use dedicated branches for meaningful work;
- keep the main branch stable;
- inspect `git status` and relevant diffs before acceptance;
- create coherent commits;
- include task IDs where practical;
- push branches explicitly;
- merge only after review;
- record important baselines with commits or tags where appropriate.

Multiple projects may proceed in parallel when each uses a separate repository and clear project and task context.

Parallel tasks in the same repository should use separate branches or worktrees when their changes could overlap. Pre-existing modified or untracked files must be reported and preserved unless their modification is explicitly in scope.

## 14. Security and privacy rules

- Secrets, passwords, API keys, tokens, and production credentials must not appear in prompts, documentation, commits, or reports.
- Environment-file contents must not be inspected unless the task explicitly requires it and the inspection is safely authorised.
- AI-generated code must be treated as untrusted until reviewed.
- Production data and private client data must not be exposed to an unapproved AI service.
- Reports should identify sensitive files only as needed and must not reveal their values.
- Generated code and external input must remain subject to normal validation, authorisation, privacy, and security review.
- Codex must not deploy or alter production unless a separately approved task explicitly authorises it.

These boundaries apply even when broader repository access is technically available.

## 15. Deployment and production boundaries

Implementation, local code generation, or a successful local command is not equivalent to production completion.

When production work is authorised, completion may require:

- review of the accepted diff;
- relevant automated or manual tests;
- production build verification;
- migration and data-impact review;
- a verified deployment procedure;
- post-deployment smoke tests;
- release documentation;
- rollback awareness.

The exact requirements depend on the project and the change. Deployment commands and infrastructure details must come from verified project documentation or an explicitly approved task; they must not be invented.

Without explicit deployment authority, AI work stops at analysis, implementation, verification, or deployment preparation as defined by the task.

## 16. Evidence and reporting standard

A Codex report should include, as applicable:

- verified findings and supporting paths;
- reasonable inferences;
- unknowns requiring investigation;
- a concise summary of the result;
- exact changed files;
- commands executed;
- command, test, lint, and build results;
- failures and limitations;
- migration or configuration effects;
- confirmation of whether Git state changed;
- acceptance-criteria status;
- unresolved risks;
- a suggested commit message.

Reports must distinguish “not run,” “failed,” and “passed.” A command that was not run cannot be reported as successful. A harmless inspection failure should still be disclosed when it affects confidence or completeness.

Read-only audits should explicitly confirm whether any file changed and whether final Git status differs from the initial snapshot.

## 17. Exceptions and proportionality

The process may be reduced for low-risk, obvious, and easily reversible work. Proportionality affects documentation depth and verification breadth; it does not remove the requirements to:

- understand the relevant repository state;
- keep the task scoped;
- protect secrets and private data;
- report actual changes and checks honestly;
- obtain human review before acceptance.

Exceptions to an explicit task constraint require human direction. Codex must not infer permission for materially broader work from a narrow task.

Emergency work may use a shorter preparation cycle, but the impact, verification, Git record, and follow-up documentation should still be captured.

## 18. Lessons and future evolution

The practices in v0.1 reflect two repeated lessons:

- read-only reconnaissance reduces errors caused by incorrect repository assumptions;
- small tasks with precise prompts and evidence-based reports are easier to review, correct, and trace than broad multi-purpose requests.

The standard should evolve through documented lessons from active projects. Proposed additions should remain proposals until successfully used or explicitly accepted across projects.

Potential future tools, automation, or autonomous behaviour are outside the current standard unless a later version records their adoption. This section does not authorise them.

## 19. Version history

| Version | Date | Status | Summary |
|---|---|---|---|
| 0.1 | 2026-07-30 | Draft | Initial cross-project standard based on practices validated through GBS Core and Express Web Platform. |
