<?php
session_start();
include('include/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else
{
$p_id=intval($_GET['p_id']);// product id
if(isset($_POST['submit']))
{
	
	$category=$_POST['category'];
	$subcategory=$_POST['subcategory'];
	$p_name=$_POST['p_name'];
	$p_price=$_POST['p_price'];
	$p_description=$_POST['p_description'];
	
$sql=mysqli_query($con,"UPDATE product SET c_id='$category',sub_id='$subcategory',p_name='$p_name',p_price='$p_price',p_description='$p_description' WHERE p_id='$p_id'");
$_SESSION['msg']="Product Updated Successfully !!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin | Insert Product</title>
	<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="css/theme.css" rel="stylesheet">
	<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>

   <script>
function getSubcat(val) 
{
	$.ajax({
	type: "POST",
	url: "get_subcat.php",
	data:'c_id='+val,
	success: function(data)
	{
		$("#subcategory").html(data);
	}
	});
}
function selectCountry(val) 
{
$("#search-box").val(val);
$("#suggesstion-box").hide();
}
</script>	


</head>
<body>
<?php include('include/header.php');?>

	<div class="wrapper">
		<div class="container">
			<div class="row">
<?php include('include/sidebar.php');?>				
			<div class="span9">
					<div class="content">

						<div class="module">
							<div class="module-head">
								<h3>Insert Product</h3>
							</div>
							<div class="module-body">

									<?php if(isset($_POST['submit']))
{?>
									<div class="alert alert-success">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong></strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
									</div>
<?php } ?>


									<?php if(isset($_GET['del']))
{?>
									<div class="alert alert-error">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong></strong> 	<?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?>
									</div>
<?php } ?>

									<br />

			<form class="form-horizontal row-fluid" name="insertproduct" method="post" enctype="multipart/form-data">

<?php 

$query=mysqli_query($con,"select product.*,category.c_name,category.c_id,sub_category.sub_name,sub_category.sub_id from product join category on product.c_id=category.c_id join sub_category on product.sub_id=sub_category.sub_id where product.p_id='$p_id'");
$cnt=1;
while($row=mysqli_fetch_array($query))
{
  


?>


<div class="control-group">
<label class="control-label" for="basicinput">Category</label>
<div class="controls">
<select name="category" class="span8 tip" onChange="getSubcat(this.value);"  required>
<option value="<?php echo htmlentities($row['c_id']);?>"><?php echo htmlentities($row['c_name']);?></option> 
<?php $query=mysqli_query($con,"select * from category");
while($rw=mysqli_fetch_array($query))
{
	if($row['c_name']==$rw['c_name'])
	{
		continue;
	}
	else
	{
	?>

<option value="<?php echo $rw['c_id'];?>"><?php echo $rw['c_name'];?></option>
<?php }} ?>
</select>
</div>
</div>

									
<div class="control-group">
<label class="control-label" for="basicinput">Sub Category</label>
<div class="controls">

<select   name="subcategory"  id="subcategory" class="span8 tip" required>
<option value="<?php echo htmlentities($row['sub_id']);?>"><?php echo htmlentities($row['sub_name']);?></option>
</select>
</div>
</div>


<div class="control-group">
<label class="control-label" for="basicinput">Product Name</label>
<div class="controls">
<input type="text" name="p_name" placeholder="Enter Product Name" value="<?php echo htmlentities($row['p_name']);?>" class="span8 tip" >
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">Product Price</label>
<div class="controls">
<input type="text" name="p_price" placeholder="Enter Product Price" value="<?php echo htmlentities($row['p_price']);?>" class="span8 tip" required>
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">Product Description</label>
<div class="controls">
<textarea name="p_description" placeholder="Enter Product Description" rows="6" class="span8 tip">
<?php echo htmlentities($row['p_description']);?>
</textarea>  
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">Product Image1</label>
<div class="controls">
<img src="uploads/<?php echo htmlentities($row['p_image1']);?>" width="200" height="100"><a href="update-image1.php?p_id=<?php echo $row['p_id'];?>">Change Image</a>
</div>
</div>


<div class="control-group">
<label class="control-label" for="basicinput">Product Image2</label>
<div class="controls">
<img src="uploads/<?php echo htmlentities($row['p_image2']);?>" width="200" height="100"> <a href="update-image2.php?p_id=<?php echo $row['p_id'];?>">Change Image</a>
</div>
</div>



<div class="control-group">
<label class="control-label" for="basicinput">Product Image3</label>
<div class="controls">
<img src="uploads/<?php echo htmlentities($row['p_image3']);?>" width="200" height="100"><a href="update-image3.php?p_id=<?php echo $row['p_id'];?>">Change Image</a>
</div>
</div>
<?php } ?>
	<div class="control-group">
											<div class="controls">
												<button type="submit" name="submit" class="btn">Update</button>
											</div>
										</div>
									</form>
							</div>
						</div>


	
						
						
					</div><!--/.content-->
				</div><!--/.span9-->
			</div>
		</div><!--/.container-->
	</div><!--/.wrapper-->

<?php include('include/footer.php');?>

	<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
	<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
	<script src="scripts/datatables/jquery.dataTables.js"></script>
	<script>
		$(document).ready(function() {
			$('.datatable-1').dataTable();
			$('.dataTables_paginate').addClass("btn-group datatable-pagination");
			$('.dataTables_paginate > a').wrapInner('<span />');
			$('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
			$('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
		} );
	</script>
</body>
<?php } ?>