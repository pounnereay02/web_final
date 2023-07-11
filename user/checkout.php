<?php

if(isset($_POST['order_btn'])){

   $name = $_POST['name'];
   $number = $_POST['number'];
   $email = $_POST['email'];
   $address = $_POST['address'];

   $cart_query = mysqli_query($conn, "SELECT cart.id, cart.name, cart.price, cart.quantity, cart.user_id FROM `cart` JOIN `tbl_users` ON cart.user_id = tbl_users.user_id WHERE cart.user_id = $user_id");
   $price_total = 0;
   if(mysqli_num_rows($cart_query) > 0)
   {
      while($product_item = mysqli_fetch_assoc($cart_query)){
         $product_name[] = $product_item['name'] .' ('. $product_item['quantity'] .') ';
         $product_price = number_format($product_item['price'] * $product_item['quantity']);
         $price_total += $product_price;
      };
   };

   $total_product = implode(', ',$product_name);
   $detail_query = mysqli_query($conn, "INSERT INTO `order` (`username`, `number`, `order_date`, `email`, `address`, `total_product`, `total_price`, `user_id`) VALUES ('$name', '$number', current_timestamp(), '$email', '$address', '$total_product', '$price_total', $user_id)") or die('query failed');

   mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = $user_id");

   if($cart_query && $detail_query)
   {

    $order = mysqli_query($conn, "SELECT o.id, o.order_date FROM `order` o JOIN tbl_users u ON o.user_id = u.user_id WHERE u.user_id = $user_id order by o.id DESC LIMIT 1;") or die('query failed');
    $orderInfo = mysqli_fetch_assoc($order);

    $orderID = $orderInfo['id'];
    $orderDate = $orderInfo['order_date'];

      echo "
      <div class='order-message-container'>,
      <div class='message-container'>
         <h3>Thank you for shopping with us!</h3>
         <div class='order-detail'>
            <span>".$total_product."</span>
            <span class='total'> total : $".$price_total."/-  </span>
         </div>
         <div class='customer-details'>
            <p> Order number : <span>".$orderID."</span> </p>
            <p> Your Name : <span>".$name."</span> </p>
            <p> Your Number : <span>".$number."</span> </p>
            <p> Your Email : <span>".$email."</span> </p>
            <p> Your Address : <span>".$address."</span> </p>
            <p> Date : <span>".$orderDate."</span> </p>
            <p class='pRed'>(Pay when product arrives)</p>
            <p class='pRed'>(Product will be delivered 14 day after order date)</p>
         </div>
            <a href='index.php?p=home' class='btn'>Back</a>
         </div>
      </div>
      ";
   }

}

?>

<div class="container">
    <section class="checkout-form">
        <h1 class="heading">Complete your order</h1>

        <form action="" method="post">

            <div class="display-order">
                <?php
                    $select_cart = mysqli_query($conn, "SELECT cart.id, cart.name, cart.price, cart.quantity, cart.user_id FROM `cart` JOIN `tbl_users` ON cart.user_id = tbl_users.user_id WHERE cart.user_id = $user_id");
                    $total = 0;
                    $grand_total = 0;
                    if(mysqli_num_rows($select_cart) > 0)
                    {
                        while($fetch_cart = mysqli_fetch_assoc($select_cart))
                        {
                            $total_price = number_format($fetch_cart['price'] * $fetch_cart['quantity']);
                            $grand_total = $total += $total_price;
                ?>
                            <span><?= $fetch_cart['name']; ?> (<?= $fetch_cart['quantity']; ?>)</span>
                <?php
                        }
                    }
                    else
                    {
                    echo "<div class='display-order'><span>your cart is empty!</span></div>";
                    }
                ?>
                <span class="grand-total"> Total : $<?= $grand_total; ?>/- </span>
            </div>

            <div class="flex">
                <div class="inputBox">
                    <span>Your Name</span>
                    <input type="text" placeholder="name" name="name" value="<?php echo  $_SESSION['username'] ?>" required>
                </div>
                <div class="inputBox">
                    <span>Your Number</span>
                    <input type="number" placeholder="number" name="number" value="<?php echo  $_SESSION['phone'] ?>" required>
                </div>
                <div class="inputBox">
                    <span>Your Email</span>
                    <input type="email" placeholder="email" name="email" value="<?php echo  $_SESSION['email'] ?>" required>
                </div>
                <div class="inputBox">
                    <span>Your Address</span>
                    <input type="text" placeholder="address" name="address" value="<?php echo  $_SESSION['address'] ?>" required>
                </div>
            </div>
            <input type="submit" value="Order Now" name="order_btn" class="btn">
        </form>

    </section>
</div>