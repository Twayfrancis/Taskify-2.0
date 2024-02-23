<?php require "../layouts/header.php"; ?>           
<?php require "../../config/db_config.php"; ?>

<?php 

    if(!isset($_SESSION['adminname'])) {

        header("location: ".ADMINURL."/admins/login-admins.php");

    }

    if(isset($_GET['id'])) {

        $id = $_GET['id'];

        $delete = $conn->prepare("DELETE FROM categories WHERE id = '$id'");
        $delete->execute();
        header("location: ".ADMINURL."/categories-admins/show-categories.php");

    } else {
        header("location: http://localhost/Taskify-2.0/404.php");
    }


?>


<?php require "../layouts/footer.php"; ?>           
