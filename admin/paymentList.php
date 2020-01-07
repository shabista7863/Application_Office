<?php
require_once('../database/config.php');

if(empty($_SESSION['id'])){
    header("Location: login.php");
 }

$term='';

if(isset($_GET['term']))
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

$select ="select * from payments ".$term." LIMIT $record_index, $limit ";
$result = $conn->prepare($select);
$result->execute();
$row_count= $result->rowCount();
$res = $result->fetchAll();
// print_r($res);
// die;

?>





<!DOCTYPE HTML>
<html>
<head>
<title>Payment List</title>
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
					<h2 class="title1">Payment</h2>
					<div class="searchData">
					<form method="GET">
								 <input type="text" class="datafilter form-control" placeholder="Search by user name" aria-label="Username" aria-describedby="basic-addon1" name="term" required >
								
                      <span class="search"><button type="submit" value="submit" class ="search-span">
                          <i class="fa fa-search"></i></button></span>
								
						</form>
					</div>
				</div>
					
					
					<div class="table-responsive bs-example widget-shadow">
						<h4>Payment List:</h4>
						<table class="table table-bordered"> 
							<thead> 
								<tr> 
									
									<th>S.no.</th>
									<th>User Name</th> 
									<th>Email Id</th> 
									<th>Phone No</th> 
									<th>Payment Gross($)</th> 
									<th>Payment Status</th> 
									<th>Payment Date</th> 
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
									<td><?php echo $row['email']; ?></td> 
									<td><?php echo $row['phoneno']; ?></td> 
									<td><?php echo $row['payment_gross']; ?></td> 
									<td><?php echo ($row['payment_status']==1?'Paid':'UnPaid'); ?></td> 
									<td><?php echo $row['created_dt']; ?></td> 
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

      <a href="paymentList.php?page=<?php echo $page-1;?>" <?php if($page==1) { echo 'style="display:none !important"';} ?> name="page" id="page">prev</a>
    </li>
<?php	

	$sql = "select * from payments ".$term." "; 
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
    	<a href="paymentList.php?page=<?php echo $j;?><?=$search?>" name="page" id="page"><?php echo $j; ?></a></li>
   


 <?php                 
} 
?>
<li class=" ">
        <a href="paymentList.php?page=<?php echo $page+1;?>"  <?php if($page==$total_pages) { echo 'style="display:none !important"';} ?> name="page" id="page">next</a>
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