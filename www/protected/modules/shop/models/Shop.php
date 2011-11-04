<?php

	class Shop {
		public static function mailNotification ($order) {
			$email = Shop::module()->notifyAdminEmail;
			if($email !== null) {
				$appTitle = Yii::app()->name;
				$headers="From: {$title}\r\nReply-To: {do@not-reply.org}";

				mail($email,
						Shop::t('Order #{order_id} has been made in your Webshop', array(
								'{order_id}' => $order->id)),
						CHtml::link(Shop::t('direct link'), array(
								'//shop/order/view', 'id' => $order->id)));
			}
		}

		public static function pricingInfo() {
			Shop::register('js/jquery.tools.min.js');
			Shop::register('css/shop.css');
			Yii::app()->clientScript->registerScript('tooltip', 
					"$('.price_information').tooltip(); ");

			echo '<p class="price_information">';
			echo Shop::t('All prices are including VAT') . '<br />';
			echo Shop::t('All prices excluding shipping costs');
			echo '</p>';
			echo '<div class="tooltip">';
				Yii::app()->controller->renderPartial('/shippingMethod/index'); 
			echo '</div>';

		}

/*		public function getCustomer() {
			$customer = false;
			$customer = Yii::app()->user->getState('customer_id');
				if(!$customer && !Yii::app()->user->isGuest)
					$customer = Customer::model()->find('user_id = :uid', array(
								':uid' => Yii::app()->user->id));

			return $customer;

		} */

		public static function priceFormat ($price) {
			$price = sprintf('%.2f', $price);
			if(Yii::app()->language == 'de')
				$price = str_replace('.', ',', $price);

			$price .= ' '.Shop::module()->currencySymbol;
		
			return $price;
		}
		public static function getPaymentMethod() {
			return Yii::app()->user->getState('payment_method');
		}

		public static function getShippingMethod() {
			if($shipping_method = Yii::app()->user->getState('shipping_method'))
				return ShippingMethod::model()->findByPk($shipping_method);
		}


		public static function getCartContent() {
			if(is_string(Yii::app()->user->getState('cart')))
				return json_decode(Yii::app()->user->getState('cart'), true);
			else
				return Yii::app()->user->getState('cart');
		}

		public static function setCartContent($cart) {
			return Yii::app()->user->setState('cart', json_encode($cart));
		}

		public static function getPriceTotal() {
			$price_total = 0;
			$tax_total = 0;
			foreach(Shop::getCartContent() as $product)  {
				$model = Products::model()->findByPk($product['product_id']);
				$price_total += $model->getPrice(@$product['Variations'], @$product['amount']);
				$tax_total += $model->getTaxRate(@$product['Variations'], @$product['amount']);

		}

			if($shipping_method = Shop::getShippingMethod())
				$price_total += $shipping_method->price;

			$price_total = Shop::t('Price total: {total}', array(
						'{total}' => Shop::priceFormat($price_total),
						)); 
			$price_total .= '<br />';
			$price_total .= Shop::t('All prices are including VAT: {vat}', array(
						'{vat}' => Shop::priceFormat($tax_total))) . '<br />';
			$price_total .= Shop::t('All prices excluding shipping costs') . '<br />';

			return $price_total;
		}

		public static function register($file)
		{
			$url = Yii::app()->getAssetManager()->publish(
					Yii::getPathOfAlias('application.modules.shop.assets'));

			$path = $url . '/' . $file;
			if(strpos($file, 'js') !== false)
				return Yii::app()->clientScript->registerScriptFile($path);
			else if(strpos($file, 'css') !== false)
				return Yii::app()->clientScript->registerCssFile($path);

			return $path;
		}

	public static function module()
	{
		if(isset(Yii::app()->controller)
			&& isset(Yii::app()->controller->module)
			&& Yii::app()->controller->module instanceof ShopModule)
			return Yii::app()->controller->module;
		elseif(Yii::app()->getModule('shop') instanceof ShopModule)
			return Yii::app()->getModule('shop');
		else
		{
			while (($parent=$this->getParentModule())!==null)
				if($parent instanceof shopModule)	
					return $parent;
		} 
	}


		public static function getCustomer() {
			if(!Yii::app()->user->isGuest) 
				if($customer = Customer::model()->find('user_id = :uid', array(
							':uid' => Yii::app()->user->id))) 
				return $customer;

			if($customer_id = Yii::app()->user->getState('customer_id')) 
				return Customer::model()->findByPk($customer_id);
		}

		public static function t($string, $params = array())
		{
			Yii::import('application.modules.shop.ShopModule');

			return Yii::t('ShopModule.shop', $string, $params);
		}
		/* set a flash message to display after the request is done */
		public static function setFlash($message) 
		{
			Yii::app()->user->setFlash('yiishop',Shop::t($message));
		}

		public static function hasFlash() 
		{
			return Yii::app()->user->hasFlash('yiishop');
		}

		/* retrieve the flash message again */
		public static function getFlash() {
			if(Yii::app()->user->hasFlash('yiishop')) {
				return Yii::app()->user->getFlash('yiishop');
			}
		}

		public static function renderFlash()
		{
			if(Yii::app()->user->hasFlash('yiishop')) {
				echo '<div class="info">';
				echo Shop::getFlash();
				echo '</div>';
				Yii::app()->clientScript->registerScript('fade',"
						setTimeout(function() { $('.info').fadeOut('slow'); }, 5000);	
						"); 
			}
		}
	}
