<?php

    class TemplateUtils
    {
        static function includeTemplate($pagename, $data=array())
        {
            $__templatefile = $pagename;
            if (!is_readable($__templatefile))
            {
                throw new Exception('Template ' . htmlspecialchars($__templatefile) . ' is not found.');
            }
            extract($data);
            ob_start();

            try
            {
                require $__templatefile;
            }
            catch (Exception $e)
            {
                ob_end_clean();
                throw $e;
            }
        }
    }