<?php

use bz4work\MainAsset;

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ConfigSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Configs');
$this->params['breadcrumbs'][] = $this->title;

MainAsset::register($this);
?>

<div class="config-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!-- Render create form -->
    <?= $this->render('_form_ajax', [
        'model' => $model,
    ]) ?>

    <br>

    <?php Pjax::begin(['id' => 'config']); ?>

    <H3>List params:</H3>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'param_name',
            'param_type',
            'param_value',

            //buttons section
            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'view' => function($url, $model){
                        return false;
                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', false, [
                            'class' => 'pjax-update-link',
                            'cursor' => 'pointer',
                            'update-url' => '/conf-dev/default/get-data-pjax?id='.$model->id,
                            'title' => Yii::t('yii', 'Update'),
                        ]);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', false, [
                            'class' => 'pjax-delete-link',
                            //'delete-url' => $url,
                            'delete-url' => '/conf-dev/default/delete-pjax?id='.$model->id,
                            //'data-method' => 'post',
                            'pjax-container' => 'my_pjax',
                            'title' => Yii::t('yii', 'Delete')
                        ]);
                    }
                ],
            ],//end buttons section
        ],//end columns section
    ]); ?>
    <?php Pjax::end(); ?>
</div>

