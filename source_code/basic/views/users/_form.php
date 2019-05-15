<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;
/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'realname')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= Html::label(Yii::t('app', 'Password retry'), 'password-retry', ['class' => 'control-label pass' ])?>
    
    <?= Html::input('password', 'password-retry', '', ['class' => 'form-control pass' ,'id' => 'password-retry']) ?>
    <br>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['id' => 'submitButton', 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$this->registerJs(
    "
    $(document).ready(function(){
        $('#submitButton').attr('disabled',true);
        chkPass();
        $('.pass').change(function(){
            chkPass();
        })
    })
    function chkPass(){
        if($('#users-password').val() == $('#password-retry').val()){
            $('#submitButton').removeAttr('disabled');
        }else{
            $('#submitButton').attr('disabled',true);
        }
    }
    ",
     View::POS_READY,
    'my-button-handler'
);

?>
