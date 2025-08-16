<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <?php
    // Dynamic meta tags
    $pageTitle = isset($pageTitle) ? $pageTitle . ' - A&Y Digital Excellence' : 'A&Y Digital Excellence - Premium Digital Marketing Agency';
    $metaDescription = isset($metaDescription) ? $metaDescription : 'A&Y Digital Excellence - Your premium partner in digital marketing, web development, and creative solutions.';
    $ogImage = isset($ogImage) ? $ogImage : 'assets/images/og-default.jpg';
    ?>
    
    <title><?php echo htmlspecialchars($pageTitle); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($metaDescription); ?>">
    <meta name="keywords" content="digital marketing, web development, creative agency, A&Y, premium services, dark theme">
    <meta name="author" content="A&Y Digital Excellence">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="<?php echo htmlspecialchars($pageTitle); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($metaDescription); ?>">
    <meta property="og:image" content="<?php echo htmlspecialchars($ogImage); ?>">
    <meta property="og:type" content="website">
    
    <!-- Favicon - Using A&Y logo -->
    <link rel="icon" type="image/jpeg" href="assets/images/A&Y pvt Ltd.jpg">
    <link rel="apple-touch-icon" href="assets/images/A&Y pvt Ltd.jpg">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous">
    
    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Custom Premium Styles - DARK THEME -->
    <link rel="stylesheet" href="assets/css/premium-style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/custom.css?v=<?php echo time(); ?>">
    
    <!-- Custom Styles for Loading Screen -->
    <style>
        .loading {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #0a0b0f;
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .loading.fade-out {
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.5s ease, visibility 0.5s ease;
        }
        /* Force dark theme immediately */
        body {
            background-color: #0a0b0f !important;
            color: #ffffff !important;
        }
    </style>
</head>
