<?php
if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

// Include head section
require_once INCLUDES_PATH . 'head.php';
?>
<body>
    <!-- Premium Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <img src="assets/images/A&Y pvt Ltd.jpg" alt="A&Y Digital Excellence Logo" class="navbar-logo me-2">
                <span class="text-gradient">A&Y</span> Digital Excellence
            </a>
            
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars text-accent"></i>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php foreach ($valid_pages as $page => $title): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_page === $page) ? 'active' : ''; ?>" 
                           href="?page=<?php echo $page; ?>">
                            <?php echo $title; ?>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content Container -->
    <main class="main-content">
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main class="container py-4">
