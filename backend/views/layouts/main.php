<?php

/* @var $this \yii\web\View */
/* @var $content string */

use common\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use backend\assets\AppAsset;

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
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
//    $obCurrency = Yii::$app->CbRF->filter(['currency' => "EUR"])->one();
    
//    print_r($obCurrency);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Orders', 'url' => ['/order/index?sort=-ID']],
            ['label'=>'Pages', 'items'=>[
                ['label' => 'All pages', 'url' => ['/page/index']],
                ['label' => 'Command', 'url' => ['/command/index']],
                ['label' => 'Ofices', 'url' => ['/ofice/index']],
                ]
            ],
            ['label'=>'Site', 'items'=>[
                ['label' => 'Options', 'url' => ['/config/index']],
                ['label' => 'Banners', 'url' => ['/banner/index']],
                ['label' => 'News', 'url' => ['/news/index']],
                ['label' => 'Reviews', 'url' => ['/review/index']],
                ['label' => 'Actions', 'url' => ['/special/index']],
                ['label' => 'Main icons', 'url' => ['/main-icons/index']],
            ]],
            ['label' => 'Cruises', 'items'=>[
                ['label' => 'Cruises', 'url' => ['/cruise/index'],],
                ['label' => '|--Specials', 'url' => ['/cruise/special'],],
                ['label' => 'Companies', 'url' => ['/company/index']],
                ['label' => '|--Company Types', 'url' => ['/company-type']],
                ['label' => '|--Company Groups', 'url' => ['/company-group']],
                ['label' => 'Ships', 'url' => ['/ship/index']],
                ['label' => '|--Ship types', 'url' => ['/ship-type']],
                ['label' => '|--Decks', 'url' => ['/deck']],
                ['label' => 'Cabins', 'url' => ['/cabin/index']],
                ['label' => '|--Cabin locationa', 'url' => ['/cabin-loc']],
            // ['label' => 'Cabins', 'url' => ['/cabin_loc/index']],
            ]],
            ['label' => 'Regions', 'items'=>[
                ['label' => 'Regions', 'url' => ['/region/index']],
                ['label' => 'Countries', 'url' => ['/country/index']],
                ['label' => 'Ports', 'url' => ['/port/index']],
            ]],
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            ),
            ['label' => 'На сайт', 'url' => ['../']],
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <? // = Yii::$app->options->test ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Астарта <?= date('Y') ?></p>

        <p class="pull-right"><?= "Andrew Serebryakov" ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
