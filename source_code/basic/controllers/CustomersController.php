<?php

public function actionSaveResult()
{
    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

    $model = new Customers();

    if (Yii::$app->request->isPost) {
        ///modell feltöltése a post adatokkal
        if( $model->save()){

        }
        return '{"status":"ok"}';
        }

    return $this->render('update', [
        'model' => $model,
    ]);
}