<?php
/** @var $active_category */

if ( ! isset( $activated ) ) {
    $activated = '';
}

$categories = get_categories( array ( 'hide_empty' => 0, 'orderby' => 'id', 'order' => 'asc', 'include' => '2, 3, 4, 5' ) );
?>

<!-- Main buttons on desktop -->
<div class="desktop">
    <div class="main-buttons" id="btn-work">
        <div class="button-text">
            <a href="/">Work</a>
            <span class="bottom-border"></span>
        </div>

        <div class="filter-button">
            <?= $active_category ? $active_category : 'all' ?>
            <i id="rotate-arrow" class="material-icons" aria-hidden="true">arrow_downward</i>
        </div>
    </div>

    <div class="main-buttons <?php if ( $activated == 'about' ): ?>activated<?php endif; ?>" id="btn-about">
        <a href="<?= site_url( 'about' ) ?>">About</a>
        <span class="bottom-border"></span>
    </div>

    <div class="main-buttons" id="btn-news">
        <a href="https://instagram.com/franziskaveh" target="_blank">News</a>
        <span class="bottom-border"></span>
    </div>

    <div class="main-buttons <?php if ( $activated == 'contact' ): ?>activated<?php endif; ?>" id="btn-contact">
        <a href="<?= site_url( 'contact' ) ?>">Contact</a>
        <span class="bottom-border"></span>
    </div>

</div>
<!-- End of Main buttons on desktop -->
<!-- Main buttons on mobile -->
<div class="mobile">
    <div class="toggle-menu-button show">
        <i data-active="true" class="material-icons">reorder</i>
    </div>
    <div class="controls">
        <div class="controls-btn close-btn">
            <div id="cross" class="cross"></div>
        </div>
        <div class="controls-btn">

            <a href="/" class="button-text"> Work </a>

            <p class="filter-text">Filter By:</p>
            <div class="mobile-filter-wrap">

                <div class="filter-element-item col l2 s4" style="padding-left: 0">
                    <div class="filter-element-image">
                        <a href="<?= site_url( 'project' ) ?>">
                            <?= types_render_field( 'all-categories-thumbnail', array( 'id' => '32' ) ) ?>
                        </a>
                    </div>
                    <div class="valign-wrapper">
                        <a href="<?= site_url( 'project' ) ?>"><h5 class="center-align valign">All</h5></a>
                    </div>
                </div>

                <?php foreach ( $categories as $category ): ?>

                <div class="filter-element-item col l2 s4">
                    <div class="filter-element-image">
                        <a href="<?= get_category_link( $category->term_id ) ?>">
                            <?php if (function_exists( 'z_taxonomy_image') ) z_taxonomy_image( $category->term_id, 'filter-image' ); ?>
                        </a>
                    </div>
                    <div class="valign-wrapper">
                        <a href="<?= get_category_link( $category->term_id ) ?>">
                            <h5 class="center-align valign"><?= $category->name ?></h5>
                        </a>
                    </div>
                </div>

                <?php endforeach; ?>

            </div>
        </div>

        <div class="controls-btn <?php if ( $activated == 'about' ): ?>activated<?php endif; ?>">
            <a href="<?= site_url( 'about' ) ?>" class="button-text"> About </a>
        </div>

        <div class="controls-btn">
            <a href="https://instagram.com/franziskaveh" target="_blank" class="button-text"> News </a>
        </div>

        <div class="controls-btn <?php if ( $activated == 'contact' ): ?>activated<?php endif; ?>">
            <a href="<?= site_url( 'contact' ) ?>" class="button-text"> Contact </a>
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

            <div class="controls-btn">
                <a href="<?= site_url( 'jobs' ) ?>" class="button-text"> Jobs </a>
            </div>

        <?php endif; ?>

        <div class="controls-btn">
            <a href="<?= site_url( 'imprint' ) ?>" class="button-text"> Imprint </a>
        </div>

    </div>
</div>
<!-- End of Main buttons on mobile -->