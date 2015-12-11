<?php

    require_once(__DIR__ . '/wp-load.php');
    require_once(ABSPATH . WPINC . '/lib/class-email-utils.php');

    $result = EmailUtils::sendMessage();
    returnFromScript($result);

    function returnFromScript($response)
    {
        exit($response);
    }