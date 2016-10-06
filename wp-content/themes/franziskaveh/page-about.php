<?php
/**
 * Template Name: About Page
 *
 * @package Franziska_Veh
 */

get_header();
?>

<div class="container about">
    <?php $activated = 'about'; ?>
    <?php $active_category = 'filter' ?>
    <?php include( locate_template( 'template-parts/navigation.php' ) ); ?>

    <div class="row padding-top-about">
        <div class="col left l6 m12 s12">
            <h4><?= the_title() ?></h4>
            <?= the_content() ?>
        </div>
        <div class="col right l6 m12 s12">
            <h4><?= types_render_field( 'projects-and-clients-title', array( 'id' => get_the_ID() ) ) ?></h4>

            <?php
                $args = array(
                    'posts_per_page' => -1,
                    'post_status'    => 'publish',
                    'post_type'      => 'about-client',
                    'orderby'        => 'date',
                    'order'          => 'desc',
                    'fields'         => 'ids'
                );
                $loop = new WP_Query( $args );

                while ( $loop->have_posts() ) : $loop->the_post();

            ?>

                <div class="projects-component">
                    <span class="title"><?= the_title() ?></span><br>
                    <?= the_content() ?>
                </div>

            <?php endwhile; ?>
        </div>
    </div>

</div>

<?php
get_footer();