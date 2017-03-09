<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<?php

/* @var $this yii\web\View */

$this->title = 'Добавить книгу автора';
?>

<div class="site-index">

    <div class="jumbotron">
        <h1>Добавить книгу автора<?=$name?></h1>


    </div>

  <?php $f = ActiveForm::begin(); ?>
	<?=$f->field($author,'name'); ?>
	<?= Html::submitButton('Добавить',['class' => 'btn btn-primary']); ?>
	

<?php ActiveForm::end(); ?>
</div>
