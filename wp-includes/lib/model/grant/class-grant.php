<?php

require_once(ABSPATH . WPINC . '/lib/model/document/class-document-item.php');

class Grant extends DocumentItem
{
    const ID_FIELD = "grant_id";

    const DB_TABLE_NAME = "wp_grant";
}