<?php
$this->breadcrumbs=array(
	'Product Specifications'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ProductSpecification', 'url'=>array('index')),
	array('label'=>'Manage ProductSpecification', 'url'=>array('admin')),
);
?>

<h1>Create ProductSpecification</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>