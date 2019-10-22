<header role="banner" class="masthead container">
  <!--div class="row"-->
    <div class="col-lg-12">
      <div class="rip-hgroup">
        <h1 class="h site-title"><a class="home-link" title="Home" href="<?php echo home_url(); ?>/"><?php echo preg_replace('/(h)(u)(gh)(x)/i', '$1<span class="text-info">$2</span>$3<span class="text-info">$4</span>', get_bloginfo('name')); ?></a></h1>
        <p class="inline-block"><dfn><?php echo get_site_owner_name(); ?></dfn> – <?php echo get_tagline(); ?></p>
      </div>
      <nav role="navigation">
        <?php
          if (has_nav_menu('primary_navigation')) :
            wp_nav_menu(
              array('theme_location' => 'primary_navigation', 'menu_class' => 'nav')
            );
          endif;
        ?>
      </nav>
    </div><!--/.col-->
  <!--div-->
</header>