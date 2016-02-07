<?php

require_once(ABSPATH . WPINC . '/lib/model/document/class-document-item.php');

class Program extends DocumentItem
{
    const ID_FIELD = "program_id";

    const DB_TABLE_NAME = "wp_program";
}