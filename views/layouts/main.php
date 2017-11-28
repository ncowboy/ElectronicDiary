<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;
use rmrevin\yii\fontawesome\FA;
rmrevin\yii\fontawesome\AssetBundle::register($this);


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
    NavBar::begin([
        'brandLabel' => '',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [ 
             Yii::$app->user->can('menu_users') ?
            ['label' => 'Пользователи', 'url' => ['/users/show']] : (''),
             Yii::$app->user->can('menu_groups') ?
            ['label' => 'Учебные группы', 'url' => ['/groups']] : (''),
             Yii::$app->user->can('menu_students') ?
            ['label' => 'Ученики', 'url' => ['/students']] : (''),
             Yii::$app->user->can('menu_teachers') ?
            ['label' => 'Преподаватели', 'url' => ['/teachers']] : (''),
             Yii::$app->user->can('menu_lessons') ?
            ['label' => 'Уроки', 'url' => ['/lessons']] : (''),
             Yii::$app->user->can('menu_catalog') ?
            ['label' => 'Каталог', 'items' => [
                ['label' => 'Филиалы', 'url' => ['/buildings']],
                ['label' => 'Предметы', 'url' => ['/subjects']],
                ['label' => 'Типы групп', 'url' => ['/group-types']]
            ]] : (''),
          
            Yii::$app->user->isGuest ? (
                ['label' => 'Вход', 'url' => ['/site/login']]
                    
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Выход (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
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
