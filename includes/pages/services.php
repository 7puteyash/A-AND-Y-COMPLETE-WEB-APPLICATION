<?php
if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}
?>
<!-- Services Hero -->
<section class="page-hero py-5 bg-dark">
    <div class="container">
        <h1 class="section-title text-center">Our Services</h1>
        <p class="lead text-center mb-0">Comprehensive Digital Solutions for Your Business</p>
    </div>
</section>

<!-- Services Grid -->
<section class="services-grid py-5">
    <div class="container">
        <div class="row">
            <?php
            // TODO: DYNAMIC SERVICES
            $services = [
                [
                    'icon' => 'fas fa-code',
                    'title' => 'Web Development',
                    'description' => 'Custom websites that drive results'
                ],
                [
                    'icon' => 'fas fa-paint-brush',
                    'title' => 'UI/UX Design',
                    'description' => 'Beautiful and functional designs'
                ],
                [
                    'icon' => 'fas fa-chart-line',
                    'title' => 'Digital Marketing',
                    'description' => 'Results-driven marketing strategies'
                ],
                [
                    'icon' => 'fas fa-mobile-alt',
                    'title' => 'Mobile Development',
                    'description' => 'Native and cross-platform apps'
                ],
                [
                    'icon' => 'fas fa-search',
                    'title' => 'SEO Optimization',
                    'description' => 'Improve your search rankings'
                ],
                [
                    'icon' => 'fas fa-comments',
                    'title' => 'Social Media',
                    'description' => 'Engage with your audience'
                ]
            ];
            
            foreach ($services as $service): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 p-4">
                        <i class="<?php echo $service['icon']; ?> fa-3x mb-3 text-gold"></i>
                        <h3 class="h4 mb-3"><?php echo $service['title']; ?></h3>
                        <p class="mb-3"><?php echo $service['description']; ?></p>
                        <a href="/contact" class="btn btn-primary mt-auto">Learn More</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Process Section -->
<section class="process py-5 bg-darker">
    <div class="container">
        <h2 class="section-title text-center mb-5">Our Process</h2>
        <div class="row">
            <?php
            $steps = [
                ['number' => '01', 'title' => 'Discovery', 'description' => 'Understanding your needs'],
                ['number' => '02', 'title' => 'Planning', 'description' => 'Creating the roadmap'],
                ['number' => '03', 'title' => 'Execution', 'description' => 'Bringing ideas to life'],
                ['number' => '04', 'title' => 'Delivery', 'description' => 'Launch and support']
            ];
            
            foreach ($steps as $step): ?>
                <div class="col-md-3 mb-4">
                    <div class="process-step text-center">
                        <div class="step-number mb-3"><?php echo $step['number']; ?></div>
                        <h3 class="h5 mb-3"><?php echo $step['title']; ?></h3>
                        <p class="mb-0"><?php echo $step['description']; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="cta py-5">
    <div class="container text-center">
        <h2 class="mb-4">Ready to Transform Your Business?</h2>
        <p class="lead mb-4">Let's discuss how we can help you achieve your goals</p>
        <a href="/contact" class="btn btn-primary btn-lg">Get Started</a>
    </div>
</section>
<div class="container">
    <h1 class="mb-4">Our Services</h1>
    <div class="row">
        <!-- Service content will go here -->
        <p class="lead">Content coming soon...</p>
    </div>
</div>
