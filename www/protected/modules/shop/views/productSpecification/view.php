<?php
$this->breadcrumbs=array(
	'Product Specifications'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List ProductSpecification', 'url'=>array('index')),
	array('label'=>'Create ProductSpecification', 'url'=>array('create')),
	array('label'=>'Update ProductSpecification', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ProductSpecification', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ProductSpecification', 'url'=>array('admin')),
);
?>

<h1>View ProductSpecification #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'is_user_input',
		'required',
	),
)); ?>
