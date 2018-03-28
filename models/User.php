<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $user
 * @property string $password
 * @property string $auth_key
 * @property string $photo
 * @property integer $status
 * @property string $last_login
 * @property string $create_at
 * @property string $update_at
 * @property string $role_name;
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{

    public $perfil;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'username', 'auth_key', 'role_name'], 'required'],
            [['password'], 'required', 'on' => 'create'],
            [['status'], 'integer'],
            [['last_login', 'create_at', 'update_at'], 'safe'],
            [['name'], 'string', 'max' => 60],
            [['email'], 'string', 'max' => 130],
            [['username'], 'string', 'max' => 32],
            [['password', 'auth_key'], 'string', 'max' => 150],
            [['photo'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Nome'),
            'email' => Yii::t('app', 'E-mail'),
            'username' => Yii::t('app', 'Login'),
            'password' => Yii::t('app', 'Senha'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'photo' => Yii::t('app', 'Foto'),
            'status' => Yii::t('app', 'Status'),
            'last_login' => Yii::t('app', 'Último Login'),
            'create_at' => Yii::t('app', 'Criado em'),
            'update_at' => Yii::t('app', 'Alterado em'),
            'role_name' => Yii::t('app', 'Perfil')
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\query\UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\UserQuery(get_called_class());
    }

    /**
     * Finds an identity by the given ID.
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface the identity object that matches the given ID.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     * @param mixed $token the token to be looked for
     * @param mixed $type the type of the token. The value of this parameter depends on the implementation.
     * For example, [[\yii\filters\auth\HttpBearerAuth]] will set this parameter to be `yii\filters\auth\HttpBearerAuth`.
     * @return IdentityInterface the identity object that matches the given token.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException();
    }

    /**
     * Returns an ID that can uniquely identify a user identity.
     * @return string|int an ID that uniquely identifies a user identity.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns a key that can be used to check the validity of a given identity ID.
     *
     * The key should be unique for each individual user, and should be persistent
     * so that it can be used to check the validity of the user identity.
     *
     * The space of such keys should be big enough to defeat potential identity attacks.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @return string a key that is used to check the validity of a given identity ID.
     * @see validateAuthKey()
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * Validates the given auth key.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @param string $authKey the given auth key
     * @return bool whether the given auth key is valid.
     * @see getAuthKey()
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->getAttribute('password'));
    }

    public static function findByUserName($username)
    {
        return static::findOne(['username' => $username, 'status' => 1]);
    }
}
