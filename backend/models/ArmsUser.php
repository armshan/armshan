<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%arms_user}}".
 *
 * @property int $ID
 * @property string $Username
 * @property string $Password
 * @property string $Access-Token
 * @property int $Status  1 正常 2 删除
 * @property string $CreateTime
 * @property string $UpdateTime
 */
class ArmsUser extends \yii\db\ActiveRecord
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
            [['Username', 'Password'], 'required'],
            ['Username', 'filter', 'filter' => 'trim'],
            ['Username', 'unique','message' => '该用户名已被使用！'],
            ['Username', 'string', 'min' => 6, 'max' => 16],
            ['Username', 'match','pattern'=>'/^[(x{4E00}-x{9FA5})a-zA-Z]+[(x{4E00}-x{9FA5})a-zA-Z_d]*$/u','message'=>'用户名由字母，汉字，数字，下划线组成，且不能以数字和下划线开头。'],
            [['Password'], 'string', 'min' => 6,'max'=>16],
            [['Status'], 'integer'],
            ['Status', 'in', 'range' => [1, 2, ]],
            [['CreateTime', 'UpdateTime'], 'safe'],
            [['Username', 'Password', 'Access-Token'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'Username' => '用户名',
            'Password' => '密码',
            'Access-Token' => '令牌',
            'Status' => '状态',
            'CreateTime' => '创建时间',
            'UpdateTime' => '更新时间',
        ];
    }
}
