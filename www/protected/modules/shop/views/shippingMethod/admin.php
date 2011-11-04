<?php
$this->breadcrumbs=array(
	'Shipping Methods'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List ShippingMethod', 'url'=>array('index')),
	array('label'=>'Create ShippingMethod', 'url'=>array('create')),
);

?>

<h1>Manage Shipping Methods</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'shipping-method-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'title',
		'tax_id',
		'price',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
