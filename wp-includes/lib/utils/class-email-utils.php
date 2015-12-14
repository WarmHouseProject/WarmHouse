<?php

    require_once(ABSPATH . WPINC . '/lib/helper/class-request-helper.php');
    require_once(ABSPATH . WPINC . '/lib/model/email/class-email.php');

    class EmailUtils
    {
        const ERR_NO_EMAIL         = 'no email';
        const ERR_WRONG_EMAIL      = 'wrong email';
        const ERR_NO_MESSAGE       = 'empty message';
        const ERR_UNABLE_TO_SEND   = 'sending error';
        const ERR_SUCCESS          = "success";

        static private $_userName = "";
        static private $_userEmail = "";
        static private $_userMessage = "";

        public static function sendMessage()
        {
            if (!EmailUtils::$_userName || !EmailUtils::$_userEmail || !EmailUtils::$_userMessage)
            {
                return;
            }

            $headers = 'From: ' . EmailUtils::$_userName . ' <' . EmailUtils::$_userEmail . '>';
            $sent = wp_mail(Email::RECEIVER_ADDRESS, Email::MESSAGE_SUBJECT, EmailUtils::$_userMessage, $headers);
            if ($sent)
            {
                return EmailUtils::ERR_SUCCESS;
            }
            else
            {
                return EmailUtils::ERR_UNABLE_TO_SEND;
            }
        }

        public static function getMessageData()
        {
            EmailUtils::$_userName    = EmailUtils::getUserName();
            EmailUtils::$_userEmail   = EmailUtils::getUserEmail();
            EmailUtils::$_userMessage = EmailUtils::getUserMessage();
        }

        public  static function checkMessageData()
        {
            if (!EmailUtils::$_userName || !EmailUtils::$_userEmail || !EmailUtils::$_userMessage)
            {
                EmailUtils::getMessageData();
            }

            if (empty(EmailUtils::$_userEmail))
            {
                return EmailUtils::ERR_NO_EMAIL;
            }

            if (!is_email(EmailUtils::$_userEmail))
            {
                return EmailUtils::ERR_WRONG_EMAIL;
            }

            if (empty(EmailUtils::$_userMessage))
            {
                return EmailUtils::ERR_NO_MESSAGE;
            }

            return EmailUtils::ERR_SUCCESS;
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