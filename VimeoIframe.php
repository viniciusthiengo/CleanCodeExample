<?php
    class VimeoIframe extends VideoIframeAbstract implements VimeoIframeConstantsImpl
    {
        public function __construct( $tagIframe=null )
        {
            parent::__construct( $tagIframe );
        }


        protected function generateExternalId()
        {
            $urlParts = explode('/', $this->url);
            $containId = $urlParts[ count($urlParts) - 1 ];
            $containIdParts = explode('?', $containId);
            $this->externalId = $containIdParts[0];
        }


        public function getThumb()
        {
            $jsonObj = DownloadUtil::downloadJson('http://vimeo.com/api/v2/video/'.$this->externalId.'.json');
            return( $jsonObj[0]->{$this->thumbSize} );
        }


        public function setThumbSize( $constantThumbSize )
        {
            switch( $constantThumbSize ){
                case VideoIframeConstantsImpl::THUMB_SMALL:
                    $this->thumbSize = self::THUMB_SMALL;
                    break;
                case VideoIframeConstantsImpl::THUMB_MEDIUM:
                    $this->thumbSize = self::THUMB_MEDIUM;
                    break;
                case VideoIframeConstantsImpl::THUMB_LARGE:
                    $this->thumbSize = self::THUMB_LARGE;
                    break;
                default:
                    throw new Exception('Constante de tamanho de thumb Vimeo inválida.');
            }
        }
    }