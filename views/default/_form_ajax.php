<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Config */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="config-form">

    <H3>Add new Param:</H3>

    <?php yii\widgets\Pjax::begin(['id' => 'new_config']) ?>

    <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true ]]); ?>

    <?= $form->field($model, 'id')->hiddenInput(['readonly' => true])->label(false) ?>

    <?= $form->field($model, 'param_name')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'param_type')->dropDownList(['INT' => 'INT', 'FLOAT' => 'FLOAT', 'TEXT' => 'TEXT']) ?>

    <?= $form->field($model, 'param_value')->textInput(['maxlength' => 200]) ?>

    <div class="form-group action-buttons">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php yii\widgets\Pjax::end() ?>
</div>