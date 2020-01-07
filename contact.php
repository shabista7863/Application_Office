<?php
require_once 'database/config.php';
if(isset($_POST['submit'])){
include 'src/PHPMailer.php';
            
            $mail = new PHPMailer();
            $to = "shabista.sarwer@altsols.com";
            $email  =  $_POST['email'];
            $name  =  $_POST['name'];
            $message  =  $_POST['message']; 
            $mail->setFrom('info@altsols.com');
            $mail->addAddress( $to,$name);
            $mail->Subject = "Contact Us Enquiry";
            $mail->isHTML(true);
            $mail->Body ="Name : $name<br>
                            Email : $email<br>
                            Message : $message<br>";
               
                if(!$mail->send()) {
                    $fmsg= 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
                } else {
                    $smsg = true;
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
    <img src="image/c-banner.jpg" class="img-fluid mar-banner" alt="">
    <section id="contact">
        <div class="container">
            <div class="row d-flex align-items-stretch">
               <div class="col-md-6 col-lg-4 c-box  wow fadeInLeft">
                   <div class="card mn">
                      <div class="card-body">
                          <div class="text-center"><img src="image/avatarH.png" class="img-fluid avatar-img" alt=""></div>
                           <h5 class="text-center">Consultas, soporte y ventas</h5>
                           <p class="mb-2 text-center">Respuestas inmediatas</p>
                           <p class="mb-2 text-center">E-mail: scliente@aplicacionesoffice.com</p>
                         
                      </div>
                    </div></div>
               <div class="col-md-6 col-lg-4 c-box  wow fadeInDown"><div class="card mn">
                     <div class="card-body">
                          <div class="text-center"><img src="image/wapp.gif" class="img-fluid avatar-img" alt=""></div>
                           <h5 class="text-center">Ventas: : +51972582917</h5>
                           <p class="mb-2 text-center">Lunes a viernes 9:00am a 5:00pm (hora Bogotá - Lima - Quito)</p>
                         
                      </div>
                    </div></div>
               <div class="col-md-6 col-lg-4 c-box  wow fadeInRight"><div class="card mn">
                     <div class="card-body">
                          <div class="text-center"><img src="image/logoskype.gif" class="img-fluid avatar-img" alt=""></div>
                           <p class="text-center mb-0">Buscar por:</p>
                          <h5 class="text-center mb-2">Aplicacionesoffice</h5>
                           <p class="mb-2 text-center">Proyectos personalizados, demostracción y ayuda.</p>
                         
                         
                      </div>
                    </div></div>
                   
                </div>

         <div class="row mt-5">
           
                <div class="col-md-8 mx-auto">
                    <div class="form">
                        <?php if($smsg) { ?>
                        <div class="text-center mb-4">
                          <span class="paymeny-Scuess p-icon"><img src="image/success.svg" alt="" style="width: 80px;"> </span>
                        
                      </div>
                        <div class="text-center">
                          <h2>
                              
                             <span id="success" class="">Your details has been successfully .</span>
                             
                          </h2><?php } ?>
                      </div> 
                        <form action="" method="post" role="form" class="contactForm">
                           
                                <div class="form-group  wow fadeInDown">
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Nombre:" required>

                                </div>
                                <div class="form-group  wow fadeInDown">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="E-mail:" required>
                                </div>
                         

                            <div class="form-group  wow fadeInDown">
                                <textarea class="form-control" name="message" rows="5"   placeholder="Message" required></textarea>

                            </div>
                            <div class="text-center  wow fadeInDown">
                                <button type="submit" name="submit" title="Send Message">Send Message</button>
                            </div>
                        </form>
                        
                    
                      
                        <p class="text-center mt-3">Respondemos correos lo más rápido posible, si no encuentra respuesta; revisa carpeta Spam o correos no deseados.</p>
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
