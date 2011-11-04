<?php
$this->breadcrumbs=array(
	Yii::t('ShopModule.shop', 'Products')=>array('index'),
	$model->title=>array('view','id'=>$model->product_id),
	Yii::t('ShopModule.shop', 'Update'),
);

?>

<div class="prepend-1" id="shopcontent">

<h1><?php echo Yii::t('ShopModule.shop', 'Update'); ?>
 <?php echo $model->title; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

</div>
