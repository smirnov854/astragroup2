<?php

/* @var $this yii\web\View */

$this->title = 'Astarta Group';
?>
<div class="site-index">

    <div class="jumbotron">
        <p class="lead">Система управления контентом Астарта.</p>
        <p class="lead">Для начала работы необходимо заполнить справочники:</p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Каюты</h2>

                <p>Типы кают лайнеров.</p>

                <p><?=\yii\helpers\Html::a('Каюты',['/cabin/index'],[
                        'class' => 'btn btn-default'
                    ])?>
                </p>
            </div>
            <div class="col-lg-4">
                <h2>Компании</h2>

                <p>Список Круизных компаний</p>

                <p><?=\yii\helpers\Html::a('Компании',['/company/index'],[
                        'class' => 'btn btn-default'
                    ])?></p>
            </div>
            <div class="col-lg-4">
                <h2>Страны</h2>

                <p>Список Стран отправления</p>

                <p><?=\yii\helpers\Html::a('Страны',['/country/index'],[
                        'class' => 'btn btn-default'
                    ])?></a>
                </p>
            </div>

            <div class="col-lg-4">
                <h2>Порты</h2>

                <p>Список возможных портов захода.</p>

                <p><?=\yii\helpers\Html::a('Порты',['/port/index'],[
                        'class' => 'btn btn-default'
                    ])?>
                </p>
            </div>
            <div class="col-lg-4">
                <h2>Регионы</h2>

                <p>Список Регион плавания</p>

                <p><?=\yii\helpers\Html::a('Регионы',['/region/index'],[
                        'class' => 'btn btn-default'
                    ])?></p>
            </div>
            <div class="col-lg-4">
                <h2>Суда</h2>

                <p>Список круизных судов</p>

                <p><?=\yii\helpers\Html::a('Суда',['/ship/index'],[
                        'class' => 'btn btn-default'
                    ])?></a>
                </p>
            </div>
        </div>

    </div>
</div>
