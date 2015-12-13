<?php


class NeedyItem
{
    const ID_FIELD                = "needy_id";
    const NAME_FIELD              = "name";
    const SHORT_DESCRIPTION_FIELD = "short_description";
    const LONG_DESCRIPTION_FIELD  = "long_description";
    const CONTACT_INFO_FIELD      = "contact_info";
    const STATUS_FIELD            = "status";
    const PRIORITY_FIELD          = "priority";
    const AVATAR_FIELD            = "avatar";
    const IMAGE_FIELD             = "image_id";

    const NEEDY_TYPE              = "needy_type";

    const MAX_NAME_LENGTH              = 255;
    const MIN_NAME_LENGTH              = 5;
    const MIN_SHORT_DESCRIPTION_LENGTH = 10;
    const MAX_SHORT_DESCRIPTION_LENGTH = -1;
    const MIN_LONG_DESCRIPTION_LENGTH  = 30;
    const MAX_LONG_DESCRIPTION_LENGTH  = -1;
    const MAX_CONTACT_LENGTH           = 255;
    const MIN_CONTACT_LENGTH           = 5;
}