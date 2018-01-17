<?php
use yii\widgets\DetailView;
$this->beginContent('@app/views/layouts/personal.php');?>
<?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'username',
                    'email:email',
                    'userRoleAlias',
                ],
            ]) ?>
<?php
$this->endContent();



  



