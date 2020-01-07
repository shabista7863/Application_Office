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