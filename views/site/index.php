<?php

/* @var $this yii\web\View */
use yii\helpers\Html;


$this->title = 'Курсы по подготовке к ЕГЭ и ОГЭ в Москве - Merlin';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Добро пожаловать </h1>

        <p class="lead">На сайт учебного центра</p>

        <p><?= Yii::$app->user->isGuest ? Html::a('Войти на сайт', '/login', ['class' => 'btn btn-lg btn-success']) : ''?></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Супервайзерам</h2>

                Управление полномочиями по ведению групп для учителей, создание учетных записей </p>

              
            </div>
            <div class="col-lg-4">
                <h2>Преподавателям</h2>

                <p>Просмотр и редактирование закрепленных групп, занятий. Выставление оценок, комментариев. Добавление новых учеников в группу. </p>

                
            </div>
            <div class="col-lg-4">
                <h2>Родителям</h2>

                <p>Просмотр данных по успеваемости и посещаемости по ученику (ученикам) </p>

                
            </div>
        </div>

    </div>
</div>
