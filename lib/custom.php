<?php
/**
 * Custom functions
 */
$showTitle = true;

function d( $expression, $exit = false ) {
  echo '<pre>';
  var_dump($expression);
  echo '</pre>';
  if ( $exit ) exit;
}

function get_site_owner_name() {
  $adminEmail = get_bloginfo('admin_email');
  $author = get_user_by('email', $adminEmail);
  $authorName = $author->first_name . ' ' . $author->last_name;

  return $authorName;
}

function get_tagline() {
  $tagline =
    preg_replace(
      array(
        '/\b(ui)\b/i'
      , '/\b(ux)\b/i'
      ),
      array(
        '<abbr title="User Interface">$1</abbr>'
      , '<abbr title="User Experience">$1</abbr>'
      ),
      get_bloginfo('description')
    )
  ;

  return $tagline;
}

function make_cta( $attrs, $content="Learn More" ) {
  // data-toggle="modal" href="#hire"
  $pairs = array(
    'modal' => null,
    'type' => 'btn',
    'style' => 'primary',
    'size' => 'lg',
    'valign' => 'middle',
    'talign' => null //'center'
  );
  $linkAttrs = '';
  $pAttrs = '';

  extract( shortcode_atts( $pairs, $attrs ) );

  if ( !empty($modal) ) {
    $linkAttrs .= ' data-toggle="modal" href="' . $modal . '"';
  }

  if ( !empty($valign) ) {
    $content = preg_replace( array( '/\[(adjacent)\]/i', '/\[(icon)\]/i' ), '[$1 valign="' . $valign . '"]', $content);
  }

  if ( !empty($talign) ) {
    $pAttrs .= ' class="text-' . $talign . '"';
  }

  return '<p' . $pAttrs . '><a class="btn btn-' . $style . ' btn-' . $size . ' btn-cta"' . $linkAttrs . '>' . do_shortcode($content) . '</a></p>';
}

function make_icon( $attrs, $content="" ) {
  // data-toggle="modal" href="#hire"
  $pairs = array(
    'family' => 'ss-icon',
    'set' =>  'ss-junior',
    'glyph' => '', //'ss-smile',
    'valign' => 'middle'
  );
  $attrsHtml = '';

  extract( shortcode_atts( $pairs, $attrs ) );

  $attrsHtml .= 'class="' . $family . ' ' . $set . ' ' . $glyph . ' valign-' . $valign . '" ';

  return '<span ' . $attrsHtml . '>' . $content . '</span>';
}

function make_adjacent( $attrs, $content="" ) {
  // data-toggle="modal" href="#hire"
  $pairs = array(
    'valign' => 'middle'
  );
  $attrsHtml = '';

  extract( shortcode_atts( $pairs, $attrs ) );

  $attrsHtml .= 'class="valign-' . $valign . '" ';

  return '<span ' . $attrsHtml . '>' . $content . '</span>';
}

function make_lead( $attrs, $content="" ) {
  // <p class="text-justify lead shadow">
  $pairs = array(
    'class' => null, //'shadow'
    'talign' => 'justify'
  );
  $classes = array( 'lead' );

  extract( shortcode_atts( $pairs, $attrs ) );

  if ( !empty($talign) ) {
    $classes[] = 'text-' . $talign;
  }

  if ( !empty($class) ) {
    $classes[] = $class;
  }

  return '<p class="' . implode(' ', $classes) . '">' . do_shortcode( $content ) . '</p>';
}

function make_jumbotron( $attrs, $content="" ) {
  $pairs = array(
    'class' => null,
  );
  $classes = array( 'jumbotron' );

  extract( shortcode_atts( $pairs, $attrs ) );

  return '<div class="' . implode( ' ', $classes ) . '">' . do_shortcode( $content ) . '</div>';
}

function insert_title( $attrs, $content ) {
  global $showTitle;

  $showTitle = false;

  return get_the_title();
}

function insert_year( $attrs, $content ) {
  return date('Y');
}

function get_xhtml( $html, $stripInvalidTags = false, $correctEntities = true ) {
  $finds =
    array(
      '/<(link|meta|img)([^<>]+)(?<!\/)>/i'
    , '/<(script|style)([^<>]+)>([^<>]+)<\/\1>/i'
    )
  ;

  if ( $stripInvalidTags ) {
    $finds[] = '/<((noscript)>(?:[^<>]+)<\/\2)>/i';
  }

  $replacements =
    array(
      '<$1$2 />'
    , '<$1$2>/*<![CDATA[*/$3/*]]>*/</$1>'
    )
  ;

  if ( $stripInvalidTags ) {
    $replacements[] = '<!--$1-->';
  }

  $xhtml = preg_replace( $finds, $replacements, $html );

  if ( $correctEntities ) {
    $xhtml =
      preg_replace_callback(
        '/<(?!\!\[CDATA)([^<>="\'\s]+)([^<>]+)>([^<>]+)<\/\1>/'
      , function ($matches) {
          return '<' . $matches[1] . $matches[2] . '>' . htmlspecialchars( $matches[3], ENT_NOQUOTES | ENT_XML, get_bloginfo('charset'), false ) . '</' . $matches[1] . '>';
        }
      , $xhtml
    );

    //$xhtml = preg_replace('/DOCTYPE/i', 'MOCKTYPE', $xhtml);
  }
  
  return $xhtml;
}

function xhtmlize( $html ) {
  echo get_xhtml( $html );
  //echo $html;
}

add_shortcode( 'cta', 'make_cta' );
add_shortcode( 'icon', 'make_icon' );
add_shortcode( 'adjacent', 'make_adjacent' );
add_shortcode( 'lead', 'make_lead' );
add_shortcode( 'jumbotron', 'make_jumbotron' );
add_shortcode( 'title', 'insert_title' );
add_shortcode( 'year', 'insert_year' );
?>