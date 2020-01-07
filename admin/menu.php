<?php 
	require_once ('../database/config.php'); 
	error_reporting(0);
?>

<div class="sticky-header header-section ">
			<div class="header-left">
				<!--toggle button start-->
				<button id="showLeftPush"><i class="fa fa-bars"></i></button>
				<!--toggle button end-->
			
				<div class="clearfix"> </div>
			</div>
			<div class="header-right">
				
				
			
				<div class="profile_details">		
					<ul>
						<li class="dropdown profile_details_drop">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								<div class="profile_img">	
									<span class="prfil-img">										
										<img src="../uploaded/<?=$_SESSION['image']?>" 
 										alt=" " height="50" width="50"> 
 									</span> 
									<div class="user-name">
										<p></p>
										<span> <?php 

										if(isset($_POST['admin_name'])) { 
												$_SESSION['admin_name'] = $_POST['admin_name'];
											   echo $_SESSION['admin_name']; } else {
											   echo $_SESSION['admin_name']; } ?></span>
									</div>
									<i class="fa fa-angle-down lnr"></i>
									<i class="fa fa-angle-up lnr"></i>
									<div class="clearfix"></div>	
								</div>	
							</a>
							<ul class="dropdown-menu drp-mnu">
								<!-- <li> <a href="#"><i class="fa fa-cog"></i> Settings</a> </li> 
								<li> <a href="#"><i class="fa fa-user"></i> My Account</a> </li>  -->
								<li> <a href="profile.php?id=<?=$_SESSION['id']?>"<i class="fa fa-suitcase"></i> Profile</a> </li> 
								<li> <a href="logout.php"><i class="fa fa-sign-out"></i>Logout</a> </li>
							</ul>
						</li>
					</ul>
				</div>
				<div class="clearfix"> </div>				
			</div>
			<div class="clearfix"> </div>	
		</div>