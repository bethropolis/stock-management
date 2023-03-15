<?php
require "header.php";
require "inc/dbh.inc.php";
require "./islogin.php";

$sql = "SELECT items.name, manage.quantity, manage.date_purchase, items.price, manage.quantity * items.price AS total_price FROM manage INNER JOIN items ON manage.item_id = items.id";

$result = mysqli_query($conn, $sql);
if (!$result) {
    die("SQL query failed: " . mysqli_error($conn));
}

$total = 0;

?>
<div class="container table">
    <table>
        <thead>
            <tr>
                <th>Item Name</th>
                <th>Quantity Bought</th>
                <th>Date Purchase</th>
                <th>Price per Ratio</th>
                <th>Total Price</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><?php echo $row["name"]; ?></td>
                    <td><?php echo $row["quantity"]; ?></td>
                    <td><?php echo $row["date_purchase"]; ?></td>
                    <td>KES.<?php echo $row["price"]; ?></td>
                    <td>KES. <?php echo $row["total_price"]; ?></td>
                </tr>
                <?php $total += $row["total_price"]; ?>
            <?php endwhile; ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4">Grand Total</th>
                <td>KES. <?php echo $total; ?></td>
            </tr>
        </tfoot>
    </table>
</div>
<?php
mysqli_close($conn);
?>
<?php

require "footer.php";
?>