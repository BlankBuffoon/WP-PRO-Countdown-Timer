<?php

$wpet_posts = get_posts( array('post_type'=>'timer','numberposts'=>-1) );

foreach( $wpet_posts as $wpet_post ) {
    wp_delete_post($wpet_post->ID, true);
}