<?php
require_once ('database/config.php');
//error_reporting(0);

$whr = '';
$term ='';
$c_id = '';

if(!empty($_GET['c_id'])) {
    $whr = "AND  PI.c_id =".$_GET['c_id']." ";
    $c_id = $_GET['c_id'];
}
if(isset($_GET['term'])) {
    $term = " AND PI.name LIKE '%".$_GET['term']."%' OR PI.reference LIKE '%".$_GET['term']."%' ";
}

$select = $conn->prepare("SELECT  PI.* FROM product_item as PI LEFT JOIN product_category as PC
             ON PI.c_id = PC.id  WHERE PI.status='1' ".$whr." AND PC.status= '1'  ".$term." ");
$select->execute();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Application Office</title>
    <?php include('head.php')?>
</head>

<body>
    <?php include('header.php')?>

    <img src="image/portadaH.png" class="img-fluid" alt="">

    <section class="mt-5">
        <div class="container">
            <div class="row">

                <div class="col-md-12 col-lg-12 mt-3 mt-md-0">
                   
                    <div class="row justify-content-end">
                    <div class="col-md-8 col-lg-8">
                        <h4 class=" color-blue font-weight-bold">Productos y precios</h4>
                        
                      
                    </div>
                    
                    <div class="col-md-4 col-lg-4">
                <form method="GET">
                    <div class="input-group ">
                        <input type="hidden" name="c_id" value="<?=$c_id?>" >
                        <input type="text" class="form-control" placeholder="Buscar por nombre / referencia" aria-label="Username" aria-describedby="basic-addon1" name="term" required autocomplete="off">
                        <div class="input-group-prepend" >
                            <span class="input-group-text" id="basic-addon1" style="padding: 0px; border-color: #124a99;"> 
                                <button type="submit" value="submit" class="saerch-btn">Buscar</button></span>
                        
                          </div> 
                      </div>
                </form>
                
                    </div>
                    </div> 
               
                    
                    <br>
                    <div class="clearfix"></div>

                    <div class="row d-flex align-items-stretch">

                     <div class="col-md-3">
                         
                         <div class="card sticky-top shadow left-side">
                        <h3>Categorias</h3>
                          <div class="nav flex-column nav-pills">
                         <?php 
                                $selCate =$conn->prepare("select * from product_category where status='1' ");
                                $selCate->execute();
                                while($row = $selCate->fetch(PDO::FETCH_ASSOC)){
                                
                             ?>
                            <a class="nav-link <?php if($row['id']==$_REQUEST['c_id']) { echo 'active';} ?>"  href="product.php?c_id=<?php echo $row['id']; ?>" > 
                                <?php echo $row['category'];?> </a>
                       
                       
                         <?php } ?>
                          </div>
                    </div>
                     </div>

                     <div class="col-md-9">
                       <div class="row">
                        <?php
                        $row_count = $select->rowCount();
                            if($row_count!=0)
                            {
                            while($row=$select->fetch(PDO::FETCH_ASSOC)){

                           ?>
                           
                           <input type="hidden" name="pid" class="itmid-<?=$row['id']?>" value="<?=$row['id']?>">
                            <input type="hidden" name="price" class="price-<?=$row['id']?>" value="<?=$row['price']?>">
                         <div class="col-lg-6 mb-4  wow fadeInDown">
                            <div class="card product-box shadow border">
                                <div class="card-body">
                              <div class="img-blog">
                                
                                         <?php
                                            if($row['image']) { ?>
                                                 <img src="uploaded/<?php echo $row['image']; ?>" 
                                        alt=""  class="img-fluid d-block mx-auto ">
                                                
                                                <?php } else {    ?>   
                                                  <a href="<?=$row['video']?>" data-lity>
                                                <img src="image/video.gif" 
                                        alt=" "  class="img-fluid d-block mx-auto ">  </a>
                                                <?php } ?>

                                  
                                        </div>  

                                    <h4 class="title"><?php echo $row['name']; ?> </h4>
                                    <p class="ref">Reference: 
                                        <span> <?php echo $row['reference']; ?> </span> </p>
                                    <p class="price">(USD): $ <span class="price-span"><?php echo $row['price']; ?></span> </p>
                                    <p class="description"> <?php echo $row['description']; ?></p>
                                    <p class="text-center mt-4">
                                        <a href="javascript:void(0);" title="Click Here" class="payment-infos" onClick="funpaynow(<?=$row['id']?>)">
                                            <img src="image/comprar.png" class="w170" alt="" >
                                    </a> </p>
                                </div>
                            </div>

                        </div>
                        <?php }
                    }else{   echo "<div class='no-data-found'><i class='fa fa-frown-o'></i> <br> <span> Product </span> Not Found </div>";   
                    }
                         ?>

                  </div>
                   </div>

                    </div>
                </div>
            </div>
        </div>
    </section>


    <!--==========================  Footer ============================-->
    <div class="mt-5">
        <?php include('footer.php')?>
    </div>

<script type="text/javascript">
    
    function funpaynow(id){

        $('#payment-infos').modal('show');
        $('.pid').val( $('.itmid-'+id).val());
        $('.price').val( $('.price-'+id).val());
        //console.log($('.itmid-'+id).val() + '-----' + ('.price-'+id).val() );
    }
    
    
 
    
    
</script>





 <!-- payment-info -->
    <div class="modal fade" id="payment-infos">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Payment Information </h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <form action="payment_paypal.php" method="post">
                    <div class="modal-body">
                        <input type="hidden" class="pid" name="pid">
                        <input type="hidden" class="price" name="price">
                        <div class="mb-3"><label for="">Nombre :</label><input type="text" class="form-control" name="name" required></div>
                        <div class="mb-3"><label for="">E-mail:</label><input type="email" class="form-control" name="email" required></div>
                        <div class="mb-3"><label for="">telefono no:</label><input type="tel" class="form-control" name="phoneno" required></div>
                    </div>
                    <div class="modal-footer">
                      <input type="submit" name="submit" class="btn btn-primary btn-sm" border="0" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif">  
                    
                    </div>
                </form>

            </div>
        </div>
    </div>

<script>
    $('#payment-infos').on('hidden.bs.modal', function () {
    $(this).find('form').trigger('reset');
})
</script>


</body>

</html>
