<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models\personal;

/**
 * Description of ExcelForm
 *
 * @author i.borisov
 */
class ExcelForm extends \yii\base\Model {
    public $file;
    
    public function rules(){
        return [
            [['file'],'required'],
            [['file'],'file','extensions'=>'xlsx','maxSize'=>1024 * 1024 * 5],
        ];
    }
    
    public function attributeLabels(){
        return [
            'file'=>'Select File',
        ];
    }

}
