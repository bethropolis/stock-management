<?php
require "./dbh.inc.php";

try {
    // Sanitize user input and prepare SQL statement
    $item_id = mysqli_real_escape_string($conn, $_POST["item_id"]);
    $quantity = mysqli_real_escape_string($conn, $_POST["quantity"]);

    $stmt = $conn->prepare("INSERT INTO `manage` (`item_id`, `quantity`, `date_purchase`)
             VALUES (?, ?, current_timestamp())");
    $stmt->bind_param("ii", $item_id, $quantity);
    if ($stmt->execute()) {
        // Update stock quantity in items table
        $stmt_update = $conn->prepare("UPDATE `items` SET `stock` = `stock` - ? WHERE `id` = ?");
        $stmt_update->bind_param("ii", $quantity, $item_id);
        $stmt_update->execute();
        $stmt_update->close();
        
        // Success, redirect back to sell.php
        header("Location: ../sell.php");
    } else {
        // Error, redirect back to sell.php with error message
        $error_message = "Error: " . $conn->error;
        header("Location: ../sell.php?error=" . urlencode($error_message));
        exit();
    }
    $stmt->close();
    exit();
} catch (Exception $e) {
    // Display error message to user
    echo "Error: " . $e->getMessage();
}
?>
