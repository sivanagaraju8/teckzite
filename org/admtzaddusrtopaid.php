<?php
session_start();
if((!isset($_SESSION['tz_webteam'])))
{
	header("location:index");
}
require_once("site-settings.php");
$ip=$_SERVER['REMOTE_ADDR'];
$getuserdata=mysql_fetch_array(mysql_query("SELECT * FROM organizers WHERE orgid='".mysql_real_escape_string($_SESSION['tz_organizer'])."'"));
$sitesettingsdat=mysql_fetch_array(mysql_query("SELECT * FROM site_settings WHERE function='Adding Notices'"));

?>
<html lang="en">
   <?php include ("includes/files_include.php") ?>
          <link rel="stylesheet" href="node_modules/summernote/dist/summernote-bs4.css">
         <link rel="stylesheet" href="node_modules/quill/dist/quill.snow.css">
   <link rel="stylesheet" href="node_modules/simplemde/dist/simplemde.min.css">
     <script src="node_modules/jquery/dist/jquery.min.js"></script>
 <script>    
  $(document).ready(function() {
  $('#summernote').summernote();     
});
    $(document).ready(function() {
  $('#sum_description').summernote();     
});
    $(document).ready(function() {
  $('#summernote1').summernote();
});
    $(document).ready(function() {
  $('#summernote2').summernote();
});
    $(document).ready(function() {
  $('#summernote3').summernote();
});
function no(){
  document.getElementById('div1').style.display ='none';
}
function yes(){
  document.getElementById('div1').style.display = 'block';
} 
</script>
<script>
function showHint(str) {
    if (str.length >= 3) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txt").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "getuser.php?q=" + str, true);
        xmlhttp.send();
        
    } else {
        document.getElementById("txt").innerHTML = "";
        return;
    }
}
</script>
<body>
  <div class="container-scroller">
   <?php include ("includes/topbar.php") ?>
    <div class="container-fluid page-body-wrapper">
      <div class="row row-offcanvas row-offcanvas-right">
        
          </div>
        </div>
        <?php 
        if(isset($_POST['ad_user'])){
        	$add=($_SESSION['tz_organizer']);
        	$ip=$_SERVER['REMOTE_ADDR'];        	
        	$po=mysql_real_escape_string($_POST['username']);
        	$g=mysql_query("SELECT * FROM users where stuid='$po'");
        	$m=mysql_num_rows($g);
        	if($m==1){
        	$e=mysql_query("UPDATE users set paid='yes' where stuid='$po' ");
        	if($e==true){
        		echo'<script>alert("Updated succesfull")</script>';
        		mysql_query("INSERT INTO paid_log (added_by,paid_id,added_ip,status) values ('$add','$po','$ip','Success')");
        	}else{
        		echo'<script>alert("Some fields are missing")</script>';
        		mysql_query("INSERT INTO paid_log (added_by,paid_id,added_ip,status) values ('$add','$po','$ip','Missing Values')");
        	}
        }else{
        	echo'<script>alert("Not registered")</script>';
        		mysql_query("INSERT INTO paid_log (added_by,paid_id,added_ip,status) values ('$add','$po','$ip','not_registered')");
        }
    }

    if(isset($_POST['cance_pay'])){
        	$add=($_SESSION['tz_organizer']);
        	$ip=$_SERVER['REMOTE_ADDR'];        	
        	$po=mysql_real_escape_string($_POST['username']);
        	$g=mysql_query("SELECT * FROM users where stuid='$po'");
        	$m=mysql_num_rows($g);
        	if($m==1){
        	$e=mysql_query("UPDATE users set paid='no' where stuid='$po' ");
        	if($e==true){
        		echo'<script>alert("Cancelled succesfully")</script>';
        		mysql_query("INSERT INTO paid_log (added_by,paid_id,added_ip,status) values ('$add','$po','$ip','Cancelled')");
        	}else{
        		echo'<script>alert("Some fields are missing")</script>';
        		mysql_query("INSERT INTO paid_log (added_by,paid_id,added_ip,status) values ('$add','$po','$ip','Missing Values')");
        	}
        }else{
        	echo'<script>alert("Not registered")</script>';
        		mysql_query("INSERT INTO paid_log (added_by,paid_id,added_ip,status) values ('$add','$po','$ip','not_registered')");
        }
    }

    if(isset($_POST['change_pass'])){
        	$add=($_SESSION['tz_organizer']);
        	$ip=$_SERVER['REMOTE_ADDR'];        	
        	$po=mysql_real_escape_string($_POST['username']);
        	$pass=md5("tz123");
        	$g=mysql_query("SELECT * FROM users where stuid='$po'");
        	$m=mysql_num_rows($g);
        	if($m==1){
        	$e=mysql_query("UPDATE users set passwd='$pass' where stuid='$po' ");
        	if($e==true){
        		echo'<script>alert("Changed succesfull")</script>';
        		mysql_query("INSERT INTO org_passlog (changed_by,changed_id,changed_ip,status,changed_pass) values ('$add','$po','$ip','Success','$pass')");
        	}else{
        		echo'<script>alert("Some fields are missing")</script>';
        		mysql_query("INSERT INTO org_passlog (changed_by,changed_id,changed_ip,status,changed_pass) values ('$add','$po','$ip','Missing Values','$pass')");
        	}
        }else{
        	echo'<script>alert("Not registered")</script>';
        		mysql_query("INSERT INTO org_passlog (changed_by,changed_id,changed_ip,status,changed_pass) values ('$add','$po','$ip','not_registered','$pass')");
        }
    }
        ?>
        <!-- partial -->
       <?php include ("includes/sidebar.php") ?>
        <div class="content-wrapper">

   
			<?php
      if($getuserdata['role']!="Webteam")
        {
     if($sitesettingsdat['value']=="off")
         {
      ?>
            <center>
	  	<div class="alert alert-warning">
    				<strong>Sorry!!!  Webteam Stopped Adding Notice....Please Contact webteam</strong>
    			</div>	
    			</center>			
				<?php
        }else{
	
		?>



        <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Add User to Paid data of <?php echo $title;?></h4>
                  <form  action="admtzaddusrtopaid.php" method="post"  enctype="multipart/form-data">                                                       
                     <div class="form-group">
                      <label for="exampleInputParticipants">Username</label>
                      <input type="text" class="form-control" onkeyup="showHint(this.value)"  name='username' minlength="7" placeholder="Username" required="">
                      <div id="txt"></div>
                    </div>                     
 <div class="forn-group">                    
                    <!--button type="submit" name="add_user" class="btn btn-success mr-2"><i class="fa fa-plus" ></i> Add to paid</button>
                    <button type="submit" name="cancel_pay" class="btn btn-danger mr-2"><i class="fa fa-trash-o" ></i>Cancel Payment</button-->
                    <button type="submit" name="change_pass" class="btn btn-info mr-2"><i class="fa fa-unlock" ></i>Change Password</button>
                   </div>
                   </form>
                </div>
            </div>
        </div>

		
							<?php
}
        }
        else
        {          
          ?>
          
        <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Add User to Paid data of <?php echo $title;?></h4>
                  <form  action="admtzaddusrtopaid.php" method="post"  enctype="multipart/form-data">
                   <div class="form-group">
                      

                     <div class="form-group">
                      <label for="exampleInputParticipants">Username</label>
                      <input type="text" class="form-control" onkeyup="showHint(this.value)"  name='username' placeholder="Username" minlength="7" required="">
                      <div id="txt"></div>
                    </div> 
 <div class="forn-group">                    
                <!--button type="submit" name="add_user" class="btn btn-success mr-2"><i class="fa fa-plus" ></i> Add to paid</button>
                    <button type="submit" name="cancel_pay" class="btn btn-danger mr-2"><i class="fa fa-trash-o" ></i>Cancel Payment</button-->
                    <button type="submit" name="change_pass" class="btn btn-info mr-2"><i class="fa fa-unlock" ></i>Change Password</button>
                   </div>
                   </form>
                </div>
            </div>
        </div>
     
       
                    
        <?php
      }
      ?>

