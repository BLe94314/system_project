<!-- most_borrowed_books.php -->
<?php

$connection = mysqli_connect("localhost", "root", "", "lms");

if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

$query = "
    SELECT 
        b.book_name,
        COUNT(ib.book_no) AS times_issued
    FROM 
        issued_books ib
    JOIN 
        books b ON ib.book_no = b.book_no
    GROUP BY 
        ib.book_no
    ORDER BY 
        times_issued DESC
    LIMIT 10
";

$result = mysqli_query($connection, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($connection));
}

echo "Most Borrowed Books:\n";
echo "---------------------\n";

while ($row = mysqli_fetch_assoc($result)) {
    echo "{$row['book_name']} - Issued {$row['times_issued']} times\n";
}

mysqli_close($connection);
