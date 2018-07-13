<?php use amass\panel\Panel; ?>

<?= Panel::widget([
     'headerTitle' => 
        '<strong align="center">' . $comment->nick .'</strong> ' . 
        Yii::$app->formatter->format($comment->date_time, 'dateTime'),
     'content' => $comment->message,
     'footer' => FALSE,
     'type' => 'success',
]); ?>