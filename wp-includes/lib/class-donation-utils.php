<?php

require_once(ABSPATH . WPINC . '/lib/class-child.php');
require_once(ABSPATH . WPINC . '/lib/class-orphanage.php');

class DonationUtils
{
    static function createPaymentPurpose($child, $orphanage)
    {
        if ($child)
        {
            return 'Помощь ребёнку ' . $child->name;
        }

        if ($orphanage)
        {
            return 'Помощь детскому дому "' . $orphanage->name . '"';
        }

        return "Назначение отсутствует";
    }
}