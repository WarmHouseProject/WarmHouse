<?php

    require_once(__DIR__ . '/wp-load.php');
    require_once(ABSPATH . WPINC . '/lib/utils/class-email-utils.php');
    require_once(ABSPATH . WPINC . '/lib/utils/class-recaptcha-utils.php');

    $checkMessageDataResult = EmailUtils::checkMessageData();
    if ($checkMessageDataResult != EmailUtils::ERR_SUCCESS)
    {
        returnFromScript($checkMessageDataResult);
    }

    if (!ReCaptchaUtils::checkCaptcha())
    {
        returnFromScript(ReCaptchaUtils::ERR_BOT_CHECK_FAILED);
    }

    $sendMessageResult = EmailUtils::sendMessage();
    returnFromScript($sendMessageResult);

    function returnFromScript($response)
    {
        exit($response);
    }