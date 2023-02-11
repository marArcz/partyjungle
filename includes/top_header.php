  <!-- body -->
  <?php
	session_start();
	?>


  <!-- end loader -->
  <!-- header -->
  <header>
  	<!-- header inner -->
  	<div class="header">
  		<div class="header_top d_none1">
  			<div class="container">
  				<div class="row">
  					<div class="col-md-4">
  						<ul class="conta_icon ">
  							<li><a href="#"><img src="assets/images/call.png" alt="#" />Call us: 0965 753 4909 </a> </li>
  						</ul>
  					</div>
  					<div class="col-md-4">
  						<ul class="social_icon" hidden>
  							<li>
  								<a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
  							</li>
  							<li> <a href="#"><i class="fa fa-twitter"></i></a></li>
  							<li> <a href="#"> <i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
  							<li> <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i>
  								</a>
  							</li>
  						</ul>
  					</div>
  					<div class="col-md-4">
  						<div class="se_fonr1">

  							<span class="time_o"> Open hour: 8.00am - 5.00pm</span>
  						</div>
  					</div>
  				</div>
  			</div>
  		</div>
  		<div class="header_midil">
  			<div class="container">
  				<div class="row d_flex">
  					<div class="col-md-4">
  						<ul class="conta_icon d_none1">
  							<li>
  								<a href="#" style="margin-bottom:2vh;"><img src="assets/images/email.png" alt="#" />
  									partyjungle@gmail.com
  								</a>
  							</li>
  						</ul>
  					</div>
  					<div class="col-md-4">
  						<a class="logo" href="#"><img src="assets/images/logo1.png" alt="#" /></a>
  					</div>
  					<div class="col-md-4">
  						<ul class="right_icon d_none1">

  							<?php


								if (!isset($_SESSION["uid"])) {
								?>

  								<a href="#" class="loginbtn " onclick="logintab()">Log in</a>
  								<a href="#" class="order" onclick="signuptab()">Sign up</a>
  							<?php
								} else {
								?>
  								<li><a href="#" onclick="carttab()"><img src="images/shopping.png" alt="#" /><span class="badge  bg-danger text-light" style="margin-left:-4vh;margin-bottom:2vh;" id="cart_count">0</span></a> </li>

  								<a href="./logout.php" class="loginbtn ">Log out</a>
  							<?php
								}

								?>

  						</ul>
  					</div>
  				</div>
  			</div>
  		</div>
  		<div class="header_bottom">
  			<div class="container">
  				<div class="row">
  					<div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
  						<nav class="navigation navbar navbar-expand-md navbar-dark ">
  							<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
  								<span class="navbar-toggler-icon"></span>
  							</button>
  							<div class="collapse navbar-collapse" id="navbarsExample04">
  								<ul class="navbar-nav mr-auto">
  									<li class="nav-item active" id="nav_home">
  										<a class="nav-link" href="#" onclick="dashtab();">Home</a>
  									</li>
  									<li class="nav-item" id="nav_products">
  										<a class="nav-link" href="#" onclick="prodtab();">Products</a>
  									</li>

  									<?php


										if (isset($_SESSION["uid"])) {
										?>
  										<li class="nav-item" id="nav_cart">
  											<a class="nav-link" href="#" onclick="carttab()">Cart</a>
  										</li>

  										<li class="nav-item" id="nav_ostat">
  											<a class="nav-link" href="#" onclick="orderstattab()">Status</a>
  										</li>

  									<?php
										}
										?>



  									<li class="nav-item" id="nav_contact">
  										<a class="nav-link" href="#" onclick="contacttab();">Contact</a>
  									</li>

  									<li class="nav-item" id="nav_about">
  										<a class="nav-link" href="#" onclick="abouttab();">About</a>
  									</li>
  								</ul>
  							</div>
  						</nav>
  					</div>
  					<div class="col-md-4">
  						<div class="search">

  							<input class="form_sea" type="text" placeholder="Search" name="search" id="search" onkeypress="searchproducts(this.value)">
  							<button class="seach_icon"><i class="fa fa-search"></i></button>

  						</div>
  					</div>
  				</div>
  			</div>
  		</div>
  	</div>
  </header>