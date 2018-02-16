<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "buildings".
 *
 * @property integer $id
 * @property string $name
 * @property string $alias
 * @property string $region
 * @property string $metro
 * @property string $adress
 *
 * @property Groups[] $groups
 */
class Buildings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'buildings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'alias', 'region', 'metro', 'adress'], 'required', 'message' => 'поле не может быть пустым' ],
            [['name', 'alias', 'region', 'metro'], 'string', 'max' => 50],
            [['adress'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя на сервере',
            'alias' => 'Название',
            'region' => 'Район',
            'metro' => 'Метро',
            'adress' => 'Адрес',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroups()
    {
        return $this->hasMany(Groups::className(), ['building_id' => 'id']);
    }
}
