<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Franziska_Veh
 */

get_header(); ?>

<header>
    <a href="/">
        <h1>Franziska Veh</h1>
    </a>
    <?php get_template_part( 'template-parts/filters' ); ?>
</header>

<div class="container">
	<?php $active_category = 'filter' ?>
	<?php include( locate_template( 'template-parts/navigation.php' ) ); ?>

	<div class="top-header-wrap show valign-wrapper row">
		<h2>
			Franziska is an Berlin based Art Director, with a focus on branding and data vizualisation.
		</h2>
	</div>

	<!-- Grid layer for displaying projects -->
	<div id="bricklayer" class="bricklayer two-columns">

        <?php
            $args = array(
                'posts_per_page' => -1,
                'post_status'    => 'publish',
                'post_type'      => 'project',
                'orderby'        => 'date',
                'order'          => 'desc',
                'fields'         => 'ids'
            );
            $loop = new WP_Query( $args );

            while ( $loop->have_posts() ) : $loop->the_post();

        ?>

        <div class="project-item columns-2 animation-element bounce-up in-view">
            <a href="<?= get_the_permalink() ?>" title="<?= the_title() ?>"></a>
            <?= get_the_post_thumbnail() ?>
            <h4><?php echo types_render_field( 'category-title', array( 'id' => get_the_ID() ) ); ?></h4>
            <h2><?= the_title(); ?></h2>
            <p class="project-info"><?= get_the_excerpt() ?></p>
        </div>

        <?php endwhile; ?>

	</div>
	<!-- End of Grid layer -->
</div>

<?php
get_footer();
