<?php 
use yii\widgets\ActiveForm;
?>
<!-- Modal -->
<div class="modal fade" id="sendLabelEmail" role="dialog" aria-labelledby="sendLabelEmailLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="myModalLabel"> <span class="glyphicon glyphicon-list-alt"></span> Send Email</h4>
	  </div>
		<div class="alert alert-success fade in" id="sendemail-msg" style="display:none;"></div>
			<?php $form = ActiveForm::begin(['options' => ['id'=>'label-send-mail-form']]); ?>
				<div class="modal-body">
					<div id="loaded-content"></div>				
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
					<input type="submit" class="btn btn-success" value="Send" >
				</div>
			<?php ActiveForm::end(); ?>
	</div>
  </div>
</div>