How to Run Integration Tests for the LMS Project
================================================

Project Structure
-----------------
system_project/
├── code/
│   └── book_functions.php
├── integration_testing/
│   └── DatabaseIntegrationTest.php
├── vendor/
│   └── ... (installed by Composer)
└── composer.json

Requirements
------------
- PHP 8.0 or later
- Composer
- PHPUnit (installed via Composer)
- A running MySQL/MariaDB server with the 'lms' database configured

Installation Steps
------------------
1. Open a terminal in the 'system_project' root folder.
2. Install PHPUnit using Composer:

   composer require --dev phpunit/phpunit

3. Ensure your local database (e.g., via XAMPP) is running and the 'lms' database exists.

Running the Integration Test
----------------------------
1. In the terminal, navigate to the root 'system_project' directory.
2. Execute the following command to run the integration test:

   ./vendor/bin/phpunit integration_testing/DatabaseIntegrationTest.php

Expected Output
---------------
PHPUnit 11.5.18 by Sebastian Bergmann and contributors.

Runtime:       PHP 8.2.12

............                                                         1 / 1 (100%)

Time: 00:00.011, Memory: 8.00 MB

OK (1 test, 4 assertions)