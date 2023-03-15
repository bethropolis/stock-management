<?php
require "./dbh.inc.php";

try {
    // Sanitize user input and prepare SQL statement
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $stock = mysqli_real_escape_string($conn, $_POST["stock"]);
    $measurement = mysqli_real_escape_string($conn, $_POST["measurement"]);
    $ratio = mysqli_real_escape_string($conn, $_POST["ratio"]);
    $price = mysqli_real_escape_string($conn, $_POST["price"]);

    $stmt = $conn->prepare("INSERT INTO `items` (`name`, `stock`, `measurement`, `ratio`, `price`, `date_added`)
             VALUES (?, ?, ?, ?, ?, current_timestamp())");
    $stmt->bind_param("siiii", $name, $stock, $measurement, $ratio, $price);
    if ($stmt->execute()) {
        // Success, redirect back to items.html
        header("Location: ../items.php");
    } else {
        // Error, redirect back to items.html with error message
        $error_message = "Error: " . $conn->error;
        header("Location: ../items.php?error=" . urlencode($error_message));
        exit();
    }
    $stmt->close();
    exit();
    // Redirect to success page
    header("Location: ../items.php");
    exit();
} catch (Exception $e) {
    // Display error message to user
    echo "Error: " . $e->getMessage();
}
