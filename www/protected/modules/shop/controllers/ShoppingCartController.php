<?php

class ShoppingCartController extends Controller
{
	public function actionView()
	{
		$cart = Shop::getCartContent();

		$this->render('view',array(
						'products'=>$cart
						));
	}

	public function actionGetPriceTotal() {
		echo Shop::getPriceTotal();
	}

	public function actionUpdateAmount() {
		$cart = Shop::getCartContent();

		foreach($_GET as $key => $value) {
			if(substr($key, 0, 7) == 'amount_') {
				if($value == '')
					return true;
				if (!is_numeric($value) || $value <= 0)
					throw new CException('Wrong amount');
				$position = explode('_', $key);
				$position = $position[1];
				
				if(isset($cart[$position]['amount']))
					$cart[$position]['amount'] = $value;
					$product = Products::model()->findByPk($cart[$position]['product_id']);
					echo Shop::priceFormat(
							@$product->getPrice($cart[$position]['Variations'], $value));
					return Shop::setCartContent($cart);
			}	
		}

}


	// Add a new product to the shopping cart
	public function actionCreate()
	{
		if(!is_numeric($_POST['amount']) || $_POST['amount'] <= 0) {
			Shop::setFlash(Shop::t('Illegal amount given'));
			$this->redirect(array( 
							'//shop/products/view', 'id' => $_POST['product_id']));
		}
		if(isset($_POST['Variations']))
			foreach($_POST['Variations'] as $key => $variation) {
				$specification = ProductSpecification::model()->findByPk($key);
				if($specification->required && $variation[0] == '') {
					Shop::setFlash(Shop::t('Please select a {specification}', array(
									'{specification}' => $specification->title)));
					$this->redirect(array(
								'//shop/products/view', 'id' => $_POST['product_id']));
				}

		}


		$cart = Shop::getCartContent();

		// remove potential clutter
		if(isset($_POST['yt0']))
			unset($_POST['yt0']);
		if(isset($_POST['yt1']))
			unset($_POST['yt1']);

		$cart[] = $_POST;
	
		Shop::setCartcontent($cart);
		Shop::setFlash(Shop::t('The product has been added to the shopping cart'));
		$this->redirect(array('//shop/products/index'));
	}

	public function actionDelete($id)
	{
		$id = (int) $id;
		$cart = json_decode(Yii::app()->user->getState('cart'), true);

		unset($cart[$id]);
		Yii::app()->user->setState('cart', json_encode($cart));

			$this->redirect(array('//shop/shoppingCart/view'));
	}

	public function actionIndex()
	{
		if(isset($_SESSION['cartowner'])) {
			$carts = ShoppingCart::model()->findAll('cartowner = :cartowner', array(':cartowner' => $_SESSION['cartowner']));

			$this->render('index',array( 'carts'=>$carts,));
		} 
	}

	public function actionAdmin()
	{
		$model=new ShoppingCart('search');
		if(isset($_GET['ShoppingCart']))
			$model->attributes=$_GET['ShoppingCart'];
			$model->cartowner = Yii::app()->User->getState('cartowner');

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=ShoppingCart::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='shopping cart-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
