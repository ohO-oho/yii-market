<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'order-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'customer_id'); ?>
		<?php echo $form->textField($model,'customer_id', array('disabled' => 'true')); ?>
		<?php echo $form->error($model,'customer_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ordering_confirmed'); ?>
		<?php echo $form->checkBox($model,'ordering_confirmed'); ?>
		<?php echo $form->error($model,'ordering_confirmed'); ?>

		<?php echo $form->labelEx($model,'ordering_done'); ?>
		<?php echo $form->checkBox($model,'ordering_done'); ?>
		<?php echo $form->error($model,'ordering_done'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('ShopModule.shop', 'Create') : Yii::t('ShopModule.shop', 'Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
