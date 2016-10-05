<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Franziska_Veh
 */

get_header(); ?>

<div class="container">
	<?php $category = 'filter'; ?>
	<?php include( locate_template( 'template-parts/navigation.php' ) ); ?>

	<div class="container">
		<div class="row">
			<div class="top-header-wrap show valign-wrapper row">
				<h2>
					<?= the_title(); ?>
				</h2>
			</div>
		</div>

		<div class="row">
			<?= the_content() ?>
		</div>
	</div>

</div>

<?php
get_footer();
