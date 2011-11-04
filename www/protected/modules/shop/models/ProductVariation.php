<?php

/**
 * This is the model class for table "shop_product_variation".
 *
 * The followings are the available columns in table 'shop_product_variation':
 * @property integer $id
 * @property integer $product_id
 * @property integer $specification_id
 * @property string $title
 * @property double $price_adjustion
 */
class ProductVariation extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ProductVariation the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function listData($variations) {
		$var = array();

		foreach($variations as $id => $variation) 
			if($variation->price_adjustion == 0) 
				$var[$variation->id] = sprintf('%s', $variation->title);
			else
				$var[$variation->id] = sprintf('%s (%s%s)',
						$variation->title,
						$variation->price_adjustion > 0 ? '+' : '',
						Shop::priceFormat($variation->price_adjustion));

		return $var;
	}

	public function __toString() {
		return $this->title;
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'shop_product_variation';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_id, specification_id, title, price_adjustion, position', 'required'),
			array('product_id, specification_id', 'numerical', 'integerOnly'=>true),
			array('price_adjustion', 'numerical'),
			array('title', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, product_id, specification_id, title, price_adjustion', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'product' => array(self::BELONGS_TO, 'Products', 'product_id'),
			'specification' => array(self::BELONGS_TO, 'ProductSpecification', 'specification_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'product_id' => 'Product',
			'specification_id' => 'Specification',
			'title' => 'Title',
			'price_adjustion' => 'Price Adjustion',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('specification_id',$this->specification_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('price_adjustion',$this->price_adjustion);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}
