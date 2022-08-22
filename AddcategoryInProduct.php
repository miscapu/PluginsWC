<?php
/**
 * get categories for products
 */
    $orderby    =   'name';
    $order      =   'asc';
    $hide_empty =   false;
    $cat_args   =   array(
        'orderby'       =>  $orderby,
        'order'         =>  $order,
        'hide_empty'    =>  $hide_empty
    );

    $product_categories =   get_terms( 'product_cat', $cat_args );

    ?>
        <?php
    if ( !empty( $product_categories ) )
    {
        echo "<form method='post'>";

        echo "<input type='text' name='post_title' placeholder='Enter title for product'>";
        echo "<textarea name='content' id='content' cols='20' rows='5' placeholder='Description Product'></textarea>";
        echo "<select name='category_product'>";
        foreach ( $product_categories as $key => $product_category ):
            echo '<option value="'.$product_category->name.'">'.$product_category->name.'</option>';
        endforeach;
        echo "</select>";
        echo "<input type='submit' name='submit' value='Add Data'>";
        echo '</form>';
    }


/**
 * Send Data into DB
 */
// store post variables (title/content/categories)
$title_product  =   $_POST['post_title'];
$content_product  =   $_POST['content'];
$prod_category =   $_POST['category_product'];

$my_product =   array(
    'post_title'    =>  $title_product,
    'post_status'   =>  'publish',
    'post_content'  =>  $content_product,
    'post_author'   =>  1,
    'post_type'     =>  'product',
);
wp_insert_post( $my_product );

/**
 * Get last id
 */
global $wpdb;
$last_id = $wpdb->insert_id;#last id

wp_set_object_terms( $last_id, $prod_category, 'product_cat' );