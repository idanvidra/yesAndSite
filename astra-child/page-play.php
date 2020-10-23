<?php
wp_enqueue_script( 'play-js', '/wp-content/themes/astra-child/assets/js/unminified/play.js', array(), filemtime( get_theme_file_path( 'assets/js/unminified/play.js' ) ) );

if ( empty( $_COOKIE['uid'] ) ) {
    global $wpdb;

    $table = 'queue_manager';

    $uid = uniqid( '', true );
    $current_time = current_time( 'mysql', true );

    $data = array(
        'uid'              => $uid,
        'status'           => 'pending_match',
        'last_active_time' => $current_time,
    );

    // Save in DB.
    $wpdb->insert( $table, $data );

    // Save in cookie.
    // need to add array as third parameter ['expires' => 0, 'path' => '/', 'domain' => null, 'secure' => true, 'httponly' => true, 'samesite' => 'Strict']
    setcookie( 'uid', $uid );
} else {
    $uid = wp_strip_all_tags( $_COOKIE['uid'] );
}

?>

<?php get_header(); ?>


<?php if ( astra_page_layout() == 'left-sidebar' ) : ?>

<?php get_sidebar(); ?>

<?php endif ?>

<div id="primary" <?php astra_primary_class(); ?>>

    <?php astra_primary_content_top(); ?>

    <?php astra_content_page_loop(); ?>

    <?php astra_primary_content_bottom(); ?>

</div><!-- #primary -->

<?php if ( astra_page_layout() == 'right-sidebar' ) : ?>

<?php get_sidebar(); ?>

<?php endif ?>

<?php get_footer(); ?>