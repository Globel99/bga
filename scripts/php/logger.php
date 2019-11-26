<?php
    function writeLog($type, $message) {
        if($type == "INFO") {
            $file = $_SERVER['DOCUMENT_ROOT'].'/logs/infoLog.log';
            file_put_contents($file, $message, FILE_APPEND | LOCK_EX);
            fclose($file);
        } else if($type == "PROCESSOR") {
            $file = $_SERVER['DOCUMENT_ROOT'].'/logs/processorLog.log';
            file_put_contents($file, $message, FILE_APPEND | LOCK_EX);
            fclose($file);
        } else if($type == "ERROR") {
            $file = $_SERVER['DOCUMENT_ROOT'].'/logs/errorLog.log';
            file_put_contents($file, $message, FILE_APPEND | LOCK_EX);
            fclose($file);
        } else {
            echo "something went wrong";
        }
    }
?>