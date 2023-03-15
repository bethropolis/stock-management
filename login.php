<?php
require "header.php";
?>
<div class="container">
    <h2>Login</h2>
    <form method="post" action="inc/login.inc.php">
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Login</button>
    </form>
    <div class="mt-3">
        <p>Don't have an account? <a href="signup.php">Signup here</a>.</p>
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