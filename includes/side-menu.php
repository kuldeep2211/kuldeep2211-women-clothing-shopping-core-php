<div class="side-menu animate-dropdown outer-bottom-xs">
    <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Categories</div>        
    <nav class="yamm megamenu-horizontal" role="navigation">
  
        <ul class="nav">
            <li class="dropdown menu-item">
              <?php $sql=mysqli_query($con,"select c_id,c_name  from category");
while($row=mysqli_fetch_array($sql))
{
    ?>
                <a href="category.php?c_id=<?php echo $row['c_id'];?>" class="dropdown-toggle"><i class=""></i>
                <?php echo $row['c_name'];?></a>
                <?php }?>
                        
</li>
</ul>
    </nav>
</div>