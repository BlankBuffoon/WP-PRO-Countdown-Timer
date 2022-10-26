<?php

$properties = get_posts( array('post_type'=>'timers','numberposts'=>-1) );

foreach( $properties as $property ) {
    wp_delete_post($property->ID, true);
}