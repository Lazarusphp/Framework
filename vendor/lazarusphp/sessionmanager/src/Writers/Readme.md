
# Built-in SessionWriter Class

The `SessionWriter` class is responsible for handling database queries related to session management. It is used as the default implementation when instantiating the `SessionManager`.

## Custom Session Managers

If your application requires a different database connection or custom query logic, you can implement a custom session manager. This allows you to override the default behavior of the `SessionWriter` to suit your specific requirements.