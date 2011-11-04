<?php
$this->breadcrumbs=array(
	'Orders'=>array('index'),
	$model->order_id=>array('view','id'=>$model->order_id),
	Yii::t('ShopModule.shop', 'Update'),
);

?>
<h1> <?php echo Yii::t('ShopModule.shop', 'Update Order '); echo $model->order_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
