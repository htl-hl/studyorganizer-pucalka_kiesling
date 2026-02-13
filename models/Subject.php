<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Subjects".
 *
 * @property int $subjectId
 * @property string|null $name
 * @property int|null $teacherId
 *
 * @property Teacher $teacher
 */
class Subject extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Subjects';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'teacherId'], 'default', 'value' => null],
            [['teacherId'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['teacherId'], 'exist', 'skipOnError' => true, 'targetClass' => Teacher::class, 'targetAttribute' => ['teacherId' => 'teacherId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'subjectId' => Yii::t('app', 'Subject ID'),
            'name' => Yii::t('app', 'Name'),
            'teacherId' => Yii::t('app', 'Teacher ID'),
        ];
    }

    /**
     * Gets query for [[Teacher]].
     *
     * @return \yii\db\ActiveQuery|TeacherQuery
     */
    public function getTeacher()
    {
        return $this->hasOne(Teacher::class, ['teacherId' => 'teacherId']);
    }

    /**
     * {@inheritdoc}
     * @return SubjectQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SubjectQuery(get_called_class());
    }

}
