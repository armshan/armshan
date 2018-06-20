<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\base\NotSupportedException;
use yii\web\NotFoundHttpException;
use yii\web\UrlNormalizerRedirectException;

/**
 * This is the model class for table "{{%arms_user}}".
 *
 * @property int $ID
 * @property string $UserName
 * @property string $Password
 * @property string $Access-Token
 * @property int $Status  1 正常 2 删除
 * @property string $CreateTime
 * @property string $UpdateTime
 */

 class User extends ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    const STATUS_ACTIVE=1;
    const STATUS_DELETE=2;

    public static function tableName()
    {
        return '{{%arms_user}}';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'CreateTime',
                'updatedAtAttribute' => 'UpdateTime',
                'value' => date('Y-m-d H:i:s',time())
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['UserName', 'Password'], 'required'],
            ['UserName', 'filter', 'filter' => 'trim'],
            ['UserName', 'unique','message' => '该用户名已被使用！'],
            ['UserName', 'string', 'min' => 6, 'max' => 16],
            [['Password'], 'string', 'min' => 6,'max'=>16],
            [['Status'], 'integer'],
            ['Status', 'in', 'range' => [1, 2]],
            [['CreateTime', 'UpdateTime'], 'safe'],
            [['UserName', 'Password', 'AccessToken'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'UserName' => '用户名',
            'Password' => '密码',
            'AccessToken' => '令牌',
            'Status' => '状态',
            'CreateTime' => '创建时间',
            'UpdateTime' => '更新时间',
        ];
    }


     public function beforeValidate()
     {
         if ($this->isNewRecord) {
             $this->setPassword($this->Password);
         }
         return true;
     }
     public function setPassword($password)
     {
         $this->Password = substr(md5($password),8,16);
     }

     public function validatePassword($password)
    {
         return substr(md5(substr(md5($password),8,16)),8,16)=== $this->Password;
     }


     public function getAuthKey()
     {
         return $this->Password;
     }

     /**
      * @inheritdoc
      */
     public function validateAuthKey($authKey)
     {
         return $this->getAuthKey() === $authKey;
     }
     /**
      * @inheritdoc
      */
     public static function findIdentity($id)
     {
         return static::findOne(['id' => $id, 'Status' => self::STATUS_ACTIVE]);
     }

     /**
      * @inheritdoc
      */
     public static function findIdentityByAccessToken($token, $type = null)
     {
         return static::findOne(['AccessToken' => $token, 'Status' => self::STATUS_ACTIVE]);
     }

     /**
      * Finds user by username
      *
      * @param string $username
      * @return static|null
      */
     public static function findByUsername($username)
     {
         return static::findOne(['UserName' => $username, 'Status' => self::STATUS_ACTIVE]);
     }

     /**
      * Finds user by password reset token
      *
      * @param string $token password reset token
      * @return static|null
      */
     public static function findByPasswordResetToken($token)
     {
         if (!static::isPasswordResetTokenValid($token)) {
             return null;
         }

         return static::findOne([
             'password_reset_token' => $token,
             'Status' => self::STATUS_ACTIVE,
         ]);
     }

     /**
      * Finds out if password reset token is valid
      *
      * @param string $token password reset token
      * @return bool
      */
     public static function isPasswordResetTokenValid($token)
     {
         if (empty($token)) {
             return false;
         }

         $timestamp = (int) substr($token, strrpos($token, '_') + 1);
         $expire = Yii::$app->params['user.passwordResetTokenExpire'];
         return $timestamp + $expire >= time();
     }

     /**
      * @inheritdoc
      */
     public function getId()
     {
         return $this->getPrimaryKey();
     }

     /**
      * @inheritdoc
      */


     /**
      * Validates password
      *
      * @param string $password password to validate
      * @return bool if password provided is valid for current user
      */



     /**
      * Generates "remember me" authentication key
      */
     public function generateAuthKey()
     {
         throw new NotSupportedException('"generateAuthKey" is not implemented.');
//        $this->Password = Yii::$app->security->generateRandomString();
     }

     /**
      * Generates new password reset token
      */
     public function generatePasswordResetToken()
     {
         throw new NotSupportedException('"generatePasswordResetToken" is not implemented.');
//        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
     }

     /**
      * Removes password reset token
      */
     public function removePasswordResetToken()
     {
         throw new NotSupportedException('"removePasswordResetToken" is not implemented.');
//        $this->password_reset_token = null;
     }



     /**
      * 生成 api_token
      */
     public function generateApiToken()
     {
         $this->AccessToken = Yii::$app->security->generateRandomString() . '_' . time();
     }

     /**
      * 校验api_token是否有效
      * @param $token
      * @return bool
      */
     public static function apiTokenIsValid($token)
     {
         if (empty($token)) {
             return false;
         }

         $timestamp = (int) substr($token, strrpos($token, '_') + 1);
         $expire = Yii::$app->params['user.apiTokenExpire'];
         return $timestamp + $expire >= time();
     }
}
