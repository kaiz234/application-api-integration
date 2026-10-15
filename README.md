# WordPress Application Development & API Integration

## Overview

This portfolio case study describes a WordPress integration pattern using PHP shortcodes and a REST API to retrieve and display content from an external Laravel-backed service.

The public case study is intentionally sanitized. It does not include employer credentials, private endpoints, production payloads, internal site identifiers, or confidential source code. This repository is a documented example of the integration approach, not a claim that the original employer integration can be deployed as-is.

## Problem

A WordPress site may need to display content managed by a separate application. Maintaining duplicate content manually can create extra work and lead to inconsistent information between systems.

## Approach

The implementation pattern documented here includes:

- **WordPress shortcodes:** `[laravel_tabs]` for displaying API-driven content and `[laravel_post_form]` for a form-related workflow.
- **API consumption:** PHP requests an external API and processes returned content for WordPress display.
- **Content handling:** the integration pattern accounts for fields such as title, content, media, permalink, category, and date, depending on the response available.
- **WordPress post workflow:** a form-related flow can create a WordPress post after validating and sanitizing submitted values.
- **Security controls:** nonce verification, capability checks where relevant, input validation, and output escaping should be applied to any public-facing submission flow.
- **Diagnostics:** error logging can support troubleshooting without exposing secrets or sensitive response data.

This README describes the pattern at a high level. It does not publish the original production API URL or imply that every listed control has been independently audited in the original implementation.

## Technology

- PHP
- WordPress
- Shortcodes
- REST API / HTTP requests
- Laravel-backed API integration
- WordPress post and permalink functions
- Input validation, sanitization, and output escaping

## Architecture

```text
External Laravel-backed service
              |
              | HTTP API response
              v
WordPress PHP integration
              |
              | Validate and map response fields
              v
Shortcode / WordPress display
              |
              v
Rendered content on the WordPress page
```

For a form-based workflow, submitted data should be validated and sanitized, the user's permissions should be checked where applicable, and any cross-system request should handle errors and timeouts explicitly.

## Engineering considerations

### API reliability
- Set a reasonable request timeout.
- Handle non-success HTTP status codes and malformed JSON.
- Avoid assuming every response field is present.
- Do not display raw API errors or sensitive payloads to visitors.
- Consider caching read-only responses where freshness requirements permit.

### WordPress security
- Verify nonces for state-changing form submissions.
- Check user capabilities before privileged actions.
- Sanitize input and escape output for its final context.
- Restrict accepted URLs and data formats where applicable.
- Keep API keys and credentials outside public source code.
- Avoid logging authentication headers, secrets, or personal data.

### Maintainability
- Separate API transport, response mapping, and rendering logic.
- Use clear error handling and reusable helper functions.
- Document shortcode attributes and expected API fields.
- Test both successful responses and failure cases.

## Suggested test plan

| Test | Expected behavior |
|---|---|
| API returns valid content | The integration maps and displays supported fields |
| API returns an empty result | A safe empty state is shown |
| API returns a non-success status | The page fails gracefully and does not expose internal details |
| API response is malformed | The response is handled without an uncaught error |
| Required form field is missing | Submission is rejected with a clear validation message |
| Nonce is invalid or missing | State-changing submission is rejected |
| User lacks required capability | Privileged action is denied |
| Content contains HTML-sensitive characters | Output is escaped appropriately |
| API request times out | The page remains usable and a safe error is recorded |

These are recommended test cases, not results of a test run.

## Privacy and publication notes

This portfolio case study deliberately excludes:
- Private API URLs, tokens, API keys, and credentials.
- Production site keys, customer data, and real API responses.
- Employer-owned source code unless publication is explicitly authorized.
- Claims about performance, usage, or test coverage without evidence.

## Current status

**Status: Case study and test plan.**

This repository documents the integration approach. A runnable demo implementation and verified test results should be added only after creating a clean-room example with a public or local mock API and actually testing it.

## Future improvements

- Add a small local mock API or fixture-based test server.
- Add automated PHP syntax checks and unit tests for response mapping.
- Add a demo plugin using only synthetic data.
- Add a CI workflow after the demo can run without private services.
