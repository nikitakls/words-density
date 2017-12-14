<?php
/**
 * DenisityProcessor.php
 * User: nikitakls
 * Date: 13.12.17
 * Time: 0:10
 */

namespace app\helpers;

/**
 */

class DensityProcessor
{

    /**
     * @param $content
     * @return array
     */
    public function process($content): array
    {
        $words = self::getAllWords($content);
        $result = array_count_values($words);
        arsort($result);

        return $result;
    }

    public static function getAllWords($content): array
    {
        $content = mb_strtolower($content);
        $content = strip_tags($content);

        return array_filter(preg_split('/[^[:alpha:]]+/us', $content));
    }
}