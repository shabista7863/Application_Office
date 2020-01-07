<?php 
 
require_once ('database/config.php');
require_once ('database/payment_config.php');
if(isset($_POST['submit'])){

$item_number =$_POST['pid'];
$payment_gross = $_POST['price'];
$name = $_POST['name'];
$email = $_POST['email'];
$phoneno = $_POST['phoneno'];
$code = 'USD';
  try {
    $insert = "insert into payments(item_number,payment_gross,name,email,phoneno,currency_code) values (:item_number, :payment_gross, :name, :email, :phoneno,:currency_code)";
    $result= $conn->prepare($insert);
    $result->bindparam(':item_number', $item_number, PDO::PARAM_INT);
    $result->bindparam(':payment_gross', $payment_gross, PDO::PARAM_STR);
    $result->bindparam(':name', $name, PDO::PARAM_STR);
    $result->bindparam(':email', $email, PDO::PARAM_STR);
    $result->bindparam(':phoneno', $phoneno, PDO::PARAM_STR);
    $result->bindparam(':currency_code', $code, PDO::PARAM_STR);
    $result->execute();
    //$result->commit();
    $lastId =  $conn->lastInsertId();

    } catch (PDOExecption $e ) {
         $conn->rollback();
            print "Error!: " . $e->getMessage() . "</br>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
    <style type="text/css">
        .poyment-box{position: absolute; text-align: center;
    left: 50%;
    top: 30%; margin: 0px auto;
    transform: translate(-50%, -50%);
    max-width: 560px; }
    </style>

</head>
<body >

<div class="container">
   
        <div class="pro-box position-relative">
            
            <div class="body poyment-box">
                <span><img src="image/loader.gif" style="height:150px;"></span>
				<h3 class="text-center">Your payment is being submitted. Please do not close or refresh this window or click the Back button on your browser.</h3>
                <form name="myForm" id="myForm" action="<?php echo PAYPAL_URL; ?>" method="post">
                    
                    <input type="hidden" name="business" value="<?php echo PAYPAL_ID; ?>">
					
                    <input type="hidden" name="cmd" value="_xclick">
					<input type="hidden" name="country" value="US">
                    
                    <input type="hidden" name="item_name" value="Titles Of tiels">
                    <input type="hidden" name="item_number" value="<?php echo $_POST['pid']; ?>">
                    <input type="hidden" name="amount" value="<?php echo $_POST['price']; ?>">
                    <input type="hidden" name="currency_code" value="<?php echo PAYPAL_CURRENCY; ?>">
					
                    <input type="hidden" name="return" value="<?php echo PAYPAL_RETURN_URL; ?>?id=<?php echo urlencode(base64_encode($lastId)); ?>">
                    <input type="hidden" name="cancel_return" value="<?php echo PAYPAL_CANCEL_URL; ?>">
					
                   
                   
                </form>
            </div>
        </div>
    <?php //} ?>
</div>
  <script src="lib/jquery/jquery.min.js"></script>
 <script src="lib/jquery/jquery-migrate.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
 <script src="lib/easing/easing.min.js"></script>
  <script src="lib/mobile-nav/mobile-nav.js"></script>
  <script src="lib/wow/wow.min.js"></script>
 <script src="lib/waypoints/waypoints.min.js"></script>
  <script src="lib/counterup/counterup.min.js"></script>
  <script src="lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="lib/isotope/isotope.pkgd.min.js"></script>
  <script src="lib/lightbox/js/lightbox.min.js"></script>
  <script src="js/main.js"></script>
  <script src="js/lity.min.js"></script>

<script type="text/javascript">
    window.onload=function(){
        var auto = setTimeout(function(){ autoRefresh(); }, 100);
        function submitform(){         
          document.forms["myForm"].submit();
        }

        function autoRefresh(){
           clearTimeout(auto);
           auto = setTimeout(function(){ submitform(); autoRefresh(); }, 5000);
        }
    }
</script>

</body>
</html>



