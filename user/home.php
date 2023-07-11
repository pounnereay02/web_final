<?php


if(isset($_POST['add_to_cart']))
{
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = 1;
    $user_id = $_SESSION['user_id'];

    $select_cart = mysqli_query($conn, "SELECT cart.id, cart.name, cart.price, cart.quantity, cart.user_id FROM `cart` JOIN `tbl_users` ON cart.user_id = tbl_users.user_id WHERE name = '$product_name' AND cart.user_id = $user_id");


    if(mysqli_num_rows($select_cart) > 0)
    {
        $message[] = 'product already added to cart';
    }else
    {
        $insert_product = mysqli_query($conn, "INSERT INTO `cart`(name, price, image, quantity, user_id) VALUES('$product_name', '$product_price', '$product_image', '$product_quantity', $user_id)");
        $updateQuantity =  mysqli_query($conn, "UPDATE tbl_book SET book_qty = book_qty - 1 WHERE book_id = $product_id;");
        $message[] = 'product added to cart succesfully';
        // Set the number of seconds to wait before refreshing the page
        $refresh_time = 0.5;

        // Use the header function to send a raw HTTP header to the client
        header("refresh: $refresh_time;");

    }
}

?>

<?php
if(isset($message))
{
   foreach($message as $message)
   {
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};
?>

<div class="container">

    <section class="products">

        <h1 class="heading">latest products</h1>

        <div class="box-container">

            <?php
            
            $select_products = mysqli_query($conn, "SELECT book_id, book_name, book_price, image_name, author FROM `tbl_book` ORDER BY book_id DESC;");
            if(mysqli_num_rows($select_products) > 0){
                while($fetch_product = mysqli_fetch_assoc($select_products)){
            ?>

            <form action="" method="post">
                <div class="box">
                    <a href="index.php?p=viewBook&id=<?= $fetch_product['book_id']?>">
                        <img src="../admin/images/<?php echo $fetch_product['image_name']?$fetch_product['image_name'] : 'no_img.jpg'; ?>" />
                        <h1><?php echo $fetch_product['book_name']; ?></h1>
                        <p><?php echo $fetch_product['author']; ?></p>
                        <div class="price">$ <?php echo $fetch_product['book_price']; ?>.00</div>
                        <input type="hidden" name="product_id" value="<?php echo $fetch_product['book_id']; ?>">
                        <input type="hidden" name="product_name" value="<?php echo $fetch_product['book_name']; ?>">
                        <input type="hidden" name="product_price" value="<?php echo $fetch_product['book_price']; ?>">
                        <input type="hidden" name="product_image" value="<?php echo $fetch_product['image_name']; ?>">
                        <input type="submit" class="btn" value="Add to Cart" name="add_to_cart">
                    </a>        
                </div>
            </form>

            <?php
                };
            };
            ?>

        </div>

    </section>

</div>