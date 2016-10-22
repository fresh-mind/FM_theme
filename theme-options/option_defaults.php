<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Alena
 * Date: 03.08.16
 * Time: 11:03
 * To change this template use File | Settings | File Templates.
 */

$defaults = array(

    'main_options' => array(
        'freshmind'            => '11111',
        'copyright_text'  => 'All rights reserved',
        'phone'           => '<span>812</span> 123 45 67',
        'address'         => 'SPb, Nevsky pr., 1',
        'email'			  => 'info@fresh-mind.ru',
        'google_maps_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1998.7155132857895!2d30.310029315512136!3d59.93686266920466!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4696311af3115d53%3A0x95467c366bfc8035!2z0J3QtdCy0YHQutC40Lkg0L_RgC4sIDEsINCh0LDQvdC60YIt0J_QtdGC0LXRgNCx0YPRgNCzLCAxOTExODY!5e0!3m2!1sru!2sru!4v1456226949370',
        'portfolio_url'   => 'freshmind-portfolio',
        'read_more_text'  => 'Read more',
    ),
    'crumbs_options' => array(
        'sep' => '/',
        'home_text' => 'Home',
        'category_text' => __('Archive', 'freshmind') . ": %s",
        'search_text' => __('Search results for', 'freshmind') . ": %s", // текст для страницы с результатами поиска
        'tag_text' => __('Posts with tags', 'freshmind') . ": %s", // текст для страницы тега
        'author_text' => __('Posts of author', 'freshmind') . ": %s", // текст для страницы автора
        '404_text' => __('Error 404', 'freshmind'), // текст для страницы 404
        'page_text' => __('Page', 'freshmind') . ": %s", // текст 'Страница N'
        'cpage_text' => __('Comments page', 'freshmind') . ": %s", // текст 'Страница комментариев N'
    ),
);

function freshmind_options_defaults( $option_name = 'main_options' ){

    global $defaults;

    $defaults_array = $defaults[ $option_name ];

    return $defaults_array;

}