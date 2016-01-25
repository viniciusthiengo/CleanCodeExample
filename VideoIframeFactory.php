<?php

/**
 * Created by PhpStorm.
 * User: viniciusthiengo
 * Date: 1/24/16
 * Time: 2:50 PM
 */
class VideoIframeFactory
{
    private function __construct(){}

    static public function create( $tagIframe )
    {

        $obj = null;
        if( substr_count( $tagIframe, YouTubeIframeConstantsImpl::DOMAIN ) > 0 ){
            $obj = new YouTubeIframe( $tagIframe );
        }
        else if( substr_count( $tagIframe, VimeoIframeConstantsImpl::DOMAIN ) > 0 ){
            $obj = new VimeoIframe( $tagIframe );
        }
        else{
            throw new Exception("Iframe tag inválida, forneça uma de YouTube ou Vimeo.");
        }

        return( $obj );
    }
}