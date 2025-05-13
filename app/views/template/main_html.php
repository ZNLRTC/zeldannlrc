<!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="<?= isset($html_description) ? $this->escapeHtml( $html_description ) : '' ?>" >
        <title> <?php echo $this->escapeHtml( $html_title ); ?></title>
        <!-- favicon -->
        <link rel="shortcut icon" href="<?php echo BASE_URL_ASSETS; ?>images/favicon.ico" />
        <link rel="stylesheet" href="<?php echo BASE_URL_ASSETS; ?>template/vendors/fontawesome/css/brands.min.css">
        <link rel="stylesheet" href="<?php echo BASE_URL_ASSETS; ?>template/vendors/fontawesome/css/solid.css">
        <link rel="stylesheet" href="<?php echo BASE_URL_ASSETS; ?>template/vendors/fontawesome/css/all.css">
        <link rel="stylesheet" href="<?php echo BASE_URL_ASSETS; ?>template/vendors/fontawesome/css/solid.min.css">
        <link rel="stylesheet" href="<?php echo BASE_URL_ASSETS; ?>bootstrap/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL_ASSETS; ?>dataTables/css/jquery.dataTables.css" />
        <link rel="stylesheet" href="<?php echo BASE_URL_ASSETS; ?>template/css/fonts.css">

        <?php if(isset($is_blog_post)): ?>
            <!-- Open Graph meta tags for Facebook sharing, please make sure you know how this works before editing -->
            <meta property="og:title" content="<?= $blog['title'] ?>" />
            <meta property="og:description" content="Click for more details" />
            <meta property="og:image" content="<?= $blog['image'] != NULL ? BASE_URL_ASSETS .'images/blogs/'. $blog['image'] : BASE_URL_ASSETS .'images/blogs/blogs-fall-back-image.jpg' ?>" />
            <meta property="og:url" content="<?= BASE_URL . 'blogs/blog?id=' . $blog['id'] ?>" />
            <meta property="og:type" content="article" />
            <meta property="fb:app_id" content="554186593802735" />
        <?php endif ?>
        

        <!-- custumized head-->

        <?php 
            date_default_timezone_set('Asia/Manila');
            echo $html_head;
        ?>

    </head>

    <?= $html_body ?>

    <script>var base_url = "<?= BASE_URL ?>"</script>

    <script type="text/javascript" src="<?php echo BASE_URL_ASSETS; ?>js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL_ASSETS; ?>js/popper.min.js"></script> 
    <script type="text/javascript" src="<?php echo BASE_URL_ASSETS; ?>dataTables/js/jquery.dataTables.js" defer></script> 
    // <script type="text/javascript" src="<?php echo BASE_URL_ASSETS; ?>bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL_ASSETS; ?>bootstrap/js/bootstrap.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <?= isset($html_footer) ? $html_footer : '' ?>

</html>

