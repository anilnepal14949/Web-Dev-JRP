<?php
	include_once 'admin/admin.php';
	$admin = new Admin;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Bootstrap Project</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<nav id="main-navbar" class="navbar sticky-top navbar-dark navbar-expand-lg bg-dark">
	  <div class="container">
	  	<a class="navbar-brand fw-bold" href="#">Bootstrap Project</a>
	    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler">
	      <span class="navbar-toggler-icon"></span>
	    </button>
	    <div class="collapse navbar-collapse" id="navbarToggler">
	      <ul class="navbar-nav text-uppercase fw-bold ms-auto mb-2 mb-lg-0">
	      	<?php
	      		$menus = $admin->getAllOrderedRecords("menu", "menu_order", "ASC");
	      		if(!empty($menus)):
	      			foreach($menus as $menu):
	      	?>
	      		<li class="nav-item">
		          <a class="nav-link" <?php if($menu["menu_link"] == "home") { echo 'aria-current="page"'; } ?> href="#<?=$menu['menu_link']?>"><?=$menu["menu_title"]?></a>
		        </li>
	      	<?php
	      			endforeach;
	      		endif;
	      	?>
	      </ul>
	    </div>
	  </div>
	</nav>
	<?php
		$banner = $admin->getSingleRecord("banner");
		$banner = $banner[0];
	?>
	<div data-bs-spy="scroll" data-bs-target="#main-navbar" data-bs-smooth-scroll="true" tabindex="0">
		<section id="home" class="hero-section d-flex flex-column align-items-center justify-content-center">
			<img src="images/banner/<?=$banner['banner_image']?>" alt="Avatar">
			<h1 class="fw-bolder text-uppercase mt-4"><?=$banner['banner_title']?></h1>
			<span class="star-icon d-flex align-items-center justify-content-center"><i class="bi bi-star-fill"></i></span>
			<p class="fw-bold fs-4 mt-4"><?= $banner["banner_desc"] ?></p>
		</section>
		<section class="container portfolio mt-5" id="portfolio">
			<h1 class="fw-bolder text-center text-dark">
				PORTFOLIO
			</h1>
			<div class="text-center star-icon d-flex align-items-center justify-content-center"><i class="bi bi-star-fill"></i></div>
			<div class="row gy-5 mt-2">
				<div class="col col-lg-4 col-md-6 col-sm-12">
					<img src="images/cabin.png" alt="Cabin">
				</div>
				<div class="col col-lg-4 col-md-6 col-sm-12">
					<img src="images/cake.png" alt="Cake">
				</div>
				<div class="col col-lg-4 col-md-6 col-sm-12">
					<img src="images/circus.png" alt="Circus">
				</div>
				<div class="col col-lg-4 col-md-6 col-sm-12">
					<img src="images/game.png" alt="Game">
				</div>
				<div class="col col-lg-4 col-md-6 col-sm-12">
					<img src="images/safe.png" alt="Safe">
				</div>
				<div class="col col-lg-4 col-md-6 col-sm-12">
					<img src="images/submarine.png" alt="Submarine">
				</div>
			</div>
		</section>
		<section id="about" class="container-fluid about mt-5 d-flex align-items-center justify-content-center">
			<div class="container text-light d-flex align-items-center justify-content-center flex-column">
				<h1 class="fw-bolder text-center">
					ABOUT
				</h1>
				<div class="text-center star-icon"><i class="bi bi-star-fill"></i></div>
				<div class="row fs-5 m-auto mt-4">
					<div class="col-md-6">
						<p>
							Freelancer is a free bootstrap theme created by Start Bootstrap. The download includes the complete source files including HTML, CSS, and JavaScript as well as optional SASS stylesheets for easy customization.
						</p>
					</div>
					<div class="col-md-6">
						<p>
							You can create your own custom avatar for the masthead, change the icon in the dividers, and add your email address to the contact form to make it fully functional!
						</p>
					</div>
					<a href="#" class="w-auto m-auto fw-bold fs-5 btn btn-lg  btn-outline-light"><i class="bi bi-download"></i> Free Download </a>
				</div>
			</div>
		</section>
		<section id="contact" class="container contact py-5">
			<div class="container text-dark d-flex align-items-center justify-content-center flex-column">
				<h1 class="fw-bolder text-center">
					CONTACT
				</h1>
				<div class="text-center star-icon"><i class="bi bi-star-fill"></i></div>
				<form class="form mt-4">
				  	<div class="mb-3 form-floating">
				    	<input type="text" class="form-control" id="full_name" placeholder="Full Name">
				    	<label for="full_name">Full Name</label>
				  	</div>
				  	<div class="mb-3 form-floating">
				    	<input type="email" class="form-control" id="email" placeholder="Email">
				    	<label for="email">Email</label>
				  	</div>
				  	<div class="mb-3 form-floating">
				    	<input type="tel" class="form-control" id="phone_number" placeholder="Phone Number">
				    	<label for="phone_number">Phone Number</label>
				  	</div>
				  	<div class="mb-3 form-floating">
				    	<textarea class="form-control" id="message" style="height: 100px;" placeholder="Message"></textarea>
				    	<label for="message">Message</label>
				  	</div>
				  	<button type="submit" class="btn btn-danger fw-bold py-3 px-4 disabled">Send Message</button>
				</form>
			</div>
		</section>
	</div>
	<footer class="container-fluid">
		<div class="row container text-light text-center m-auto">
			<div class="col">
				<h3> LOCATION </h3>
				<p>
					55 Own Palace, Suburb State, 1234<br> At this address
				</p>
			</div>
			<div class="col">
				<h3> AROUND THE WEB </h3>
				<div class="socials">
					<a href="#"><i class="bi bi-facebook"></i></a>
					<a href="#"><i class="bi bi-twitter"></i></a>
					<a href="#"><i class="bi bi-linkedin"></i></a>
				</div>
			</div>
			<div class="col">
				<h3> ABOUT FREELANCER </h3>
				<p>
					Freelance is a free to use, MIT licensed <br> Bootstrap theme created with love. 
				</p>
			</div>
		</div>
	</footer>
	<div class="footer-bottom text-light d-flex align-items-center justify-content-center">
		Copyright &copy; Your Website 2022
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>