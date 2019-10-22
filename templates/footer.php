<footer class="content-info container" role="contentinfo">
  <div class="row">
    <div class="col-lg-12">
      <?php dynamic_sidebar('sidebar-footer'); ?>
      <p class="text-center">&copy; <?php echo date('Y'); ?> <?php echo get_site_owner_name(); ?></p>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>