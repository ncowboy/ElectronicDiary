<?php

/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\Users;
use yii\helpers\Url;
rmrevin\yii\fontawesome\AssetBundle::register($this);
 $user = Yii::$app->user->identity;
 $userRoleName = Users::findOne(['username' => $user->username])->userRoleAlias;
 $loggedUserLabel = $user->name . ' ' . $user->surname . ' ' . '(' . $userRoleName . ')';


AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    $url = Yii::$app->request->getUrl();
    NavBar::begin([
        'brandLabel' => '',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'encodeLabels' => false,
        'activateParents' => true, 
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Пользователи', 'url' => ['/admin/users'], 'active' => $url == Url::toRoute(['/admin/users'])],
            ['label' => 'Учебные группы', 'url' => ['/admin/groups'], 'active' => $url == Url::toRoute(['/admin/groups'])],
            ['label' => 'Ученики', 'url' => ['/admin/students'], 'active' => $url == Url::toRoute(['/admin/students'])],
            ['label' => 'Преподаватели', 'url' => ['/admin/teachers'], 'active' => $url == Url::toRoute(['/admin/teachers'])],
            ['label' => 'Уроки', 'url' => ['/admin/lessons'], 'active' => $url == Url::toRoute(['/admin/lessons'])] ,
            ['label' => 'Каталог', 'items' => [
                ['label' => 'Филиалы', 'url' => ['/admin/buildings'], 'active' => $url == Url::toRoute(['/admin/buildings'])],
                ['label' => 'Предметы', 'url' => ['/admin/subjects'], 'active' => $url == Url::toRoute(['/admin/subjects'])],
                ['label' => 'Типы групп', 'url' => ['/admin/group-types'], 'active' => $url == Url::toRoute(['/admin/group-types'])]
            ]],
          
            Yii::$app->user->isGuest ? (
                ['label' => 'Вход', 'url' => ['/login']]
            ) :        
       (       
                ['label' => '<span class="glyphicon glyphicon-user"></span>', 'items' =>[
                    '<div class="container-fluid personal-label-header">'.Html::a(Html::encode($loggedUserLabel), Url::to('/admin/personal')).'</div>',
                    '<li>' . Html::a('Выход', '/site/logout', ['data' => [
                'confirm' => 'Выйти?',
                'method' => 'post',
            ],]) . '</li>'
                  ]]
            )
            
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'homeLink' => ['label' => '', 'url' => '/', 'class' => 'fa fa-home fa-lg',],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ])
        
            ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Образовательный центр МERLIN <?= date('Y') ?></p>

        <!--<p class="pull-right"><?= Yii::powered() ?></p> -->
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
