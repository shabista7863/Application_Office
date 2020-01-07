<?php
require_once ('../database/config.php');
//
 $message="";
 //error_reporting(0);
if(isset($_POST['submit'])){
// print_r($_POST);
// die;
	$id = $_POST['id'];
	$category = $_POST['category'];
	$updRes = $conn->prepare("UPDATE product_category SET category=:category WHERE id='$id' ");
	$updRes->bindparam(':category',$category);
	$updRes->execute();

	if($updRes){
			$message=   '<div class="alert alert-success ">
				               Successfully Updated Category Data!
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
$selRes=$conn->prepare("SELECT * FROM product_category WHERE id ='".$_GET['id']."' ");
$selRes->execute();
$result = $selRes->fetch(PDO::FETCH_ASSOC);
// print_r($result);
// die;
?>

<!DOCTYPE HTML>
<html>
<head>
<title></title>
<?php include('head.php')?>
</head> 
<body class="cbp-spmenu-push">
		<?php include('left-sidebar.php')?>
		<!--left-fixed -navigation-->
		
		<!-- header-starts -->
			<?php include('menu.php')?>

			 <div id="page-wrapper">

            <div class="main-page" style="position: relative;">

        	<div class="forms">
				<div class="arror-icon-dev"><a href="categoryList.php" ><i class="fa fa-arrow-circle-left"></i></a>
				</div>

		<form action="" method="POST">
			<h3 class="title1">Update Category  :</h3>
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
				<input type="hidden" name="id" value="<?php echo $_GET['id'];?>" class=" form-control1" >
				<div class="col-sm-8">
				<input type="text" name="category" class=" form-control1" id="inputPassword" placeholder="Category" value="<?php echo $result['category'];?>">
				</div>
				</div>

				<div class="form-group">
				<div class="col-sm-10 ">
				<p class="pull-right"> <br>
				<input type="submit"  name="submit" value="Submit" class="btn btn-primary" > </p>
				</div></div>

			<div class="clearfix"></div>
			</div>
		</form>
</div></div>
</div>

<?php include('footer.php')?>
</body>
</html>