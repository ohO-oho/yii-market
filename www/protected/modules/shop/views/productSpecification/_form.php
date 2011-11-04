<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'product-specification-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_user_input'); ?>
		<?php echo $form->checkBox($model,'is_user_input'); ?>
		<?php echo $form->error($model,'is_user_input'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'required'); ?>
		<?php echo $form->checkBox($model,'required'); ?>
		<?php echo $form->error($model,'required'); ?>
	</div>



	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
