<?php get_header(); ?>


<?php
if (have_posts()) {
    while (have_posts()) {
        the_post(); ?>
        <div class="page-banner">
            <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/inc/images/ocean.jpg') ?>);"></div>
            <div class="page-banner__content container container--narrow">
                <h1 class="page-banner__title"><?php the_title(); ?>
                </h1>
                <div class="page-banner__intro">
                    <p>DONT FORGET TO REPLACE ME LATER</p>
                </div>
            </div>
        </div>
        <div class="container container--narrow page-section">
            <div class="metabox metabox--position-up metabox--with-home-link">
                <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('event') ?>"><i class="fa fa-home" aria-hidden="true"></i> Event Home</a>
                    <span class=" metabox__main"><?php echo get_the_title() ?></span></p>
            </div>

            <div class="generic-content">
                <div class="hover6">
                    <div class="hover07 column ">
                        <figure><?php the_post_thumbnail('medium-large') ?>
                        </figure>
                    </div>
                </div>
                <p><?php the_content(); ?></p>
            </div>

            <?php
            $Eventstartdate = new DateTime(get_field('event_date'));
            $EventEnddate = new DateTime(get_field('event_end_time'));
            $interval = $Eventstartdate->diff($EventEnddate);
            //echo $interval->format('%d Days-%H Hours-%i Minutes');
            ?>
            <div class="container">
                <h2 class="text-center">EVENT DETAILS</h2>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>EVENT INFORMATIONS</th>
                        <th>EVENT DETAILS</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="evnt_table_info"><strong>EVENT START DATE</strong></td>
                        <td><?php the_field('event_date'); ?> </td>
                    </tr>
                    <tr>
                        <td class="evnt_table_info"><strong>EVENT END DATE</strong></td>
                        <td><?php the_field('event_end_time'); ?></td>
                    </tr>
                    <tr>
                        <td class="evnt_table_info"><strong>EVENT DURATIONS</strong></td>
                        <td><?php if ($interval->d > 1) {
                                echo $interval->format('%d Days-%H Hours-%i Minutes');
                            } elseif ($interval->d < 1) {
                                echo $interval->format('%H Hours-%i Minutes');
                            } else {
                                echo $interval->format('%d Day-%H Hours-%i Minutes');
                            } ?>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </div>

        <?php
    }
}
?>

<?php get_footer();
