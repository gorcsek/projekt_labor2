<?php

namespace app\controllers;

use Yii;
use app\models\Users;
use app\models\UsersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\AccessRule;
use yii\filters\AccessControl;

/**
 * UsersController implements the CRUD actions for Users model.
 */
class UsersController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                   'class' => AccessControl::className(),
                   // We will override the default rule config with the new AccessRule class
                   'ruleConfig' => [
                       'class' => AccessRule::className(),
                   ],
                   'only' => ['index','create', 'update', 'delete'],
                   'rules' => [
                       [
                           'actions' => ['index','create', 'update', 'delete'],
                           'allow' => true,
                           // Allow users, moderators and admins to create
                           'roles' => [
                               Users::ROLE_ADMIN
                           ],
                       ],
                       [
                           'actions' => ['update', 'view'],
                           'allow' => true,
                           // Allow users, moderators and admins to create
                           'roles' => [
                               Users::ROLE_ADMIN
                           ],
                       ],
                    ]
                ]
        ];
    }

    /**
     * Lists all Users models.
     * @return mixed
     */
    public function actionIndex()
    {
    //var_dump(Yii::$app->user);die;
        $searchModel = new UsersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Users model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if(Yii::$app->user->identity->role >= 90){
            $model = $this->findModel($id);
        }else{
            $model = $this->findModel(Yii::$app->user->identity->id);
        }
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Users model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Users();
        $model->enabled = 1;
        $model->created = new \DateTime('now');
        $model->created = $model->created->format('Y-m-d');
        $model->authkey = Yii::$app->security->generateRandomString();
        //$model->authkey = crypt($model->username, '$2a$10$1qAz2wSx3eDc4rFv5tGb5t');
        if ($model->load(Yii::$app->request->post())) {
            $model->password = crypt($model->password, Yii::$app->getSecurity()->generatePasswordHash($model->password));
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $model->password = "";
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Users model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(Yii::$app->user->identity->role >= 90){
            $model = $this->findModel($id);
        }else{
            $model = $this->findModel(Yii::$app->user->identity->id);
        }

        if(empty($_POST['Users']['password'])){
            unset($_POST['Users']['password']);
        }
        if ($model->load($_POST) ){
            if(isset($_POST['Users']['password'])){
                $model->password = crypt($model->password, Yii::$app->getSecurity()->generatePasswordHash($model->password));
            }
            if($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->password = "";
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Users model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(Yii::$app->user->identity->role >= 90){
            $this->findModel($id)->delete();
            return $this->redirect(['index']);
        }else{
            throw new NotFoundHttpException('Nem engedélyezett művelet.');
        }

    }

    /**
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Users the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Users::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
