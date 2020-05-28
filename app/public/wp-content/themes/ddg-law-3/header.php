<!DOCTYPE html>
<html lang="he" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php wp_head(); ?>
</head>

<body>

    <img src="<?php echo get_theme_file_uri('/images/menu-bcd_logo.png') ?>" class="top-banner" alt="DdgLaw-icon">
    <nav class="navbar navbar-expand">

        <ul class="navbar-nav navbar-expand-lg mx-auto pb-1">

        <li class="navbar-item">
                <?php 
                    if (is_user_logged_in()) { ?>
                        <a type="button" href="<?php echo wp_logout_url('/') ?>" class="btn btn-sm btn-danger mr-3" data-dismiss="modal">יציאה</a>
                    <?php } else { ?>
                   <? } ?>
            </li>

            <li class="navbar-item">
                <?php 

                    if (!is_user_logged_in()) { ?>
                        <a class="nav-link" href="<?php echo get_post_type_archive_link('notary') ?>"><i class="fas fa-lock"> נוטריון</i><span class="sr-only"></span></a>
                    <?php } else { ?>
                        <a class="nav-link" href="<?php echo get_post_type_archive_link('notary') ?>"><i class="fas fa-lock"> נוטריון</i><span class="sr-only"></span></a>

                   <? } ?>
            </li>

            <li class="navbar-item">
                <a class="nav-link" href="#footer">צור קשר <span class="sr-only">(current)</span></a>
            </li>

            <li class="navbar-item">
                <a class="nav-link" href="#">מאמרים<span class="sr-only">(current)</span></a>
            </li>

            <li class="navbar-item">
                <a class="nav-link" href="#">השותפים<span class="sr-only">(current)</span></a>
            </li>

            <li class="navbar-item">
                <a class="nav-link" href="#">תחומי עיסוק<span class="sr-only">(current)</span></a>
            </li>

            <li class="navbar-item">
                <a class="nav-link" href="#">אודות<span class="sr-only">(current)</span></a>
            </li>

            <li class="navbar-item">
                <a class="nav-link" href="/">ראשי<span class="sr-only">(current)</span></a>
            </li>
        </ul>
    </nav>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
        </ul>
    </div>