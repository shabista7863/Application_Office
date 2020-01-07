<link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<?php

require_once ('database/config.php');
$token_id = $_GET['token_id'];
$select = "select downloads.token_id,product_item.file,downloads.status from downloads left join product_item on downloads.pid = product_item.id
			 where  token_id = '$token_id'  ";
$result = $conn->prepare($select);
$result->execute();
$status=$result->fetch(PDO::FETCH_ASSOC);
	if($status['status']=='0'){	
	    $updated = "update downloads set status='1' where token_id = '$token_id' ";   //download file
		$results = $conn->prepare($updated);
		$results->execute();
		
		    $filePath = 'downloads/'.urldecode($status['file']); 
		    // Process download
                    echo $file = $filePath;
                    if (file_exists($file)) {
                        header('Content-Description: File Transfer');
                        header('Content-Type: application/octet-stream');
                        header('Content-Disposition: attachment; filename='.basename($file));
                        header('Content-Transfer-Encoding: binary');
                        header('Expires: 0');
                        header('Cache-Control: must-revalidate');
                        header('Pragma: public');
                        header('Content-Length: ' . filesize($file));
                        ob_clean();
                        flush();
                        readfile($file);
                        exit;
                    }
               
    
    }
	else{
    	echo ' <section id="contact" class="mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mx-auto">

                    <div class="text-center mb-4">
                        <span class="paymeny-Scuess p-icon"><img src="image/success.svg" alt="" style="width: 80px;"> </span>
                    </div>
                    <div class="text-center">
                        <h2>
                            <span id="success" class="">File Already downloaded .</span>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </section>';
    	
    	
}

?>
 