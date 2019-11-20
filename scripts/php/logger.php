<?php
    function writeLog($type, $message) {
        if($type == "INFO") {
            $infoFile = fopen($_SERVER['DOCUMENT_ROOT'].'/logs/infoLog.log', "w");
            fwrite($infoFile, $message);
            fclose($infoFile);
        } else {
            $errorFile = fopen($_SERVER['DOCUMENT_ROOT'].'/logs/errorLog.log', "w");
            fwrite($errorFile, $message);
            fclose($errorFile);
        }
    }
?>