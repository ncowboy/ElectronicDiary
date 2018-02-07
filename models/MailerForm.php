<?php

namespace app\models;

use Yii;
use yii\base\Model;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use yii\helpers\ArrayHelper;

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
     
       $sheet->setCellValue('A1', 'Дата и время')
           ->setCellValue('B1', 'Группа')
           ->setCellValue('C1', 'Предмет')
            ->setCellValue('D1', 'Тема')
            ->setCellValue('E1', 'П')
            ->setCellValue('F1', 'РУ')
            ->setCellValue('G1', 'ДЗ')
            ->setCellValue('H1', 'Д')
            ->setCellValue('I1', 'Комментарий');
       $sheet->getStyle('A1:I1')->getAlignment()
           ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
       $sheet->getStyle('A1:I1')->getFont()->setBold(\PhpOffice\PhpSpreadsheet\Shared\Font::ARIAL_BOLD);
       $sheet->getStyle('A1:I1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->
       getStartColor()->setRGB('C0C0C0');
       $sheet->getColumnDimension('A')->setAutoSize(true);
       $sheet->getColumnDimension('B')->setAutoSize(true);
       $sheet->getColumnDimension('C')->setAutoSize(true);
       $sheet->getColumnDimension('D')->setWidth('30');
       $sheet->getColumnDimension('I')->setWidth('30');
       $sheet->getStyle('D1:D500')->getAlignment()->setWrapText(true);
       $sheet->getStyle('I1:I500')->getAlignment()->setWrapText(true);
       $sheet->setAutoFilter('A1:I1');
       
      
       $sheet->getStyle('E1:H500')->getAlignment()
           ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
       
      $student = Students::findOne(['id' => $this->id]);
      $inLesson = StudentsInLesson::findAll(['student_id' => $student->id]);
      ArrayHelper::multisort($inLesson, function($model) {
        return $model->lesson->datetime;
      });
           foreach ($inLesson as $key => $value) {
             
        $sheet->setCellValueByColumnAndRow(1, $key+2, $value->lesson->datetime)
        ->setCellValueByColumnAndRow(2, $key+2, $value->groupCode)
         ->setCellValueByColumnAndRow(3, $key+2, $value->lesson->group->subjectName)
         ->setCellValueByColumnAndRow(4, $key+2, $value->lesson->theme)
        ->setCellValueByColumnAndRow(5, $key+2, $value->attendanceString)
        ->setCellValueByColumnAndRow(6, $key+2, $value->mark_work_at_lesson)
        ->setCellValueByColumnAndRow(7, $key+2, $value->mark_homework)
        ->setCellValueByColumnAndRow(8, $key+2, $value->mark_dictation)
        ->setCellValueByColumnAndRow(9, $key+2, $value->comment);
       }
       $sheet->getStyle('A1:I' . (string)(count($inLesson)+1))->getBorders()->getAllBorders()
         ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
       
       $sheet->getCell('A' . (string)(count($inLesson)+2))
           ->setValue('"П" - посещаемость, "РУ" - оценка за работу на уроке, '
               . '"ДЗ" - оценка за домашнее задание, "Д" - оценка за диктант')
           ->getStyle()->getFont()->setItalic(true)->setSize(9)->setBold(true);
       $sheet->mergeCells('A' . (string)(count($inLesson)+2) . ':I' . (string)(count($inLesson)+2));
      
      $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
      $file = 'uploads/reportStudentId' . $student->id . '.xlsx';
      var_dump($student);
      $writer->save($file);
      
      return true;
  
    }
    
    public function sendEmail()
    {
      $student = Students::findOne(['id' => $this->id]);
      if ($this->validate()) {
            Yii::$app->mailer->compose()
                ->setTo($this->email)->setFrom('merlin.ege@gmail.com')
                ->setSubject('Отчет об успеваемости студента: ' . $this->fullName)
                ->setTextBody('какие-то данные')
                ->attach('uploads/reportStudentId' . $student->id . '.xlsx')
                ->send();
            return true;
      }else{
        return false;
      }   
    }
    
    
}