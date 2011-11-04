<?php
$this->breadcrumbs=array(
	Yii::t('ShopModule.shop', 'Images') =>array('index'),
	Yii::t('ShopModule.shop', 'Upload'),
);

?>

<div id="shopcontent">

	<h1> <?php Yii::t('ShopModule.shop', 'Upload Image'); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

</div>
