<?php

    class Orphanage
    {
        const ID_FIELD                = "orphanage_id";
        const NAME_FIELD              = "name";
        const DESCRIPTION_FIELD       = "description";
        const CONTACT_INFO_FIELD      = "contact_info";
        const PRIORITY_FIELD          = "priority";
        const AVATAR_FIELD            = "avatar";
        const IMAGE_FIELD             = "image_id";

        const MAX_NAME_LENGTH              = 255;
        const MIN_NAME_LENGTH              = 5;
        const MIN_DESCRIPTION_LENGTH       = 10;
        const MAX_DESCRIPTION_LENGTH       = -1;
        const MAX_CONTACT_LENGTH           = 255;
        const MIN_CONTACT_LENGTH           = 5;
    }