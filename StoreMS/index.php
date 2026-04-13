<?php
   session_start();
   $user_first_name = $_SESSION['user_first_name'];
   $user_last_name =  $_SESSION['user_last_name'];
   
   if (!empty($user_first_name) && !empty($user_last_name)){
	   
  ?>
<!DOCTYPE html>
<html>
<head>
       <title> Store Management System </title>
	   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
    i {
        color: darkblue !important;
        font-size: 4.5rem !important;
    }

    i:hover {
        color: #6f42c1 !important;
    }

    /* Bootstrap override fix */
    i.text-success {
        color: darkblue !important;
    }
</style>
</head>
<body>

     <div class="container bg-light">
	 <div class="container-foulid border-bottom border-success">
	 <?php include('topbar.php');?>
	 </div>
	 
	 <div class="container-foulid">
	 <div class="row">
	 <div class="col-sm-3 bg-lihght p-0 m-0">
	 <?php include('leftbar.php');?>
	 </div>
	 
	    <div class="col-sm-9 border-start border-success">
	    <div class="row p-4">
	         <div class="col-sm-3">
	          <a href="add_category.php"> <i class="fa-solid fa-folder-plus fa-5x text-success "></i></a> 
			   <p> Add Category </p>
	         </div>
			 
			 <div class="col-sm-3">
	           <a href="list_of_category.php"> <i class="fa-solid fa-list fa-5x text-success "></i> </a> 
			   <p> List of Category </p>
	         </div>
			 
			 <div class="col-sm-3">
	           <a href="add_product.php"> <i class="fa-regular fa-square-plus fa-5x text-success "></i></a>
			   <p> ADD product </p>
	         </div>
			 
			 <div class="col-sm-3">
	           <a href="list_of_product.php"> <i class="fa-solid fa-table-list fa-5x text-success "></i></a>
			   <p> List Of product </p>
	         </div> 
	 </div>
	 </hr>
	 
	  <div class="row p-4">
	         <div class="col-sm-3">
	          <a href="add_store_product.php"> <i class="fa-solid fa-house-chimney-medical fa-5x text-success "></i></a> 
			   <p> ADD Store Product </p>
	         </div>
			 
			 <div class="col-sm-3">
	           <a href="list_of_entry_product.php"> <i class="fa-solid fa-bag-shopping fa-5x text-success "></i> </a> 
			   <p> Store Product List </p>
	         </div>
			 
			 <div class="col-sm-3">
	           <a href="add_spend_product.php"> <i class="fa-solid fa-wallet fa-5x text-success "></i></a>
			   <p> Spend Product </p>
	         </div>
			 
			 <div class="col-sm-3">
	           <a href="list_of_spend_product.php"> <i class="fa-solid fa-list-check fa-5x text-success"></i></a>
			   <p> Spend Product List </p>
	         </div> 
	 </div>
	 </hr>
	 
	  <div class="row p-4">
	         <div class="col-sm-3">
	          <a href="report.php"> <i class="fa-solid fa-chart-column fa-5x text-success "></i></a> 
			   <p> report </p>
	         
	 </div>
	  
	   </hr>
	 
	  <div class="row p-4">
	         <div class="col-sm-3">
	          <a href="add_user.php"> 
			  <i class="fa-solid fa-user-plus fa-5x text-success"></i></a> 
			   <p> ADD User </p>
	         </div>
			 
			 <div class="col-sm-3">
	          <a href="list_of_users.php">
              <i class="fa-solid fa-people-group fa-5x text-success"></i></a> 
			  <p> User List </p>
	         </div>
			 
			 <div class="col-sm-3">
	         </div>
			 
			 <div class="col-sm-3">
	         </div> 
	 </div>
	 <div class="container-foulid border-top border-success">
	 <?php include('bottombar.php');?>
	 </div>
</body> 
</html>                                         
<?php
   }else{
	   header('location: login.php');
   }
 ?>