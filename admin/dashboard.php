<?php

require_once ('../database/config.php');


?>




<!DOCTYPE HTML>
<html>
<head>
<title>Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php include('head.php')?>

<!-- <style type="text/css">
  
 

</style> -->
</head> 
<body class="cbp-spmenu-push">
    <div class="main-content">
    
        <!--left-fixed -navigation-->
        <?php include('left-sidebar.php')?>
        <!-- header-starts -->
        <?php include('menu.php')?>
        <!-- //header-ends -->
        <!-- main content start-->
        <div id="page-wrapper">
            <div class="main-page">
            <div class="col_3">
            <div class="col-md-3 widget widget1">
                <div class="r3_counter_box">
                     <i class="pull-left fa fa-users dollar2 icon-rounded"></i>
                    
                    <div class="stats">
                        <h5><strong>
                            <?php
                            $select ="select count(*) from product_item";
                            $result=$conn->prepare($select);
                            $result->execute();
                            $num_rows = $result->fetchColumn();
                            ?>
                            <?php echo $num_rows ?></strong></h5>
                      <span>Total Users</span>
                      
                    </div>
                </div>
            </div>
            <div class="col-md-3 widget widget1">
                <div class="r3_counter_box">
                    <i class="pull-left fa fa-eye icon-rounded" style="background: #ea3c00;"></i>
                    <div class="stats">
                      <h5><strong>

                        <?php
                        $select ="select  count(*) as status from product_item where status='1'";
                        $result=$conn->prepare($select);
                        $result->execute();
                        $num_row = $result->fetch(PDO::FETCH_ASSOC);
                        // print_r($num_row);
                        // die;
                        ?>

                        <?php echo $num_row['status']; ?>
                      </strong></h5>
                      <span>Product Activate</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 widget widget1">
                <div class="r3_counter_box">
                    <i class="pull-left fa fa-eye-slash icon-rounded"></i>
                    <div class="stats">
                      <h5><strong>
                        <?php
                        $select ="select  count(*) as status from product_item where status='0'";
                        $result=$conn->prepare($select);
                        $result->execute();
                        $num_row1 = $result->fetch(PDO::FETCH_ASSOC);
                        
                        ?>

                        <?php echo $num_row1['status']; ?>
                      </strong></h5>
                      <span>Product DeActivate</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 widget widget1">
                <div class="r3_counter_box">
                    <i class="pull-left fa fa-credit-card dollar1 icon-rounded"></i>
                    <div class="stats">
                      <h5><strong>   
                        <?php $select ="select sum(payment_gross) from payments where payment_status='1' ";
                            $result=$conn->prepare($select);
                            $result->execute();
                            $tot_pay = $result->fetchColumn(); 
                        ?>
                        <?php echo $tot_pay ?>
                      </strong></h5>
                      <span>Payments</span>
                    </div>
                </div>
             </div>
            
            <div class="clearfix"> </div>
        </div>
        



    <div class="form-three widget-shadow">
      <div class="form-group">
        <?php
$select = "SELECT EXTRACT(YEAR FROM created_dt) as years FROM payments group by year(created_dt)"; 
$result = $conn->prepare($select);
$result->execute();
$res = $result->fetchAll(); 
?>
<div class="col-md-2 col-md-offset-10">

  <select class="form-control" id="sel1" name="">
     <option>-- Select Year --</option>
    <?php 
   
    foreach($res as $row){

    ?>
<option value=""><?php echo $row['years']; ?></option>

<?php } ?>
  </select>
</div>

<div class="clearfix"></div>

</div>
      <figure class="highcharts-figure">
    <div id="container"></div>
  
   <table id="datatable" style="display: none;">
        <thead>
            <tr>
                <th></th>
                <th>Activate</th>
                <th>DeActivate</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $month = array(1=>'jan',2=> 'Feb',3=> 'Mar', 4=>'Apr',5=>'May',6=>'Jun',7=>'Jul',8=>'Aug',9=>'Sep',10=>'Oct',11=>'Nov',12=>'Dec');
            foreach($month as $key=>$val){
            ?>
            <tr>
                <th><?php echo $val; //echo $key[$val] ?></th>
                <td> <?php 
                $select = "select sum(payment_gross) as totPayment from payments  
                            where payment_status='1' and month(created_dt) = '$key'  and year(created_dt) = YEAR(CURDATE()) ";
                $result = $conn->prepare($select);
                $result->execute(); 

                $res = $result->fetch(PDO::FETCH_ASSOC);
                echo $res['totPayment']; ?> 
            </td>

                <td>
                   <?php 
                $select = "select sum(payment_gross) as totPayment from payments  
                            where payment_status='0' and month(created_dt) = '$key'  and year(created_dt) = YEAR(CURDATE())";
                $result = $conn->prepare($select);
                $result->execute(); 

                $res = $result->fetch(PDO::FETCH_ASSOC);
                echo $res['totPayment']; ?> 

                </td>
            </tr>
           <?php } ?>

        </tbody>
    </table>
  
</figure>
    </div>
            

                
            </div>
        </div>
    <!--footer-->
    
    <!--//footer-->

        
    <!-- new added graphs chart js-->
    


<?php include('footer.php')?>

<script src="js/highcharts.js"></script>
<script src="js/data.js"></script>
<!-- <script src="https://code.highcharts.com/modules/exporting.js"></script>-->
<script src="https://code.highcharts.com/modules/accessibility.js"></script> 

<script type="text/javascript">
  Highcharts.chart('container', {
    data: {
        table: 'datatable'
    },
    chart: {
        type: 'column'
    },
    title: {
        text: 'Current Year'
    },
    xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
                 title: {
            text: 'Month'
        }
            },
    yAxis: {
        allowDecimals: false,
        title: {
            text: 'Product Payments'
        }
    },
    tooltip: {
        formatter: function () {
            return '<b>' + this.series.name + '</b><br/>' +
                this.point.y + ' ' + this.point.name.toLowerCase();
        }
    }
});
</script>
</body>
</html>