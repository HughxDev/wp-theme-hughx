<?php
require get_template_directory() . '/lib/validate-brand-questionnaire.php';
if ($form) {
?>
<article class="brand-questionnaire">
  <form id="request-form" class="modal-content" name="requestForm" action="." method="post" enctype="multipart/form-data">
    <?php echo (isset($error_messages) ? $error_messages : ''); ?>
    <div class="form-group">
      <label class="control-label" for="client-name">Client Name</label>
      <input id="client-name" class="form-control" name="client-name" type="text" />
    </div><!--/.form-group-->
    <div class="form-group">
      <label class="control-label">If you could choose any celebrity to endorse your brand, who would they be? What about them reflects your brand / product / service?</label>
      <textarea class="form-control"></textarea>
    </div><!--/.form-group-->
    <div class="form-group">
      <label class="control-label">Fun <input class="form-control" name="fun-serious" type="range" /> Serious</label>
    </div>
    <!-- <p><label>Casual <input name="fun-serious" type="range" /> Formal</label></p>

    <p><label>Relaxed <input name="relaxed-professional" type="range" /> Professional</label></p>

    <p><label>Modern <input name="modern-traditional" type="range" /> Traditional</label></p>

    <p><label>Vibrant <input name="vibrant-muted" type="range" /> Muted</label></p>

    <p><label>Unique <input name="unique-familiar" type="range" /> Familiar</label></p>

    <p><label>Youthful <input name="youthful-mature" type="range" /> Mature</label></p> -->

    <p><button>Submit</button> <a href="javascript:void(0);">Reset</a></p>
    <ul id="request-form-footer" class="list-unstyled list-inline">
      <li><button name="submit" type="submit" class="btn btn-primary ss-paperairplane" title="Send E-mail">Get At Me</button></li>
      <li><a class="ss-trash" href="javascript:void(0);" data-dismiss="modal" title="Close">Maybe Later</a></li>
    </ul>
    <input id="ajax" name="ajax" type="hidden" value="false" />
  </form><!-- /.modal-content -->
</article>
<?php
} else {
  echo $success_message;
}
?>