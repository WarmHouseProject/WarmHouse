<?php

    require_once(ABSPATH . WPINC . '/lib/helper/class-request-helper.php');
    require_once(ABSPATH . WPINC . '/lib/model/email/class-email.php');

    class EmailUtils
    {
        const ERR_NO_EMAIL       = 'no email';
        const ERR_WRONG_EMAIL    = 'wrong email';
        const ERR_NO_MESSAGE     = 'empty message';
        const ERR_UNABLE_TO_SEND = 'sending error';
        const ERR_SUCCESS        = "success";

        public static function sendMessage()
        {
            $userName    = EmailUtils::getUserName();
            $userEmail   = EmailUtils::getUserEmail();
            $userMessage = EmailUtils::getUserMessage();

            if (empty($userEmail))
            {
                return EmailUtils::ERR_NO_EMAIL;
            }

            if (!is_email($userEmail))
            {
                return EmailUtils::ERR_WRONG_EMAIL;
            }

            if (empty($userMessage))
            {
                return EmailUtils::ERR_NO_MESSAGE;
            }

            $headers = 'From: ' . $userName . ' <' . $userEmail . '>';
            $sent = wp_mail(Email::RECEIVER_ADDRESS, Email::MESSAGE_SUBJECT, $userMessage, $headers);
            if ($sent)
            {
                return EmailUtils::ERR_SUCCESS;
            }
            else
            {
                return EmailUtils::ERR_UNABLE_TO_SEND;
            }
        }

        private static function getUserName()
        {
            $name = trim(RequestHelper::getParameter("user_name"));
            $name = empty($name) ? Email::ANONYMOUS_USER_TAG : $name;
            return addslashes($name);
        }

        private static function getUserEmail()
        {
            return addslashes(trim(RequestHelper::getParameter("user_email")));
        }

        private static function getUserMessage()
        {
            return addslashes(RequestHelper::getParameter("user_message"));
        }

    }