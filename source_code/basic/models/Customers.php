<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customers".
 *
 * @property int $id
 * @property string $created Létrehozva
 * @property string $name Név
 * @property string $desc Megjegyzés
 * @property string $filling_name Kitöltő neve
 * @property array $result Eredmény
 */
class Customers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created', 'result'], 'safe'],
            [['name', 'result'], 'required'],
            [['desc'], 'string'],
            [['name', 'filling_name'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created' => 'Létrehozva',
            'name' => 'Név',
            'desc' => 'Megjegyzés',
            'filling_name' => 'Kitöltő neve',
            'result' => 'Eredmény',
            'action' => 'Művelet'
        ];
    }

    /**
     * {@inheritdoc}
     * @return CustomersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CustomersQuery(get_called_class());
    }
}
