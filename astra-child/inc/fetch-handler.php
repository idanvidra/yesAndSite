<?php
/**
 * Ajax function for finding a match.
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

add_action( 'wp_ajax_find_match', 'find_match' );
add_action( 'wp_ajax_nopriv_find_match', 'find_match' );

function find_match() {
    if ( empty( $_GET['uid'] ) ) {
        wp_send_json_error();
    }

    global $wpdb;

    $table = 'queue_manager';

    $uid = sanitize_text_field( $_GET['uid'] );
    $current_time = current_time( 'mysql', true );

    $data = array(
        'last_active_time' => $current_time,
    );

    $wpdb->update( $table, $data, array( 'uid' => $uid ) );

    $user_data = $wpdb->get_row( "SELECT * FROM $table WHERE uid = '$uid'", "ARRAY_A" );
    
    if ( ! empty( $user_data['match_id'] ) ) {
        error_log('match found');
    } else {
        error_log('waiting for a match');
    }

    wp_send_json_success( 'you did it' );
}

?>