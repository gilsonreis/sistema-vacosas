<?php

namespace app\controllers;

use app\models\Vacosa;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

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
                'rules' => [
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

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $vacosas = Vacosa::find()
            ->with([
                'contribuicoes',
                'contribuicoes.contribuinte',
                'tipo'
            ])
            ->where(['status' => 1])
            ->orderBy('create_at desc')
            ->all();

        $id_usuario = Yii::$app->getUser()->getIdentity()->getId();

        // Dashboard total participacoes
        $sql_participacoes = "select
                count( id ) qts
            from
                contribuicoes
            where
                contribuinte_id = :id_usuario
                and comprovado = 1;";
        $qtde_participacoes = Yii::$app->getDb()->createCommand($sql_participacoes, ['id_usuario' => $id_usuario])->queryScalar();

        // Dashboard total participacoes 6 meses
        $sql_participacoes = "select
                count( id ) as qts_seis_meses
            from
                contribuicoes
            where
                create_at >= date_sub(
                    now(),
                    interval 6 month
                )
                and contribuinte_id = :id_usuario
                and comprovado = 1;";
        $qtde_participacoes_6_meses = Yii::$app->getDb()->createCommand($sql_participacoes, ['id_usuario' => $id_usuario])->queryScalar();

        // Dashboard soma valores contribuições
        $sql_valor = "select
                sum( valor ) qts_valor
            from
                contribuicoes
            where
                contribuinte_id = :id_usuario
                and comprovado = 1;";
        $valor_contribuicao = Yii::$app->getDb()->createCommand($sql_valor, ['id_usuario' => $id_usuario])->queryScalar();

        // Dashboard contribuições indicações por mim
        $sql_valor = "select
                count( id ) qts_por_mim
            from
                vacosas
            where
                responsavel_id = :id_usuario;";
        $valor_contribuicao_por_mim = Yii::$app->getDb()->createCommand($sql_valor, ['id_usuario' => $id_usuario])->queryScalar();

        return $this->render('dashboard', [
            'vacosas' => $vacosas,
            'valor_contribuicao' => $valor_contribuicao,
            'qtde_participacoes' => $qtde_participacoes,
            'qtde_participacoes_6_meses' => $qtde_participacoes_6_meses,
            'valor_contribuicao_por_mim' => $valor_contribuicao_por_mim
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }



    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
