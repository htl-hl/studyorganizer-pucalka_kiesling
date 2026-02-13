<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Teacher".
 *
 * @property int $teacherId
 * @property string|null $name
 * @property int|null $is_active
 *
 * @property Subject[] $subjects
 */
class Teacher extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Teacher';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'is_active'], 'default', 'value' => null],
            [['is_active'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'teacherId' => Yii::t('app', 'Teacher ID'),
            'name' => Yii::t('app', 'Name'),
            'is_active' => Yii::t('app', 'Is Active'),
        ];
    }

    /**
     * Gets query for [[Subjects]].
     *
     * @return \yii\db\ActiveQuery|SubjectQuery
     */
    public function getSubjects()
    {
        return $this->hasMany(Subject::class, ['teacherId' => 'teacherId']);
    }

    /**
     * {@inheritdoc}
     * @return TeacherQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TeacherQuery(get_called_class());
    }

}
