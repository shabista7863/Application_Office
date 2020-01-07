<?php

require_once('../database/config.php');

$id= $_GET['id'];


$select ="select status from product_item where id='$id' ";
$results=$conn->prepare($select);
$results->execute();
$status=$results->fetch(PDO::FETCH_ASSOC);

	if($status['status']==0){
			$update = "update product_item set status='1' where id='$id' ";
			$results = $conn->prepare($update);
			$results->execute();
			echo 'Active';
	    } else {
	      	$update = "update product_item set status='0' where id='$id' ";
			$results = $conn->prepare($update);		
			$results->execute();
			echo 'Deactive';
	    }

?>
<?php
$id= $_GET['id'];


$select ="select status from product_category where id='$id' ";
$results=$conn->prepare($select);
$results->execute();
$status=$results->fetch(PDO::FETCH_ASSOC);

	if($status['status']==0){
			$update = "update product_category set status='1' where id='$id' ";
			$results = $conn->prepare($update);
			$results->execute();
			echo 'Active';
	    } else {
	      	$update = "update product_category set status='0' where id='$id' ";
			$results = $conn->prepare($update);		
			$results->execute();
			echo 'Deactive';
	    }

?>
