<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0">
    <a href="home" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
        <h1 class="m-0">Gardener</h1>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="home" class="nav-item nav-link <?= ($page=='home')?'active':'' ?>">Home</a>
            <a href="about_us" class="nav-item nav-link <?= ($page=='about_us')?'active':'' ?>">About</a>
            <a href="services" class="nav-item nav-link <?= ($page=='services')?'active':'' ?>">Services</a>
            <a href="projects" class="nav-item nav-link <?= ($page=='projects')?'active':'' ?>">Projects</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle <?= ($page=='features' || $page=='quote' || $page=='our_team' || $page=='testimonials')?'active':'' ?>" data-bs-toggle="dropdown">Pages</a>
                <div class="dropdown-menu bg-light m-0">
                    <a href="features" class="dropdown-item <?= ($page=='features')?'active':'' ?>">Features</a>
                    <a href="quote" class="dropdown-item <?= ($page=='quote')?'active':'' ?>">Free Quote</a>
                    <a href="our_team" class="dropdown-item <?= ($page=='our_team')?'active':'' ?>">Our Team</a>
                    <a href="testimonials" class="dropdown-item <?= ($page=='testimonials')?'active':'' ?>">Testimonial</a>
                    <!-- <a href="404" class="dropdown-item">404 Page</a> -->
                </div>
            </div>
            <a href="contact" class="nav-item nav-link <?= ($page=='contact')?'active':'' ?>">Contact</a>
        </div>
        <a href="" class="btn btn-primary py-4 px-lg-4 rounded-0 d-none d-lg-block">Get A Quote<i class="fa fa-arrow-right ms-3"></i></a>
    </div>
</nav>
<!-- Navbar End -->
