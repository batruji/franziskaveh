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

<div class="container category-page">
	<?php $active_category = single_cat_title( '', false ); ?>
	<?php include( locate_template( 'template-parts/navigation.php' ) ); ?>

	<div class="top-header-wrap show valign-wrapper row">
		<h2>
			<?php if ( category_description() ):; ?>
				<?= strip_tags ( category_description() ); ?>
			<?php else: ?>
				<?php echo types_render_field( 'all-categories-title', array( 'id' => '32' ) ); ?>
	        <?php endif; ?>
		</h2>
	</div>

	<div id="bricklayer" class="bricklayer three-columns">
		<?php
			if ( have_posts() ) :

			while ( have_posts() ) : the_post();
		?>
			<div class="project-item animation-element bounce-up in-view">
				<a href="<?= get_the_permalink() ?>" title="<?= the_title() ?>"></a>
				<?= get_the_post_thumbnail() ?>
				<h4><?php echo types_render_field( 'category-title', array( 'id' => get_the_ID() ) ); ?></h4>
				<h2><?= the_title(); ?></h2>
				<p class="project-info"><?= get_the_excerpt() ?></p>
			</div>

		<?php
			endwhile;

			endif;
		?>

	</div>
</div>

<?php
get_footer();
