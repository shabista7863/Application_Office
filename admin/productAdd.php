<?php

require_once ('../database/config.php');
$message="";
error_reporting(0);
 $nameErr = $referenceErr = $priceErr = $descriptionErr = $categoryErr= $fileErr = ""; 
 $name = $reference=$price=$description=$video="";
 $fileErr = "";

if(isset($_POST['submit']) && !empty($_POST['submit'])){
	// print_r($_POST);
	// die;
	$c_id = $_POST['c_id'];
	$name=$_POST['name'];
	$reference=$_POST['reference'];
	$price=$_POST['price'];
	$description=$_POST['description'];
	$video=$_POST['video'];


   // Product Image Upload
	$image_file = $_FILES['image']['name'];
	$temp1  = $_FILES["image"]["tmp_name"];
	$size  = $_FILES["image"]["size"];  //1MB size
	$path= "../uploaded/";
	$target = $path.basename($_FILES["image"]["name"]);

	// Download File Upload like, jpg,png,exe,pdf,excel etc
	$image_file = $_FILES['file']['name'];
	$temp  = $_FILES["file"]["tmp_name"];
	$size  = $_FILES["file"]["size"];  //1MB size
	$pathDownload= "../downloads/";
	$targetDownload = $pathDownload.basename($_FILES["file"]["name"]);

		if(empty($c_id))
			{
				$categoryErr = " Product Category Mandatory";
			}
		if(empty($name))
			{
				$nameErr = " Product Name Mandatory";
			}

		if(empty($reference))
		{
			$referenceErr = "Reference Mandatory";
		}
		
		if(empty($price))
		{
			$priceErr = "Price  Mandatory";
		}
		
		if(empty($description)) 
		{
			$descriptionErr = "Description Mandatory";
		}
        if(empty($file)) 
		{
			$fileErr = "File Like .exe  Should Be Mandatory";
		}

	if( !empty($name) && !empty($reference) && !empty($price) && !empty($description) ){	
		if(move_uploaded_file($temp, $targetDownload)) { //download file					
					$insert="INSERT INTO product_item (c_id,name,reference,price,description,video,image,file) VALUES (:c_id, :name, :reference, :price, :description, :video, :image, :file)";
					
					$result=$conn->prepare($insert);
					$result->bindparam(':c_id', $c_id, PDO::PARAM_INT);
					$result->bindparam(':name', $name, PDO::PARAM_STR);
					$result->bindparam(':reference',$reference,PDO::PARAM_STR);
					$result->bindparam(':price',$price,PDO::PARAM_STR);
					$result->bindparam(':description',$description,PDO::PARAM_STR);
					$result->bindparam(':video',$video,PDO::PARAM_STR);
					$result->bindparam(':file',basename($_FILES["file"]["name"]),PDO::PARAM_STR);
					if($temp1) {  // Product image
						move_uploaded_file($temp1, $target);
						$result->bindparam(':image',basename($_FILES["image"]["name"]),PDO::PARAM_STR);
					} else {
					$imageName = "";
					$result->bindparam(':image',$imageName,PDO::PARAM_STR);
					}
				
					  $result->execute();
					
						if($result){
							$message=  '<div class="alert alert-success ">
				               Successfully Inserted Data!
				               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							    <span aria-hidden="true">&times;</span>
							  </button>
				                 </div>';
				                  $name = $reference=$price=$description=$video="";
				                  $fileErr = '';
				                
				                 
						}else{
							 $message=  '<div class="alert alert-danger bg-danger text-white">
				                 Oops! Something went wrong. Please try again later.
				                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							    <span aria-hidden="true">&times;</span>
							  </button>
				                 </div>';
							 } // else
		}//if image	
	}
}

$select =$conn->prepare("select * from product_category where status='1' ");
$select->execute();

