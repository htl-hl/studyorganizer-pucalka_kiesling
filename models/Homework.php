<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Homework".
 *
 * @property int $homeworkId
 * @property string|null $title
 * @property string|null $description
 * @property string|null $due_date
 * @property int|null $is_done
 * @property int|null $userId
 * @property int|null $subjectId
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Homework extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Homework';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'subjectId'], 'required'],
            [['description'], 'string'],
            [['due_date', 'created_at', 'updated_at'], 'safe'],
            [['is_done', 'userId', 'subjectId'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'homeworkId' => Yii::t('app', 'Homework ID'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'due_date' => Yii::t('app', 'Due Date'),
            'is_done' => Yii::t('app', 'Is Done'),
            'userId' => Yii::t('app', 'User ID'),
            'subjectId' => Yii::t('app', 'Subject'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public function getSubject()
    {
        return $this->hasOne(Subject::class, ['subjectId' => 'subjectId']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if (!empty($this->due_date)) {
                if (is_numeric($this->due_date)) {
                    $timestamp = (int)$this->due_date;
                } else {
                    $timestamp = strtotime($this->due_date);
                }

                if ($timestamp) {
                    $this->due_date = date('Y-m-d', $timestamp);
                }
            }
            return true;
        }
        return false;
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['userId' => 'userId']);
    }

    /**
     * {@inheritdoc}
     * @return HomeworkQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new HomeworkQuery(get_called_class());
    }

}
