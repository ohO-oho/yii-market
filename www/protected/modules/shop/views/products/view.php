<?php
$this->breadcrumbs=array(
	Shop::t('Products')=>array('index'),
	$model->title,
);

?>

<div class="product-header">
    <h2 class="title"><?php echo $model->title; ?></h2>
    <?php printf('<h2 class="price">%s</h2>',
            Shop::priceFormat($model->price));
    ?>
</div>

<div class="clear"></div>

<div class="product-images">
<?php 
if($model->images) {
	foreach($model->images as $image) {
		$this->renderPartial('/image/view', array( 'model' => $image));
		echo '<br />'; 
	}
} else 
$this->renderPartial('/image/view', array( 'model' => new Image()));
?>	
</div>

<div class="product-options"> 
	<?php $this->renderPartial('/products/addToCart', array(
			'model' => $model)); ?>
</div>


<div class="product-description">
	<p> <?php echo $model->description; ?> </p>
</div>


<?php 
$specs = $model->getSpecifications();
if($specs) {
	echo '<table>';
	
	printf ('<tr><td colspan="2"><strong>%s</strong></td></tr>',
			Shop::t('Product Specifications'));
			
	foreach($specs as $key => $spec) {
		if($spec != '')
			printf('<tr> <td> %s: </td> <td> %s </td> </td>',
					$key,
					$spec);
	}
	
	echo '</table>';
} 
?>
