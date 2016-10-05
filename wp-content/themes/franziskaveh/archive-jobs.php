<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Franziska_Veh
 */

get_header();
?>

<div class="container">
	<?php $active_category = 'filter'; ?>
	<?php include( locate_template( 'template-parts/navigation.php' ) ); ?>

	<div class="top-header-wrap show valign-wrapper row">
		<h2>
			<?= types_render_field( 'jobs-page-title', array( 'id' => '32' ) ) ?>
		</h2>
	</div>

	<div class="container">
		<div class="row">
			<?php
				if ( have_posts() ) :

				while ( have_posts() ) : the_post();
				$subtitle = types_render_field( 'subtitle', array( 'id' => get_the_ID() ) );
			?>
				<div class="jobs-entry">
					<h4><?= the_title() ?></h4>

					<?php if ( $subtitle ): ?>
						<h3><?php echo $subtitle; ?></h3>
					<?php endif; ?>

					<?= the_content() ?>
				</div>

			<?php
				endwhile;

				endif;
			?>

		</div>
	</div>
</div>

<?php
get_footer();
