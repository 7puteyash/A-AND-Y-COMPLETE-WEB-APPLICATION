<?php
if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

// Projects per page
$per_page = 9;
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// TODO: Implement getAllProjects() function
$projects = [
    [
        'id' => 1,
        'title' => 'Project One',
        'slug' => 'project-one',
        'description' => 'Digital transformation project',
        'cover_image' => 'project1',
        'category' => 'Web Development'
    ],
    // Add more sample projects
];

$total_projects = count($projects);
$total_pages = ceil($total_projects / $per_page);
$offset = ($current_page - 1) * $per_page;
$current_projects = array_slice($projects, $offset, $per_page);
?>

<!-- Portfolio Hero -->
<section class="page-hero py-5 bg-dark">
    <div class="container">
        <h1 class="section-title text-center">Our Work</h1>
        <p class="lead text-center mb-0">Showcasing Our Creative Excellence</p>
    </div>
</section>

<!-- Portfolio Grid -->
<section class="portfolio py-5">
    <div class="container">
        <div class="row g-4">
            <?php foreach ($current_projects as $project): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100">
                        <picture>
                            <source 
                                srcset="https://res.cloudinary.com/ay-marketing/image/upload/f_auto,q_auto,w_600/<?php echo $project['cover_image']; ?>.jpg"
                                media="(min-width: 768px)"
                            >
                            <source 
                                srcset="https://res.cloudinary.com/ay-marketing/image/upload/f_auto,q_auto,w_400/<?php echo $project['cover_image']; ?>.jpg"
                                media="(min-width: 400px)"
                            >
                            <img 
                                src="https://res.cloudinary.com/ay-marketing/image/upload/f_auto,q_auto,w_200,e_blur:1000/<?php echo $project['cover_image']; ?>.jpg"
                                data-src="https://res.cloudinary.com/ay-marketing/image/upload/f_auto,q_auto,w_400/<?php echo $project['cover_image']; ?>.jpg"
                                alt="<?php echo htmlspecialchars($project['title']); ?>"
                                class="card-img-top"
                                loading="lazy"
                                width="400"
                                height="300"
                            >
                        </picture>
                        <div class="card-body">
                            <h3 class="h5 card-title"><?php echo htmlspecialchars($project['title']); ?></h3>
                            <p class="card-text"><?php echo htmlspecialchars($project['category']); ?></p>
                            <a href="?page=project&slug=<?php echo urlencode($project['slug']); ?>" class="btn btn-primary">View Project</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Pagination -->
        <?php if ($total_pages > 1): ?>
            <nav aria-label="Portfolio navigation" class="mt-5">
                <ul class="pagination justify-content-center">
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <li class="page-item <?php echo ($i === $current_page) ? 'active' : ''; ?>">
                            <a class="page-link" href="?page=work&page=<?php echo $i; ?>">
                                <?php echo $i; ?>
                            </a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        <?php endif; ?>
    </div>
</section>
