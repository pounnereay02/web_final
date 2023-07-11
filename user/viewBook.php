<?php 
    $id=$_GET['id'];
    $sql=" SELECT * FROM `tbl_book` JOIN `tbl_genre` ON gid = genre_id WHERE book_id = $id";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);

    $book_id = $row['book_id'];
    $name = $row['book_name'];
    $price = $row['book_price'];
    $qty = $row['book_qty'];
    $image = $row['image_name'];
    $genre = $row['genre_name'];
    $author = $row['author'];
    $description =$row['description'];

    if(isset($_POST['add_to_cart']))
    {
        if(isset($_POST['add_to_cart']))
        {
            $product_id = $book_id;
            $product_name = $name;
            $product_price =$price;
            $product_image = $image;
            $product_quantity = 1;
        
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
    <div class="bookContainer">
        <div class="cover">
            <div class="image">
                <img src="../admin/images/<?php echo$image?$image : 'no_img.jpg'; ?>" /> 
            </div>
        </div>
        <div class="detial">
            <p id="bName"> <?php echo $name ?> </p>
            <p>By <span id="bAuthor"><?php echo $author ?></span></p>
            <hr>
            <div class="addToC">
                <div class="col1">
                    <p id="bPrice"> $ <?php echo $price ?>.00 </p>
                    <p>In stock : <span id="bQty"><?php echo $qty ?></span></p>
                </div>
                <div class="col2">
                    <form action="" method="post">
                        <div class="box">
                            <input type="submit" class="btn" value="Add to Cart" name="add_to_cart">
                        </div>
                    </form>
                </div>
            </div>
            <hr>
            <p>Dscription :</p> <br>
            <p id="bDes"><?php echo $description ?> </p>
        </div>
    </div>
</div>