<?php $categories = get_categories( array ( 'hide_empty' => 0, 'orderby' => 'id', 'order' => 'asc', 'include' => '2, 3, 4, 5' ) ); ?>

<div id="desktop-filter-elements" class="filter-elements row">
    <div class="container">
        <div class="row">

            <div class="filter-element-item col l2">
                <div class="filter-element-image">
                    <a href="<?= site_url( 'project' ) ?>">
                        <?= types_render_field( 'all-categories-thumbnail', array( 'id' => '32' ) ) ?>
                    </a>
                </div>
                <div class="valign-wrapper">
                    <a href="<?= site_url('project') ?>">
                        <h5 class="center-align valign">
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
                        <?php if (function_exists( 'z_taxonomy_image') ) z_taxonomy_image( $category->term_id ); ?>
                    </a>
                </div>
                <div class="valign-wrapper">
                    <a href="<?= get_category_link( $category->term_id ) ?>">
                        <h5 class="center-align valign">
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