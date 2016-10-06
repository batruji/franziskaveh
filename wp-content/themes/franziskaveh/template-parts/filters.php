<?php
    $categories = get_categories( array ( 'hide_empty' => 0, 'orderby' => 'id', 'order' => 'asc', 'include' => '2, 3, 4, 5' ) );
    $cat_id = get_query_var('cat');
?>

<div id="desktop-filter-elements" class="filter-elements row">
    <div class="container">
        <div class="row">

            <div class="filter-element-item col l2">
                <div class="filter-element-image">
                    <a href="<?= site_url( '/' ) ?>">
                        <?= types_render_field( 'all-categories-thumbnail', array( 'id' => '32' ) ) ?>
                    </a>
                </div>
                <div class="valign-wrapper category-all">
                    <a href="<?= site_url('/') ?>">
                        <h5 class="center-align valign <?php if ( is_home() ): ?>no-hover<?php endif; ?>">
                            All
                            <span class="bottom-border"></span>
                        </h5>
                    </a>
                </div>
            </div>

            <?php foreach ( $categories as $category ): ?>

            <div class="filter-element-item col l2 s4">
                <div class="filter-element-image">
                    <a href="<?= get_category_link( $category->term_id ) ?>">
                        <?php if (function_exists( 'z_taxonomy_image') ) z_taxonomy_image( $category->term_id, 'filter-image' ); ?>
                    </a>
                </div>
                <div class="valign-wrapper category-<?= $category->term_id ?>">
                    <a href="<?= get_category_link( $category->term_id ) ?>">
                        <h5 class="center-align valign <?php if ( $category->term_id == $cat_id ): ?>no-hover<?php endif; ?>">
                            <?= $category->name ?>
                            <span class="bottom-border"></span>
                        </h5>
                    </a>
                </div>
            </div>

            <?php endforeach; ?>

        </div>
    </div>
</div>