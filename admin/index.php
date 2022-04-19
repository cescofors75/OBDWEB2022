<?php 
include('./template/header.php');
include_once("db_connect.php");
?>
<title></title>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<link href="./bootstrap_toggle/bootstrap-toggle.min.css" rel="stylesheet">
<script src="./bootstrap_toggle/bootstrap-toggle.min.js"></script> 
<link rel="stylesheet" href="./css/style.css" type="text/css" media="all">
<script type="text/javascript" src="script/delete_script.js"></script>
<style>
	
img.circle {
  box-shadow: 0 0 15px #999;
border-radius: 50%;
}

img.shadow {
  box-shadow: 0 0 15px #999;

}
</style>
<?php 
session_start();
if(isset($_GET['metode'])){
$_SESSION['metode'] = $_GET['metode'];
header('Location:'.$_SERVER['PHP_SELF']);
exit();
}
if(isset($_SESSION['metode']))
{
switch($_SESSION['metode']){
case 0:
	$_SESSION['url'] =	'SELECT COUNT(*) as total_products FROM ambrand where active=0';
	include('pagination.php');
	$_SESSION['color'] = 'red';
    $_SESSION['url'] = "SELECT distinct ambrand.brandId,  ambrand.brandName, ambrand.active, left(ambrand.brandName,1) as initial ,ambrandsaddress.city as pobla, ambrandsaddress.street as direc FROM ambrand inner join ambrandsaddress on ambrand.brandId=ambrandsaddress.brandId  where active = 0 order by brandName LIMIT ".$start.",".NUM_ITEMS_BY_PAGE;
    $_SESSION['url_initial'] = "SELECT distinct left(ambrand.brandName,1) as initial FROM ambrand join (SELECT distinct ambrand.brandId,  ambrand.brandName,  ambrand.active, left(ambrand.brandName,1) as initial ,ambrandsaddress.city as direc, ambrandsaddress.street as pobla  FROM ambrand  inner join ambrandsaddress on ambrand.brandId=ambrandsaddress.brandId order by brandName LIMIT ".$start.",".NUM_ITEMS_BY_PAGE.") d on ambrand.brandName in(d.brandName) where ambrand.active = 0";
break;
case 1:
	$_SESSION['url'] =	'SELECT COUNT(*) as total_products FROM ambrand where active=1';
	include('pagination.php');
	$_SESSION['color'] = 'green';
    $_SESSION['url'] = "SELECT distinct ambrand.brandId,  ambrand.brandName,  ambrand.active, left(ambrand.brandName,1) as initial ,ambrandsaddress.city as pobla, ambrandsaddress.street as direc FROM ambrand inner join ambrandsaddress on ambrand.brandId=ambrandsaddress.brandId  where active = 1 order by brandName LIMIT ".$start.",".NUM_ITEMS_BY_PAGE;
    $_SESSION['url_initial'] = "SELECT distinct left(ambrand.brandName,1) as initial FROM ambrand join (SELECT distinct ambrand.brandId,  ambrand.brandName,  ambrand.active, left(ambrand.brandName,1) as initial ,ambrandsaddress.city as direc, ambrandsaddress.street as pobla  FROM ambrand  inner join ambrandsaddress on ambrand.brandId=ambrandsaddress.brandId order by brandName LIMIT ".$start.",".NUM_ITEMS_BY_PAGE.") d on ambrand.brandName in(d.brandName) where ambrand.active = 1";
break;
case 2:
	$_SESSION['url'] = 'SELECT COUNT(*) as total_products FROM ambrand ';
	include('pagination.php');
	$_SESSION['color'] = 'orange';
	$_SESSION['url'] = "SELECT distinct ambrand.brandId,  ambrand.brandName, ambrand.active, left(ambrand.brandName,1) as initial,ambrandsaddress.city as pobla, ambrandsaddress.street as direc  FROM ambrand inner join ambrandsaddress on ambrand.brandId=ambrandsaddress.brandId  order by brandName LIMIT ".$start.",".NUM_ITEMS_BY_PAGE;
	$_SESSION['url_initial'] = "SELECT distinct left(ambrand.brandName,1) as initial FROM ambrand join (SELECT distinct ambrand.brandId,  ambrand.brandName,  ambrand.active, left(ambrand.brandName,1) as initial ,ambrandsaddress.city as direc, ambrandsaddress.street as pobla  FROM ambrand  inner join ambrandsaddress on ambrand.brandId=ambrandsaddress.brandId order by brandName LIMIT ".$start.",".NUM_ITEMS_BY_PAGE.") d on ambrand.brandName in(d.brandName)";
break;
}
}else{
	$_SESSION['url'] = 'SELECT COUNT(*) as total_products FROM ambrand ';
	include('pagination.php');
	$_SESSION['color'] = 'orange';
	$_SESSION['url'] = "SELECT distinct ambrand.brandId,  ambrand.brandName,  ambrand.active, left(ambrand.brandName,1) as initial ,ambrandsaddress.city as pobla, ambrandsaddress.street as direc  FROM ambrand  inner join ambrandsaddress on ambrand.brandId=ambrandsaddress.brandId order by brandName LIMIT ".$start.",".NUM_ITEMS_BY_PAGE;
	$_SESSION['url_initial'] = "SELECT distinct left(ambrand.brandName,1) as initial FROM ambrand join (SELECT distinct ambrand.brandId,  ambrand.brandName,  ambrand.active, left(ambrand.brandName,1) as initial ,ambrandsaddress.city as direc, ambrandsaddress.street as pobla  FROM ambrand  inner join ambrandsaddress on ambrand.brandId=ambrandsaddress.brandId order by brandName LIMIT ".$start.",".NUM_ITEMS_BY_PAGE.") d on ambrand.brandName in(d.brandName)";
	
}


