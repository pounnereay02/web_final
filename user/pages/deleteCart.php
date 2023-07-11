
<?php
	include_once "../../conn_db/db_config.php";
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$sql = "DELETE FROM `cart` WHERE `cart`.`id` = $id";
		//$updateQuantity =  mysqli_query($conn, "UPDATE tbl_book SET book_qty = book_qty + 1 WHERE book_id = $id");
		$result = mysqli_query($conn,$sql);
		if(!$result){
			echo "Error in deleting a record";
		}else{
			header("location: ../index.php?p=cart");
		}
	}else{
		echo "Error in page";
	}
?>