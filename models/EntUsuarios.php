<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mod_usuarios_ent_usuarios".
 *
 * @property string $id_usuario
 * @property string $txt_auth_item
 * @property string $txt_token
 * @property string $txt_imagen
 * @property string $txt_username
 * @property string $txt_apellido_paterno
 * @property string $txt_apellido_materno
 * @property string $txt_auth_key
 * @property string $txt_password_hash
 * @property string $txt_password_reset_token
 * @property string $txt_email
 * @property string $fch_creacion
 * @property string $fch_actualizacion
 * @property string $id_status
 *
 * @property AuthAssignment[] $authAssignments
 * @property AuthItem[] $itemNames
 * @property ModUsuariosEntSesiones[] $modUsuariosEntSesiones
 * @property ModUsuariosCatStatusUsuarios $idStatus
 * @property AuthItem $txtAuthItem
 */
class EntUsuarios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mod_usuarios_ent_usuarios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['txt_auth_item', 'txt_username', 'txt_auth_key', 'txt_password_hash', 'txt_email'], 'required'],
            [['fch_creacion', 'fch_actualizacion'], 'safe'],
            [['id_status'], 'integer'],
            [['txt_auth_item'], 'string', 'max' => 64],
            [['txt_token'], 'string', 'max' => 100],
            [['txt_imagen'], 'string', 'max' => 200],
            [['txt_username', 'txt_password_hash', 'txt_password_reset_token', 'txt_email'], 'string', 'max' => 255],
            [['txt_apellido_paterno', 'txt_apellido_materno'], 'string', 'max' => 30],
            [['txt_auth_key'], 'string', 'max' => 32],
            [['txt_token'], 'unique'],
            [['txt_password_reset_token'], 'unique'],
            [['id_status'], 'exist', 'skipOnError' => true, 'targetClass' => ModUsuariosCatStatusUsuarios::className(), 'targetAttribute' => ['id_status' => 'id_status']],
            [['txt_auth_item'], 'exist', 'skipOnError' => true, 'targetClass' => AuthItem::className(), 'targetAttribute' => ['txt_auth_item' => 'name']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_usuario' => 'Id Usuario',
            'txt_auth_item' => 'Txt Auth Item',
            'txt_token' => 'Txt Token',
            'txt_imagen' => 'Txt Imagen',
            'txt_username' => 'Txt Username',
            'txt_apellido_paterno' => 'Txt Apellido Paterno',
            'txt_apellido_materno' => 'Txt Apellido Materno',
            'txt_auth_key' => 'Txt Auth Key',
            'txt_password_hash' => 'Txt Password Hash',
            'txt_password_reset_token' => 'Txt Password Reset Token',
            'txt_email' => 'Txt Email',
            'fch_creacion' => 'Fch Creacion',
            'fch_actualizacion' => 'Fch Actualizacion',
            'id_status' => 'Id Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthAssignments()
    {
        return $this->hasMany(AuthAssignment::className(), ['user_id' => 'id_usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemNames()
    {
        return $this->hasMany(AuthItem::className(), ['name' => 'item_name'])->viaTable('auth_assignment', ['user_id' => 'id_usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModUsuariosEntSesiones()
    {
        return $this->hasMany(ModUsuariosEntSesiones::className(), ['id_usuario' => 'id_usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdStatus()
    {
        return $this->hasOne(ModUsuariosCatStatusUsuarios::className(), ['id_status' => 'id_status']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTxtAuthItem()
    {
        return $this->hasOne(AuthItem::className(), ['name' => 'txt_auth_item']);
    }
}
