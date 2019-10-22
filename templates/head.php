<?php
/*
header('Content-Type: application/xhtml+xml; charset=UTF-8');
echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
*/
?>
<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9" <?php language_attributes(); ?>><![endif]-->
<!--[if gt IE 8]><!-->
<html
  xmlns="http://www.w3.org/1999/xhtml"
  xmlns:mathml="http://www.w3.org/1998/Math/MathML"
  xmlns:svg="http://www.w3.org/2000/svg"
  xmlns:xlink="http://www.w3.org/1999/xlink"
  class="no-js"
  lang="<?php bloginfo('language'); ?>" xml:lang="<?php bloginfo('language'); ?>" dir="<?php bloginfo('text_direction'); ?>"><!--<![endif]-->
<head>
  <meta charset="utf-8" />
  <title><?php wp_title('|', true, 'right'); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <?php wp_head(); ?>

  <link rel="alternate" type="application/rss+xml" title="<?php echo get_bloginfo('name'); ?> Feed" href="<?php echo home_url(); ?>/feed/" />

  <!-- ****** faviconit.com smile-favicons ****** -->
  <!-- Basic favicons: transparent -->
  <link rel="shortcut icon" sizes="16x16 32x32 48x48 64x64" href="/smile-favicon.ico?v=2" />
  <link rel="shortcut icon" type="image/x-icon" href="/smile-favicon.ico?v=2" />
  <!--[if IE]><link rel="shortcut icon" href="/smile-favicon.ico?v=2" /><![endif]-->
  <!-- For Opera Speed Dial: -->
  <link rel="icon" type="image/png" sizes="195x195" href="/smile-favicon-195.png?v=1" />
  <!-- For iPad with high-resolution Retina display running iOS ≥ 7: -->
  <link rel="apple-touch-icon" sizes="152x152" href="/smile-favicon-152.png?v=1" />
  <!-- For iPad with high-resolution Retina display running iOS ≤ 6: -->
  <link rel="apple-touch-icon" sizes="144x144" href="/smile-favicon-144.png?v=1" />
  <!-- For iPhone with high-resolution Retina display running iOS ≥ 7: -->
  <link rel="apple-touch-icon" sizes="120x120" href="/smile-favicon-120.png?v=1" />
  <!-- For iPhone with high-resolution Retina display running iOS ≤ 6: -->
  <link rel="apple-touch-icon" sizes="114x114" href="/smile-favicon-114.png?v=1" />
  <!-- For Google TV devices: -->
  <link rel="icon" type="image/png" sizes="96x96" href="/smile-favicon-96.png?v=1" />
  <!-- For iPad Mini: -->
  <link rel="apple-touch-icon" sizes="76x76" href="/smile-favicon-76.png?v=1" />
  <!-- For first- and second-generation iPad: -->
  <link rel="apple-touch-icon" sizes="72x72" href="/smile-favicon-72.png?v=1" />
  <!-- For non-Retina iPhone, iPod Touch, and Android 2.1+ devices: -->
  <link rel="apple-touch-icon" href="smile-favicon-57.png?v=1" />
  <!-- Windows 8 Tiles -->
  <meta name="msapplication-TileColor" content="#FFFFFF" />
  <meta name="msapplication-TileImage" content="/smile-favicon-144.png?v=1" />
  <!-- ****** faviconit.com favicons ****** -->
</head>
