<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\Url;

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
    $menuItems = [
        ['label' => 'Página Inicial', 'url' => ['/site/index']],
        //                            /{controlador}/{action}
        ['label' => 'Usuários', 'url' => ['/user/index']],
        ['label' => 'Cursos', 'url' => ['/curso/index']],
        ['label' => 'Sobre', 'url' => ['/site/about']],
        ['label' => 'Contato', 'url' => ['/site/contact']],
        [
            'label' => '<i class="glyphicon glyphicon-knight"></i> Skifree',
            'items' => [
                 ['label' => '<i class="glyphicon glyphicon-screenshot"></i> Jogar', 'url' => Url::to(['jogo/index'])],
                 '<li class="divider"></li>',
                //  '<li class="dropdown-header">Informações Extras</li>',
                 ['label' => '<i class="glyphicon glyphicon-stats"></i> Hall da Fama', 'url' => Url::to(['jogo/ranking'])],
            ],
        ],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Cadastrar', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => '<i class="glyphicon glyphicon-user"></i> Entrar', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Sair (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
        'encodeLabels' => false,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?> <!-- define o conteúdo específico de cada view -->
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <b>Micael Levi</b> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>