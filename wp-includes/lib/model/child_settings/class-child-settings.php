<?php

require_once(ABSPATH . WPINC . '/lib/model/needy_settings/class-needy-item-settings.php');

class ChildSettings extends NeedyItemSettings
{
    const ID_FIELD        = "child_settings_id";
    const NEEDY_ID_FIELD  = "child_id";

    const DB_TABLE_NAME = "wp_child_settings";
}