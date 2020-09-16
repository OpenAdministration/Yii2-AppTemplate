<?php

namespace app\models\install;

use magp\yii2jsv\JsonSchemaValidator;
use romi45\yii2jsonvalidator\JsonValidator;
use Swaggest\JsonSchema\JsonSchema;
use Yii;

/**
 * This is the model class for table "config".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $value
 */
class ConfigRecord extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName() : string
    {
        return 'config';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() : array
    {
        return [
            ['id', 'integer', 'min' => 1],
            ['name', 'string', 'max' => 255],
            ['value', JsonValidator::class ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() : array
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'value' => 'Value',
        ];
    }

}
