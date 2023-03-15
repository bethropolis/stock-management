<?php
require_once "dbh.inc.php"; // include the database connection
// Get the form data from the POST request
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$password = $_POST['password'];
$position = $_POST['position'];
$salary = $_POST['salary'];

// Validate user input
if (empty($first_name) || empty($last_name) || empty($email) || empty($password) || empty($position) || empty($salary)) {
    header("Location: ../signup.php?error=emptyfields");
    exit();
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../signup.php?error=invalidemail");
    exit();
} else {
    $stmt = $conn->prepare("SELECT * FROM employees WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the email address is already in use
    if ($result->num_rows > 0) {
        header("Location: ../signup.php?error=emailtaken");
        exit();
    } else {
        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare the SQL statement to insert a new user
        $stmt = $conn->prepare("INSERT INTO employees (first_name, last_name, email, password, position, salary) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssi", $first_name, $last_name, $email, $hashed_password, $position, $salary);

        // Execute the SQL statement to insert the new user
        if ($stmt->execute()) {
            header("Location: ../signup.php?success");
        } else {
            header("Location: ../signup.php?error=database");
        }

        $stmt->close(); // Close the prepared statement
        $conn->close(); // Close the database connection
    }
}
