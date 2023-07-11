<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manga69</title>
    <link rel="stylesheet" href="../../css/style.css?v=<?php echo time(); ?>">

    <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    
<?php include "../conn_db/db_config.php";?>

<!-- Start Header -->
<?php include "header.php" ?>
<!-- End Header -->

<!-- Start Dashboard -->
<?php
	if(isset($_GET['p']))
    {
        include $_GET['p'].".php";      
    }
	else
    {
		#default page
        include "home.php";
	}
?>
<!-- End Dashboard -->


<script src="../../js/script.js"></script>
</body>
</html>