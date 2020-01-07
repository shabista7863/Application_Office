<?php
require_once('../database/config.php');
if(empty($_SESSION['id'])){
    header("Location: login.php");
 }

$term='';

if(isset($_GET['term'])) //search operation
{
	$term = "WHERE name LIKE '%".$_GET['term']."%'  ";
}

$limit = 10; 
    if (isset($_GET["page"] )) 
        {
        $page  = $_GET["page"]; 
        } 
    else 
       {
        $page=1; 
       };  
$record_index= ($page-1) * $limit; 

$select = $conn->prepare("SELECT pi.id,pi.status,pi.name, pi.reference, pi.price,pc.category FROM product_category as pc INNER JOIN product_item as pi on pc.id=pi.c_id 
       ".$term." order by pi.id DESC LIMIT $record_index,$limit");
$select->execute();
$row_count= $select->rowCount();
$res = $select->fetch(PDO::FETCH_BOTH);


?>





<!DOCTYPE HTML>
<html>
<head>
<title>Product List</title>
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
				<div class="tables">
				<div class="" style="position: relative;">
					<h2 class="title1">Products</h2>

				
					<div class="searchData">
						<form method="GET">
								 <input type="text" class="datafilter form-control" placeholder="Search by product name" aria-label="Username" aria-describedby="basic-addon1" name="term" required >
								
                      <span class="search"><button type="submit" value="submit" class ="search-span">
                      	<i class="fa fa-search"></i></button></span>
								
						</form>
					</div>
				</div>
					<div class="table-responsive bs-example widget-shadow">
						<h4>List Products :</h4>
						<table class="table table-bordered"> 
							<thead> 
								<tr> 
									
									<th>S.no.</th>
									<th>Products Name</th> 
									<th>Reference</th> 
									<th>Price($)</th> 
									<th>Category</th> 
									<!--<th>Video</th> -->
									<!--<th>Product Image</th>-->
									<th>Status</th>
									<th>Action</th>  
								</tr> 
							</thead> 

					

								<?php
								$i=1;
							if($row_count>0){
									foreach($res as $row){
								?>

								<tr> 
									
									<td><?php echo $i++; ?></td> 
									<td><?php echo $row['name']; ?></td> 
									<td><?php echo $row['reference']; ?></td> 
									<td><?php echo $row['price']; ?></td> 
									<td><?php  echo $row['category']; ?></td>
									<!--<td><?php  echo $row['video']; ?></td> -->

									<!--<td><img src="../uploaded/<?php echo $row['image'];?>" -->
 								<!--		alt=" " height="50" width="50"></td>-->
									<td class="t-btn">
										<input type="checkbox" class="status" 
													<?php if($row['status']==1) { ?> 
														checked 
													<?php } ?> 											
											value="<?=$row['id']?>" data-toggle="toggle">

									</td>
									<td class="text-nowrap"><a href="productUpdate.php?id=<?=$row['id'] ?>" class="btn btn-sm btn-success">Edit</a>
									<!-- <a href="#"  onclick="ConfirmDelete()" class="btn btn-sm btn-danger">Delete</a></td>  -->
								</tr> 
							<?php }   } else { ?>
								<tr> 	
									<td colspan="7"> 				
									 
									<div class='no-data-found text-center' ><i class='fa fa-frown-o'></i> <br> <span>No record </span>found 
									</div>
									 	</td>
								</tr> 
								<?php }	?>	
							 </table> 



 <ul class="pagination pull-right">
   
<li class=" ">

      <a href="productList.php?page=<?php echo $page-1;?>" <?php if($page==1) { echo 'style="display:none !important"';} ?> name="page" id="page">prev</a>
    </li>
<?php	

	$sql = "SELECT pi.id,pi.status,pi.name, pi.reference, pi.price,pc.category FROM product_category as pc INNER JOIN product_item as pi on pc.id=pi.c_id 
        ".$term." "; 
	$retval1 = $conn->prepare($sql); 
	$retval1->execute(); 
	$total_records=$retval1->rowCount();
	$total_pages = ceil($total_records / $limit);   
		for ($j=1; $j<=$total_pages; $j++) {  
            if(isset($_REQUEST['term'])) {
        		$search = '&term='.$_REQUEST['term'].'';
        	}
 ?>
 	
    <li <?php if($page==$j) {echo 'class="active"' ;}?>>
    	<a href="productList.php?page=<?php echo $j;?><?=$search?>" name="page" id="page"><?php echo $j; ?></a></li>
   


 <?php                 
} 
?>
<li class=" ">
        <a href="productList.php?page=<?php echo $page+1;?>"  <?php if($page==$total_pages) { echo 'style="display:none !important"';} ?> name="page" id="page">next</a>
    </li>

</ul>
					</div>
				</div>
			</div>
		</div>
		
	<?php include('footer.php')?>
	
	<link href="css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="js/bootstrap-toggle.min.js"></script>

<script>
	$(document).ready(function(){
		
		$('.status').change(function() {
			 var id = $(this).val();
		   if($(this).is(":checked")) {	
				   $.ajax({
					        url: "set_satus.php?id=" + id,
					        type: 'GET',	
					        success: function(data) {    
					        	console.log('Active')
					             // $( ".result" ).html( data );	
					        }
					    });    
		   
		      return;
		   } else {
		   $.ajax({
			        url: "set_satus.php?id=" + id,
			        type: 'GET',			       
			        dataType: 'GET',
			        success: function(data) {  
			        console.log('Deactive')  
			              //$( ".result" ).html( data );	
			        }
			 
			});
		    return;
		}
	})
		})

</script>
</body>
</html>