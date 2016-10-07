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
	<?php $active_category = single_cat_title( '', false ); ?>
	<?php include( locate_template( 'template-parts/navigation.php' ) ); ?>

	<div class="top-header-wrap show valign-wrapper row">
		<h2>
			<?= strip_tags ( category_description(), '<br>' ); ?>
		</h2>
	</div>

	<div id="bricklayer" class="bricklayer three-columns">
		<?php
			if ( have_posts() ) :

			while ( have_posts() ) : the_post();
				$category = strtolower ( single_cat_title( '', false ) );
				$category_image = get_field( 'category_image_' . $category );
				if ( $category_image ) {
					$size = 'one-third';
					$img_src = wp_get_attachment_image_url( $category_image['id'], $size );
					$img_srcset = wp_get_attachment_image_srcset( $category_image['id'], $size );
				}
		?>
			<div class="project-item animation-element bounce-up in-view">
				<a href="<?= get_the_permalink() ?>" title="<?= the_title() ?>"></a>

				<?php if ( $category_image ): ?>
					<img src="<?php echo esc_url( $img_src ); ?>"
						 srcset="<?php echo esc_attr( $img_srcset ); ?>"
						 alt="<?= $category_image['alt']; ?>"
						 sizes="(max-width: <?= $category_image['sizes'][$size.'-width'] ?>px) 100vw, <?= $category_image['sizes'][$size.'-width'] ?>px">
				<?php else: ?>
					<?= get_the_post_thumbnail( null, 'one-third' ) ?>
				<?php endif; ?>

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
