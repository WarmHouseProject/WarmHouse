<?php

    class Stock
    {
        const ID_FIELD                = "stock_id";
        const NAME_FIELD              = "name";
        const DESCRIPTION_FIELD       = "description";
        const PRIORITY_FIELD          = "priority";
        const STATUS_FIELD            = "status";
        const AVATAR_FIELD            = "avatar";
        const IMAGE_FIELD             = "image_id";

        const DB_TABLE_NAME = "wp_stock";

        const MAX_NAME_LENGTH              = 255;
        const MIN_NAME_LENGTH              = 5;
        const MIN_DESCRIPTION_LENGTH       = 10;
        const MAX_DESCRIPTION_LENGTH       = -1;
    }