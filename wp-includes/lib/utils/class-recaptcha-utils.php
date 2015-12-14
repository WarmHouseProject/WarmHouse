<?php

    require_once(ABSPATH . WPINC . '/lib/helper/class-request-helper.php');
    require_once(ABSPATH . WPINC . '/lib/model/recaptcha/class-recaptcha.php');

    class ReCaptchaUtils
    {
        const ERR_BOT_CHECK_FAILED = "i think you're a robot";

        static public function checkCaptcha()
        {
            $userResponse = RequestHelper::getParameter("g-recaptcha-response");

            $url = ReCaptcha::CHECK_SERVER_URL;
            $data = array('secret' => ReCaptcha::SECRET_KEY, 'response' => $userResponse);
            $captchaServerResponse = ReCaptchaUtils::sendPostRequest($url, $data);

            return ReCaptchaUtils::getCaptchaCheckResult($captchaServerResponse);
        }

        static private function getCaptchaCheckResult($response)
        {
            return json_decode($response)->success;
        }

        static private function sendPostRequest($url, $data)
        {
            $options = array(
                'http' => array(
                    'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method'  => 'POST',
                    'content' => http_build_query($data),
                ),
            );
            $context  = stream_context_create($options);
            return file_get_contents($url, false, $context);
        }
    }