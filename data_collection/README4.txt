How to Run Data Collection Scripts for the LMS Project
=======================================================

Project Structure
-----------------
system_project/
├── code/
│   └── book_functions.php
├── data_collection/
│   └── most_borrowed_books.php
├── vendor/
│   └── ... (installed by Composer)
└── composer.json

Requirements
------------
- PHP 8.0 or later
- A running MySQL/MariaDB server with the 'lms' database configured
- A functioning LMS database with populated tables (e.g., books, issued_books)

Setup Instructions
------------------
1. Ensure that your database service is running (e.g., via XAMPP).
2. Confirm that the 'lms' database contains relevant tables and data:
   - `books`
   - `issued_books`
   - These should include book names and their corresponding issue records.

Running the Data Collection Script
----------------------------------
1. Open a terminal or command prompt.
2. Navigate to the root 'system_project' directory.
3. Run the following command to execute the script:

   php data_collection/most_borrowed_books.php

Expected Output
---------------
<!-- most_borrowed_books.php -->
Most Borrowed Books:
---------------------
Harry Potter and the Sorcerer's Stone - Issued 2 times
The Hobbit - Issued 1 times
The Shining - Issued 1 times

The output will vary depending on the data stored in your `issued_books` table.