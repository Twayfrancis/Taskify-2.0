<?php 
require "../layouts/header.php";           
require "../../config/db_config.php";

// Checking if logged-in user is a superadmin before showing the delete link
if (!isset($_SESSION['adminname']) || $_SESSION['role'] !== 'superadmin') {
    echo "<script>alert('Unauthorized access.'); window.location.href='feedback.php';</script>";
    exit;
}

// Check if an ID is provided for deletion
if (isset($_GET['id'])) {
    $feedbackId = $_GET['id']; // Assume you are getting the correct 'id' parameter for feedback

    // Prepare delete statement
    $delete = $conn->prepare("DELETE FROM contact WHERE id = :feedbackId");
    $delete->bindParam(':feedbackId', $feedbackId, PDO::PARAM_INT);

    // Execute delete statement
    if ($delete->execute()) {
        // Redirect with success message
        echo "<script>alert('Feedback deleted successfully'); window.location.href='feedback.php';</script>";
    } else {
        // Redirect with error message
        echo "<script>alert('Error deleting feedback'); window.history.back();</script>";
    }
} else {
    // Redirect if ID not provided
    echo "<script>window.history.back();</script>";
}
?>
