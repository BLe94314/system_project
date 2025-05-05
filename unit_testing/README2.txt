How to Run LMS Project Unit Tests Using PHPUnit
===============================================

Project Structure
-----------------
system_project/
├── code/
│   └── book_functions.php
├── unit_testing/
│   └── book_functions_test.php
├── vendor/
│   └── ... (installed by Composer)
└── composer.json

Requirements
------------
- PHP (version 8.0 or later)
- Composer
- PHPUnit (installed via Composer)

Installation Steps
------------------
1. Open a terminal in the system_project root folder.
2. Run the following command to install PHPUnit via Composer:

   composer require --dev phpunit/phpunit

Run Unit Tests
--------------
1. In the terminal, navigate to the root system_project directory.
2. Run the test suite using this command:

   ./vendor/bin/phpunit unit_testing/book_functions_test.php

Example Output
--------------
PHPUnit 11.5.18 by Sebastian Bergmann and contributors.

Runtime:       PHP 8.2.12

............                                                      12 / 12 (100%)

Time: 00:00.008, Memory: 8.00 MB

OK (12 tests, 13 assertions)

What’s Tested
-------------
- isValidBookTitle($title)
- isValidBookPrice($price)

Tests cover various valid and invalid inputs.
