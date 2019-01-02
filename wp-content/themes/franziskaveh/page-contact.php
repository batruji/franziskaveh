<?php
/**
 * Template Name: Contact Page
 *
 * @package Franziska_Veh
 */

get_header();
?>

<div class="container">
    <?php $activated = 'contact'; ?>
    <?php $active_category = 'filter' ?>
    <?php include( locate_template( 'template-parts/navigation.php' ) ); ?>

    <div class="contact">

		<div class="row">
			<div class="top-header-wrap show valign-wrapper row">
				<h2>
					<?= types_render_field( 'contact-page-title', array( 'id' => get_the_ID() ) ) ?>
				</h2>
			</div>
		</div>

        <div class="row">
            <div class="col s12 m12 l12">
				<h2>Rudolfstrasse 11<br>10245 Berlin<br><a href="mailto:hello@franziskaveh.com" target="_blank">hello@franziskaveh.com</a><br>+49 176 78 16 47 76</h2>
                <h2>
                    <a href="https://instagram.com/franziskaveh/" target="_blank">Instagram</a>
                    <br>
                    <a href="https://twitter.com/franziskaveh/" target="_blank">Twitter</a>
                </h2>
            </div>

			<?php
			// do we have active Job offers?
			$args = array(
				'posts_per_page' => -1,
				'post_status'    => 'publish',
				'post_type'      => 'jobs',
				'fields'         => 'ids'
			);
			$loop = new WP_Query( $args );

			if ( $loop->have_posts() ):
				?>
				<div class="col s12 m12 l12">
					<a href="<?= site_url( 'jobs' ) ?>"><h2>Jobs <img src="/wp-content/themes/franziskaveh/octopus.svg" class="octopus"></h2></a>
				</div>
			<?php endif; ?>

			<div class="col s12 m12 l12">

				<?php the_field( 'image_embed_code' ); ?>

				<a class="spotify-link" href="<?php the_field( 'spotify_list_url' ); ?>" target="_blank" rel="nofollow">Listen on spotify</a>

			</div>

            <div class="col s12 m12 l12">
                <div class="imprint-link">
                    <a href="<?= site_url( 'imprint' ) ?>"><h4 class="imprint">Imprint</h4></a>
                    <span class="bottom-border"></span>
                </div>
            </div>
        </div>
    </div>

</div>

<?php
get_footer();