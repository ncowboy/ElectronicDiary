<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "groups".
 *
 * @property integer $id
 * @property integer $building_id
 * @property integer $subject_id
 * @property integer $group_type_id
 *
 * @property Buildings $building
 * @property GroupTypes $groupType
 * @property Subjects $subject
 */
class Groups extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'groups';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['building_id', 'subject_id', 'group_type_id'], 'required'],
            [['building_id', 'subject_id', 'group_type_id'], 'integer'],
            [['building_id'], 'exist', 'skipOnError' => true, 'targetClass' => Buildings::className(), 'targetAttribute' => ['building_id' => 'id']],
            [['group_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => GroupTypes::className(), 'targetAttribute' => ['group_type_id' => 'id']],
            [['subject_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subjects::className(), 'targetAttribute' => ['subject_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'building_id' => 'Building ID',
            'subject_id' => 'Subject ID',
            'group_type_id' => 'Group Type ID',
            'groupCode' => 'Номер группы',
            'buildingName' =>'Филиал',	
            'subjectName' => 'Предмет'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    
    
    
    
    public function getBuilding()
    {
        return $this->hasOne(Buildings::className(), ['id' => 'building_id']);
    }
    
    public function getBuildingName(){
        return $this->building->alias;
    }

 
    public function getGroupType()
    {
        return $this->hasOne(GroupTypes::className(), ['id' => 'group_type_id']);
    }
    
    public function getGroupTypeCode(){
        return $this->groupType->type_alias;
    }
    
    public function getGroupCode()
    {
        return $this->addNull($this->building_id) . "." . $this->addNull($this->subject_id) . "-" . $this->getGroupTypeCode() . "-" . $this->addNull($this->id) ;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(Subjects::className(), ['id' => 'subject_id']);
    }
    
    public function getSubjectName()
    {
        return $this->subject->alias;
    }
    
    public function addNull($int) {
       if ($int < 10)
        $int = '0' . $int;
       return $int;
    }
}
