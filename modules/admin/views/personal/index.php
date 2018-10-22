<?php
use yii\widgets\DetailView;
$this->beginContent('@app/modules/admin/views/layouts/personal.php');
?>
<h4>Профиль</h4>
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



  



