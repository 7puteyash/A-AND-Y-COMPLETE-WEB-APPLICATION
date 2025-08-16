// A&Y Digital Excellence - Premium JavaScript Interactions
// Copyright (c) 2024 A&Y Web Application

class AYDigital {
    constructor() {
        this.initializeScrollEffects();
        this.initializeAnimations();
        this.initializeInteractiveElements();
        this.initializeLoadingScreen();
        this.initializeParticleBackground();
        this.initializeFormEnhancements();
        this.initializeNavigationEffects();
    }

    // =====================================
    // LOADING SCREEN SYSTEM
    // =====================================
    initializeLoadingScreen() {
        const loadingScreen = document.createElement('div');
        loadingScreen.id = 'loading-screen';
        loadingScreen.innerHTML = `
            <div class="loading-content">
                <div class="loading-logo">
                    <h1 class="loading-title">A&Y</h1>
                    <div class="loading-subtitle">Digital Excellence</div>
                </div>
                <div class="loading-progress">
                    <div class="loading-bar"></div>
                </div>
                <div class="loading-percentage">0%</div>
            </div>
        `;
        document.body.prepend(loadingScreen);

        // Simulate loading progress
        let progress = 0;
        const loadingBar = loadingScreen.querySelector('.loading-bar');
        const loadingPercentage = loadingScreen.querySelector('.loading-percentage');

        const progressInterval = setInterval(() => {
            progress += Math.random() * 15 + 5;
            if (progress > 100) {
                progress = 100;
                clearInterval(progressInterval);
                
                setTimeout(() => {
                    loadingScreen.style.opacity = '0';
                    setTimeout(() => {
                        loadingScreen.remove();
                        this.showContent();
                    }, 500);
                }, 300);
            }
            
            loadingBar.style.width = progress + '%';
            loadingPercentage.textContent = Math.floor(progress) + '%';
        }, 100);
    }

    showContent() {
        document.body.classList.add('loaded');
        this.animateElements();
    }

