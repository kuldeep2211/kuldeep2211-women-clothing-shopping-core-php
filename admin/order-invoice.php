<?php
session_start();
include('include/config.php');
if(strlen($_SESSION['alogin'])==0)
{   
    header('location:index.php');
}
else
{

    $sqlQry ="select
    user.fname,
    user.lname,
    user.email,
    user.mobileno,
    shipping.address1,
    shipping.address2,
    shipping.address3,
    shipping.landmark,
    shipping.pincode,
    product.p_id,
    product.p_name,
    product.p_price,
    order_detail.od_qty,
    order_detail.od_id,
    orders.o_total,
    orders.o_date,
    order_detail.o_id
from order_detail 
    join orders on order_detail.o_id = orders.o_id
    join user on orders.u_id = user.u_id 
    join shipping on orders.u_id = shipping.u_id 
    join product on product.p_id = order_detail.p_id 
where 
    order_detail.o_id = '".$_REQUEST['o_id']."'";
    
    $query = mysqli_query($con,$sqlQry);
    $row = mysqli_fetch_assoc($query);
       
}
?>
<link rel="stylesheet" href="assets/css/invoice-bootstrap.min.css">
<!------ Include the above in your HEAD tag ---------->
<style type="text/css">
    .invoice-title h2, .invoice-title h3 {
    display: inline-block;
}

.table > tbody > tr > .no-line {
    border-top: none;
}

.table > thead > tr > .no-line {
    border-bottom: none;
}

.table > tbody > tr > .thick-line {
    border-top: 2px solid;
}
</style>
<script>
function myFunction() 
{
  window.print();
}
</script>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="pull-right"><input type="submit" name="submit" value="Print this page" onclick="myFunction()"></div><br>
    		<div class="invoice-title">
    			<h2>Invoice</h2>
                <h3 class="pull-right">Order # <?php echo htmlentities($row['o_id']);  ?></h3>
    		</div>
    		<hr>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    				<strong>Billed To:</strong><br>
    				<?php 
                    echo $row['fname']." ".$row['lname']."<br>";
                    echo $row['email']."<br>";
                    echo $row['mobileno']."<br>";
                    echo $row['address1']." ".$row['address2']." ".$row['address3']."<br>";
                    echo $row['landmark']." ".$row['pincode']."<br>";
                    ?><br>
    					
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    			</div>
    		</div>
    		<div class="row">
    			<div class="col-xs-6">
    				
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
    					<strong>Order Date:</strong><br>

    					<?php echo  date('d M Y',strtotime($row['o_date']));
 ?><br><br>
    				</address>
    			</div>
    		</div>
    	</div>
    </div>
    
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>Order summary</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-condensed">


                            <thead>
                                <tr> 
                                <td>
                                    <strong>#</strong>
                                </td>           
                                <td>
                                    <strong>Product Name</strong>
                                </td>
                                <td class="text-center">
                                    <strong>Price</strong>
                                </td>
                                <td class="text-center">
                                    <strong>Quantity</strong>
                                </td>
                                    <td class="text-right">
                                        <strong>Totals</strong>
                                    </td>
                                </tr>
                            </thead>
            <?php

            //echo $sqlQry;exit;
            $query = mysqli_query($con,$sqlQry);
            $cnt=1;
            while($row=mysqli_fetch_array($query))
            {
            ?>
    						
    						<tbody>
    							<!-- foreach ($order->lineItems as $line) or some such thing here -->
                                	<tr>
                                        <td class="text-center"><?php echo htmlentities($cnt);?></td>
                                        <td><?php echo $row['p_name'];?></td>
                                        <td class="text-center">&#8377;<?php echo htmlentities($row['p_price']);?></td>
                                        <td class="text-center"><?php echo htmlentities($row['od_qty']);?></td>
        								<td class="text-right">&#8377;<?php echo htmlentities($row['od_qty']*$row['p_price']);?></td>
        							</tr>
                                
    						</tbody>
        <?php 

$GrandTotal  =  $row['o_total'];

        $cnt=$cnt+1; } ?>


        <tr>
                                    <td class="thick-line"></td>
                                    <td class="thick-line"></td>
                                    <td class="thick-line"></td>
                                    <td class="thick-line text-center"><strong>Grand Total</strong></td>
                                    <td class="thick-line text-right">&#8377;<?php echo $GrandTotal?></td>
                                </tr>
    					</table>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</div>