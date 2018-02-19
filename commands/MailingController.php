<?php
namespace app\commands;

use yii\console\Controller;
use app\models\Students;
use app\models\MailerForm;
use yii\helpers\Console;
/**
 * Console mailer for students reports
 * 
 */

class MailingController extends Controller
{
  public $defaultAction = 'send';
    /**
     * This command sends reports to all students parents.
     * 
     */ 
    public function actionSend()
    {
         $students = Students::find()->all();
         Console::startProgress(0, count($students));   
      if(isset($students)) {
        foreach ($students as $key => $value) {
        $email = new MailerForm();
        $email->setAttributes([
        'id' => $value->id,
        'email' => $value->parents_email,
        'fullName' => $value->userFullName
        ]);
        $email->sendEmail();
        Console::updateProgress($key+1, count($students));
        }
        Console::endProgress();
      }
      return true;
    }
}
