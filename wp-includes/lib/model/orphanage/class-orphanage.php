<?php
require_once(ABSPATH . WPINC . '/lib/model/needy/class-needy-item.php');

    class Orphanage extends NeedyItem
    {
        const ID_FIELD = "orphanage_id";

        const DB_TABLE_NAME = "wp_orphanage";
    }