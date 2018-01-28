<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "group_types".
 *
 * @property integer $id
 * @property string $type_code
 * @property string $type_alias
 * @property string $description
 *
 * @property Groups[] $groups
 */
class GroupTypes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'group_types';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_code', 'type_alias', 'description'], 'required'],
            [['type_code', 'type_alias'], 'string', 'max' => 20],
            [['description'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type_code' => 'Код',
            'type_alias' => 'Буквенное обозначение',
            'description' => 'Описание',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroups()
    {
        return $this->hasMany(Groups::className(), ['group_type_id' => 'id']);
    }
}
