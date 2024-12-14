<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $username
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%users}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username'], 'required'],
            [['username'], 'string', 'max' => 255],
            [['username'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
        ];
    }

    /**
     * Finds user object by the given ID.
     *
     * @param int|string $id
     * @return User|null object by id
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Returns the unique ID of the user.
     *
     * @return int|string еhe unique identifier of the user.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Given auth key
     *
     * @return string a key that is used to check validity
     */
    public function getAuthKey()
    {
        return '';
    }

    /**
     * Validates the given authentication key.
     *
     * @param  string $authKey for validation
     * @return bool (valid auth key or not)
     */
    public function validateAuthKey($authKey)
    {
        return true;
    }
}
