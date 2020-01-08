<?php
require_once ('../database/config.php');
//error_reporting(0);
$message ="";
if(isset($_POST['submit'])){
 

	$id=trim($_POST['id']);
	$c_id=$_POST['c_id'];
	$name = $_POST['name'];
	$reference = $_POST['reference'];
	$price = $_POST['price'];
	$description = $_POST['description'];
	$video = $_POST['video'];

	$updated = "UPDATE product_item SET c_id=:c_id,name=:name,reference=:reference,price=:price, 
			   description=:description,video=:video WHERE id='$id'";


	$result = $conn->prepare($updated);
	$result->bindparam(':c_id', $c_id);
	$result->bindparam(':name', $name);
	$result->bindparam(':reference',$reference);
	$result->bindparam(':price',$price);
	$result->bindparam(':description',$description);
	$result->bindparam(':video',$video);
	$result->execute();
	print_r($result);
	die;

	if($_FILES["image"]["name"]){
			$temp  = $_FILES["image"]["tmp_name"];
			$size  = $_FILES["image"]["size"]; 
			$path= "../uploaded/";
			$target = $path . basename($_FILES["image"]["name"]);
			$imgName = basename($_FILES["image"]["name"]);
				if(move_uploaded_file($temp, $target)){  //Product image updated
					$updated = "UPDATE product_item SET image=:image WHERE id='$id'";
					$result = $conn->prepare($updated);
					$result->bindparam(':image',$imgName);
					$result->execute();	
					
			}
				}
				if($_FILES["file"]["name"]){   //files updated
					$temp  = $_FILES["file"]["tmp_name"];
					$size  = $_FILES["file"]["size"]; 
					$pathDownload= "../downloads/";
					$targetDownload = $pathDownload . basename($_FILES["file"]["name"]);
					$dwonloadImg = basename($_FILES["file"]["name"]);
				if(move_uploaded_file($temp, $targetDownload)){
					
					$updated = "UPDATE product_item SET file=:file WHERE id='$id'";
					$result->bindparam(':file',$dwonloadImg);
					$result->execute();	

				
				}
				
			}
			if($result){

				$message=   '<div class="alert alert-success ">
				               Successfully Updated Data!
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
$select ="SELECT * FROM product_item WHERE id ='".$_GET['id']."' ";
$results=$conn->prepare($select);
$results->execute();
$res = $results->fetch(PDO::FETCH_ASSOC);
// print_r($res);
// die;

// category name
$selCat =$conn->prepare("SELECT * FROM product_category order by category asc");
$selCat->execute();
$cat=$selCat->fetch(PDO::FETCH_ASSOC);
// print_r($cat);
// die;	

?>



<!DOCTYPE HTML>
<html>
<head>
<title>Product updated</title>
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
			<div class="main-page"  style="position: relative;">
				<div class="forms">
					<div class="arror-icon-dev"><a href="productList.php"><i class="fa fa-arrow-circle-left">
					</i></a>
					</div>
					<div class="row">
						<h3 class="title1">Update Product :</h3>
						<div class="form-three widget-shadow">
							<?php echo $message?>
							<form action="" method="POST" enctype="multipart/form-data" 
							class="form-horizontal">
						<input type="hidden" class="form-control1" name="id" 
						value="<?php echo $_GET['id']; ?>">
									
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Product Category 
									</label>										
									<div class="col-sm-8">
										 <select  name="c_id" class=" form-control " id="exampleFormControlSelect2" >
										 	 <option value="" >--select option--</option>
							    	<?php 
							  while($cat = $selCat->fetch(PDO::FETCH_ASSOC)){
							    ?>
							      <option value="<?php echo $cat['id'];?>"
							       <?=$cat['id']==$res['c_id']?'selected':''?> ><?php echo $cat['category'];?></option>
							     <?php } ?>
							    </select>							   
								</div>
                             </div>

								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Product Name</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="name" value="<?php echo $res['name'];?> " id="focusedinput" placeholder="name">
									</div>
								
								</div>
								<div class="form-group">
									<label for="disabledinput" class="col-sm-2 control-label">Reference
									</label>
									<div class="col-sm-8">
										<input type="text"  name="reference" value="<?php echo $res['reference'];?> " class="form-control1" placeholder="Reference" >
									</div>
								</div>
								<div class="form-group">
									<label for="inputPassword"  class="col-sm-2 control-label">Price</label>
									<div class="col-sm-8">
										<input type="text" name="price" value="<?php echo $res['price'];?> " class="form-control1" id="inputPassword" placeholder="Price" >
									</div>
								</div>

								<div class="form-group">
									<label for="inputPassword" class="col-sm-2 control-label">Video url</label>
									<div class="col-sm-8">
										<input type="text" name="video" value="<?php echo $res['video'];?>" class="form-control1" id="inputPassword" placeholder="Video url" >
									</div>
								</div>

								<div class="form-group">
									<label for="inputPassword"  class="col-sm-2 control-label">Description</label>
									<div class="col-sm-8">
										<textarea name="description"  class="form-control1" placeholder="Description" ><?php echo $res['description'];?></textarea>

										
									</div>
								</div>

								<div class="form-group">
									<label for="inputPassword" class="col-sm-2 control-label">file</label>
									<div class="col-sm-8">
										<input type="file" name="file" class="" id="inputPassword">
										<!-- <img src="../uploaded/<?php echo $res['file'];?>" 
 										alt=" " height="" width=""> -->
									</div>
								</div>

								<div class="form-group">
									<label for="inputPassword" class="col-sm-2 control-label">image</label>
									<div class="col-sm-8">
										<input type="file" name="image"  class="" id="inputPassword"><br>
										<?php if($res['image']) { ?>
										<img src="../uploaded/<?php echo $res['image'];?>" 
 										alt=" " height="50" width="50">
 										<?php } ?>
									</div>
									
								</div>

								<div class="form-group">
									<div class="col-sm-10 ">
									<p class="pull-right"><input type="submit"  name="submit" 
										value="Submit" class="btn btn-primary" name=""> </p>
								</div></div>
								
								
								</div>
							</form>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		<!--footer-->
		
        <!--//footer-->
	
	<?php include('footer.php')?>
   
</body>
</html>