<?php
if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

$slug = isset($_GET['slug']) ? $_GET['slug'] : '';
if (empty($slug)) {
    header('Location: ?page=work');
    exit;
}

// TODO: Implement getProjectBySlug() function
$project = [
    'title' => 'Sample Project',
    'description' => 'Detailed project description goes here.',
    'cover_image' => 'project1',
    'gallery' => ['image1', 'image2', 'image3'],
    'video_url' => 'https://example.com/video.mp4',
    'video_poster' => 'video-poster'
];
?>

<!-- Project Content -->
<div class="container py-5">
    <h1><?php echo htmlspecialchars($project['title']); ?></h1>
    
    <!-- Cover Image -->
    <picture class="mb-4 d-block">
        <source srcset="https://res.cloudinary.com/ay-marketing/image/upload/f_auto,q_auto,w_1200/<?php echo $project['cover_image']; ?>.jpg" media="(min-width: 992px)">
        <img 
            src="https://res.cloudinary.com/ay-marketing/image/upload/f_auto,q_auto,w_400,e_blur:1000/<?php echo $project['cover_image']; ?>.jpg"
            data-src="https://res.cloudinary.com/ay-marketing/image/upload/f_auto,q_auto,w_800/<?php echo $project['cover_image']; ?>.jpg"
            alt="<?php echo htmlspecialchars($project['title']); ?>"
            class="img-fluid"
            loading="lazy"
            width="800"
            height="600"
        >
    </picture>

    <div class="mb-4">
        <?php echo nl2br(htmlspecialchars($project['description'])); ?>
    </div>

    <?php if (!empty($project['gallery'])): ?>
    <div id="projectGallery" class="carousel slide mb-4" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php foreach ($project['gallery'] as $index => $image): ?>
            <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                <img 
                    src="https://res.cloudinary.com/ay-marketing/image/upload/f_auto,q_auto,w_800/<?php echo $image; ?>.jpg"
                    class="d-block w-100"
                    alt="Gallery image"
                    loading="lazy"
                >
            </div>
            <?php endforeach; ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#projectGallery" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#projectGallery" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>
    <?php endif; ?>

    <?php if (!empty($project['video_url'])): ?>
    <div class="ratio ratio-16x9">
        <video 
            controls
            poster="https://res.cloudinary.com/ay-marketing/image/upload/f_auto,q_auto,w_800/<?php echo $project['video_poster']; ?>.jpg"
            preload="none"
        >
            <source src="<?php echo htmlspecialchars($project['video_url']); ?>" type="video/mp4">
        </video>
    </div>
    <?php endif; ?>

    <div class="text-center mt-4">
        <a href="?page=work" class="btn btn-primary">Back to Portfolio</a>
    </div>
</div>