<?php
$message="";
require_once ('../database/config.php');
//echo $_SESSION['id'];
error_reporting(0);
if(isset($_POST['updated'])){	
	$id = $_POST['id'];
	$admin_name = $_POST['admin_name'];
	$email = $_POST['email'];
	$password = $_POST['password'];

	$temp  = $_FILES["image"]["tmp_name"];
	$size  = $_FILES["image"]["size"];  
	$path= "../uploaded/";
	$target = $path . basename($_FILES["image"]["name"]);
	$imageDownload = basename($_FILES["image"]["name"]);

	$select="select * from admin_login where id ='".$_GET['id']."' AND password=:password";
	$result=$conn->prepare($select);
	$result->bindparam(':password',$password,PDO::PARAM_STR);
	$result->execute();

	$totC = $result->rowcount(); 
	if( $totC > 0){
	   $update = "update admin_login set admin_name=:admin_name, email=:email where id ='$id' "; 
			$result = $conn->prepare($update);
			$result->bindparam(':admin_name', $admin_name);
			$result->bindparam(':email', $email);
			//$result->bindparam(':image', basename($_FILES["image"]["name"]));		
		 	$result->execute(); 
		 	
		}else{
				$password = md5($password);
				 $update = "update admin_login set admin_name=:admin_name, email=:email, password=:password  
				 			 where id ='$id' "; 	
				$result = $conn->prepare($update);
				$result->bindparam(':admin_name', $admin_name);
				$result->bindparam(':email', $email);
				$result->bindparam(':password', $password);	
				//$result->bindparam(':image', basename($_FILES["image"]["name"]));			
			    $result->execute(); 
			}
		if($_FILES["image"]["name"]){
			 if(move_uploaded_file($temp, $target)){
				$updated = "update admin_login set  image=:image where id ='$id'"; 
				$result = $conn->prepare($updated);		
				$result->bindparam(':image',$imageDownload);
			 	$result->execute(); 
			 	
				if($result){
						
					$message = '<div class="alert alert-success bg-success text-white">
			                Successfully.
			                </div>';
					
				}else{
				$message = '<div class="alert alert-danger bg-danger text-white">
			                Oops! Something went wrong. Please try again later.
			                </div>';

				}
			}
			
		}
	}

	$select="select * from admin_login where id ='".$_GET['id']."'";
	$result=$conn->prepare($select);	
	$result->execute(); 
	$row = $result->fetch(PDO::FETCH_ASSOC);
	$_SESSION['image']=  $row['image'];
   //die;
?>


<!DOCTYPE HTML>
<html>
<head>
<title>Application Ofiice</title>
<?php include('head.php')?>
</head> 
<body class="cbp-spmenu-push">
	<div class="main-content">
	<!--left-fixed -navigation-->
		<?php include('left-sidebar.php')?>
		<!--left-fixed -navigation-->
		
		<!-- header-starts -->
			<?php include('menu.php')?>
		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page">
				<div class="forms">
					
					<div class="row">
						
						<div class="col-md-10 col-md-offset-1">
							<h3 class="title1">Profile:</h3>

						<div class="form-three widget-shadow">
							<?php echo $message ?>
							<form action="" method="POST" enctype="multipart/form-data" class="form-horizontal">

								
								<input type="hidden" class="form-control1" name="id"
								 value="<?php echo $_SESSION['id']; ?>">
									
								<div class="form-group">
									<label for="focusedinput" class="col-sm-3 control-label">Full Name</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="admin_name" value="<?php echo $row['admin_name']; ?> " id="focusedinput" placeholder="name">
									</div>
								
								</div>
								<div class="form-group">
									<label for="disabledinput" class="col-sm-3 control-label"> Email Address</label>
									<div class="col-sm-8">
										<input type="text"  name="email" value="<?php echo $row['email']; ?> " class="form-control1" placeholder="Reference" required>
									</div>
								</div>
								<div class="form-group">
									<label for="inputPassword"  class="col-sm-3 control-label">Password</label>
									<div class="col-sm-8">
										<input type="password" name="password" 
										value="<?php echo $row['password']; ?>" class="form-control1" id="inputPassword" placeholder="Price" required>
									</div>
								</div>

								<div class="form-group">
									<label for="inputPassword" class="col-sm-3 control-label">Image</label>
									<div class="col-sm-8">
										<input type="file" name="image"  class="" id="inputPassword">
										<br>	
										<img src="../uploaded/<?php echo $row['image'];?>" alt=" " height="50" width="50">
									</div>
									
								</div>

								<div class="form-group">
									<div class="col-sm-10 ">
									<p class="pull-right"><input type="submit"  name="updated" 
										value="Submit" class="btn btn-primary"> </p>
								</div></div>
								
								
								</div>
							</form>
						</div>
					</div>
					</div>
				</div>
			</div>
		</div>
		<!--footer-->
		
	<?php include('footer.php')?>
   
</body>
</html>