    // =====================================
    // SCROLL EFFECTS & PARALLAX
    // =====================================
    initializeScrollEffects() {
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-in');
                }
            });
        }, observerOptions);

        // Observe all animatable elements
        const animatableElements = document.querySelectorAll(
            '.fade-up, .slide-in, .scale-in, .card, .service-icon, .portfolio-item'
        );
        animatableElements.forEach(el => observer.observe(el));

        // Scroll effects
        window.addEventListener('scroll', () => {
            const scrollY = window.pageYOffset;
            
            // Hero parallax
            const hero = document.querySelector('.hero');
            if (hero) {
                hero.style.transform = `translateY(${scrollY * 0.5}px)`;
            }

            // Navigation effects
            const navbar = document.querySelector('.navbar');
            if (navbar) {
                if (scrollY > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            }

            // Progress bar
            const scrollPercent = scrollY / (document.body.scrollHeight - window.innerHeight);
            this.updateProgressBar(scrollPercent);
        });
    }

    updateProgressBar(percent) {
        let progressBar = document.querySelector('.scroll-progress-bar');
        if (!progressBar) {
            progressBar = document.createElement('div');
            progressBar.className = 'scroll-progress-bar';
            document.body.appendChild(progressBar);
        }
        progressBar.style.width = `${percent * 100}%`;
    }

    // =====================================
    // PARTICLE BACKGROUND
    // =====================================
    initializeParticleBackground() {
        const canvas = document.createElement('canvas');
        canvas.id = 'particle-canvas';
        canvas.style.cssText = `
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        `;
        document.body.appendChild(canvas);

        const ctx = canvas.getContext('2d');
        const particles = [];
        const particleCount = 50;

        function resizeCanvas() {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        }
        resizeCanvas();
        window.addEventListener('resize', resizeCanvas);

        class Particle {
            constructor() {
                this.x = Math.random() * canvas.width;
                this.y = Math.random() * canvas.height;
                this.size = Math.random() * 2 + 1;
                this.speedX = (Math.random() - 0.5) * 0.5;
                this.speedY = (Math.random() - 0.5) * 0.5;
                this.opacity = Math.random() * 0.5 + 0.2;
            }

            update() {
                this.x += this.speedX;
                this.y += this.speedY;

                if (this.x < 0 || this.x > canvas.width) this.speedX *= -1;
                if (this.y < 0 || this.y > canvas.height) this.speedY *= -1;
            }

            draw() {
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
                ctx.fillStyle = `rgba(212, 175, 55, ${this.opacity})`;
                ctx.fill();
            }
        }

        // Initialize particles
        for (let i = 0; i < particleCount; i++) {
            particles.push(new Particle());
        }

        function animate() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            
            particles.forEach(particle => {
                particle.update();
                particle.draw();
            });

            // Draw connections
            for (let i = 0; i < particles.length; i++) {
                for (let j = i + 1; j < particles.length; j++) {
                    const dx = particles[i].x - particles[j].x;
                    const dy = particles[i].y - particles[j].y;
                    const distance = Math.sqrt(dx * dx + dy * dy);

                    if (distance < 100) {
                        ctx.beginPath();
                        ctx.moveTo(particles[i].x, particles[i].y);
                        ctx.lineTo(particles[j].x, particles[j].y);
                        ctx.strokeStyle = `rgba(212, 175, 55, ${0.1 * (1 - distance / 100)})`;
                        ctx.stroke();
                    }
                }
            }

            requestAnimationFrame(animate);
        }
        animate();
    }

    // =====================================
    // INTERACTIVE ELEMENTS
    // =====================================
    initializeInteractiveElements() {
        // Enhanced button hover effects
        document.querySelectorAll('.btn').forEach(btn => {
            btn.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px) scale(1.05)';
                this.style.boxShadow = '0 10px 30px rgba(212, 175, 55, 0.3)';
            });

            btn.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
                this.style.boxShadow = 'none';
            });
        });

        // Card hover effects
        document.querySelectorAll('.card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-10px) rotateX(5deg)';
                this.style.boxShadow = '0 20px 40px rgba(0, 0, 0, 0.3)';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) rotateX(0deg)';
                this.style.boxShadow = '0 10px 30px rgba(0, 0, 0, 0.1)';
            });
        });

        // Portfolio item effects
        document.querySelectorAll('.portfolio-item').forEach(item => {
            item.addEventListener('mouseenter', function() {
                const overlay = this.querySelector('.portfolio-overlay');
                if (overlay) {
                    overlay.style.opacity = '1';
                    overlay.style.transform = 'scale(1)';
                }
            });

            item.addEventListener('mouseleave', function() {
                const overlay = this.querySelector('.portfolio-overlay');
                if (overlay) {
                    overlay.style.opacity = '0';
                    overlay.style.transform = 'scale(0.9)';
                }
            });
        });
    }

    // =====================================
    // FORM ENHANCEMENTS
    // =====================================
    initializeFormEnhancements() {
        const contactForm = document.getElementById('contactForm');
        if (contactForm) {
            this.initializeContactForm();
        }

        document.querySelectorAll('input, textarea').forEach(field => {
            field.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
            });

            field.addEventListener('blur', function() {
                if (!this.value) {
                    this.parentElement.classList.remove('focused');
                }
            });

            field.addEventListener('input', this.validateField.bind(this));
        });
    }

    initializeContactForm() {
        const form = document.getElementById('contactForm');
        const submitBtn = document.getElementById('submit-btn');
        const messagesDiv = document.getElementById('form-messages');

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            this.clearValidationErrors();
            this.showLoading(true);
            
            const formData = new FormData(form);
            
            try {
                const response = await fetch('src/api/contact.php', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                
                const data = await response.json();
                
                if (response.ok && data.status === 'success') {
                    this.showMessage(data.message, 'success');
                    form.reset();
                } else {
                    if (data.messages && Array.isArray(data.messages)) {
                        this.showValidationErrors(data.messages);
                    } else {
                        this.showMessage(data.message || 'An error occurred', 'danger');
                    }
                }
                
            } catch (error) {
                this.showMessage('Network error. Please try again later.', 'danger');
            }
            
            this.showLoading(false);
        });

        form.querySelectorAll('input, textarea').forEach(field => {
            field.addEventListener('blur', () => this.validateField({ target: field }));
            field.addEventListener('input', () => {
                if (field.classList.contains('is-invalid')) {
                    this.validateField({ target: field });
                }
            });
        });
    }

    showLoading(loading) {
        const submitBtn = document.getElementById('submit-btn');
        const btnText = submitBtn.querySelector('.btn-text');
        const spinner = submitBtn.querySelector('.spinner-border');
        
        if (loading) {
            submitBtn.disabled = true;
            btnText.textContent = 'Sending...';
            spinner.classList.remove('d-none');
        } else {
            submitBtn.disabled = false;
            btnText.textContent = 'Send Message';
            spinner.classList.add('d-none');
        }
    }

    showMessage(message, type) {
        const messagesDiv = document.getElementById('form-messages');
        
        // Enhanced styling and animations
        messagesDiv.className = `alert alert-${type}`;
        messagesDiv.style.display = 'block';
        
        // Add icon and enhanced message for success
        if (type === 'success') {
            messagesDiv.innerHTML = `
                <div style="display: flex; align-items: center; justify-content: center; text-align: center;">
                    <div>
                        <div style="font-size: 1.1rem; font-weight: 600; margin-bottom: 0.5rem;">
                            ✨ Thank You! ✨
                        </div>
                        <div style="font-size: 0.95rem; opacity: 0.9;">
                            ${message}
                        </div>
                    </div>
                </div>
            `;
        } else {
            messagesDiv.textContent = message;
        }
        
        // Smooth scroll to message with better positioning
        messagesDiv.scrollIntoView({ 
            behavior: 'smooth', 
            block: 'center',
            inline: 'center' 
        });
        
        // Add a slight delay to ensure the message is visible after scroll
        setTimeout(() => {
            // Add focus for screen readers
            messagesDiv.setAttribute('role', 'alert');
            messagesDiv.setAttribute('aria-live', 'polite');
            
            // Add celebration effect for success messages
            if (type === 'success') {
                this.addCelebrationEffect();
            }
        }, 300);
        
        // Auto-hide success messages after longer duration (7 seconds)
        if (type === 'success') {
            setTimeout(() => {
                this.hideMessageGracefully();
            }, 7000);
        }
    }
    
    // Add celebration particle effect
    addCelebrationEffect() {
        const messagesDiv = document.getElementById('form-messages');
        
        // Create celebration particles
        for (let i = 0; i < 15; i++) {
            const particle = document.createElement('div');
            particle.style.cssText = `
                position: absolute;
                width: 8px;
                height: 8px;
                background: #ffd700;
                border-radius: 50%;
                pointer-events: none;
                z-index: 1000;
                animation: celebrationParticle 2s ease-out forwards;
            `;
            
            const rect = messagesDiv.getBoundingClientRect();
            particle.style.left = (rect.left + rect.width / 2) + 'px';
            particle.style.top = (rect.top + rect.height / 2) + 'px';
            
            // Random animation delay and direction
            particle.style.animationDelay = (i * 0.1) + 's';
            particle.style.setProperty('--dx', (Math.random() - 0.5) * 200 + 'px');
            particle.style.setProperty('--dy', (Math.random() - 0.5) * 200 + 'px');
            
            document.body.appendChild(particle);
            
            // Remove particle after animation
            setTimeout(() => particle.remove(), 2000);
        }
        
        // Add particle animation CSS if not exists
        if (!document.getElementById('celebration-styles')) {
            const style = document.createElement('style');
            style.id = 'celebration-styles';
            style.textContent = `
                @keyframes celebrationParticle {
                    0% {
                        transform: translate(0, 0) scale(1);
                        opacity: 1;
                    }
                    100% {
                        transform: translate(var(--dx), var(--dy)) scale(0);
                        opacity: 0;
                    }
                }
            `;
            document.head.appendChild(style);
        }
    }
    
    // Graceful message hiding
    hideMessageGracefully() {
        const messagesDiv = document.getElementById('form-messages');
        messagesDiv.style.transition = 'all 0.5s ease';
        messagesDiv.style.opacity = '0';
        messagesDiv.style.transform = 'translateY(-10px)';
        
        setTimeout(() => {
            messagesDiv.style.display = 'none';
            messagesDiv.style.opacity = '1';
            messagesDiv.style.transform = 'translateY(0)';
        }, 500);
    }

    showValidationErrors(errors) {
        errors.forEach(error => {
            this.showMessage(error, 'danger');
        });
    }

    clearValidationErrors() {
        document.querySelectorAll('.is-invalid').forEach(field => {
            field.classList.remove('is-invalid');
        });
        const messagesDiv = document.getElementById('form-messages');
        if (messagesDiv) messagesDiv.style.display = 'none';
    }

    validateField(event) {
        const field = event.target;
        const value = field.value.trim();
        let isValid = true;

        if (field.hasAttribute('required') && !value) {
            isValid = false;
        }

        if (value && field.type === 'email') {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            isValid = emailRegex.test(value);
        }

        field.classList.toggle('is-valid', isValid);
        field.classList.toggle('is-invalid', !isValid);
        
        return isValid;
    }

    // =====================================
    // NAVIGATION EFFECTS
    // =====================================
    initializeNavigationEffects() {
        document.querySelectorAll('a[href^="#"]').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    }

    // =====================================
    // ANIMATIONS & EFFECTS
    // =====================================
    initializeAnimations() {
        const statsSection = document.querySelector('.stats');
        if (statsSection) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        this.animateStats();
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });
            
            observer.observe(statsSection);
        }
    }

    animateStats() {
        const statNumbers = document.querySelectorAll('.stats .display-4');
        statNumbers.forEach(stat => {
            const target = parseInt(stat.textContent);
            let current = 0;
            const increment = target / 50;
            
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }
                stat.textContent = Math.floor(current) + (stat.textContent.includes('+') ? '+' : '');
            }, 40);
        });
    }

    animateElements() {
        const elements = document.querySelectorAll('.fade-up, .slide-in, .scale-in');
        elements.forEach((el, index) => {
            setTimeout(() => {
                el.classList.add('animate-in');
            }, index * 100);
        });
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new AYDigital();
});

// Performance optimization
window.addEventListener('load', () => {
    document.body.classList.add('fully-loaded');
});
