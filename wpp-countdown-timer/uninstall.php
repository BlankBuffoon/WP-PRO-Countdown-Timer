<?php

$wppct_posts = get_posts( array('post_type'=>'wppct_timer','numberposts'=>-1) );

foreach( $wppct_posts as $wppct_post ) {
    wp_delete_post($wppct_post->ID, true);
}