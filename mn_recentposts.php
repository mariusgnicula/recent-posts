<?php
/*
* Plugin Name: MN Recent Posts
* Description: A custom recent posts widget with feature image, title, category, excerpt and a read more link.
* Version: 0.1
* Author: Marius Nicula
* Author URI: https://www.linkedin.com/in/mariusgnicula
*/

// recent posts function start
function mn_recent_posts() {

    // query args
    // maybe make it more dynamic in the future

    $mn_args = array(
        'post_type'  => 'post',
        'posts_per_page' => 4
    );

    // WP_Query declaration

    $mn_recent_query = new WP_Query( $mn_args );

    // query loop condition
    // if posts exist, echo recent posts start tag

    if ( $mn_recent_query->have_posts() ) {

        // recent posts container start tag

        echo '<div class="mn-post__container">';

        // loop start

        while ( $mn_recent_query->have_posts() ) {

            $mn_recent_query->the_post();

            // post start tag
            echo '<div class="mn-post">';

                // article image
                // using background-image to maintain a cover aspect
                // not the best for SEO, but I'll try and fix it in a later version

                $id = get_the_id();
                $feature = get_post( get_post_thumbnail_id( $id ) );
                $feature_id = $feature->ID;
                $feature_link = wp_get_attachment_image_src( $feature_id, 'full' );
                $feature_link = $feature_link[0];

                echo '<div class="mn_post__feature" style="background-image: url(' . $feature_link . ')">';

                    echo '<a href="' . get_permalink() . '"></a>';

                echo '</div>';

                // post details - currently having an title, category, excerpt and link

                echo '<div class="mn_post__details">';

                    echo '<a href="' . get_permalink() . '"><h2>' . get_the_title() . '</h2></a>';

	                the_excerpt();

	                echo '<a href="' . get_permalink() . '">Read more</a>';

                echo '</div>';

            echo '</div>';
        }

        wp_reset_postdata();

        echo '</div>';

    }
}

add_shortcode('mn_recent_posts', 'mn_recent_posts');

?>
