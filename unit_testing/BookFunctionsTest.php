<!-- book_functions_test.php -->
<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../code/book_functions.php';

class BookFunctionsTest extends TestCase
{

    public function testValidTitleReturnsTrue()
    {
        $this->assertTrue(isValidBookTitle("Harry Potter"));
    }

    public function testShortTitleReturnsFalse()
    {
        $this->assertFalse(isValidBookTitle("HP"));
    }

    public function testEmptyTitleReturnsFalse()
    {
        $this->assertFalse(isValidBookTitle(""));
    }

    public function testNullTitleReturnsFalse()
    {
        $this->assertFalse(isValidBookTitle(null));
    }

    public function testValidPriceReturnsTrue()
    {
        $this->assertTrue(isValidBookPrice(19.99));
        $this->assertTrue(isValidBookPrice("10"));
    }

    public function testNegativePriceReturnsFalse()
    {
        $this->assertFalse(isValidBookPrice(-5));
    }

    public function testZeroPriceReturnsFalse()
    {
        $this->assertFalse(isValidBookPrice(0));
    }

    public function testNonNumericPriceReturnsFalse()
    {
        $this->assertFalse(isValidBookPrice("free"));
    }

    public function testValidISBNReturnsTrue()
    {
        $this->assertTrue(isValidISBN("9783161484100"));
    }

    public function testISBNWithLettersReturnsFalse()
    {
        $this->assertFalse(isValidISBN("97831A484100"));
    }

    public function testShortISBNReturnsFalse()
    {
        $this->assertFalse(isValidISBN("1234567890"));
    }

    public function testEmptyISBNReturnsFalse()
    {
        $this->assertFalse(isValidISBN(""));
    }

}
