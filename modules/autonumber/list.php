<?php 
if(!isset($_SESSION['USERID'])){
	redirect(web_root."admin/index.php");
}
?>

 
           <div class="center wow fadeInDown">
                 <h2 class="page-header">List of Autonumbers</h2>
               
            </div>
           
			<form action="controller.php?action=delete" Method="POST">  	 		
				<table id="dash-table" class="table table-striped  table-hover table-responsive" style="font-size:12px" cellspacing="0">

				
				  <thead>
				  	<tr> 
				  		<th>
				  		 <input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');"> 
				  		 Autonumber</th> 
				  		  <th>Key</th>
				  		 <!-- <th width="10%" align="center">Action</th> -->
				  	</tr>	
				  </thead>  
				  <tbody>
				  	<?php 
				  		$mydb->setQuery("SELECT * FROM `tblautonumbers`");
				  		$cur = $mydb->loadResultList();

						foreach ($cur as $result) {
				  		echo '<tr>'; 
			  			echo '<td> <input type="checkbox" name="selector[]" id="chkall" value="'.$result->AUTOID.'"> ' . $result->AUTOSTART.'' . $result->AUTOEND.'</td>';
			  			echo '<td>' . $result->AUTOKEY.'</td>';
				  		
				  		echo '</tr>';
				  	} 
				  	?>
				  </tbody>
					
				</table>
				     <div class="btn-group">
				  <a href="index.php?view=add" class="btn btn-default">New</a>
					<?php
					if($_SESSION['TYPE']=='Administrator'){
					echo '<button type="submit" class="btn btn-default" name="delete"><span class="glyphicon glyphicon-trash"></span> Delete Selected</button>';
					; }?>
				</div>


			</form> 