<?php
// Start the session
session_start();

?>

<header>
  <nav>
    <div id="left">
        <ul>
            <li><a class="logo" href="index.php?p=home">Manga69</a></li>
        </ul>
    </div>

    <?php

    $user_id = $_SESSION['user_id'];
      
      $select_rows = mysqli_query($conn, "SELECT cart.id, cart.name, cart.price, cart.quantity, cart.user_id FROM `cart` JOIN `tbl_users` ON cart.user_id = tbl_users.user_id WHERE cart.user_id = $user_id") or die('query failed');
      $row_count = mysqli_num_rows($select_rows);

      ?>

    <div id="right">
        <ul>
            <li><a href="index.php?p=home">Home</a></li>
            <li><a href="index.php?p=list_order">Order History</a></li>
            <li><a href="index.php?p=about">About Us</a></li>
            <li><a href="index.php?p=cart">Cart <span id="cart"><?php echo $row_count; ?></span></a></li>
            <li><a href="../logout.php">Logout</a></li>
        </ul>
    </div>
  </nav>
</header>