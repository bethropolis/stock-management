<?php
require "header.php";
?>

<div class="container">
    <h2>Register</h2>
    <form method="post" action="inc/signup.inc.php">
        <label for="first_name">First Name</label>
        <input type="text" name="first_name" id="first_name" placeholder="Enter your first name" required />

        <label for="last_name">Last Name</label>
        <input type="text" name="last_name" id="last_name" placeholder="Enter your last name" required />

        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Enter your email" required />

        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Enter your password" required />

        <label for="position">Position</label>
        <select name="position" id="position" placeholder="Enter your position" class="form-control" required>
            <option value="">-- Select Unit --</option>
            <option value="employee">employee</option>
            <option value="manager">manager</option>
            <option value="director">director</option>
        </select>
        <label for="salary">Salary</label>
        <input type="number" name="salary" id="salary" placeholder="Enter your salary" required />

        <button type="submit">Sign Up</button>
    </form>

    <div class="mt-3">
        <p>Have an account? <a href="login.php">Login here</a>.</p>
    </div>

    <div id="error-message"></div>
</div>
<script>
    // Get error message from URL parameters and display it
    const urlParams = new URLSearchParams(window.location.search);
    const errorMessage = urlParams.get("error");
    if (errorMessage) {
        const errorMessageDiv = document.getElementById("error-message");
        errorMessageDiv.innerHTML = errorMessage;
    }
</script>

<?php

require "footer.php";
?>

</body>

</html>