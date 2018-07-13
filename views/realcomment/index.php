<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use amass\panel\Panel;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Real Comments';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="realcomment-index">
<h1><?= Html::encode($this->title) ?></h1>
<div class="col-md-8 col-md-offset-2">
    <div class="row">
        <div class="col-lg-4">
            <div class="panel panel-info">
                <div class="panel-heading">Enter comment</div>
                <div class="panel-body">
                    <div class="realcomment-form">
                        <?php $form = ActiveForm::begin(); ?>
                        <?= $form->field($model, 'nick')->textInput(['maxlength' => true]) ?>
                        <?= $form->field($model, 'message')->textInput(['maxlength' => true]) ?>
                        <?= Html::submitButton('Send', ['class' => 'btn btn-success']) ?>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
                     
        </div>
        
        <div class="col-lg-8">
            <div class="panel panel-primary">
                <div class="panel-heading">Comments</div>
                <div class="panel-body" style="max-height: 350px; overflow: auto;">
                    <ul id="comments" class="list-unstyled">
                    <?php foreach ($comments as $comment): ?>
                        <li>
                        <?= Panel::widget([
                             'headerTitle' => 
                                '<strong align="center">' . $comment->nick .'</strong> ' . 
                                Yii::$app->formatter->format($comment->date_time, 'dateTime'),
                             'content' => $comment->message,
                             'footer' => FALSE,
                             'type' => 'default',
                        ]); ?>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            
        </div>
    </div>
</div>
</div>

<?php 
$js = <<<JS
    $('form').on('beforeSubmit', function(){
        var data = $(this).serialize();
        $.ajax({
            url: '/realcomment/index',
            type: 'POST',
            data: data,
            success: function(res){
                var newComment = document.createElement('li');
                newComment.innerHTML = res;
                comments.insertBefore(newComment, comments.firstChild);
                console.log(res);
            },
            error: function(){
                alert('Error!');
            }
        });
        return false;
    });
JS;
$this->registerJs($js);
?>