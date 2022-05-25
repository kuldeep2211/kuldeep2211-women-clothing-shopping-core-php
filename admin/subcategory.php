<?php
session_start();
include('include/config.php');
if(strlen($_SESSION['alogin'])==0)
{	
header('location:index.php');
}
else
{
if(isset($_POST['submit']))
{
	$category=$_POST['category'];
	$sub_name=$_POST['sub_name'];
$sql=mysqli_query($con,"insert into sub_category(c_id,sub_name) values('$category','$sub_name')");
$_SESSION['msg']="SubCategory Created !!";

}

if(isset($_GET['del']))
		  {
		          mysqli_query($con,"delete from sub_category where sub_id = '".$_GET['sub_id']."'");
                  $_SESSION['msgdel']="SubCategory deleted !!";
		  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin | SubCategory</title>
	<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="css/theme.css" rel="stylesheet">
	<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
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
								<h3>Sub Category</h3>
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
									<strong></strong>	<?php echo htmlentities($_SESSION['msgdel']);?><?php echo htmlentities($_SESSION['msgdel']="");?>
									</div>
<?php } ?>

									<br />

<form class="form-horizontal row-fluid" name="subcategory" method="post" >

<div class="control-group">
<label class="control-label" for="basicinput">Category</label>
<div class="controls">
<select name="category" class="span8 tip" required>
<option value="">Select Category</option> 
<?php $query=mysqli_query($con,"select * from category");
while($row=mysqli_fetch_array($query))
{?>

<option value="<?php echo $row['c_id'];?>"><?php echo $row['c_name'];?></option>
<?php } ?>
</select>
</div>
</div>

									
<div class="control-group">
<label class="control-label" for="basicinput">SubCategory Name</label>
<div class="controls">
<input type="text" placeholder="Enter SubCategory Name"  name="sub_name" class="span8 tip" required>
</div>
</div>


	<div class="control-group">
											<div class="controls">
												<button type="submit" name="submit" class="btn">Create</button>
											</div>
										</div>
									</form>
							</div>
						</div>


	<div class="module">
							<div class="module-head">
								<h3>Sub Category</h3>
							</div>
							<div class="module-body table">
								<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
									<thead>
										<tr>
											<th>#</th>
											<th>Category</th>
											<th>SubCategory</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>

<?php $query=mysqli_query($con,"select sub_category.sub_id,category.c_name,sub_category.sub_name from sub_category join category on sub_category.c_id = category.c_id");
$cnt=1;
while($row=mysqli_fetch_array($query))
{
?>									
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											<td><?php echo htmlentities($row['c_name']);?></td>
											<td><?php echo htmlentities($row['sub_name']);?></td>
											<td>
											<a href="edit-subcategory.php?sub_id=<?php echo $row['sub_id']?>" ><i class="">Edit</i></a>
											<a href="subcategory.php?sub_id=<?php echo $row['sub_id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"><i class="">Delete</i></a></td>
										</tr>
										<?php $cnt=$cnt+1; } ?>
										
								</table>
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