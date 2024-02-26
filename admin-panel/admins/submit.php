<?php require "../../config/db_config.php"; ?>
<?php

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    $fname = htmlspecialchars($_POST['fname']);
    $lname = htmlspecialchars($_POST['lname']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);
    
    // Insert data into the database
    $sql = "INSERT INTO contact (fname, lname, email, subject, message)
            VALUES (:fname, :lname, :email, :subject, :message)";
    
    try {
        $stmt = $conn->prepare($sql);
        
        // Bind parameters correctly
        $stmt->bindParam(':fname', $fname);
        $stmt->bindParam(':lname', $lname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':subject', $subject);
        $stmt->bindParam(':message', $message);
        
        // Execute the prepared statement
        $stmt->execute();
        echo "<script>alert('Thank you for your message, " . $fname . ". We will get back to you shortly.'); window.location.href='../../contact.php';</script>";
        // echo "Thank you for your message, " . $fname . ". We will get back to you shortly.";
        // header("Location: ../../contact.php");
    } catch (PDOException $e) {
        // Handle potential errors here
        echo "There was an error saving your message: " . $e->getMessage();
    }
} else {
    // Not a POST request, redirect to the form or show an error
    echo "Form submission error.";
}

?>