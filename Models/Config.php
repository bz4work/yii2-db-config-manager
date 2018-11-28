<?php
namespace bz4work\Models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "ywk_config_params".
 *
 * @property int $id
 * @property string $param_name название параметра
 * @property string $param_type тип параметра
 * @property string $param_value значение параметра
 * @property int $author id юзера который создал запись
 * @property int $updated_by id юзера который обновил запись
 * @property string $created_at создана запись
 * @property string $updated_at обновлена запись
 */
class Config extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%config_params}}';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['param_name', 'param_type'], 'required'],
            [['param_type'], 'string'],
            [['author', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['param_name'], 'string', 'max' => 30],
            [['param_value'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'param_name' => 'Param Name',
            'param_type' => 'Param Type',
            'param_value' => 'Param Value',
            'author' => 'Author',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
