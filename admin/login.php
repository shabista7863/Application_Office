<?php
require_once ('../database/config.php');
$message = "";  
if(isset($_POST['SignIn'])){	
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	if(empty($email) && empty($password)) {
		 $message = '<div class="alert alert-warning" style="margin-top:-45px">
	                <strong>Warning !</strong> Username cant be empty.
	                 </div>';
	}else {

		 $select = "select * from admin_login where email=:email AND password=:password ";
		$result= $conn->prepare($select);
		$result->bindparam(':email',$email,PDO::PARAM_STR);
		$result->bindparam(':password',$password,PDO::PARAM_STR);
		$result->execute(); 
		$rr =$result->fetch(PDO::FETCH_BOTH); 

			if($result->rowCount() >=1){
				$_SESSION['id']=$rr['id'];
				$_SESSION['admin_name']=$rr['admin_name']; 
				$_SESSION['image']=$rr['image'];
				header("location:dashboard.php");
			} else {
				  $message = '<div class="alert alert-danger" style="margin-top:-45px">
		                	  <strong>Oops!</strong>  Something went wrong. Please try again later.
		                      </div>';
				}
		}
}

?>




<!DOCTYPE HTML>
<html>
<head>
<title>Application Office</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />



<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/font-awesome.css" rel="stylesheet"> 
<link href="//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
<link href="css/custom.css" rel="stylesheet">

</head> 
<body class="">
	
<div class="main-content">
	
		<!--left-fixed -navigation-->		
		<!-- header-starts -->
		
		<!-- //header-ends -->
		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page login-page ">

				<h2 class="title1">Login</h2> 
                   
				<div class="widget-shadow">

					<div class="login-body">
						<!-- <p class="text-center"><img src="images/logo.png" alt=""></p> -->
						<?php echo $message ?>
						<form action="#" method="POST">
						
							<input type="email" class="user" name="email" autocomplete="off" placeholder="Enter Your Email">
							<input type="password" name="password" class="lock" autocomplete="off" placeholder="Password" >
							<div class="forgot-grid">
								<label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i></i>Remember me</label>
								
								<div class="clearfix"> </div>
							</div>
							<input type="submit" name="SignIn" value="Sign In">
							
						</form>
					</div>
				</div>
				
			</div>
		</div>
	<?php include('footer.php')?>	
	</div>
	
	
	
   
</body>
</html>