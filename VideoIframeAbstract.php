<?php
    abstract class VideoIframeAbstract
    {
        private $tagIframe;
        protected $url;
        protected $externalId;
        protected $thumbSize;


        protected function __construct( $tagIframe=null ){
            $this->tagIframe = $tagIframe;

            if( is_string($tagIframe) ){
                $this->init();
            }
        }


        public function init(){
            $this->generateUrl();
            $this->generateExternalId();
            $this->setThumbSize( VideoIframeConstantsImpl::THUMB_MEDIUM );
        }


        protected function generateUrl(){
            if( empty($this->url) ){
                $this->generateUrlFromTagIframe();
            }
        }


        private function generateUrlFromTagIframe(){
            $doc = new DOMDocument();
            $doc->loadHTML( $this->tagIframe , LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

            $tags = $doc->getElementsByTagName('iframe');
            foreach( $tags as $tag ){
                $this->url = $tag->getAttribute('src');
                break;
            }
        }


        public function getTagIframe()
        {
            return($this->tagIframe);
        }
        public function setTagIframe( $tagIframe )
        {
            $this->tagIframe = $tagIframe;
        }


        public function getUrl()
        {
            return($this->url);
        }
        public function setUrl( $url )
        {
            $this->url = $url;
        }


        abstract public function getThumb();
        abstract protected function generateExternalId();
        abstract public function setThumbSize( $constantThumbSize );
    }