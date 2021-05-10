<?php
/*
 * Set specific configuration variables here
 */

use Laravolt\Avatar\Generator\DefaultGenerator;

return [

    /*
    |--------------------------------------------------------------------------
    | Image Driver
    |--------------------------------------------------------------------------
    | Avatar use Intervention Image library to process image.
    | Meanwhile, Intervention Image supports "GD Library" and "Imagick" to process images
    | internally. You may choose one of them according to your PHP
    | configuration. By default PHP's "GD Library" implementation is used.
    |
    | Supported: "gd", "imagick"
    |
    */
    'driver'      => env('AVATAR_DRIVER'),

    // Initial generator class
    'generator'   => DefaultGenerator::class,

    // Whether all characters supplied must be replaced with their closest ASCII counterparts
    'ascii'       => env('AVATAR_ASCII'),

    // Image shape: circle or square
    'shape'       => env('AVATAR_SHAPE'),

    // Image width, in pixel
    'width'       => env('AVATAR_WIDTH'),

    // Image height, in pixel
    'height'      => env('AVATAR_HEIGHT'),

    // Number of characters used as initials. If name consists of single word, the first N character will be used
    'chars'       => env('AVATAR_CHARS'),

    // font size
    'fontSize'    => env('AVATAR_FONTSIZE'),

    // convert initial letter in uppercase
    'uppercase'   => env('AVATAR_UPPERCASE'),

    // Fonts used to render text.
    // If contains more than one fonts, randomly selected based on name supplied
    'fonts'       => [__DIR__ . '/../fonts/OpenSans-Bold.ttf', __DIR__ . '/../fonts/rockwell.ttf'],

    // List of foreground colors to be used, randomly selected based on name supplied
    'foregrounds' => [
        '#FFFFFF',
    ],

    // List of background colors to be used, randomly selected based on name supplied
    'backgrounds' => [
        '#f44336',
        '#E91E63',
        '#9C27B0',
        '#673AB7',
        '#3F51B5',
        '#2196F3',
        '#03A9F4',
        '#00BCD4',
        '#009688',
        '#4CAF50',
        '#8BC34A',
        '#CDDC39',
        '#FFC107',
        '#FF9800',
        '#FF5722',
    ],

    'border' => [
        'size'  => env('AVATAR_BORDER_SIZE'),

        // border color, available value are:
        // 'foreground' (same as foreground color)
        // 'background' (same as background color)
        // or any valid hex ('#aabbcc')
        'color' => 'background',
    ],
];
