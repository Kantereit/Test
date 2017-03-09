<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<?php

/* @var $this yii\web\View */

$this->title = 'Редактировать автора';
?>

<div class="site-index">
<h2><?=$done?></h2>
    <div class="jumbotron">
        <h1>Редактировать <?=$type?><?=$name?></h1>


    </div>

  <?php $f = ActiveForm::begin(); ?>
	<?=$f->field($author,'name')->textInput(['placeholder' => $name]) ; ?>
	<?=Html::submitButton('Добавить',['class' => 'btn btn-primary']); ?>
	

<?php ActiveForm::end(); ?>
</div>
