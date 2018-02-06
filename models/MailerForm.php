<?php

namespace app\models;

use Yii;
use yii\base\Model;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class MailerForm extends Model
{
    public $id;
    public $email;
    public $fullName;
    
    public function rules()
    {
        return [
            [['email', 'fullName', 'id'], 'required'],
            ['email', 'email'],
        ];
    }
    
    public function createFile() {
      
      $spreadsheet = new Spreadsheet();
      $spreadsheet->setActiveSheetIndex(0);
      $sheet = $spreadsheet->getActiveSheet();
     
       $sheet->setCellValue('A1', 'Урок')
            ->setCellValue('B1', 'Дата и время')
            ->setCellValue('C1', 'Тема')
            ->setCellValue('D1', 'Посещаемость')
            ->setCellValue('E1', 'Работа на уроке')
            ->setCellValue('F1', 'Домашнее задание')
            ->setCellValue('G1', 'Диктант')
            ->setCellValue('H1', 'Комментарий');
       
      $student = Students::findOne(['id' => $this->id]);
      $inLesson = StudentsInLesson::findAll(['student_id' => $student->id]);
     
     
      
      foreach ($inLesson as $key => $value) {
        $sheet->setCellValueByColumnAndRow(1, $key+2, $value->marksGroupedString)
        ->setCellValueByColumnAndRow(2, $key+2, $value->lesson->datetime)
        ->setCellValueByColumnAndRow(3, $key+2, $value->lesson->theme)
        ->setCellValueByColumnAndRow(4, $key+2, $value->attendance)
        ->setCellValueByColumnAndRow(5, $key+2, $value->mark_work_at_lesson)
        ->setCellValueByColumnAndRow(6, $key+2, $value->mark_homework)
        ->setCellValueByColumnAndRow(7, $key+2, $value->mark_dictation)
        ->setCellValueByColumnAndRow(8, $key+2, $value->comment);
       }
       
      //   $sheet->setCellValueByColumnAndRow(1, 2, 'привет')
   //     ->setCellValueByColumnAndRow(2, 2, 'привет1')
      //  ->setCellValueByColumnAndRow(3, 2, 'привет2')
      //  ->setCellValueByColumnAndRow(4, 2,'привет3')
      //  ->setCellValueByColumnAndRow(5, 2, 'привет4')
      //  ->setCellValueByColumnAndRow(6, 2, 'привет5')
       // ->setCellValueByColumnAndRow(7, 2, 'привет6')
       // ->setCellValueByColumnAndRow(8, 2, 'привет7')
       // ->mergeCells('A3:H3');
      
      $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
      $writer->save('uploads/report.xlsx');
      return true;
  
    }
    
    public function sendEmail()
    {
      if ($this->validate()) {
            Yii::$app->mailer->compose()
                ->setTo($this->email)->setFrom('merlin.ege@gmail.com')
                ->setSubject('Отчет об успеваемости студента: ' . $this->fullName)
                ->setTextBody('какие-то данные')
                ->attach('uploads/report.xlsx')
                ->send();
            return true;
      }else{
        return false;
      }   
    }
    
    
}