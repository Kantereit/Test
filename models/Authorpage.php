<?php
namespace app\models;
use Yii;
use yii\base\Model;

class Authorpage extends Model {
	public $name;
	public function rules()
	{
	
		return [
			[['name'], 'required','message' => 'Введите имя']
	
		];
	
	}
}

?>