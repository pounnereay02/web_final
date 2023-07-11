<div class="container">
    <section class="shopping-cart">
    <table class="table table-hover">

    <h1 class="heading">Your order history</h1>

        <thead>
            <tr>
            <th scope="col">ID</th>
            <th scope="col">Username</th>
            <th scope="col">Phone</th>
            <th scope="col">OrderDate</th>
            <th scope="col">Email</th>
            <th scope="col">Address</th>
            <th scope="col">Product</th>
            <th scope="col">Total</th>
            </tr>
        </thead>
        <tbody>
                        
            <?php
                        
                $sql = "SELECT id, username, number, order_date, email, address, total_product, total_price FROM `order` WHERE user_id = $user_id ORDER BY id DESC";
                                
                            $result = $conn->query($sql); 
                        #$num_row = $result->num_rows;# count recored in table
                        if($result->num_rows > 0){
                            while($row=$result->fetch_array()){
                            
                                ?> 
                                    <tr>
                                    <th scope='row'><?= $row[0]?></th>
                                    <td><?=$row[1]?></td>
                                    <td><?=$row[2]?></td>
                                    <td><?=$row[3]?></td>
                                    <td><?=$row[4]?></td>
                                    <td><?=$row[5]?></td>
                                    <td><?=$row[6]?></td>
                                    <td><?=$row[7]?></td>

                                    </tr>
                            <?php	
                                #$conn->close();
                            }
                            ?>  
                            
                        <?php	
                        }else
                        {
                            echo '<tr><td colspan="8" style="text-align:center;color:red;">No Order found!</td></tr>';
                        }
                        ?> 
                        
                        
                            
        </tbody>
    </table>
    </section>
</div>