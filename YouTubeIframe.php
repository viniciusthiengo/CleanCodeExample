<?php
    class YouTubeIframe extends VideoIframeAbstract implements YouTubeIframeConstantsImpl
    {
        public function __construct( $tagIframe=null )
        {
            parent::__construct( $tagIframe );
        }


        protected function generateExternalId()
        {
            $urlParts = explode('/', $this->url);
            $this->externalId = $urlParts[ count($urlParts) - 1 ];
        }


        public function getThumb()
        {
            return( 'http://img.youtube.com/vi/'.$this->externalId.'/'.$this->thumbSize );
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
                    throw new Exception('Constante de tamanho de thumb inválida.');
            }
        }
    }