?>
<!DOCTYPE HTML>
<html>
<head>
<title></title>
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
						<h3 class="title1">Add Product  :</h3>
					
						<div class="form-three widget-shadow">
						<form action=""  method="POST" enctype="multipart/form-data" class="form-horizontal"  id="myForm">
								<div class="row">
								<div class="col-md-8 col-md-offset-2"><?php echo $message ?></div>
							</div>
                            	  
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Product Category <span class="text-danger">*</span>
									</label>
										
									<div class="col-sm-8">
										 <select  name="c_id" class=" form-control <?php if($categoryErr): echo "err"; endif; ?>" id="exampleFormControlSelect2" >
										 	 <option value="" class=" " >--select option--</option>
							    	<?php 
							    while($row = $select->fetch(PDO::FETCH_ASSOC)){

							    ?>
							      <option value="<?php echo $row['id'];?>" class="<?php if($categoryErr): echo "err"; endif; ?> form-control"><?php echo $row['category']; ?></option>
							     <?php } ?>

							    </select>
							    <span class="text-danger" style=" color: #ff0000;"><?php if($categoryErr): echo $categoryErr; endif; ?>	</span>
									</div>
                             </div>

								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Product Name <span class="text-danger">*</span></label>
									
									<div class="col-sm-8">
										<input type="text" class="<?php if($nameErr): echo "err"; endif; ?> form-control1" name="name" id="focusedinput" placeholder="name" value="<?=$name?>" autocomplete="off">
										 <span class="text-danger" style=" color: #ff0000;"><?php if($nameErr): echo $nameErr; endif; ?> </span>
									</div>
								
								</div>
								<div class="form-group">
									<label for="disabledinput" class="col-sm-2 control-label"> Reference<span class="text-danger">*</span></label>
									
									<div class="col-sm-8">
										<input type="text"  name="reference" class="<?php if($referenceErr): echo "err"; endif; ?> form-control1" placeholder="Reference" value="<?=$reference?>" autocomplete="off">
										 <span class="text-danger" style=" color: #ff0000;"><?php if($referenceErr): echo $referenceErr; endif; ?> </span>
									</div>
								</div>
								<div class="form-group">
									<label for="inputPassword"  class="col-sm-2 control-label">Price<span class="text-danger">*</span>
									</label>
									
									<div class="col-sm-8">
										<input type="text" name="price" class="<?php if($priceErr): echo "err"; endif; ?> form-control1" id="inputPassword" placeholder="Price" value="<?=$price?>" autocomplete="off">
										 <span class="text-danger" style=" color: #ff0000;"><?php if($priceErr): echo $priceErr; endif; ?> </span>
									</div>
								</div>

								<div class="form-group">
									<label for="inputPassword" class="col-sm-2 control-label">Video url</label>
									
									<div class="col-sm-8">
										<input type="text" name="video" class="<?php //if($videoErr): echo "err"; endif; ?> form-control1" id="inputPassword" placeholder="Video url" value="<?=$video?>" autocomplete="off">
										 <span class="text-danger" style=" color: #ff0000;"><?php if($videoErr): echo $videoErr; endif; ?> </span>
									</div>
								</div>

								<div class="form-group">
									<label for="inputPassword"  class="col-sm-2 control-label">Description<span class="text-danger">*</span></label>
									
									<div class="col-sm-8">
										<textarea name="description" class="<?php if($descriptionErr): echo "err"; endif; ?> form-control1" placeholder="Description" ><?=$description?></textarea>
										 <span class="text-danger" style=" color: #ff0000;"><?php if($descriptionErr): echo $descriptionErr; endif; ?> </span>

										
									</div>
								</div>

								<div class="form-group">
									<label for="inputPassword" class="col-sm-2 control-label">Upload File<span class="text-danger" autocomplete="off">*</span></label>
									
									<div class="col-sm-8">
										<input type="file" name="file" class="" id="inputPassword">
										<span class="file-span text-danger" style=" color: #ff0000;"><?php if(isset($fileErr)): echo $fileErr; endif; ?></span>
									</div> 
								</div>

								<div class="form-group">
									<label for="inputPassword" class="col-sm-2 control-label">Product Image
									</label>
									
									<div class="col-sm-8">
										<input type="file" name="image" class="" id="inputPassword">
									</div>
								</div>

								<div class="form-group">
									<div class="col-sm-10 ">
									<p class="pull-right">
									    <input type="submit"  name="submit" 
										value="Submit" class="btn btn-primary load_button"  id=""> </p>
									<div class="lader" style="display:none;"><img src="images/loading.gif" id="gif" style="width:100px"></div>
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
		<!--<div class="lader"><img src="images/loading.gif" style="width:100px"></div>-->
<?php include('footer.php')?>

<script type='text/javascript'>
$('#myForm').submit(function() { 
    $('.lader').show();
})
</script>
</body>
</html>