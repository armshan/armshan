<?php
namespace common\models;

use Yii;

/**
 * This is the model class for table "jw_Relation_Template_TemplateCate".
 *
 * @property integer $TemplateCateId
 * @property integer $TemplateId
 */
class RelationTemplateTemplateCate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jw_Relation_Template_TemplateCate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TemplateCateId', 'TemplateId'], 'required'],
            [['TemplateCateId', 'TemplateId'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'TemplateCateId' => '模板所属分类',
            'TemplateId' => '分类ID',
        ];
    }
}
