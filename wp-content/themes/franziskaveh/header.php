<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Franziska_Veh
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>

    <?php
        $about_page_color = types_render_field( 'about-page-color', array( 'id' => '32' ) );
        $contact_page_color = types_render_field( 'contact-page-color', array( 'id' => '37' ) );
    ?>

    <style>
        <?php /*
        .about .projects-component p,
        .about .projects-component p a,
        .about .projects-component p a:hover,
        .about .projects-component p a:focus,
        #btn-about.activated a,
        .about h4,
        .about .col p, .about .projects-component,
        .about p a {
            color: <?= $about_page_color ?>;
        }*/ ?>

        #btn-about.activated .bottom-border {
            background-color: <?= $about_page_color ?>;
        }
        #btn-about.activated a {
            color: <?= $about_page_color ?>;
        }

        .contact h2, .contact a,
        #btn-contact.activated a {
            color: <?= $contact_page_color ?>;
        }
        #btn-contact.activated .bottom-border {
            background-color: <?= $contact_page_color ?>;
        }
    </style>

    <script type="text/javascript">
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','__gaTracker');

        __gaTracker('create', 'UA-4696588-13', 'auto');
        __gaTracker('send','pageview');

    </script>
</head>

<body <?php body_class(); ?>>

<header>
    <a href="/">
        <h1 <?= is_singular( 'project' ) ? 'class="fixed"' : '' ?>>Studio Franziska Veh</h1>
    </a>
    <?php get_template_part( 'template-parts/filters' ); ?>
</header>
