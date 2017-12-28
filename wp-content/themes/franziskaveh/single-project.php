<?php
/**
 * The template for displaying single Project post.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Franziska_Veh
 */

get_header(); ?>

<div class="container">
	<?php include( locate_template( 'template-parts/navigation.php' ) ); ?>

	<div class="top-header-wrap row show">
		<div class="icon-holder"><i class="material-icons">close</i></div>
		<h2 class="center-align project-header">
			<?= the_title(); ?>
		</h2>
	</div>

	<div class="row">
		<div class="col s12 l12 m12 pad in-view">
			<?php if ( strpos( get_the_post_thumbnail_url( null, 'full' ), '.gif' ) !== false ):  ?>
				<?= get_the_post_thumbnail( null, 'full' ) ?>
			<?php else: ?>
				<?= get_the_post_thumbnail( null, 'full-size' ) ?>
			<?php endif; ?>

			<div class="type col s12 m12 l12"><?php echo types_render_field( 'category-title', array( 'id' => get_the_ID() ) ); ?></div>

			<div class="description col s12 m12 l8 offset-l2">
				<?= the_content() ?>
			</div>

		</div>
	</div>

	<?php
		$images = get_field( 'gallery_image' );

		if ( ! empty( $images ) ):
	?>


	<div class="row">
		<?php foreach ( $images as $image ): ?>
			<?php
				if ( ! $image['full_width_text'] ) :
					$size = $image['image_size'] == 'full' ? 'full-size' : 'half-size';

					$is_gif_image = false;
					if ( strpos( wp_get_attachment_image_url( $image['image']['id'], 'full' ), '.gif' ) !== false ) {
						$size = 'full';
						$is_gif_image = true;
					}

					$img_src = wp_get_attachment_image_url( $image['image']['id'], $size );
					$img_srcset = wp_get_attachment_image_srcset( $image['image']['id'], $size );
				?>
				<div class="<?= $image['image_size'] ?> col s12 <?php if ( $image['image_size'] != 'full' ): ?>l6 m6<?php endif; ?> to-animate">
					<img src="<?php echo esc_url( $img_src ); ?>"
						 <?php if ( ! $is_gif_image ): ?>srcset="<?php echo esc_attr( $img_srcset ); ?>"<?php endif; ?>
						 alt="<?= $image['image']['alt']; ?>"
						 <?php if ( ! $is_gif_image ): ?>sizes="(max-width: <?= $image['image']['sizes'][$size.'-width'] ?>px) 100vw, <?= $image['image']['sizes'][$size.'-width'] ?>px"<?php endif; ?>>
					<div class="image-caption"><?php echo $image['image_caption']; ?></div>
				</div>
			<?php else: ?>
					<div class="full text-in-gallery col s12 to-animate">
						<?php echo $image['full_width_text'] ?>
					</div>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>

	<?php
		endif;

		$credits = types_render_field( 'credits', array( 'id' => get_the_ID() ) );
	?>

	<div class="row">
		<?php if ( $credits ): ?>
		<div class="credits-holder col s12 l12 m12 to-animate">
			<div>
				<div class="expand">
					<span class="credits_title">Credits</span>
					<span class="bottom-border"></span>
				</div>
			</div>

			<div class="expandable credits col s12 m12 l8 offset-l2">
				<?= $credits ?>
			</div>
		</div>
		<?php endif; ?>

		<div class="col s12 l12 m12 to-animate">
			<p class="back col s12 m12 l8 offset-l2">
				<a href="javascript:history.back()"> &lt; Back </a>
			</p>
		</div>
	</div>

</div>

<?php
get_footer();
