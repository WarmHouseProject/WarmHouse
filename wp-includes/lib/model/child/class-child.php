<?php

require_once(ABSPATH . WPINC . '/lib/model/needy/class-needy-item.php');

class Child extends NeedyItem
{
    const ID_FIELD     = "child_id";
    const STATUS_FIELD = "status";

    const DB_TABLE_NAME = "wp_child";
}