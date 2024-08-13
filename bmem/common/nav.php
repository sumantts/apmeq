<nav class="pcoded-navbar ">
		<div class="navbar-wrapper">
			<div class="navbar-content scroll-div" id="nav_bar">
				
				<ul class="nav pcoded-inner-navbar " >
					<li class="nav-item <?php if($p == 'dashboard'){ ?> active <?php } ?>">
					    <a href="?p=dashboard" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
					</li>

					<?php if($_SESSION["user_type_code"] == 'dev' || $_SESSION["user_type_code"] == 'super'){?>
					<li class="nav-item pcoded-menu-caption" id="setup">
						<label>SETUP </label>
					</li> 

					
					<!-- <li class="nav-item <?php if($p == 'hospital-details'){ ?> active <?php } ?>">
					    <a href="?p=hospital-details&gr=setup" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Hospital Details</span></a>
					</li> -->
					<li class="nav-item <?php if($p == 'department'){ ?> active <?php } ?>">
						<a href="?p=department&gr=setup" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Department</span></a>
					</li>
					<li class="nav-item <?php if($p == 'user-type'){ ?> active <?php } ?>">
					    <a href="?p=user-type&gr=setup" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">User Type</span></a>
					</li>
					<!-- <li class="nav-item <?php if($p == 'students'){ ?> active <?php } ?>">
					    <a href="?p=students&gr=setup" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext"> Students</span></a>
					</li> -->
					<li class="nav-item <?php if($p == 'asset-type'){ ?> active <?php } ?>">
					    <a href="?p=asset-type&gr=setup" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Asset Type</span></a>
					</li>
					<?php } ?> 

					<li class="nav-item pcoded-menu-caption" id="details">
						<label>DETAILS </label>
					</li>
					<li class="nav-item <?php if($p == 'user-details'){ ?> active <?php } ?>">
					    <a href="?p=user-details&gr=details" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">User Details</span></a>
					</li>
					<li class="nav-item <?php if($p == 'asset-details'){ ?> active <?php } ?>">
					    <a href="?p=asset-details&gr=details" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Asset Details</span></a>
					</li>
					<li class="nav-item <?php if($p == 'supplier'){ ?> active <?php } ?>">
					    <a href="?p=supplier&gr=details" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Supplier</span></a>
					</li>
					<li class="nav-item <?php if($p == 'manufacturer'){ ?> active <?php } ?>">
					    <a href="?p=manufacturer&gr=details" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Manufacturer</span></a>
					</li>
					<li class="nav-item <?php if($p == 'service-providers'){ ?> active <?php } ?>">
					    <a href="?p=service-providers&gr=details" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Service Providers</span></a>
					</li>

					<li class="nav-item pcoded-menu-caption" id="actions">
						<label>ACTIONS </label>
					</li>
					<li class="nav-item <?php if($p == 'asset-reallocate'){ ?> active <?php } ?>">
						<a href="?p=asset-reallocate&gr=actions" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Asset Reallocate</span></a>
					</li>

					<li class="nav-item pcoded-menu-caption" id="reports">
						<label>REPORTS </label>
					</li>
					<li class="nav-item pcoded-hasmenu <?php if($p == 'collected_fees' || $p == 'paid_fees'){ ?> active pcoded-trigger <?php } ?>">
						<a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layout"></i></span><span class="pcoded-mtext">Reports</span></a>
						<ul class="pcoded-submenu">							
							<li <?php if($p == 'collected_fees'){ ?> class="active" <?php } ?>><a href="#">Reports</a></li>													
						</ul>
					</li>

				</ul>				
				
			</div>
		</div>
	</nav>