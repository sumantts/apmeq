<nav class="pcoded-navbar ">
		<div class="navbar-wrapper">
			<div class="navbar-content scroll-div" id="nav_bar">
				
				<ul class="nav pcoded-inner-navbar " >
					<li class="nav-item <?php if($p == 'dashboard'){ ?> active <?php } ?>">
					    <a href="?p=dashboard" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
					</li>

					<li class="nav-item pcoded-menu-caption" id="setup">
						<label>SETUP </label>
					</li> 

					<?php if($_SESSION["user_level"] == '1'){?>
					<li class="nav-item <?php if($p == 'department'){ ?> active <?php } ?>">
					    <a href="?p=department&gr=setup" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Department</span></a>
					</li>
					<li class="nav-item <?php if($p == 'fee_particulars'){ ?> active <?php } ?>">
					    <a href="?p=fee_particulars&gr=setup" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Fee Particulars</span></a>
					</li>
					<!-- <li class="nav-item <?php if($p == 'course_fee'){ ?> active <?php } ?>">
					    <a href="?p=course_fee&gr=setup" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Course Fee</span></a>
					</li> -->
					<li class="nav-item <?php if($p == 'students'){ ?> active <?php } ?>">
					    <a href="?p=students&gr=setup" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext"> Students</span></a>
					</li>
					<li class="nav-item <?php if($p == 'collect_course_fee'){ ?> active <?php } ?>">
					    <a href="?p=collect_course_fee&gr=setup" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Collect Course Fee</span></a>
					</li>
					<?php } ?>
					<li class="nav-item <?php if($p == 'introduction'){ ?> active <?php } ?>">
					    <a href="?p=introduction&gr=setup" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Introduction</span></a>
					</li>

					<li class="nav-item pcoded-menu-caption" id="reports">
						<label>REPORTS </label>
					</li>
					<li class="nav-item pcoded-hasmenu <?php if($p == 'collected_fees' || $p == 'paid_fees'){ ?> active pcoded-trigger <?php } ?>">
						<a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layout"></i></span><span class="pcoded-mtext">Reports</span></a>
						<ul class="pcoded-submenu">
							<?php if($_SESSION["user_level"] == '1'){?>
								<li <?php if($p == 'collected_fees'){ ?> class="active" <?php } ?>><a href="?p=collected_fees&gr=reports">Collected Fees</a></li>
							<?php }else{?>
								<li <?php if($p == 'paid_fees'){ ?> class="active" <?php } ?>><a href="?p=paid_fees&gr=reports">Paid Fees</a></li>
							<?php }?>							
						</ul>
					</li>

				</ul>				
				
			</div>
		</div>
	</nav>