?>

<?php include('./template/container.php');?>
<div id='top' class="container">
	<h2>List Suppliers </h2>
	<?php 
	echo '<nav>';
    echo '<ul  class="pagination">';

    if ($total_pages > 1) {
        if ($page != 1) {
            echo '<li class="page-item"><a class="page-link" href="index.php?page='.($page-1).'"><span aria-hidden="true">&laquo;</span></a></li>';
        }

        for ($i=1;$i<=$total_pages;$i++) {
            if ($page == $i) {
                echo '<li class="page-item active"><a class="page-link" href="#">'.$page.'</a></li>';
            } else {
                echo '<li class="page-item"><a class="page-link" href="index.php?page='.$i.'">'.$i.'</a></li>';
            }
        }

        if ($page != $total_pages) {
            echo '<li class="page-item"><a class="page-link" href="index.php?page='.($page+1).'"><span aria-hidden="true">&raquo;</span></a></li>';
        }
    }
    echo '</ul>';
    echo '</nav>';
	?>
	    <button onclick="location.href ='./index.php?metode=0'" type="button" class="btn btn-danger pull-right">LIST DISABLES</button>&nbsp;	
	    <button onclick="location.href ='./index.php?metode=1'" type="button" class="btn btn-success pull-right">LIST ENABLES</button>&nbsp;		
		<button onclick="location.href ='./index.php?metode=2'" type="button" class="btn btn-warning pull-right">LIST ALL</button>	</h2>
		
	<?php
		 $resultset= mysqli_query($conn, $_SESSION['url_initial'] ) or die("database error:". mysqli_error($conn));
		 echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class='texte' style='color:".$_SESSION['color']."'>Browse </span>&nbsp;&nbsp;";
		 while( $rows = mysqli_fetch_assoc($resultset) ) { 	
		/* ?>*/
		    
			 echo "<td  class='text' style='color:".$_SESSION['color']."'>&nbsp;<a class='init' style='color:".$_SESSION['color']."' href='#".$rows['initial']."'>".$rows['initial']."</a>&nbsp;</td> ";
		 /*			 echo "<td class='text'>&nbsp;<a class='init' href='#<?php echo $rows['initial']; ?>'><?php echo $rows['initial']; ?></a>&nbsp;</td> ";
             <?php*/
		 }
		 mysqli_free_result($resultset);
		$resultset = mysqli_query($conn, $_SESSION['url']) or die("database error:". mysqli_error($conn));
		$row_cnt = $resultset->num_rows;	
		?>
		<a type="button" id="active_records" class="btn btn-primary pull-left ">Enable</a>
		<a type="button" id="deactive_records" class="btn btn-primary pull-left ">Disable</a>
		<a type="button" id="All_active_records" class="btn btn-success pull-left ">All Enable</a>
		<a type="button" id="All_deactive_records" class="btn btn-danger pull-left ">All Disable</a>
	    <div id="console-event"></div>
	<table id="employee_grid" class="table table-condensed table-hover table-striped bootgrid-table" width="60%" cellspacing="0">
		<thead>
		  <tr >
			 <th><input type="checkbox" id="select_all"><strong>All(<?php echo $row_cnt; ?>)</strong></th>
			 <th>Logo</th>
			 <th>Name</th>	
			 <th>Street</th>
			 <th>City</th>
			 <th>Active</th>		 
		  </tr>
	    </thead>
		<tbody>
		<?php
		while( $rows = mysqli_fetch_assoc($resultset) ) 
		{ 
		?>
		  <tr id="<?php echo $rows["brandId"]; ?>">
			 <td id="<?php echo $rows["initial"]; ?>"><input type="checkbox" class="emp_checkbox" data-emp-id="<?php echo $rows["brandId"]; ?>"></td>
			 <td><?php echo "<img class='circle shadow' src='./suppliers_logos/jpg/".$rows["brandId"].".jpg'  "?>
                onerror="this.onerror=null;this.src='./images/no_image.jpg';" /></td>  
			 <td class='text'><?php echo $rows["brandName"]; ?></td>	
			 <td class='text'><?php echo $rows["direc"]; ?></td>
			 <td class='text'><?php echo $rows["pobla"]; ?></td>
			 <td><?php if ($rows["active"] == 1) { echo "<img src='./images/ok2.png'>"; } else { echo "<img src='./images/xroja22.png'>"; } ?></td>
			 <td><?php if ($rows["active"] == 1) { echo "<input checked class='emp_checkbox2'  data-toggle='toggle' data-on='Enabled' data-off='Disabled' type='checkbox' data-emp-id-slide="; echo $rows["brandId"]; echo "></td>";} else { echo "<input  class='emp_checkbox2'  data-toggle='toggle' data-on='Enabled' data-off='Disabled' type='checkbox' data-emp-id-slide="; echo $rows["brandId"]; echo "></td>";}
			 ?></td> 
		  </tr>
		<?php
		}
	
	
	
		mysqli_free_result($resultset); 
		mysqli_close($conn);	
		?>
		</tbody>  
	</table>		
	<div class="row">
		<div class="col-md-2 well">	
			<span class="rows_selected" id="select_count">0 Selected </span>
			</div>	
	</div>
	<div class="row">
	<?php 
	echo '<nav>';
    echo '<ul  class="pagination">';

    if ($total_pages > 1) {
        if ($page != 1) {
            echo '<li class="page-item"><a class="page-link" href="index.php?page='.($page-1).'"><span aria-hidden="true">&laquo;</span></a></li>';
        }

        for ($i=1;$i<=$total_pages;$i++) {
            if ($page == $i) {
                echo '<li class="page-item active"><a class="page-link" href="#">'.$page.'</a></li>';
            } else {
                echo '<li class="page-item"><a class="page-link" href="index.php?page='.$i.'">'.$i.'</a></li>';
            }
        }

        if ($page != $total_pages) {
            echo '<li class="page-item"><a class="page-link" href="index.php?page='.($page+1).'"><span aria-hidden="true">&raquo;</span></a></li>';
        }
    }
    echo '</ul>';
    echo '</nav>';
	?>
		<a class="btn btn-default read-more" style="background:#3399ff;color:white" href="#top" title="">Back to Top</a>			
	</div>	
</div>	
<?php include('./template/footer.php');?> 