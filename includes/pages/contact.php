<?php
if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

// Load security manager
require_once dirname(__DIR__, 2) . '/src/includes/security.php';

// Generate CSRF token
$csrfToken = SecurityManager::generateCSRFToken();
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
                
                <!-- Success/Error Messages -->
                <div id="form-messages" class="alert" style="display: none;"></div>
                
                <form id="contactForm" class="contact-form">
                    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrfToken); ?>">
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Your Name *</label>
                        <input type="text" class="form-control" id="name" name="name" required 
                               autocomplete="name" minlength="2" maxlength="100">
                        <div class="invalid-feedback"></div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address *</label>
                        <input type="email" class="form-control" id="email" name="email" required 
                               autocomplete="email" maxlength="150">
                        <div class="invalid-feedback"></div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number *</label>
                        <input type="tel" class="form-control" id="phone" name="phone" required 
                               autocomplete="tel" pattern="[\+]?[1-9][\d]{0,15}" maxlength="20">
                        <div class="invalid-feedback">Please enter a valid phone number</div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="message" class="form-label">Your Message *</label>
                        <textarea class="form-control" id="message" name="message" rows="5" required 
                                  minlength="10" maxlength="1000"></textarea>
                        <div class="form-text">Minimum 10 characters required</div>
                        <div class="invalid-feedback"></div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary" id="submit-btn">
                        <span class="btn-text">Send Message</span>
                        <span class="spinner-border spinner-border-sm d-none" role="status"></span>
                    </button>
                </form>
            </div>
            <div class="col-lg-6">
                <h2 class="h3 mb-4">Contact Information</h2>
                <div class="contact-info">
                    <div class="mb-4">
                        <h3 class="h5"><i class="fas fa-map-marker-alt me-2"></i>Location</h3>
                        <p>123 Business Street<br>
                        City, State 12345<br>
                        United States</p>
                    </div>
                    <div class="mb-4">
                        <h3 class="h5"><i class="fas fa-phone me-2"></i>Phone</h3>
                        <p>+1 (555) 123-4567</p>
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
