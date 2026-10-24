# Project Architecture

## Overview
This repository is a multi-language monorepo centered on the Ancient Bulgarian Calendar domain. It combines:
- A production-oriented PHP website and REST API (`phpsite/`)
- Reusable calendar calculation libraries in PHP, Java, and JavaScript
- Integration surfaces for WordPress (`plugins/wordpress/`, `wordpress/plugin/`)
- Legacy/companion desktop code in C (`c/win32/`)
- Containerized build/run setup with Docker (`Dockerfile`, `docker-compose.yml`, `docker-build-publish.sh`)

## Architectural Style
The system follows a layered domain architecture repeated across multiple languages:
- API layer: Interfaces and calendar-neutral types (`Leto`, `LetoPeriod`, `LetoPeriodType`, exceptions)
- Base layer: Shared validation and period logic (`LetoBase`, correctness checks, beans)
- Implementation layer: Concrete calendar engines (`bulgarian`, `gregorian`, `julian`)
- Delivery layer: Web pages, REST endpoints, and plugin entry points

This structure allows the same calendar concepts and algorithms to be reused in different runtimes.

## Main Runtime Components
- `phpsite/`: Main web application and public-facing content
- `phpsite/api/`: Versioned REST API endpoints (for dates, formats, and calendar models)
- `phpsite/leto/`: PHP calendar engine implementation used by site and API
- `java/src/bg/util/leto/`: Java implementation of the same core calendar model
- `javascript/bg/util/leto/`: JavaScript implementation of the same model
- `plugins/wordpress/` and `wordpress/plugin/`: CMS integration layer

## Data and Request Flow
1. Client requests a web page or API endpoint.
2. PHP entry points route to calendar utilities and `leto` domain classes.
3. Calendar engine resolves date conversions/calculations for Bulgarian, Gregorian, or Julian systems.
4. Response is returned as HTML or API payload.

## Deployment Model
- Local and server deployment are container-friendly through Docker Compose.
- Architecture-aware Dockerfiles support `x86_64` and `arm64` environments.
- Container runtime baseline is PHP 8.5.
- Build targets support two workflows: `runtime_no_javadoc` (fast) and `runtime_with_javadoc` (full JavaDoc publish).
- Static assets (images, fonts, CSS, JS) are served directly by the web stack, while PHP handles dynamic rendering and API logic.

## Design Intent
- Keep calendar logic explicit and testable via language-specific libraries.
- Support research-oriented experimentation with assumptions for historical calendar calculations.
- Expose the model both for direct library use and for end-user consumption through web/API channels.
