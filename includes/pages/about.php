<?php
if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}
?>
<!-- About Hero -->
<section class="page-hero py-5 bg-dark">
    <div class="container">
        <h1 class="section-title text-center">About Us</h1>
        <p class="lead text-center mb-0">Our Story, Mission, and Values</p>
    </div>
</section>

<!-- About Content -->
<section class="about-content py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <img src="/assets/images/about-image.jpg" alt="About A&Y" class="img-fluid rounded">
            </div>
            <div class="col-lg-6">
                <h2 class="mb-4">Who We Are</h2>
                <p class="lead mb-4"><!-- TODO: DYNAMIC COMPANY DESCRIPTION --></p>
                <p class="mb-4"><!-- TODO: DYNAMIC COMPANY HISTORY --></p>
                <div class="row mt-4">
                    <div class="col-6">
                        <div class="achievement-box text-center p-3">
                            <h3 class="h2 mb-2"><!-- TODO: DYNAMIC NUMBER --></h3>
                            <p class="mb-0">Projects Completed</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="achievement-box text-center p-3">
                            <h3 class="h2 mb-2"><!-- TODO: DYNAMIC NUMBER --></h3>
                            <p class="mb-0">Happy Clients</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Mission & Vision -->
<section class="mission-vision py-5 bg-darker">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h3 class="card-title mb-4">Our Mission</h3>
                        <p class="card-text"><!-- TODO: DYNAMIC MISSION --></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h3 class="card-title mb-4">Our Vision</h3>
                        <p class="card-text"><!-- TODO: DYNAMIC VISION --></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="team py-5">
    <div class="container">
        <h2 class="section-title text-center mb-5">Our Team</h2>
        <div class="row">
            <?php
            // TODO: DYNAMIC TEAM MEMBERS
            $team = [
                ['name' => 'John Doe', 'position' => 'CEO & Founder'],
                ['name' => 'Jane Smith', 'position' => 'Creative Director'],
                ['name' => 'Mike Johnson', 'position' => 'Lead Developer']
            ];
            
            foreach ($team as $member): ?>
                <div class="col-md-4 mb-4">
                    <div class="team-member text-center">
                        <img src="/assets/images/team-placeholder.jpg" alt="<?php echo $member['name']; ?>" class="img-fluid rounded-circle mb-3">
                        <h3 class="h4 mb-2"><?php echo $member['name']; ?></h3>
                        <p class="text-gold mb-3"><?php echo $member['position']; ?></p>
                        <div class="social-links">
                            <a href="#" class="me-2"><i class="fab fa-linkedin"></i></a>
                            <a href="#" class="me-2"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="me-2"><i class="fab fa-github"></i></a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="values py-5 bg-darker">
    <div class="container">
        <h2 class="section-title text-center mb-5">Our Values</h2>
        <div class="row">
            <?php
            $values = [
                ['icon' => 'fas fa-star', 'title' => 'Excellence'],
                ['icon' => 'fas fa-handshake', 'title' => 'Integrity'],
                ['icon' => 'fas fa-lightbulb', 'title' => 'Innovation'],
                ['icon' => 'fas fa-users', 'title' => 'Collaboration']
            ];
            
            foreach ($values as $value): ?>
                <div class="col-md-3 mb-4">
                    <div class="value-item text-center">
                        <i class="<?php echo $value['icon']; ?> fa-2x mb-3 text-gold"></i>
                        <h3 class="h5 mb-3"><?php echo $value['title']; ?></h3>
                        <p class="mb-0"><!-- TODO: DYNAMIC VALUE DESCRIPTION --></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<div class="container">
    <h1 class="mb-4">About Us</h1>
    <div class="row">
        <!-- About content will go here -->
        <p class="lead">Content coming soon...</p>
    </div>
</div>
