<?php

/**
 * Function generates pixel style attributes
 *
 * @param $attr
 * @return string
 */
function pixel_attr($attr)
{
    return "top: {$attr['coordinate_y']}px; left: {$attr['coordinate_x']}px; background-color: {$attr['colour']};";
}