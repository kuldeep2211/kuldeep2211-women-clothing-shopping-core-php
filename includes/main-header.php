<?php
session_start();
 if(isset($_Get['action']))
 {
		if(!empty($_SESSION['cart']))
		{
			foreach($_POST['quantity'] as $key => $val)
			{
				if($val==0)
				{
					unset($_SESSION['cart'][$key]);
				}
				else
				{
					$_SESSION['cart'][$key]['quantity']=$val;
				}
			}
		}else{
			unset($_SESSION['cart']);
		}
}
?>
	<div class="main-header">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-3 logo-holder">
					<!-- ============================================================= LOGO ============================================================= -->
<div class="logo">
	<a href="index.php">
		
		<h2>Women Clothing</h2>

	</a>
</div>		
</div>
<div class="col-xs-12 col-sm-12 col-md-6 top-search-holder">

<!-- ============================================================= SEARCH AREA : END ============================================================= -->				</div><!-- /.top-search-holder -->

				<div class="col-xs-12 col-sm-12 col-md-3 animate-dropdown top-cart-row">
					<!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->
<?php
if(!empty($_SESSION['cart']))
{
	?>
	<div class="dropdown dropdown-cart">
		<a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
			<div class="items-cart-inner">
				<div class="total-price-basket">
					<span class="total-price">
					<span class="lbl"></span>
						<span class="sign"></span>
						<span class="value"><?php echo $_SESSION['tp']; ?></span>
					</span>
				</div>
				<div class="basket">
					<i class="glyphicon glyphicon-shopping-cart"></i>
				</div>
				<div class="basket-item-count"><span class="count"><?php echo $_SESSION['qnty'];?></span></div>
			
		    </div>
		</a>
		<ul class="dropdown-menu">
		
		 <?php
    $sql = "SELECT * FROM product WHERE p_id IN(";
			foreach($_SESSION['cart'] as $p_id => $value)
			{
			$sql .=$p_id. ",";
			}
			$sql=substr($sql,0,-1) . ") ORDER BY id ASC";
			$query = mysqli_query($con,$sql);
			$totalprice=0;
			$totalqunty=0;
			if(!empty($query))
			{
			while($row = mysqli_fetch_array($query))
			{
				$o_quantity=$_SESSION['cart'][$row['p_id']]['quantity'];
				$subtotal= $_SESSION['cart'][$row['p_id']]['quantity']*$row['p_price'];
				$totalprice += $subtotal;
				$_SESSION['qnty']=$totalqunty+=$o_quantity;

	?>
		
		
			<li>
				<div class="cart-item product-summary">
					<div class="row">
						<div class="col-xs-4">
							<div class="image">
								<a href="detail.html"><img  src="admin/uploads/<?php echo $row['p_image1'];?>" width="35" height="50" alt=""></a>
							</div>
						</div>
						<div class="col-xs-7">
							
							<h3 class="name"><a href="index.php?page-detail"><?php echo $row['p_name']; ?></a></h3>
							<div class="price">&#8377;<?php echo ($row['p_price']); ?>*<?php echo $_SESSION['cart'][$row['p_id']]['quantity']; ?>
							</div>
						</div>
						
					</div>
				</div><!-- /.cart-item -->
			
				<?php } }?>
				<div class="clearfix"></div>
			<hr>
		
			<div class="clearfix cart-total">
				<div class="pull-right">
					
						<span class="text">Total :</span><span class='price'><?php echo $_SESSION['tp']; ?></span>
						
				</div>
			
				<div class="clearfix"></div>
					
				<a href="my-cart.php" class="btn btn-upper btn-primary btn-block m-t-20">My Cart</a>	
			</div><!-- /.cart-total-->
					
				
		</li>
		</ul><!-- /.dropdown-menu-->
	</div><!-- /.dropdown-cart -->
<?php } else { ?>
<div class="dropdown dropdown-cart">
		<a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
			<div class="items-cart-inner">
				<div class="total-price-basket">
					<!--<span class="lbl">cart -</span>
					<span class="total-price"> -->
						<!-- <span class="sign">Rs.</span>
						<span class="value">00.00</span> -->
					</span>
				</div>
				<div class="basket">
					<i class="glyphicon glyphicon-shopping-cart"></i>
				</div>
				<div class="basket-item-count"><span class="count">0</span></div>
			
		    </div>
		</a>
		<ul class="dropdown-menu">
		
	
		
		
			<li>
				<div class="cart-item product-summary">
					<div class="row">
						<div class="col-xs-12">
							Your Shopping Cart is Empty.
						</div>
						
						
					</div>
				</div><!-- /.cart-item -->
			
				
			<hr>
		
			<div class="clearfix cart-total">
				
				<div class="clearfix"></div>
					
				<a href="index.php" class="btn btn-upper btn-primary btn-block m-t-20">Continue Shooping</a>	
			</div><!-- /.cart-total-->
					
				
		</li>
		</ul><!-- /.dropdown-menu-->
	</div>
	<?php }?>




<!-- ============================================================= SHOPPING CART DROPDOWN : END============================================================= -->				</div><!-- /.top-cart-row -->
			</div><!-- /.row -->

		</div><!-- /.container -->

	</div>