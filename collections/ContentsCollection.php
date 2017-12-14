<?php

namespace app\collections;

use app\models\Content;

class ContentsCollection
{

    public function findLastForUser($userID): Content
    {
        $model = Content::find()
            ->where(['user_id' => $userID])
            ->orderBy('id DESC')
            ->limit(1)
            ->one();
        if (!$model) {
            throw new \RuntimeException('Content not find.');
        }

        return $model;
    }

    public function save(Content $content)
    {
        if (!$content->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

}