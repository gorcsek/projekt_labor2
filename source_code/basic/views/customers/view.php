<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Customers */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Customers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="customers-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'created',
            'name',
            'filling_name',
            //'desc:ntext',
            //'result',
        ],
    ]) ?>
    <h2><?= Yii::t('app', 'Customer details') ?></h2>
    <div>
        <table class="table">
            <tr>
                <th><?= Yii::t('app', 'Question') ?></th>
                <th><?= Yii::t('app', 'Description') ?></th>
                <th><?= Yii::t('app', 'Answer') ?></th>
            </tr>
        <?php  foreach (json_decode($model->desc) as $key => $value) {?>
            <tr>
                <td class="col-md-5"><?= $value->question ?></td>
                <?php 
                    $text = "";
                    $answer = "";
                    if(property_exists($value, 'textarea')){
                        $text = $value->textarea->value;
                    }
                    if(property_exists($value, 'answer')){
                        $answer = $value->answer;
                    }
                        ?>
                        <td class="col-md-5"><?= $text ?></td>
                        <td class="col-md-5"><?= $answer ?></td>
                        <?php
                ?>

            </tr>
          <?php } ?>
        </table>
    </div>
    <h2><?= Yii::t('app', 'Customers result') ?></h2>
    <div>
        <table class="table">
            <tr>
                <th><?= Yii::t('app', 'Question') ?></th>
                <th><?= Yii::t('app', 'Answer') ?></th>
            </tr>
        <?php 

        foreach (json_decode($model->result) as $key => $value) {
            ?>
            <tr>
                <td class="col-md-5"><?= $value->question ?></td>
                <td class="col-md-5"><?= $value->answer ?></td>
            </tr>
          <?php
        } 
        ?>
        </table>
    </div>
</div>
