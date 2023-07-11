<?php  
    $user_id = $_SESSION['user_id'];
?>

<?php

if(isset($_POST['update_update_btn'])){
   $update_value = $_POST['update_quantity'];
   $update_id = $_POST['update_quantity_id'];
   $update_quantity_query = mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_value' WHERE id = '$update_id'");
   if($update_quantity_query){
   };
};
?>

<div class="container"> 

    <section class="shopping-cart">

        <h1 class="heading">shopping cart</h1>

        <table>

            <thead>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total Price</th>
            <th>Action</th>
            </thead>

            <tbody>

            <?php 
         
                $select_cart = mysqli_query($conn, "SELECT id, name, price, image, quantity FROM `cart` JOIN `tbl_users` ON cart.user_id = tbl_users.user_id WHERE cart.user_id = $user_id");
                $grand_total = 0;

                if(mysqli_num_rows($select_cart) > 0)
                {
                    while($fetch_cart = mysqli_fetch_assoc($select_cart))
                    {?>
                        <tr>
                            <td><img src="../admin/images/<?php echo $fetch_cart['image']?$fetch_cart['image'] : 'no_img.jpg'; ?>" /></td>
                            <td><?php echo $fetch_cart['name']; ?></td>
                            <td>$<?php echo number_format($fetch_cart['price']); ?>/-</td>
                            <td>
                            <form action="" method="post">
                                <input type="hidden" name="update_quantity_id"  value="<?php echo $fetch_cart['id']; ?>" >
                                <div class="qtyForm">
                                    <div class="left">
                                        <input type="number" name="update_quantity" min="1"  value="<?php echo $fetch_cart['quantity']; ?>" >
                                    </div>
                                    <div class="right">
                                        <input type="submit" value="update" name="update_update_btn">
                                    </div>
                                </div>
                            </form>   
                            </td>
                            <td>$<?php echo $sub_total = number_format($fetch_cart['price'] * $fetch_cart['quantity']); ?>/-</td>
                            <td><a href="pages/deleteCart.php?id=<?= $fetch_cart['id']?>" onclick="return confirm('Are you sure to delete it?')" class='delete-btn' type='button' >Remove</a></td>
                        </tr>
                        <?php
                        $grand_total += $sub_total;  
                    };
                };

                ?>

                        <tr class="table-bottom">
                            <td><a href="index.php?p=home" class="option-btn">Continue Shopping</a></td>
                            <td colspan="3">Grand Total :</td>
                            <td id="totalP" colspan="2">$ <?php echo $grand_total; ?></td>
                        </tr>
            
            </tbody>

        </table>

        <div class="checkout-btn">
            <a href="index.php?p=checkout" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">Procced to Checkout</a>
        </div>

    </section>


</div>