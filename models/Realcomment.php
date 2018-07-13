<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "realcomment".
 *
 * @property int $id
 * @property string $nick
 * @property string $date_time
 * @property string $message
 */
class Realcomment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'realcomment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nick', 'date_time', 'message'], 'required'],
            [['date_time'], 'safe'],
            [['nick'], 'string', 'max' => 128],
            [['message'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'nick' => 'Nickname',
            'message' => 'Message',
        ];
    }

    public function getComments()
    {
        $comments = Realcomment::find()
            ->orderby(['date_time' => SORT_DESC])
            ->all();
        return $comments;
    }

    public function getLastComment()
    {
        $comment = Realcomment::find()
            ->orderBy(['date_time' => SORT_DESC])
            ->one(); 
        return $comment;
    }
}
