<?php

namespace app\services;


use app\collections\ContentsCollection;
use app\helpers\DensityProcessor;
use app\models\Content;

class ContentService
{

    private $texts;
    private $contentHandler;

    public function __construct(ContentsCollection $textRepo, DensityProcessor $contentHandler)
    {
        $this->texts = $textRepo;
        $this->contentHandler = $contentHandler;
    }

    /**
     * Save text for next work
     *
     * @param string $text
     * @param int $userID
     * @return Content
     */

    public function registerNewText(string $text, int $userID): Content
    {
        $model = Content::create($text, $userID);
        $this->texts->save($model);

        return $model;
    }

    /**
     * Analise text and get params for login text
     *
     * @param int $userId
     * @return array params for text
     */

    public function getLastTextDensity($userId): array
    {
        $model = $this->texts->findLastForUser($userId);

        return $this->contentHandler->process($model->content);
    }

}