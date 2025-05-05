<!-- delete_cat.php -->
<?php
require_once("../auth.php");
require_role('admin', 'admin_login.php');

$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connection, "lms");
$cat_id = intval($_GET['cid']);
$query = "DELETE FROM category WHERE cat_id = $cat_id";
$query_run = mysqli_query($connection, $query);
?>
<script type="text/javascript">
    alert("Category Deleted successfully...");
    window.location.href = "manage_cat.php";
</script>