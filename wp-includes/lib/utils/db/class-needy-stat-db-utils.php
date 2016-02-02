<?php

class NeedyStatDBUtils
{
    static function getNeedyItemStat($needyItemId, $needyItemType)
    {
        global $wpdb;
        return $wpdb->get_results(
           "SELECT
              SUM(wp1.meta_value) AS amount,
              COUNT(wp1.post_id) as count
            FROM wp_postmeta wp1
            INNER JOIN wp_postmeta wp2 ON wp2.post_id = wp1.post_id AND wp2.meta_key = 'leyka_needy_type' AND wp2.meta_value = " . $needyItemType . "
            INNER JOIN wp_postmeta wp3 ON wp3.post_id = wp1.post_id AND wp3.meta_key = 'leyka_needy_id' AND wp3.meta_value = " . $needyItemId . "
            WHERE wp1.meta_key = 'leyka_donation_amount'");
    }
}