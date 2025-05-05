<!-- book_functions.php -->

<?php
/**
 * Validates a book title.
 * - Must not be empty
 * - Must be at least 3 characters long
 */
function isValidBookTitle($title)
{
    return is_string($title) && strlen(trim($title)) >= 3;
}

/**
 * Validates a book price.
 * - Must be a positive number
 */
function isValidBookPrice($price)
{
    return is_numeric($price) && $price > 0;
}

/**
 * Validates a book ISBN.
 * - Must be a string of exactly 13 digits
 */
function isValidISBN($isbn)
{
    return is_string($isbn) && preg_match('/^\d{13}$/', $isbn);
}
