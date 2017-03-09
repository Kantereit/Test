<?php

/* @var $this yii\web\View */

$this->title = 'Автор'.' '.$name;
?>
<div class="site-index">

    <div class="jumbotron">
        <h2>Автор <?=$name?></h2>

<a class="btn btn-default" href="<?=Yii::$app->urlManager->CreateUrl(['site/addbook','name' => $name])?>">Добавить книгу автора</a>
<a class="btn btn-default" href="<?=Yii::$app->urlManager->CreateUrl(['site/update','name' => $name])?>">Редактировать автора</a>
    </div>

  		<?php foreach ($book as $books) { ?>
		<div class="body-content">
		<h3><?=$books->book?></h3>
		<a class="btn btn-default" href="<?=Yii::$app->urlManager->CreateUrl(['site/updatebook','book' => $books->book])?>">Редактировать книгу</a>
		<a class="btn btn-default" href="<?=Yii::$app->urlManager->CreateUrl(['site/deletebook','book' => $books->book,'name'=> $name])?>">Удалить книгу</a>
       <?php }?>

    </div>
</div>
