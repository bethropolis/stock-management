<?php
require_once "dbh.inc.php";
session_start();

// Check if the form has been submitted
if (isset($_POST['submit'])) {


    // Get the email and password from the form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the email and password are not empty
    if (empty($email) || empty($password)) {
        // Redirect to the login page with an error message
        header("Location: ../login.php?error=emptyfields");
        exit();
    } else {
        // Prepare a select statement to get the user with the given email
        $sql = "SELECT * FROM employees WHERE email=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            // Redirect to the login page with an error message
            header("Location: ../login.php?error=sqlerror");
            exit();
        } else {
            // Bind the email to the select statement
            mysqli_stmt_bind_param($stmt, "s", $email);

            // Execute the statement
            mysqli_stmt_execute($stmt);

            // Get the result from the statement
            $result = mysqli_stmt_get_result($stmt);

            // Check if the result has any rows
            if ($row = mysqli_fetch_assoc($result)) {
                // Verify the password
                $passwordCheck = password_verify($password, $row['password']);
                if ($passwordCheck == false) {
                    // Redirect to the login page with an error message
                    header("Location: ../login.php?error=wrongpassword");
                    exit();
                } elseif ($passwordCheck == true) {
                    // Start a session and store the user ID and email in session variables
                    setcookie("userId", $row['id'], time() + (86400 * 30), "/");
                    setcookie("userEmail", $row['email'], time() + (86400 * 30), "/");
                    setcookie("fname", $row['first_name'], time() + (86400 * 30), "/");
                    setcookie("position", $row['position'], time() + (86400 * 30), "/");

                    // Redirect to the home page
                    header("Location: ../index.php?success");
                    exit();
                }
            } else {
                // Redirect to the login page with an error message
                header("Location: ../login.php?error=nouser");
                exit();
            }
        }
    }

    // Close the statement and the database connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    // Redirect to the login page
    header("Location: ../login.php");
    exit();
}
