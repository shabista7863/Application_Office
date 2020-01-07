<?php
require_once ('../database/config.php');
error_reporting(0);
$message="";
$categoryErr="";

if(isset($_POST['submit'])){
$category = $_POST['category'];
	if(empty($category))
	{
	$categoryErr = "category mandatory";
	}
		if(!empty($category)){
    		$selRow = $conn->prepare("select * from product_category where category=:category");
			$selRow->bindparam(':category',$category,PDO::PARAM_STR);

			$selRow->execute();
			$fetchRow=$selRow->rowCount();
			
			if($fetchRow>0) {

				$message=  '<div class="alert alert-warning ">
			               Category Name Exists!
			                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							    <span aria-hidden="true">&times;</span>
							  </button>
			                 </div>';
			}else{
			$insert = $conn->prepare("insert into product_category (category) values(:category)");
			$insert->bindparam(':category',$category,PDO::PARAM_STR);
			$insert->execute();
			if($insert){
			$message=  '<div class="alert alert-success ">
			               Successfully Inserted Data!
			               	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							    <span aria-hidden="true">&times;</span>
							  </button>
			                 </div>';
			                 
			}else{
				 $message=  '<div class="alert alert-danger bg-danger text-white">
	                 Oops! Something went wrong. Please try again later.
	                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
                    </button>
	                 </div>';
				 } 
			}
		}
}
?>

<!DOCTYPE HTML>
<html>
<head>
<title></title>
<?php include('head.php')?>
</head> 
<body class="cbp-spmenu-push">
		<?php include('left-sidebar.php')?>
			<?php include('menu.php')?>

			 <div id="page-wrapper">
            <div class="main-page">
<form action="" method="POST">
	<h3 class="title1">Add Category  :</h3>
	<div class="r3_counter_box">
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<?php echo $message; ?>
			</div>
		</div>
		

<div class="form-group">
	<br>
	<label for="inputPassword"  class="col-sm-2 control-label">Category Name<span class="text-danger">*</span>
	</label>
	<?php if($categoryErr): echo $categoryErr; endif; ?>
	<div class="col-sm-8">
		<input type="text" name="category" class=" <?php if($categoryErr): echo "err"; endif; ?> form-control1" id="inputPassword" placeholder="Category" 
		value="">
	</div>
</div>

		  <div class="form-group">
		<div class="col-sm-10 ">
		<p class="pull-right"> <br>
			<input type="submit"  name="submit" 
		value="Submit" class="btn btn-primary" name=""> </p>
		</div></div>

		<div class="clearfix"></div>
</div>
</form>
</div></div>
<?php include('footer.php')?>
</body>
</html>