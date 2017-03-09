<?php

namespace app\controllers;
use yii\helpers\Html;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Authors;
use app\models\Authorpage;
use app\models\Authorsmain;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

   //экшен для главной страницы
   
	public function actionIndex()
	{
			$authorsmain = new Authorsmain();
				$authors = new Authors();
	
	//если данные передаются то показывем их
	if ((Yii::$app->request->get('name')) && ($authorsmain = Authorsmain::find()->where(['author' => Yii::$app->request->get('name')])->one())) 
	{
			$authors = Authors::find(['book'])->where(['author' => Yii::$app->request->get('name')])->all();
		
				return $this->render('author',[
		
					'name' => Yii::$app->request->get('name'),
				
						'book' => $authors
		
		]);
		//если нет то показываем всех авторов
	} else { 
		
			$authorsmain = Authorsmain::find()->all();
		
	
		return $this->render('index',[
		'authors' => $authorsmain
		]);
		}
	}
	
	//добавление авторов
	public function actionAddform()
	{
	
			
			$authors = new Authorsmain();
			$author = new Authorpage();
			
		if($author->load(Yii::$app->request->post()) && $author->validate()) {
			
				$authors->author = Html::encode($author->name);
			
				$authors->save();
			}
		
			
			return $this->render('addform',['author' => $author]);
	
	}
	//добавление книг 
	public function actionAddbook() {
	
		$authors = new Authorsmain();
	
		if((Yii::$app->request->get('name'))  && ($authors = Authorsmain::find()->where(['author' => Yii::$app->request->get('name')])->one())) {
				
				
				$addbook = new Authors();
	
					$author = new Authorpage();

	
	
	
			
			if($author->load(Yii::$app->request->post()) && $author->validate()) {
			
				$addbook->book = Html::encode($author->name);
					
						$addbook->author = Yii::$app->request->get('name');
			
							$addbook->save();
			}
		
			
			return $this->render('addbook',['author' => $author,'name' => Yii::$app->request->get('name')]);
			//если некорректный запрос показываем всех авторов
	} else {
	$authors = Authors::find()->all();
		
	
		return $this->render('index',[
		'authors' => $authors
		]);
	
	}
	
	}
	
	//обновление авторов
	public function actionUpdate() {
			$done='';
			$type='автора';//указываем что именно мы редактируем
			$authors = new Authorsmain();
			$author = new Authorpage();
			//если отправилась форма и прошла валидацию
			if($author->load(Yii::$app->request->post()) && $author->validate()) {
		
					Yii::$app->db->createCommand()->update('authorsmain', ['author' => $author->name], ['author' => Yii::$app->request->get('name')])->execute();
					Yii::$app->db->createCommand()->update('authors', ['author' => $author->name], ['author' => Yii::$app->request->get('name')])->execute();

			
			
							$authors->save();
								$done = 'Запрос выполнен успешно!';
								return $this->render('update',[
									'author'=>$author,
										'name'=>Yii::$app->request->get('name'),
											'done' => $done,
												'type' => $type
			]);
			}
		
		
	
		if((Yii::$app->request->get('name'))  && ($authors = Authorsmain::find()->where(['author' => Yii::$app->request->get('name')])->one())) {
		
			return $this->render('update',[
				'author'=>$author,
					'name'=>Yii::$app->request->get('name'),
						'done'=>$done,
							'type' => $type
			]);
		
		
		}
	
	
	
	
	}
	//обновление данных о книгах
	public function actionUpdatebook() {
		$done='';
		$addbook = new Authors();
		$type='книгу';
		
			$author = new Authorpage();
			
			//получили данные и прошли валидацию
			if($author->load(Yii::$app->request->post()) && $author->validate()) {
		
					
					Yii::$app->db->createCommand()->update('authors', ['book' => $author->name], ['book' => Yii::$app->request->get('book')])->execute();

							$addbook->save();
								$done = 'Запрос выполнен успешно!';
								return $this->render('update',[
									'author'=>$author,
										'name'=>Yii::$app->request->get('book'),
											'done' => $done,
												'type' => $type
			]);
			}
		
		if((Yii::$app->request->get('book'))  && ($addbook = Authors::find()->where(['book' => Yii::$app->request->get('book')])->one())) {
	
					return $this->render('update',[
						'author'=>$author,
							'name'=>Yii::$app->request->get('book'),
								'done'=>$done,
									'type'=>$type
			]);
	} else {
	//если пытаемся изменить несуществующую книгу
	return $this->render('error',[
	
	'name' => 'Ошибка 404',
	'message' => 'Страница не найдена'
	
	]);
	
	}
		
	}
	//удаление книги
	public function actionDeletebook() {
	
		$authors = new Authors();
			$author = new Authorpage();
			//проверяем на существование
			    if((Yii::$app->request->get('book'))  && ($authors = Authors::find()->where(['book' => Yii::$app->request->get('book')])->one())) {
				//удаляем
						Yii::$app->db->createCommand()->delete('authors', ['book' => Yii::$app->request->get('book')])->execute();
				//показываем все книги автора без удаленной
							$authors = Authors::find(['book'])->where(['author' => Yii::$app->request->get('name')])->all();
				
					return $this->render('author',[
		
						'name' => Yii::$app->request->get('name'),
				
							'book' => $authors
				
					]);
	
				}
}
}
