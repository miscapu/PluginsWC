<?php

echo "<form method='post' action='" . $_SERVER['PHP_SELF'] . "'>
        <input type='text' name='post_title' placeholder='Enter title for product'>
        <input type='submit' name='submit' value='Add Data'>
      </form>";

/**
 * Send Data into wp_posts
 */
$my_product_title = $_POST["post_title"];

if (!empty($my_product_title)):

    $my_product = array(
        'post_title' => $my_product_title,
        'post_status' => 'publish',
        'post_author' => 1,
        'post_type' => 'product' #posts #product
    );

    /**
     * functions for add data in tables:
     * postmeta post_terms
     */

    wp_insert_post($my_product);

endif;
wp_reset_postdata();


/**
 * Get last id
 */
global $wpdb;
$last_id = $wpdb->insert_id;#last id

$link_product = $wpdb->get_results("SELECT guid FROM $wpdb->posts WHERE ID = $last_id");

foreach ($link_product as $link):
    echo "<a href='" . $link->guid . "'>View Product</a>";
endforeach;