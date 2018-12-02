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

	<div class="row">
		<div class="top-header-wrap show valign-wrapper row">
			<h2>
				<?= types_render_field( 'page-title', array( 'id' => get_the_ID() ) ) ?>
			</h2>
		</div>
	</div>

    <div class="row">
        <div class="about-text col l12 m12 s12">
            <?php the_content() ?>
        </div>
        <div class="col l12 m12 s12">
			<div class="client-projects">
				<h4><?= types_render_field( 'projects-and-clients-title', array( 'id' => get_the_ID() ) ) ?></h4>

				<?php
					$args = array(
						'posts_per_page' => -1,
						'post_status'    => 'publish',
						'post_type'      => 'about-client',
						'orderby'        => 'title',
						'order'          => 'asc',
						'fields'         => 'ids'
					);
					$loop = new WP_Query( $args );

					while ( $loop->have_posts() ) : $loop->the_post();

				?>

					<div class="projects-component col l6 m12 s12">
						<span class="title"><?= the_title() ?></span><br>
						<?php the_content() ?>
					</div>

				<?php endwhile; ?>
			</div>
        </div>
    </div>

</div>

<?php
get_footer();