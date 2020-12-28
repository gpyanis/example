<?php
namespace app\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Registrs;
use yii\grid\GridView;
use yii\db\Query;
use kartik\mpdf\Pdf;

class ExampleController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout', 'matricas'],
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





	public function actionRegistrs($type){

		if(Yii::$app->request->isPost){
			if(!empty(Yii::$app->request->post()['download'])){
				          $file = new DownloadFile();
				          if($file->download()==false){
				            throw new NotFoundHttpException;
				          }
				      }
			}

	$searchModel  = new Registrs();
	$dataProvider = $searchModel->search(Yii::$app->request->queryParams, $type);

		$tabs = [
			1=>['label'=>'Visi', 'url'=>Url::toRoute(['atskaites/registrs', 'type' => 1])],
			2=>['label'=>'Nenosūtīti', 'url'=>Url::toRoute(['atskaites/registrs', 'type' => 2])]
		];
		$tabs[$type] = array_merge($tabs[$type], ['active' => true]);

		return $this->render('registrs', ['tabs'=>$tabs, 'dataProvider'=>$dataProvider, 'model'=>$model, 'items'=>$items,  'searchModel' => $searchModel, 'searchColumns'=>$searchColumns]);


	}

}
