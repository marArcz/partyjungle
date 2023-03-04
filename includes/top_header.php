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

							if (Session::getUser() === null) {
							?>

								<a href="login.php" class="loginbtn ">Log in</a>
								<a href="signup.php" class="order">Sign up</a>
							<?php
							} else {
							?>
								<li class="align-self-center">
									<a href="cart.php">
										<img src="assets/images/shopping.png" alt="#" />
										<?php
										$user_id = Session::getUser()['id'];
										$cart_items = mysqli_query($con, "SELECT SUM(quantity) FROM cart WHERE user_id=$user_id AND is_checked_out=0")->fetch_array()[0];
										?>
										<span class="badge bg-danger text-light" style="margin-left:-30px;margin-bottom:2vh;" id="cart_count">
											<?php echo $cart_items ? $cart_items : 0 ?>
										</span>
									</a>
								</li>
								<li class="align-self-center">
									<div class="dropdown">
										<a href="account.php" class="mx-2 link-dark" data-bs-toggle="dropdown" role="button">
											<?php
											if (empty(Session::getUser()['photo'])) {
											?>
												<i class="bx bx-user fs-3"></i>
											<?php
											} else {
											?>
												<img src="<?php echo Session::getUser()['photo'] ?>" class="shadow-sm account-photo" alt="">
											<?php
											}
											?>
										</a>
										<ul class="dropdown-menu dropdown-menu-end mt-3">
											<li class="py-0">
												<a class="dropdown-item d-flex align-items-center justify-content-between" href="account.php">
													<span>Account</span>

													<i class="bx bxs-user-circle"></i>
												</a>
											</li>
											<li>
												<hr class="dropdown-divider">
											</li>
											<li class="py-0">
												<a class="dropdown-item d-flex align-items-center justify-content-between" href="logout.php">
													<span>Logout</span>
													<i class="bx bx-log-out"></i>
												</a>
											</li>
										</ul>
									</div>
								</li>

								<!-- <a href="./logout.php" class="loginbtn ms-2">Log out</a> -->
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
							<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
								<span class="navbar-toggler-icon"></span>
							</button>
							<div class="collapse navbar-collapse" id="navbarsExample04">
								<ul class="navbar-nav mr-auto align-items-center d-flex flex-wrap">
									<li class="nav-item h-100 <?php echo $active_page == "home" ? "active" : "" ?>" id="nav_home">
										<a class="nav-link h-100" href="index.php">Home</a>
									</li>
									<li class="nav-item h-100 <?php echo $active_page == "products" ? "active" : "" ?>" id="nav_products">
										<a class="nav-link" href="products.php">Products</a>
									</li>
									<li class="nav-item h-100 <?php echo $active_page == "services" ? "active" : "" ?>" id="nav_products">
										<a class="nav-link" href="services.php">Services</a>
									</li>

									<?php


									if (Session::getUser() != null) {
									?>

										<li class="nav-item <?php echo $active_page == "cart" ? "active" : "" ?>" id="nav_cart">
											<a class="nav-link" href="cart.php">Cart</a>
										</li>

										<li class="nav-item <?php echo $active_page == "orders" ? "active" : "" ?>" id="nav_ostat">
											<a class="nav-link " href="orders.php">Orders</a>
										</li>
										<li class="nav-item <?php echo $active_page == "reservations" ? "active" : "" ?> " id="nav_about">
											<a class="nav-link" href="service-reservations.php">Services Ordered</a>
										</li>
										<li class="nav-item <?php echo $active_page == "product_reservations" ? "active" : "" ?> " id="nav_about">
											<a class="nav-link" href="reservations.php">Reservations</a>
										</li>

									<?php
									}
									?>
									<!-- <li class="nav-item" id="nav_contact">
										<a class="nav-link" href="#" onclick="contacttab();">Contact</a>
									</li> -->


								</ul>
							</div>
						</nav>
					</div>
					<div class="col-md-4">
						<div class="search">
							<form action="products.php" method="get">
								<?php
								if (isset($_GET['category'])) {
								?>
									<input type="hidden" name="category" value="<?php echo $_GET['category'] ?>">
								<?php
								}
								?>
								<input class="form_sea py-3" type="text" placeholder="Search" name="search" id="search-input">
								<button class="seach_icon mt-1" type="submit"><i class="bx bx-search"></i></button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>