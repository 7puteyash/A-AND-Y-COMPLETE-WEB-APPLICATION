<?php
if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}
?>
<!-- Contact Hero -->
<section class="page-hero py-5 bg-dark">
    <div class="container">
        <h1 class="section-title text-center">Contact Us</h1>
        <p class="lead text-center mb-0">Let's Start a Conversation</p>
    </div>
</section>

<!-- Contact Form Section -->
<section class="contact-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-4">
                <h2 class="h3 mb-4">Get in Touch</h2>
                <!-- TODO: DYNAMIC CONTACT FORM HANDLING -->
                <form id="contactForm" class="contact-form" method="post" action="">
                    <div class="mb-3">
                        <label for="name" class="form-label">Your Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject</label>
                        <input type="text" class="form-control" id="subject" name="subject" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Your Message</label>
                        <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>
            <div class="col-lg-6">
                <h2 class="h3 mb-4">Contact Information</h2>
                <div class="contact-info">
                    <div class="mb-4">
                        <h3 class="h5"><i class="fas fa-map-marker-alt me-2"></i>Location</h3>
                        <p><!-- TODO: DYNAMIC ADDRESS --></p>
                    </div>
                    <div class="mb-4">
                        <h3 class="h5"><i class="fas fa-phone me-2"></i>Phone</h3>
                        <p><!-- TODO: DYNAMIC PHONE --></p>
                    </div>
                    <div class="mb-4">
                        <h3 class="h5"><i class="fas fa-envelope me-2"></i>Email</h3>
                        <p><!-- TODO: DYNAMIC EMAIL --></p>
                    </div>
                    <div class="mb-4">
                        <h3 class="h5"><i class="fas fa-clock me-2"></i>Working Hours</h3>
                        <p><!-- TODO: DYNAMIC WORKING HOURS --></p>
                    </div>
                </div>
                <div class="social-links mt-4">
                    <h3 class="h5 mb-3">Follow Us</h3>
                    <a href="#" class="me-3"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="me-3"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="me-3"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="me-3"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="map-section">
    <div class="container-fluid p-0">
        <!-- TODO: DYNAMIC MAP INTEGRATION -->
        <div id="map" style="height: 400px;">
            <!-- Map will be loaded here -->
        </div>
    </div>
</section>
<div class="container">
    <h1 class="mb-4">Contact Us</h1>
    <div class="row">
        <!-- Contact form will go here -->
        <p class="lead">Content coming soon...</p>
    </div>
</div>
