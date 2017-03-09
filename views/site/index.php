<?php

/* @var $this yii\web\View */

$this->title = 'Авторы';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Авторы</h1>
<a class="btn btn-default" href="<?=Yii::$app->urlManager->CreateUrl(['site/addform'])?>">Добавить автора</a>

    </div>

    <div class="body-content">

        <div class="row">
		<?php foreach ($authors as $author) { ?>
            <div class="col-lg-4">
                

            <h2><a href="<?=Yii::$app->urlManager->CreateUrl(['site/index','name' => $author->author])?>"><?=$author->author?></a></h2>
            </div>
            <?php }?>
        </div>

    </div>
</div>
