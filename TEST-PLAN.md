# Test Plan — WordPress API Integration

## Scope

Validate a sanitized WordPress-to-API integration pattern using synthetic data or a local mock service. Do not run tests against private production endpoints without authorization.

| ID | Scenario | Expected result | Status |
|---|---|---|---|
| API-01 | API returns valid JSON with expected fields | Supported fields are mapped correctly | NOT RUN |
| API-02 | API returns an empty collection | Safe empty state is rendered | NOT RUN |
| API-03 | API returns HTTP 4xx/5xx | Error is handled without exposing internal details | NOT RUN |
| API-04 | API response is invalid JSON | Parsing failure is handled safely | NOT RUN |
| API-05 | API request times out | Request fails gracefully | NOT RUN |
| FORM-01 | Required field is missing | Submission is rejected | NOT RUN |
| FORM-02 | Nonce is missing or invalid | State-changing request is rejected | NOT RUN |
| FORM-03 | User lacks required capability | Privileged action is denied | NOT RUN |
| FORM-04 | Input includes HTML-sensitive characters | Input/output handling prevents unintended markup execution | NOT RUN |
| FORM-05 | Valid synthetic submission | Expected post workflow completes in the test environment | NOT RUN |

## Result definitions

- **PASS:** test was executed and expected behavior observed.
- **FAIL:** test was executed and expected behavior did not occur.
- **BLOCKED:** required implementation or test environment is unavailable.
- **NOT RUN:** test has not been executed.

Do not mark a scenario PASS until it has been run and the evidence has been reviewed.
