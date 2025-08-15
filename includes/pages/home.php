<?php
if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}
?>
<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <div class="hero-content text-center">
            <h1 class="display-1 mb-4 fade-up">Welcome to A&Y</h1>
            <p class="lead mb-4 fade-up">Transforming Digital Dreams into Reality</p>
            <a href="/contact" class="btn btn-primary btn-lg fade-up">Start Your Project</a>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="services py-5">
    <div class="container">
        <h2 class="section-title text-center mb-5">Our Services</h2>
        <div class="row"><?php
        // TODO: DYNAMIC SERVICES
        $services = [
            ['icon' => 'fas fa-code', 'title' => 'Web Development'],
            ['icon' => 'fas fa-paint-brush', 'title' => 'UI/UX Design'],
            ['icon' => 'fas fa-chart-line', 'title' => 'Digital Marketing']
        ];
        foreach ($services as $service): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100 text-center p-4">
                    <i class="<?php echo $service['icon']; ?> fa-3x mb-3 text-gold"></i>
                    <h3 class="h4 mb-3"><?php echo $service['title']; ?></h3>
                    <p><!-- TODO: DYNAMIC SERVICE DESCRIPTION --></p>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Featured Work -->
<section class="portfolio py-5 bg-darker">
    <div class="container">
        <h2 class="section-title text-center mb-5">Featured Projects</h2>
        <div class="row"><?php
        // TODO: DYNAMIC PROJECTS
        for ($i = 1; $i <= 3; $i++): ?>
            <div class="col-md-4 mb-4">
                <div class="portfolio-item">
                    <img src="/assets/images/project-<?php echo $i; ?>.jpg" alt="Project <?php echo $i; ?>" class="img-fluid">
                    <div class="portfolio-overlay">
                        <div class="portfolio-content text-center">
                            <h3 class="h5 mb-3">Project Title</h3>
                            <p class="mb-0">Category</p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endfor; ?>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="cta py-5">
    <div class="container text-center">
        <h2 class="mb-4">Ready to Start Your Project?</h2>
        <p class="lead mb-4">Let's create something amazing together</p>
        <a href="/contact" class="btn btn-primary btn-lg">Get Started</a>
    </div>
</section>
        <div class="col-md-4">
            <h3>Digital Excellence</h3>
            <p>We bring years of experience and expertise to help your business thrive in the digital world.</p>
        </div>
        <div class="col-md-4">
            <h3>Custom Solutions</h3>
            <p>Every business is unique. We create tailored strategies that match your specific needs and goals.</p>
        </div>
        <div class="col-md-4">
            <h3>Results Driven</h3>
            <p>Our focus is on delivering measurable results that contribute to your business growth.</p>
        </div>
    </div>
</div>
