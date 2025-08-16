<?php
if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}
?>
    </main>
    
    <!-- Premium Footer -->
    <footer class="bg-darker text-light py-5 mt-auto">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="footer-brand">
                        <h5 class="text-gradient mb-3">A&Y Digital Excellence</h5>
                        <p class="text-secondary">Transforming digital dreams into spectacular reality.</p>
                    </div>
                </div>
                <div class="col-md-6 text-end">
                    <div class="footer-links">
                        <p class="text-secondary mb-2">© <?php echo date('Y'); ?> A&Y Digital Excellence. All rights reserved.</p>
                        <p class="text-muted small">Designed with passion and precision</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="assets/js/main.js?v=<?php echo time(); ?>"></script>
    
    <!-- Initialize AOS -->
    <script>
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });
    </script>
</body>
</html>
