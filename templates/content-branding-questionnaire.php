<?php
require get_template_directory() . '/lib/validate-brand-questionnaire.php';
if ($form) {
?>
<form id="branding-questionnaire" class="form-bigger" name="brandingQuestionnaire" action="." method="post" enctype="multipart/form-data">
  <?php echo (isset($error_messages) ? $error_messages : ''); ?>
  <div class="form-group">
    <label class="control-label" for="client-name">Client Name</label>
    <input id="client-name" class="form-control" name="client-name" type="text" required="required" />
  </div><!--/.form-group-->
  <h2 class="h">Background</h2>
  <div class="form-group">
    <label class="control-label" for="dfn">What does your brand do? (Or, if it isn’t formed yet, what will it do?)</label>
    <textarea id="dfn" class="form-control" name="dfn" rows="10"></textarea>
  </div>
  <div class="form-group">
    <label class="control-label" for="target-audience">Who is your target audience? Please distinguish between the primary and secondary users of your product(s) or service(s), listing as concisely as possible any identifying demographics, interests, or behaviors.</label>
    <textarea id="target-audience" class="form-control" name="target-audience" rows="10"></textarea>
  </div>
  <div class="form-group">
    <label class="control-label" for="target-audience-needs">What specific needs or goals do your primary and secondary users have that this project would help them with?</label>
    <textarea id="target-audience-needs" class="form-control" name="target-audience-needs" rows="10"></textarea>
  </div>
  <div class="form-group">
    <label class="control-label" for="competitors">Who are your competitors? If they have them, please list their respective websites and comment on what you consider to be their strengths and weaknesses.</label>
    <textarea id="competitors" class="form-control" name="competitors" rows="10"></textarea>
  </div>
  <div class="form-group">
    <label class="control-label" for="competition">What distinguishes your brand from the competition?</label>
    <textarea id="competition" class="form-control" name="competition" rows="10"></textarea>
  </div>
  <div class="form-group">
    <label class="control-label" for="inspiration">Aside from the competition’s, are there any projects that you admire? If so, please list their respective websites. They don’t necessarily have to be the same type of project.</label>
    <textarea id="inspiration" class="form-control" name="inspiration" rows="10"></textarea>
  </div>
  <h2 class="h">Personality</h2>
  <div class="form-group">
    <label class="control-label" for="personify-bestie">If your product/service was a person, what sort of words would their best friend use to describe them? (e.g. “friendly”, “strong”, “funny”, etc.)</label>
    <textarea id="personify-bestie" class="form-control" name="personify-bestie" rows="10"></textarea>
  </div>
  <div class="form-group">
    <label class="control-label" for="personify-media">If your product/service was a person, what television shows would they watch? What music would they listen to?</label>
    <textarea id="personify-media" class="form-control" name="personify-media" rows="10"></textarea>
  </div>
  <div class="form-group">
    <label class="control-label" for="celebrity">If you could choose any celebrity to endorse your brand, who would they be? What about them reflects your brand / product / service?</label>
    <textarea id="celebrity" class="form-control" name="celebrity" rows="10"></textarea>
  </div><!--/.form-group-->
  <h2 class="h">Tone</h2>
  <p>What tone do you want to set for your site or copy? Adjust the sliders to your heart’s content. If you’re not sure, leave the thumb centered.</p>
  <div class="form-group">
    <label class="range-polar">
      <span>Fun</span>
      <input name="fun-serious" type="range" />
      <span>Serious</span>
    </label>
  </div>
  <div class="form-group">
    <label class="range-polar">
      <span>Casual</span>
      <input name="fun-serious" type="range" />
      <span>Formal</span>
    </label>
  </div>
  <div class="form-group">
    <label class="range-polar">
      <span>Relaxed</span>
      <input name="relaxed-professional" type="range" />
      <span>Professional</span>
    </label>
  </div>
  <div class="form-group">
    <label class="range-polar">
      <span>Modern</span>
      <input name="modern-traditional" type="range" />
      <span>Traditional</span>
    </label>
  </div>
  <div class="form-group">
    <label class="range-polar">
      <span>Vibrant</span>
      <input name="vibrant-muted" type="range" />
      <span>Muted</span>
    </label>
  </div>
  <div class="form-group">
    <label class="range-polar">
      <span>Unique</span>
      <input name="unique-familiar" type="range" />
      <span>Familiar</span>
    </label>
  </div>
  <div class="form-group">
    <label class="range-polar">
      <span>Youthful</span>
      <input name="youthful-mature" type="range" />
      <span>Mature</span>
    </label>
  </div>
  <ul class="list-unstyled list-inline modal-footer">
    <li><button name="submit" type="submit" class="btn btn-primary ss-paperairplane" title="Send E-mail">Submit</button></li>
    <li><a class="ss-trash reset" href=".">Reset</a></li>
  </ul>
  <input id="ajax" name="ajax" type="hidden" value="false" />
</form><!-- /.modal-content -->
<?php
} else {
  echo $success_message;
}
get_template_part('templates/footer');
?>