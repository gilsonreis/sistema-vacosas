<?php
/**
 * Created by PhpStorm.
 * User: gilso
 * Date: 14/10/2017
 * Time: 19:47
 */

namespace app\controllers;

use Yii;
use yii\base\Module;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class PermissoesController extends Controller
{
    private $auth;
    public $enableCsrfValidation = false;

    public function __construct($id, Module $module, array $config = [])
    {
        $this->auth = Yii::$app->authManager;
        parent::__construct($id, $module, $config);
    }

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
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }


    public function actionGerenciarPermissoes($perfil)
    {

        $role = $this->auth->getRole($perfil);

        if (!$perfil || empty($role)) {
            throw new NotFoundHttpException('Não encontrado!');
            return;
        }

        $per_fils = $this->auth->getPermissionsByRole($perfil);

        $permissoes_perfils = [];

        foreach ($per_fils as $fil) {
            $permissoes_perfils[] = $fil->name;
        }

        $permis = $this->auth->getPermissions();
        $permissoes = [];
        foreach ($permis as $row) {
            list($controller, $action) = explode("/", $row->name);
            $permissoes[$controller][] = $action;
        }

        if(Yii::$app->request->isPost) {
            $role = $this->auth->getRole($perfil);
            $this->auth->removeChildren($role);

            $form_permissoes = Yii::$app->request->post('form_permissoes');

            foreach ($form_permissoes as $perm) {
                $item = $this->auth->getPermission($perm);
                $this->auth->addChild($role, $item);
            }

            Yii::$app->getSession()->setFlash('success', [
                'title' => 'Sucesso!',
                'text' => 'Permissões atualizadas com sucesso!',
                'type' => 'success',
                'timer' => 30000,
                'showConfirmButton' => false
            ]);
            return $this->redirect(['/permissoes/gerenciar-permissoes/' . $perfil]);

        }


        return $this->render('gerenciar-permissoes', [
            'permissoes' => $permissoes,
            'perfil' => $perfil,
            'permissoes_perfils' => $permissoes_perfils
        ]);
    }

    public function actionIndex()
    {

    }

}