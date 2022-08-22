<?php
echo "<form method='post'>
        <input type='text' name='category_product' placeholder='Enter category name'>
        <textarea name='description_category' id='description_category' cols='30' rows='10'></textarea>
        <input type='text' name='slug_category' placeholder='Slug for category'>
        <input type='submit' name='submit' value='Add Data'>
      </form>";

/**
 * Send Data into wp_posts
 */
$customCategories       =   $_POST["category_product"];
$descriptionCatgeory       =   $_POST["description_category"];
$slugCategory       =   $_POST["slug_category"];

if ( ! empty( $customCategories ) )
{
wp_insert_term(
    $customCategories, // the term
    'product_cat', // the taxonomy
    array(
        'description'=> $descriptionCatgeory,
        'slug' => $slugCategory
    )
);
}
wp_reset_postdata();