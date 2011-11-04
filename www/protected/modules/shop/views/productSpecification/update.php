<?php
$this->breadcrumbs=array(
	'Product Specifications'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ProductSpecification', 'url'=>array('index')),
	array('label'=>'Create ProductSpecification', 'url'=>array('create')),
	array('label'=>'View ProductSpecification', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ProductSpecification', 'url'=>array('admin')),
);
?>

<h1>Update ProductSpecification <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>