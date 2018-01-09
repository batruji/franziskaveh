<?php
/**
 * Template Name: Home Page
 *
 * @package Franziska_Veh
 */

get_header(); ?>

    <div class="container">
        <?php $active_category = 'filter' ?>
        <?php include( locate_template( 'template-parts/navigation.php' ) ); ?>

        <div class="top-header-wrap show valign-wrapper row">
            <h2><?= strip_tags ( types_render_field( 'index-page-title', array( 'id' => '32' ) ), '<br>' ); ?></h2>
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

            $bricklayer_count = 1;

            while ( $loop->have_posts() ) : $loop->the_post();

                $is_one_column = types_render_field( 'display-full-width-front-page' ) == '1';
                // close the current bricklayer 2 column layout
                if ( $is_one_column ) : ?>
                    </div>
                <?php endif;

                $home_page_image = get_field( 'home_page_image' );
                if ( $home_page_image ) {
                    $is_gif_image = false;
                    if ( strpos( wp_get_attachment_image_url( $home_page_image['id'], 'full' ), '.gif' ) !== false || $is_one_column ) {
                        $size = 'full';
                        $is_gif_image = true;
                    }
                    else {
                        $size = 'half-size';
                    }

                    $img_src = wp_get_attachment_image_url( $home_page_image['id'], $size );
                    $img_srcset = wp_get_attachment_image_srcset( $home_page_image['id'], $size );
                }
                ?>

                <div class="project-item columns-2 animation-element bounce-up in-view <?php echo $is_one_column ? 'full-width-project' : '' ?>">
                    <a href="<?= get_the_permalink() ?>" title="<?= the_title() ?>"></a>

                    <?php if ( $home_page_image ): ?>
                        <img src="<?php echo esc_url( $img_src ); ?>"
                             <?php if ( ! $is_gif_image ): ?>srcset="<?php echo esc_attr( $img_srcset ); ?>"<?php endif; ?>
                             alt="<?= $home_page_image['alt']; ?>"
                             <?php if ( ! $is_gif_image ): ?>sizes="(max-width: <?= $home_page_image['sizes'][$size.'-width'] ?>px) 100vw, <?= $home_page_image['sizes'][$size.'-width'] ?>px"<?php endif; ?>>
                    <?php else: ?>
                        <?php if ( strpos( get_the_post_thumbnail_url( null, 'full' ), '.gif' ) !== false || $is_one_column ):  ?>
                            <?= get_the_post_thumbnail( null, 'full' ) ?>
                        <?php else: ?>
                            <?= get_the_post_thumbnail( null, 'half-size' ) ?>
                        <?php endif; ?>
                    <?php endif; ?>

                    <h4><?php echo types_render_field( 'category-title', array( 'id' => get_the_ID() ) ); ?></h4>
                    <h2><?= the_title(); ?></h2>
                    <p class="project-info"><?= get_the_excerpt() ?></p>
                </div>

                <?php if ( $is_one_column ) : ?>
                    <?php // open a new bricklayer 2 column layout ?>
                    <div id="bricklayer<?php echo $bricklayer_count; ?>" class="bricklayer two-columns">
                    <?php $bricklayer_count++; ?>
                <?php endif; ?>

            <?php endwhile; ?>

        </div>
        <!-- End of Grid layer -->
    </div>

<?php
get_footer();