</div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
         <!--table class="table table-bordered table-stripped">
	<thead>
		<tr>
			<th>S.no</th>
			<th>Paid Id</th>
			<th>added_by</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$e=(mysql_query("SELECT * FROM paid_log order by id desc"));
		while($r=mysql_fetch_array($e)){
         echo'
		
<tr>
<td>'.$r['id'].'</td>
<td>'.$r['paid_id'].'</td>
<td>'.$r['added_by'].'</td>
<td>'.$r['status'].'</td>
</tr>


         ';
     }
		?>
	</tbody>
</table--> 
<?php include ("includes/footer.php") ?>
        <!-- partial -->
      </div>
      <!-- row-offcanvas ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="node_modules/jquery/dist/jquery.min.js"></script>
  <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
  <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="node_modules/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="node_modules/jquery-bar-rating/dist/jquery.barrating.min.js"></script>
  <script src="node_modules/chart.js/dist/Chart.min.js"></script>
  <script src="node_modules/raphael/raphael.min.js"></script>
  <script src="node_modules/morris.js/morris.min.js"></script>
  <script src="node_modules/jquery-sparkline/jquery.sparkline.min.js"></script>
    <script src="node_modules/summernote/dist/summernote-bs4.min.js"></script>
  <script src="node_modules/tinymce/tinymce.min.js"></script>
  <script src="node_modules/quill/dist/quill.min.js"></script>
  <script src="node_modules/simplemde/dist/simplemde.min.js"></script>
  <!-- End plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->

  <script src="js/off-canvas.js"></script>
  <script src="js/editorDemo.js"></script>
   <script src="js/nicEdit.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/misc.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="js/dashboard.js"></script>
  <!-- End custom js for this page-->
</body>

</html>

	
