<?php

namespace app\controllers;

use app\models\LoginForm;
use Yii;
use app\models\User;
use app\models\search\UserSearch;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login', 'logout']
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ],
                    [
                        'allow' => false,
                        'roles' => ['?']
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();
        $model->setScenario('create');
        if ($model->load(Yii::$app->request->post())) {

            $model->setAttribute('password', Yii::$app->security->generatePasswordHash($model->getAttribute('password')));
            $model->auth_key = Yii::$app->security->generateRandomString();

            if($model->save()) {

                $auth = \Yii::$app->authManager;
                $authorRole = $auth->getRole($model->role_name);
                $auth->assign($authorRole, $model->getId());

                Yii::$app->getSession()->setFlash('success', [
                    'title' => 'Sucesso!',
                    'text' => 'Registro salvo com sucesso!',
                    'type' => 'success',
                    'timer' => 30000,
                    'showConfirmButton' => false
                ]);
                return $this->redirect(['/user']);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $auth = \Yii::$app->authManager;

        $role_user = $auth->getAssignments($model->getId());
        $role_user = array_values($role_user);

        $model->role_name = $role_user[0]->roleName;

        if ($model->load(Yii::$app->request->post())) {
            $model->setAttribute('password', Yii::$app->security->generatePasswordHash($model->getAttribute('password')));


            if($model->save()) {
                $role = $auth->getRole($model->role_name);
                $auth->revokeAll($model->getId());
                $auth->assign($role, $model->getId());

                Yii::$app->getSession()->setFlash('success', [
                    'title' => 'Sucesso!',
                    'text' => 'Registro salvo com sucesso!',
                    'type' => 'success',
                    'timer' => 30000,
                    'showConfirmButton' => false
                ]);
                return $this->redirect(['/user']);
            }
        } else {
            $model->setAttribute('password', "");
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        Yii::$app->getSession()->setFlash('success', [
            'title' => 'Sucesso!',
            'text' => 'Registro excluído com sucesso!',
            'type' => 'success',
            'timer' => 30000,
            'showConfirmButton' => false
        ]);
        return $this->redirect(['/user']);
    }

    public function actionLogin()
    {
        $this->layout = 'login';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $user = User::findOne(Yii::$app->getUser()->getIdentity()->getId());
            $user->last_login = date("Y-m-d H:i:s");
            $user->save();
            return $this->goBack('/dashboard');
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect('/user/login');
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
