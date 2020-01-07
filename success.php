<?php 
//package of PhpMailer installed
require_once ('database/config.php');
require_once ('database/payment_config.php');
//decode url
if(base64_decode(urldecode($_GET['id']))) { 
    $pid = base64_decode(urldecode($_GET['id']));
    $select = "select * from payments where payment_id='$pid' ";
    $result = $conn->prepare($select);
    $result->execute();
    $rows =$result->fetch(PDO::FETCH_ASSOC);
    //echo $rows['payment_status'];
    if($rows['payment_status']=='0'){
        $update= "update payments set payment_status='1' where payment_id='$pid' ";
        $result=$conn->prepare($update);
        $result->execute();
        // Email Link Prepared
        // Unique No Generted
        // Databaese entry save // pid,paytid,token  no 32 char, date , status 0 
        $paymentID = $rows['payment_id'];
        $itemID = $rows['item_number'];
        $tokenID= md5($pid);

        $insert ="insert into downloads(payment_id,token_id,pid) values (:payment_id ,:token_id,:pid)";
        $result= $conn->prepare($insert);
        $result->bindparam(':payment_id', $paymentID, PDO::PARAM_STR);
        $result->bindparam(':token_id', $tokenID, PDO::PARAM_STR);
        $result->bindparam(':pid', $itemID, PDO::PARAM_INT);
        $result->execute();   

        // User Mail Send 
            
            include('src/PHPMailer.php');
            $host = 'https://altsols.com/application_office/productDownload.php?token_id='.$tokenID.'';
            // $host = 'http://localhost/';
            $mail = new PHPMailer();
            //$to = "ajay.singh@altsols.com";
            $to  =  $rows['email'];
            $name  =  $rows['name']; 
            $mail->setFrom('info@altsols.com');
            $mail->addAddress( $to,$name);
            $mail->Subject = "Dwonload Files";
            $mail->isHTML(true);
           
            $mail->Body   = 'Please download files by clicking on this link<br>
                            <a href="'.$host.'">Download File</a>';
                if(!$mail->send()) {
                    $fmsg= 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
                } else {
                    $smsg = 'User Registration successfull. Please Check your email to Activate Account!';
                }
                
        // To send HTML mail, the Content-type header must be set
        // $headers  = 'MIME-Version: 1.0' . "\r\n";
        // $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        // // Additional headers
        // $headers .= 'To: Mary <info@altsols.com>' . "\r\n";
        // $headers .= 'From: Birthday Reminder <info@altsols.com>' . "\r\n";
      //  $headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
       // $headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";

        // Mail it
        //mail($to, $subject, $message, $headers);

    }
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <title>Application Office</title>
    <?php include('head.php')?>
</head>

<body>
    <?php include('header.php')?>
    <div class="clearfix"></div>
    <img src="image/paypal-bg.jpg" class="img-fluid mar-banner" alt="">
    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mx-auto">

                    <div class="text-center mb-4">
                        <span class="paymeny-Scuess p-icon"><img src="image/success.svg" alt="" style="width: 80px;"> </span>
                        <span class="paymeny-Faild p-icon d-none"><img src="image/failed.svg" alt="" style="width: 80px;"></span>
                    </div>
                    <div class="text-center">
                        <h2>
                            <span id="success" class="">Your payment has been successfully .</span>
                            <span id="fail" class="d-none">Sorry, your payment failed. Please try again later .</span>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--==========================  Footer ============================-->
    <div class="mt-5">
        <?php include('footer.php')?>
    </div>
</body>

</html>


<!-- <div class="container">
    <div class="status">
        <?php if(!empty($payment_id)){ ?>
            <h1 class="success">Your Payment has been Successful</h1>
			
            <h4>Payment Information</h4>
            <p><b>Reference Number:</b> <?php echo $payment_id; ?></p>
            <p><b>Transaction ID:</b> <?php echo $txn_id; ?></p>
            <p><b>Paid Amount:</b> <?php echo $payment_gross; ?></p>
            <p><b>Payment Status:</b> <?php echo $payment_status; ?></p>
			
            <h4>Product Information</h4>
            <p><b>Name:</b> <?php echo $productRow['name']; ?></p>
            <p><b>Price:</b> <?php echo $productRow['price']; ?></p>
        <?php }else{ ?>
            <h1 class="error">Your Payment has Failed</h1>
        <?php } ?>
    </div>
    <a href="payment_paypal.php" class="btn-link">Back to Products</a>
</div> -->



</body>
</html>