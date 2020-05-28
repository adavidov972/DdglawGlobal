<?php get_header(); 

    while(have_posts()) {
        the_post();
?>

<div class="container mb-5 generic-content">

    <div class="d-flex mr-5 text-right flex-row-reverse">
        <div min-width="100%" height="auto" class="col-4 img-fluid"><?php the_post_thumbnail('partnerPortrait');?></div>

        <div class="col-8">
            <div class="partner-name"><?php echo "עו״ד " . get_the_title(); ?></div>
            <div><a class="partner-email"
                    href="mailto: <?php echo get_field('email') ?>"><?php echo get_field('email') ?></a></div>
        </div>

    </div>

    <div class="d-flex mt-5 mr-4 text-right flex-row-reverse">
        <div class="col text-justify opensans-40-bold content-rtl"><?php the_content(); ?></div>
    </div>

    <?php $relatedOccupations = get_field('related_occupations');

    if ($relatedOccupations) {?>

    <div class="d-flex mt-5 mr-4 text-right flex-row-reverse">
        <div class="col text-justify opensans-40-bold content-rtl"><u>תחומי עיסוק :</u></div>
    </div>

    <div class="d-flex mt-4 text-right flex-row-reverse">
        <ul class="text-right content-rtl profession-list">
            <?php foreach ($relatedOccupations as $occupation) { ?>
            <li class="my-2 profession-li"><a class="profession-link"
                    href="<?php echo get_the_permalink($occupation) ?>"><?php echo get_the_title($occupation) ?></a>
            </li>
            <?php } ?>
        </ul>
    </div>

    <hr class="section-break">

    <?php }    

echo '</div>';

}

get_footer(); ?>