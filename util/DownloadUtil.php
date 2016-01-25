<?php

class DownloadUtil
{
    static public function downloadJson( $url )
    {
        $content = self::getDownloadContent( $url );
        return( json_decode($content) );
    }


    static private function getDownloadContent( $url )
    {
        $handler = fopen($url, 'f');
        $content = '';

        while( $line = fgets($handler) ){
            $content .= $line;
        }
        fclose($handler);

        return( $content );
    }
}