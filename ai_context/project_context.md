# Project Context (Business Overview)

## What This Project Is
The Bulgarian Calendar Project provides tools and public content for working with the Ancient Bulgarian Calendar, alongside Gregorian and Julian references. It serves both educational/research audiences and developers who need calendar conversion capabilities.

## Business Value
- Preserves and communicates cultural-historical knowledge in a usable digital form.
- Offers a public web experience and API access for broader adoption.
- Enables reuse through libraries in multiple languages (PHP, Java, JavaScript), lowering integration barriers.
- Supports community and ecosystem growth via WordPress/plugin compatibility.

## Primary Audiences
- Researchers and history enthusiasts exploring Bulgarian calendar assumptions.
- End users consuming calendar views and explanatory content.
- Technical integrators embedding date logic into websites, services, or plugins.

## Core Capabilities
- Date conversion and representation across Bulgarian, Gregorian, and Julian calendar systems.
- Public API endpoints for programmatic access.
- Human-readable content pages explaining principles and methodology.
- Containerized deployment for repeatable setup and operations.

## Scope and Positioning
This project is an interpretation and implementation framework rather than a final academic authority. It is designed to make assumptions transparent and enable practical experimentation, communication, and integration.

## Operational Considerations
- Multi-language codebase requires consistency in calendar rules across implementations.
- Public outputs (site/API) should prioritize correctness, traceability of assumptions, and stability.
- Changes to date algorithms can affect user trust, API consumers, and historical interpretations, so governance and testing are critical.
- For constrained servers, operations can use a fast container build target that skips JavaDoc generation, then run a full JavaDoc-enabled build before release.
