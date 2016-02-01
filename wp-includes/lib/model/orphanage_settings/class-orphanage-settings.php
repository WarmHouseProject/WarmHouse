<?php

require_once(ABSPATH . WPINC . '/lib/model/needy_settings/class-needy-item-settings.php');

class OrphanageSettings extends NeedyItemSettings
{
    const ID_FIELD        = "orphanage_settings_id";
    const NEEDY_ID_FIELD  = "orphanage_id";

    const DB_TABLE_NAME = "wp_orphanage_settings";
}