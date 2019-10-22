<?php
require get_template_directory() . '/lib/validate-contact-form.php';
if ($form) {
?>
<article class="modal fade hire" id="hire" tabindex="-1" role="dialog" aria-labelledby="modal-title" aria-hidden="true">
  <div class="modal-dialog">
    <form id="request-form" class="modal-content" name="requestForm" action="." method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h4 id="modal-title" class="h modal-title">Make An Inquiry</h4>
        <span><a href="javascript:void(0);" class="close ss-icon" data-dismiss="modal" role="button">Close</a></span>
      </div><!--/.modal-header-->
      <div id="request-form-body" class="modal-body">
        <div id="contact-result" hidden="hidden">
          <?php echo (isset($error_messages) ? $error_messages : ''); ?>
        </div>
        <div class="form-group">
          <label class="control-label" for="inquiry-subject">Subject</label>
          <select id="inquiry-subject" class="form-control" name="inquirySubject">
            <option>Project Opportunity</option>
            <option>Job Opportunity</option>
            <option>Question or Comment</option>
            <option>Bug Report</option>
            <option>Form Test</option>
          </select>
        </div><!--/.form-group-->
        <div class="form-group">
          <label class="control-label" for="inquirer-name">Name</label>
          <input id="inquirer-name" class="form-control" name="inquirerName" type="text" />
        </div><!--/.form-group-->
        <div class="form-group">
          <label class="control-label" for="inquirer-email">E-mail Address</label>
          <input id="inquirer-email" class="form-control" name="inquirerEmail" type="email" />
        </div><!--/.form-group-->
        <div class="form-group">
          <label class="control-label" for="project-budget">Budget</label>
          <div class="input-group">
            <select id="project-budget" name="projectBudget">
              <!--option>$3,000 and under</option-->
              <option>$3,000-$10,000</option>
              <option>$10,000-$25,000</option>
              <option selected="selected">$25,000-$50,000</option>
              <option>Over $50,000</option>
            </select>
          </div><!--/.input-group-->
        </div><!--/.form-group-->
        <div class="form-group">
          <label class="control-label" for="project-time-frame">Time Frame<span class="sr-only"> (in months)</span></label>
          <div class="input-group hx-input-group-sm">
            <input id="project-time-frame" class="form-control" name="projectTimeFrame" type="number" min="1" value="6" max="18" />
            <span class="input-group-addon">months</span>
          </div><!--/.input-group-->
        </div><!--/.form-group-->
        <div class="form-group">
          <label class="control-label" for="inquiry">Message</label>
          <textarea id="inquiry" name="inquiry" class="form-control" rows="5"></textarea>
        </div><!--/.form-group-->
        <div class="form-group">
          <label class="control-label" for="challenge-answer">Prove you’re not a spambot: what does UX stand for?</label>
          <input id="challenge-answer" class="form-control" name="challenge[answer]" type="text" />
          <input id="challenge-id" name="challenge[id]" type="hidden" value="0" />
        </div><!--/.form-group-->
      </div><!--/.modal-body-->
      <ul id="request-form-footer" class="modal-footer list-unstyled list-inline">
        <li><button name="submit" type="submit" class="btn btn-primary ss-paperairplane" title="Send E-mail" onclick="_gaq.push(['_trackEvent', 'Button', 'Click', 'Get At Me']);">Get At Me</button></li>
        <li><a class="ss-trash" href="javascript:void(0);" data-dismiss="modal" title="Close">Maybe Later</a></li>
      </ul>
      <input id="ajax" name="ajax" type="hidden" value="false" />
    </form><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</article><!-- /.modal -->
<?php
} else {
  echo $success_message;
}
?>