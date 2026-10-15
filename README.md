# Application Development & API Integration

A small, runnable WordPress plugin case study demonstrating how structured application data can be rendered through a WordPress shortcode.

## Demo status

**Verified in WordPress Playground:** the plugin was installed and activated, and the `[qhaiz_api_demo]` shortcode displayed three sample event cards with titles, dates, and descriptions. The user also completed the follow-up checks for responsive layout, card content, and output escaping.

This is a **mock-data demo**, not a live Laravel API integration. No private endpoint, credential, or employer code is included.

## Repository contents

- `demo-plugin/qhaiz-api-demo.php` — runnable WordPress plugin source.
- `TEST-PLAN.md` — manual test checklist and execution status.
- `TEST-RESULTS.md` — record of the checks performed in WordPress Playground.
- `evidence/playground-demo.png` — screenshot of the rendered shortcode output.

## Run the demo

1. Download the ZIP archive from the repository (or use the plugin ZIP supplied separately).
2. In WordPress Admin, go to **Plugins → Add New Plugin → Upload Plugin**.
3. Upload `qhaiz-api-demo-plugin.zip`, install it, and activate it.
4. Create a page and add a Shortcode block containing:

   `[qhaiz_api_demo]`

5. Publish or preview the page.

## Implementation notes

- Registers the `[qhaiz_api_demo]` shortcode.
- Uses a dedicated provider function to return synthetic event records.
- Escapes text and attributes using WordPress escaping functions.
- Includes an empty-state branch if the provider returns no records.
- Loads lightweight responsive CSS only on singular pages containing the shortcode.
- Uses no external libraries, API keys, or remote API calls.

## Next development step

Replace the synthetic provider with a real API client in a separate iteration. A production integration should validate the endpoint and response schema, use a bounded request timeout, handle HTTP/JSON errors, and keep credentials out of source control. Any form-submission workflow should be implemented and tested separately with appropriate nonce and capability checks.

## Test evidence

See [`TEST-RESULTS.md`](TEST-RESULTS.md) for the executed checks. Additional edge-case tests for an empty data set and HTML-sensitive input remain marked **NOT RUN**; they are not claimed as passed.
