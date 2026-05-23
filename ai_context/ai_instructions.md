# AI Instructions — Operational Rules for Automated Code Changes

These rules must be followed whenever an AI-assisted tool makes changes in this repository.

## Behavioral Rules
- Always request explicit confirmation before deleting any files or large blocks of code.
- Be concise in explanations; do not add unnecessary narrative when making small changes.
- If uncertain, open an issue and describe the proposed change rather than applying it immediately.

## Coding Style Guidelines
- Keep changes idiomatic to existing code (follow the project's style and import patterns).
- Include or update unit tests for any behavioral changes and ensure tests pass in the containerized environment before proposing a merge.
- Write clear commit messages and include a short PR description with motivation and test evidence.

## Workflow Constraints
- Never modify files under `/legacy` or other explicitly marked folders without owner approval.
- Do not introduce new runtime dependencies without approval — add requests to the issue tracker for dependency changes.
- Database migrations or schema changes must have an accompanying migration plan and review from the data team.
- For container validation on slow servers, prefer fast builds with `BUILD_TARGET=runtime_no_javadoc`; use `runtime_with_javadoc` for full release verification.

## Error Handling & Diagnostics
- If an error occurs during a change or test, do not attempt blind fixes. Collect logs, reproduce locally, and report the root cause in an issue with steps to reproduce.
- Add informative log messages for unexpected paths and avoid crashing the server on recoverable inputs.

## Security & Privacy
- Never send real document content to external services. If external analysis is required, sanitize or seek approval.
- Follow the project's secret management policies and do not commit secrets or credentials.

## Acceptance Criteria for AI Changes
- Must include tests demonstrating behavior and run successfully in CI (or the container test command locally).
- PR must include a short summary, list of modified files, and testing notes.
- For any data-destructive changes, backups and an audit trail are required.

## Always use English language
