# progettoWEB-SpottedUniCesena

Setup and compatibility notes (macOS, Windows MAMP/XAMPP)

- Document root should point to the public/ directory.
- API routing: public/.htaccess forwards /api/... requests to api/index.php; this works on macOS and Windows (MAMP/XAMPP).
- Frontend uses a relative path (api/user) so it works from a subfolder as well.

Database configuration

- Defaults are defined in config/config.php but can be overridden by environment variables:
  - DB_HOST (default: localhost)
  - DB_PORT (default: 3306; on macOS MAMP often 8889)
  - DB_NAME (default: spotted_db)
  - DB_USER (default: root)
  - DB_PASS (default: root; on Windows/XAMPP often empty "")
  - DB_CHARSET (default: utf8mb4)

Examples

- macOS MAMP default MySQL port/password:
  - DB_PORT=8889
  - DB_PASS=root

- Windows XAMPP typical settings:
  - DB_PORT=3306
  - DB_PASS=""

Notes

- On the first run, the app will create the database (if it does not exist) and run the SQL in database.sql to create tables and seed roles.