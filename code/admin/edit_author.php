<!--- edit_author.php -->
<?php
require("functions.php");
session_start();

// Connect to the database
$connection = mysqli_connect("localhost", "root", "", "lms");

if (isset($_GET['author_id'])) {
    $author_id = $_GET['author_id'];
    $query = "SELECT * FROM authors WHERE author_id = $author_id";
    $query_run = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($query_run);
}

if (isset($_POST['update_author'])) {
    $new_author_name = mysqli_real_escape_string($connection, $_POST['author_name']);
    $update_query = "UPDATE authors SET author_name = '$new_author_name' WHERE author_id = $author_id";
    if (mysqli_query($connection, $update_query)) {
        echo "<script>alert('Author updated successfully!'); window.location.href='manage_author.php';</script>";
    } else {
        echo "<script>alert('Error updating author.');</script>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Author</title>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="admin_dashboard.php">Library Management System (LMS)</a>
        </div>
    </nav><br>

    <div class="container">
        <h3 class="text-center">Edit Author</h3>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <form method="post">
                    <div class="form-group">
                        <label for="author_name">Author Name:</label>
                        <input type="text" name="author_name" class="form-control"
                            value="<?php echo $row['author_name']; ?>" required>
                    </div><br>
                    <center>
                        <button type="submit" name="update_author" class="btn btn-primary">Update Author</button>
                    </center>
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</body>

</html>