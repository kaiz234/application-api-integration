# Test Plan — Application Development & API Integration Demo

**Environment:** WordPress Playground  
**Data source:** Local synthetic/mock data  
**Scope:** WordPress plugin install, shortcode rendering, responsive presentation, content, and output escaping.

| ID | Test | Expected result | Status |
|---|---|---|---|
| API-01 | Install and activate the plugin | Plugin activates without a PHP error | PASSED |
| API-02 | Add `[qhaiz_api_demo]` to a page | Shortcode renders output rather than raw shortcode text | PASSED |
| API-03 | Resize the browser viewport | Cards adapt to available width without unwanted horizontal overflow | PASSED |
| API-04 | Check each card | All three cards show expected title, date, and description | PASSED |
| API-05 | Review displayed-value escaping in the plugin source | Dynamic text uses `esc_html()` and date attributes use `esc_attr()` | PASSED |
| API-06 | Review the plugin for remote calls or credentials | Demo makes no external API request and contains no credentials | PASSED |
| API-07 | Temporarily make the provider return an empty array | The “No events are currently available” message appears | NOT RUN |
| API-08 | Test a value containing HTML in provider data | HTML is displayed as text, not interpreted as markup | NOT RUN |

## Execution record

- Environment: WordPress Playground
- Test date: 2026-10-15
- Tests passed: API-01 through API-06
- Tests not run: API-07 and API-08
- Live API integration: Not tested; demo uses synthetic data
