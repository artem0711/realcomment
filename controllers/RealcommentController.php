<?php

namespace app\controllers;

use Yii;
use app\models\Realcomment;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Expression;

/**
 * Controller to operate with Comments
 */
class RealcommentController extends Controller
{
    /**
     * Main action for operate with Comments
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new Realcomment(); // create our model

        if (\YIi::$app->request->isAjax) // check if user is create comment
        {
            $model->date_time = new Expression('NOW()'); // take date and time now

            if ($model->load(Yii::$app->request->post()) && $model->save()) // new comment is save in DB
            {
                $comment = Realcomment::getLastComment(); // get last comment for insert into view
                return $this->renderPartial('_comment', [ // render view
                    'comment' => $comment, // last added comment
                ]);
            }
        }

        $comments = Realcomment::getComments(); // return all comments
        return $this->render('index', [ // render view
            'model' => $model, // our model
            'comments' => $comments, // all comments
        ]);
    }
}
