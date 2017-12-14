<?php

namespace tests\models;

use app\models\Content;
use app\services\ContentService;
use Yii;

class ContentServiceTest extends \Codeception\Test\Unit
{
    protected $tester;

    private function getService(): ContentService
    {
        return Yii::$container->get(ContentService::class);
    }

    public function testNewText()
    {
        $content = $this->getService()->registerNewText('test text', 1);

        expect_that($content instanceof Content);
    }

    public function testGetText()
    {
        $text = "ab ac Ab aB AB ac ab ab ab 123 123 (*&^(*@&$(*&^qwe qw
		qwe qwe df ssdf ab2ab ab2ab ая Аё аЁ ab";
        $this->getService()->registerNewText($text, 2);

        $result = $this->getService()->getLastTextDensity(2);

        expect($result)->equals([
            'ab' => 12,
            'qwe' => 3,
            'ac' => 2,
            'аё' => 2,
            'qw' => 1,
            'df' => 1,
            'ssdf' => 1,
            'ая' => 1,
        ]);

    }

}
