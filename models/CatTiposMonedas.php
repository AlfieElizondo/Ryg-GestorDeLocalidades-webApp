<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cat_tipos_monedas".
 *
 * @property string $id_moneda
 * @property string $txt_moneda
 * @property string $txt_siglas
 * @property int $b_habilitado
 */
class CatTiposMonedas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cat_tipos_monedas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['txt_moneda', 'txt_siglas'], 'required'],
            [['b_habilitado'], 'integer'],
            [['txt_moneda', 'txt_siglas'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_moneda' => 'Id Moneda',
            'txt_moneda' => 'Txt Moneda',
            'txt_siglas' => 'Txt Siglas',
            'b_habilitado' => 'B Habilitado',
        ];
    }
}
