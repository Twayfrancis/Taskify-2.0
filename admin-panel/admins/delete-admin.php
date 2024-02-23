<?php require "../layouts/header.php"; ?>           
<?php require "../../config/db_config.php"; ?>

<?php 
    if (!isset($_SESSION['adminname'])) {
        header("location: ".ADMINURL."");
        exit;
    }
    
    if (isset($_GET['id'])) {
        $adminId = $_GET['id'];

        // prepare delete statement
        $delete = $conn->prepare("DELETE FROM admins WHERE id = :adminId");
        $delete->bindParam(':adminId', $adminId, PDO::PARAM_INT);

        // execute delete statement

        if ($delete->execute()) {
            echo "<script>alert('Admin deleted successfully'); window.location.href='admins.php';</script>";
        } else {
            echo "<script>alert('Error deleting admin'); window.history.back();</script>";
        }
    } else {
        // redirect if ID not provided
        echo "<script>window.history.back();</script>";
    }
?>
          
