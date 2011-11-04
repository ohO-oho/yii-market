<?php
Shop::register('css/shop.css');
$this->breadcrumbs=array(
		Shop::t('Orders')=>array('index'),
		$model->order_id,
		);

?>

<h2> <?php echo Shop::t('Order') ?> #<?php echo $model->order_id; ?></h2>

<h3> <?php echo Shop::t('Ordering Info'); ?> </h3>

<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>array(
				'order_id',
				'customer_id',
					array(
						'label' => Shop::t('Ordering Date'),
						'value' => date('d. m. Y G:i',$model->ordering_date)
					),
				'ordering_done',
				'ordering_confirmed',
				),
			)); ?>

<h3> <?php echo Shop::t('Customer Info'); ?> </h3>

<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$model->customer,
			'attributes'=>array(
				'email',
				),
			)); ?>

<div class="summary_delivery_address">
<h3> <?php echo Shop::t('Delivery address'); ?> </h3>
<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$model->deliveryAddress,
			'attributes'=>array(
				'firstname',
				'lastname',
				'street',
				'zipcode',
				'city',
				'country'
				),
			)); ?>
</div>

<div class="summary_billing_address">
<h3> <?php echo Shop::t('Billing address'); ?> </h3>
<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$model->billingAddress,
			'attributes'=>array(
				'firstname',
				'lastname',
				'street',
				'zipcode',
				'city',
				'country'
				),
			)); ?>
</div>

<?php 
$this->renderPartial('/paymentMethod/view', array(
	'model' => $model->paymentMethod)); 
$this->renderPartial('/shippingMethod/view', array(
	'model' => $model->shippingMethod)); 
?>


<h3> <?php echo Shop::t('Ordered Products'); ?> </h3>

<?php foreach($model->products as $product) {
	$this->widget('zii.widgets.CDetailView', array(
				'data'=>$product,
				'attributes'=> array(
					'product.title',
					'amount',
					array(
						'label' => Shop::t('Specifications'),
						'type' => 'raw',
						'value' => $product->renderSpecifications())
					)
				)
			); 
	echo '<br />';
	echo '<hr />';
}

?>

<div style="clear:both;"> </div>

<div class="buttons"> 
<?php

echo CHtml::link(Shop::t('Delivery slip'), array(
			'//shop/order/slip', 'id' => $model->order_id )); 

echo CHtml::link(Shop::t('Invoice'), array(
			'//shop/order/invoice', 'id' => $model->order_id)); 

echo CHtml::link(Shop::t('Back to Orders'), array(
			'//shop/order/admin')); 

?>
</div>
