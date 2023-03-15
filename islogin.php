<?php if (!isset($_COOKIE['userId'])) { ?>
    <div class="alert alert-danger text-center" role="alert">
        This page is only for logged in users.
    </div>
<?php
exit();
}
?>