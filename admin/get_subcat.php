<?php
include('include/config.php');
if(!empty($_POST["c_id"])) 
{
$c_id=intval($_POST['c_id']);
$query=mysqli_query($con,"SELECT * FROM sub_category WHERE c_id=$c_id");
?>
<option value="">Select Subcategory</option>
<?php
 while($row=mysqli_fetch_array($query))
 {
  ?>
  <option value="<?php echo htmlentities($row['sub_id']); ?>"><?php echo htmlentities($row['sub_name']); ?></option>
  <?php
 }
}
?>