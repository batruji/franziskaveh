<?php
/**
 * The template for displaying single Project post.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Franziska_Veh
 */

get_header(); ?>

<div class="container digital project-page">
	<?php include( locate_template( 'template-parts/navigation.php' ) ); ?>

	<div class="top-header-wrap row show">
		<div class="icon-holder"><i class="material-icons">close</i></div>
		<h2 class="center-align project-header">
			<?= the_title(); ?>
		</h2>
	</div>

	<div class="row">
		<div class="col s12 l12 m12 pad in-view">
			<?= get_the_post_thumbnail() ?>

			<div class="type col s12 m12 l12"><?php echo types_render_field( 'category-title', array( 'id' => get_the_ID() ) ); ?></div>

			<div class="description col s12 m12 l8 offset-l2">
				<?= the_content() ?>
			</div>

		</div>
	</div>

	<?php
		$images = types_render_field( 'gallery-image', array( 'id' => get_the_ID(), 'separator' => '###' ) );
	 	$image_array = explode( '###', $images );

		if ( ! empty( $image_array ) ):
	?>


	<div class="row">
		<?php foreach ( $image_array as $index => $image ): ?>
			<div class="<?= $index % 2 == 0 ? 'left' : 'right' ?> col s12 l6 m6 to-animate">
				<?= $image ?>
			</div>
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
