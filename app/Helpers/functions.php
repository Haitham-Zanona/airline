<?php

/**
 * استخراج اسم المدينة من سلسلة نصية قد تحتوي على أقواس
 *
 * @param string|null $cityString
 * @return string
 */
function extractCityName($cityString)
{
    if (! $cityString) {
        return '';
    }

    if (strpos($cityString, '(') !== false && strpos($cityString, ')') !== false) {
        $matches = [];

        if (preg_match('/\((.*?)\)/', $cityString, $matches)) {
            return trim($matches[1]);
        }
    }

    return $cityString;
}
