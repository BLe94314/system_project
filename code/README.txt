Library Management System (LMS) - README1.txt

Description:
------------
This is a web-based Library Management System (LMS) designed for admin users to manage books, authors, categories, and users, as well as issue books.

Requirements:
-------------
- PHP 7.x or higher
- MySQL/MariaDB
- Web server (e.g., Apache or XAMPP)
- Browser (latest Chrome/Firefox recommended)

Installation Instructions:
--------------------------
1. Download or clone the project folder into your web server's root directory (e.g., htdocs/ for XAMPP).
   
2. Start Apache and MySQL using your control panel (e.g., XAMPP Control Panel).

3. Open phpMyAdmin (http://localhost/phpmyadmin) and:
   - Create a new database called `lms`.
   - Import the SQL file (usually named `lms.sql`) containing the schema and initial data.

4. Open the file `auth.php` and ensure session and role handling are working as expected.

5. Access the system from your browser at:
   http://localhost/[your-folder-name]/admin_login.php

6. Login using an existing admin account (check `admins` table in the database for credentials).

Important Notes:
----------------
- The database connection uses default credentials (`root` user, no password). Update `mysqli_connect()` calls if your setup is different.
- Admin authentication is enforced throughout the system using session-based access.
- This version does not hash passwords or include CSRF protection. Use in a secure and private environment only.

Optional:
---------
- You may edit database settings in each PHP file or centralize them using a separate `db_connect.php` for easier maintenance.

Support:
--------
For issues, ensure your PHP and MySQL services are running and the database is correctly imported.