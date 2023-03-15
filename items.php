<?php
require "header.php";
require "./islogin.php";
?>
<div class="container">
    <form method="post" action="inc/items.inc.php">
        <label for="name">Item Name</label>
        <input type="text" name="name" id="name" placeholder="Enter the name of the item" required />

        <label for="stock">Stock Quantity</label>
        <input type="number" name="stock" id="stock" placeholder="Enter the current stock quantity" required />

        <label for="measurement">Measurement Unit</label>
        <select name="measurement" id="measurement" class="form-control" required>
            <option value="">-- Select Unit --</option>
            <option value="1">Kilogram (kg)</option>
            <option value="2">Gram (g)</option>
            <option value="3">Liter (L)</option>
            <option value="4">Milliliter (mL)</option>
            <option value="5">Piece (pc)</option>
        </select>

        <label for="ratio">Measurement Ratio</label>
        <input type="number" name="ratio" id="ratio" placeholder="Enter the ratio of the measurement unit to the stock quantity" required />

        <label for="price">Price</label>
        <input type="number" name="price" id="price" placeholder="Enter the price of the item" required />

        <button type="submit">Add Item</button>
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