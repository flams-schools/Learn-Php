<?php

    class Loader 
    {

        const UNABLE_TO_LOAD = 'Unable to load class';

        //directories
        protected static $dirs = array();

        
        protected static function loadFile ($file)
        {
            if (file_exists($file)) {
                require_once $file;
                return TRUE;
            }
            return FALSE;
        }

        public static function autoLoad ($class)
        {
            $success = FALSE;
            $fn = str_replace('\\', DIRECTORY_SEPARATOR, $class) . 'php';

            foreach (self::$dirs as $start) {
                $file = $start . DIRECTORY_SEPARATOR . $fn;
                if (self::loadFile($file)) {
                    $success = TRUE;
                    break;
                }
            }

            if (!$success) {
                if (!self::loadFile(__DIR__ . DIRECTORY_SEPARATOR .$fn)) {
                    throw new \Exception(self::UNABLE_TO_LOAD . ' ' . $class);
                }

            }
            return $success
        }
    }


    // $data = Loader::loadFile("/index.php");