<?php
require "./inc/dbh.inc.php";
require "header.php";
require "./islogin.php";
?>
<div class="container">
    <h2>Sell Items</h2>
    <form method="post" action="inc/buy.inc.php">
        <label for="name">Item Name</label>
        <select name="item_id">
            <option value="1">-- Select Item --</option>
            <?php
            // Fetch items from database
            $sql = "SELECT * FROM items";
            $result = mysqli_query($conn, $sql);

            // Loop through the items and display them in <option> tags
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
            }
            ?>
        
        </select>

        <label for="quantity">Quantity</label>
        <input type="number" name="quantity" id="quantity" placeholder="Enter the quantity of the item you want to buy" required />

        <button type="submit">Buy</button>
    </form>
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