<!-- DatabaseIntegrationTest.php -->
<?php
use PHPUnit\Framework\TestCase;

class DatabaseIntegrationTest extends TestCase
{
    private $connection;

    protected function setUp(): void
    {
        // Connect to database
        $this->connection = new mysqli("localhost", "root", "", "lms");

        if ($this->connection->connect_error) {
            $this->fail("Database connection failed: " . $this->connection->connect_error);
        }
    }

    public function testFetchBookById()
    {
        // Assumes a book with ID = 1 exists in the database
        $bookId = 1;
        $result = $this->connection->query("SELECT * FROM books WHERE book_id = $bookId");

        $this->assertNotFalse($result, "Query failed.");
        $this->assertGreaterThan(0, $result->num_rows, "No book found with ID $bookId");

        $book = $result->fetch_assoc();
        $this->assertArrayHasKey("book_name", $book);
        $this->assertNotEmpty($book["book_name"]);
    }

    protected function tearDown(): void
    {
        if ($this->connection) {
            $this->connection->close();
        }
    }
}
