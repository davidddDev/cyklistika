<?php 

namespace App\Libraries;

class GroupHelper
{
    public function groupBy($array, $key)
    {
        $result = [];
        foreach ($array as $item) {
            $groupId = $item->$key;

            if (!isset($result[$groupId])) {
                $result[$groupId] = (object)[
                    'info' => (object)[],
                    'items' => []
                ];
            }

            $result[$groupId]->items[] = $item;
        }

        return $result;
    }
}