<?php

namespace app\controllers;

use app\models\Contribuicao;
use app\models\User;
use Yii;
use app\models\Vacosa;
use app\models\search\VacosaSearch;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * VacosasController implements the CRUD actions for Vacosa model.
 */
class VacosasController extends Controller
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
                        'actions' => ['index'],
                        'roles' => ['vacosa/index'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['view'],
                        'roles' => ['vacosa/view'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create'],
                        'roles' => ['vacosa/create'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['update'],
                        'roles' => ['vacosa/update'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['delete'],
                        'roles' => ['vacosa/delete'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['listar-vacosas'],
                        'roles' => ['vacosa/listar-vacosas'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['contribuir'],
                        'roles' => ['vacosa/contribuir'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['sugerir-vacosa'],
                        'roles' => ['vacosa/sugerir-vacosa'],
                    ],
                ],
                'denyCallback' => function ($rules, $action) {
                    throw new NotFoundHttpException("Página não encontrada!");
                },
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
     * Lists all Vacosa models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VacosaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Vacosa model.
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
     * Creates a new Vacosa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Vacosa();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('success', [
                'title' => 'Sucesso!',
                'text' => 'Registro salvo com sucesso!',
                'type' => 'success',
                'timer' => 30000,
                'showConfirmButton' => false
            ]);
            return $this->redirect(['/vacosas']);
        } else {
            $model->status = 1;
            $model->responsavel_id = Yii::$app->getUser()->getIdentity()->getId();
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Vacosa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('success', [
                'title' => 'Sucesso!',
                'text' => 'Registro salvo com sucesso!',
                'type' => 'success',
                'timer' => 30000,
                'showConfirmButton' => false
            ]);
            return $this->redirect(['/vacosas']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Vacosa model.
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
        return $this->redirect(['/vacosas']);
    }

    public function actionContribuir($id)
    {
        $vaca = Vacosa::find()->with(
            [
                'contribuicoes',
                'responsavel',
                'tipo'
            ])
            ->where(['id' => $id])
            ->andWhere(['!=', 'status', 0])
            ->one();

        if (is_null($vaca)) {
            throw new NotFoundHttpException('Essa vacosa não existe no sistema');
        }

        $valor = Contribuicao::find()->getSomaContribuicoes($id);
        if (Yii::$app->request->isPost) {
            $dados = Yii::$app->getRequest()->post();

            if (($valor + $dados['valor']) > $vaca->valor) {
                $valor_possivel = $vaca->valor - $valor;
                Yii::$app->getSession()->setFlash('warning', [
                    'title' => 'Atenção!',
                    'text' => "O valor da contribuição ultrapassou o valor da vacosa.\nVocê poderá contribuir com apenas R$ " . number_format($valor_possivel, 2, ",", "."),
                    'type' => 'warning',
                    'timer' => 30000,
                    'showConfirmButton' => false
                ]);
                return $this->render('contribuir', [
                    'vaca' => $vaca,
                    'valor' => $valor_possivel,
                    'valor_contribuido' => $valor
                ]);
            } else if ($dados['valor'] < 10.00) {
                Yii::$app->getSession()->setFlash('warning', [
                    'title' => 'Atenção!',
                    'text' => "O valor da contribuição não pode ser menor que  R$ 10,00",
                    'type' => 'warning',
                    'timer' => 30000,
                    'showConfirmButton' => false
                ]);
                return $this->render('contribuir', [
                    'vaca' => $vaca,
                    'valor' => 10.00,
                    'valor_contribuido' => $valor
                ]);
            }

            $contribuicao = new Contribuicao();
            $contribuicao->setAttribute('valor', $dados['valor']);
            $contribuicao->setAttribute('contribuinte_id', Yii::$app->getUser()->getIdentity()->getId());
            $contribuicao->setAttribute('vacosa_id', $id);

            if ($contribuicao->save()) {

                $imagem = UploadedFile::getInstanceByName('comprovante');

                if ($imagem instanceof UploadedFile) {

                    $path = Yii::getAlias('@webroot') . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR . "comprovantes" . DIRECTORY_SEPARATOR . Yii::$app->getUser()->getIdentity()->getId();

                    if (!is_dir($path)) {
                        mkdir($path, 0777, true);
                    }

                    $filename = $contribuicao->id . "-" . time() . md5(md5(md5($imagem->getBaseName()))) . "." . $imagem->getExtension();

                    $imagem->saveAs($path . DIRECTORY_SEPARATOR . $filename, true);
                    $contribuicao->comprovante = $filename;
                    $contribuicao->save(false, ['comprovante']);
                }

                $mailer = Yii::$app->mailer;
                $base_img = (Yii::$app->getUser()->getIdentity()->photo == "no-picture.png") ? "/images/" : "/uploads/usuarios/";

                $message = $mailer->compose('confirmacao', [
                    'nome' => Yii::$app->getUser()->getIdentity()->name,
                    'produto' => $vaca->nome,
                    'valor' => number_format($vaca->valor, 2, ",", "."),
                    'valor_contribuicao' => number_format($dados['valor'], 2, ",", ".")
                ])
                    ->setTo([Yii::$app->getUser()->getIdentity()->email => Yii::$app->getUser()->getIdentity()->name])
                    ->setFrom(['vacosas-no-reply@redmage.com.br' => "Vacosas Jedi's Dev"])
                    ->setSubject('Contribuição de vacosa - ' . $vaca->nome)
                    ->send();

                foreach (User::find()->where(['role_name' => "Administrador"])->all() as $admin) {
                    $message = $mailer->compose('confirmacao-admin', [
                        'contribuinte' => Yii::$app->getUser()->getIdentity()->name,
                        'produto' => $vaca->nome,
                        'valor_vacosa' => number_format($vaca->valor, 2, ",", "."),
                        'valor_contribuicao' => number_format($dados['valor'], 2, ",", "."),
                        'admin' => $admin->name,
                        'valor' => number_format($valor, 2, ",", "."),
                        'img_contribuinte' => $base_img . Yii::$app->getUser()->getIdentity()->photo
                    ])
                        ->setTo([Yii::$app->getUser()->getIdentity()->email => Yii::$app->getUser()->getIdentity()->name])
                        ->setFrom(['vacosas-no-reply@redmage.com.br' => "Vacosas Jedi's Dev"])
                        ->setSubject(Yii::$app->getUser()->getIdentity()->name . ' - Contribuição de vacosa - ' . $vaca->nome)
                        ->send();
                }
                Yii::$app->getSession()->setFlash('success', [
                    'title' => 'Obrigado!',
                    'text' => 'Sua contribuição foi salva com sucesso!',
                    'type' => 'success',
                    'timer' => 30000,
                    'showConfirmButton' => false
                ]);
                return $this->redirect(['/vacosas/listar-vacosas']);
            } else {
                $msg_erros = "";

                foreach ($contribuicao->getErrors() as $erros) {
                    foreach ($erros as $erro) {
                        $msg_erros .= $erro . "\n";
                    }
                }

                Yii::$app->getSession()->setFlash('warning', [
                    'title' => 'Atenção!',
                    'text' => $msg_erros,
                    'type' => 'warning',
                    'timer' => 30000,
                    'showConfirmButton' => false,
                    'html' => true
                ]);
                return $this->redirect(['/vacosas/contribuir/' . $id]);
            }
        }

        return $this->render('contribuir', [
            'vaca' => $vaca,
            'valor' => 10.00,
            'valor_contribuido' => $valor
        ]);
    }

    public function actionListarVacosas()
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

        return $this->render('listar-vacosas', [
            'vacosas' => $vacosas
        ]);
    }


    public function actionSugerirVacosa()
    {
        $model = new Vacosa();

        if ($model->load(Yii::$app->request->post())) {
            $model->status = 0;
            $model->responsavel_id = Yii::$app->getUser()->getId();
            if ($model->save()) {
                Yii::$app->getSession()->setFlash('success', [
                    'title' => 'Obrigado!',
                    'text' => "Sua sugestão de vacosa foi enviada para os administradores para revisão e aprovação!\nVocê reberá um e-mail de confirmação.",
                    'type' => 'success',
                    'timer' => 30000,
                    'showConfirmButton' => false
                ]);
                return $this->redirect(['/dashboard']);
            }
        }

        return $this->render('sugerir-vacosa', [
            'model' => $model
        ]);
    }

    /**
     * Finds the Vacosa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Vacosa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Vacosa::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
