<?php

class NeedyViewUtils
{
    /**
     * @param array $needyItems
     * @return array
     */
    static function prepareNeedyViewArray($needyItems)
    {
        $result = [];
        $result[0] = [];
        $result[1] = [];
        $result[2] = [];
        $result[3] = [];

        $index = 0;
        foreach ($needyItems as $needyItem)
        {
            array_push($result[$index], $needyItem);
            ++$index;
            if ($index == 4)
            {
                $index = 0;
            }
        }
        return $result;
    }
}