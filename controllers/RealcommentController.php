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
 * RealcommentController implements the CRUD actions for Realcomment model.
 */
class RealcommentController extends Controller
{
    /**
     * Lists all Realcomment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new Realcomment();

        if (\YIi::$app->request->isAjax)
        {
            $model->date_time = new Expression('NOW()');

            if ($model->load(Yii::$app->request->post()) && $model->save())
            {
                $comment = Realcomment::getLastComment();
                return $this->renderPartial('_comment', [
                    'comment' => $comment,
                ]);
            }
        }
        $comments = Realcomment::getComments();
        return $this->render('index', [
            'model' => $model,
            'comments' => $comments,
        ]);
    }
}
