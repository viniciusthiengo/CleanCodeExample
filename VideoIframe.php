<?php

    class VideoIframe
    {
        const THUMB_SMALL = 1;
        const THUMB_MEDIUM = 2;
        const THUMB_LARGE = 3;

        const THUMB_YOUTUBE_SMALL = 'default.jpg';
        const THUMB_YOUTUBE_MEDIUM = 'mqdefault.jpg';
        const THUMB_YOUTUBE_LARGE = 'maxresdefault.jpg';
        const THUMB_VIMEO_SMALL = "thumbnail_small";
        const THUMB_VIMEO_MEDIUM = "thumbnail_medium";
        const THUMB_VIMEO_LARGE = "thumbnail_large";

        public $url;
        public $idVideo;
        public $tag;
        public $size;


        public function setSize( $contantSize ){
            $this->url = $this->getUrlFromTag();

            switch( $contantSize ){
                case self::THUMB_SMALL:
                    if( substr_count($this->url, 'youtube.com') > 0 ){
                        $this->size = self::THUMB_YOUTUBE_SMALL;
                    }
                    else{
                        $this->size = self::THUMB_VIMEO_SMALL;
                    }
                    break;
                case self::THUMB_MEDIUM:
                    if( substr_count($this->url, 'youtube.com') > 0 ){
                        $this->size = self::THUMB_YOUTUBE_MEDIUM;
                    }
                    else{
                        $this->size = self::THUMB_VIMEO_MEDIUM;
                    }
                    break;
                default:
                    if( substr_count($this->url, 'youtube.com') > 0 ){
                        $this->size = self::THUMB_YOUTUBE_LARGE;
                    }
                    else{
                        $this->size = self::THUMB_VIMEO_LARGE;
                    }
                    break;
            }
        }


        public function getThumb(){
            $this->url = $this->getUrlFromTag();
            $this->idVideo = $this->getIdFromUrl();
            $thumb = null;

            if( substr_count($this->url, 'youtube.com') > 0 ){
                $thumb = 'http://img.youtube.com/vi/'.$this->idVideo.'/'.$this->size;
            }
            else if( substr_count($this->url, 'vimeo.com') > 0 ){
                $jsonData = $this->downloadVimeoJsonContent();
                $thumb = $jsonData[0]->{$this->size};
            }
            return( $thumb );
        }


        private function getUrlFromTag(){

            $doc = new DOMDocument();
            $doc->loadHTML( $this->tag, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD );

            $tags = $doc->getElementsByTagName('iframe');
            foreach( $tags as $tag ){
                return( $tag->getAttribute('src') );
            }
            return(null);
        }


        private function getIdFromUrl(){
            $id = null;

            if( substr_count($this->url, 'youtube.com') > 0 ){

                $urlParts = explode('/', $this->url);

                /* A ÚLTIMA POSIÇÃO DO URL DO IFRAME DO YOUTUBE É ONDE SE ENCONTRA O EXTERNAL ID DO VÍDEO */
                $id = $urlParts[ count($urlParts) - 1 ];
            }
            else if( substr_count($this->url, 'vimeo.com') > 0 ){

                $urlParts = explode('/', $this->url);
                $urlParts = $urlParts[ count($urlParts) - 1 ];
                $urlParts = explode('?', $urlParts);

                /* DEPOIS DO TRABALHO NO CÓDIGO, A PRIMEIRA POSIÇÃO É O EXTERNAL ID DO VÍDEO NO VIMEO */
                $id = $urlParts[0];
            }
            return( $id );
        }


        private function downloadVimeoJsonContent(){
            $handler = fopen('http://vimeo.com/api/v2/video/'.$this->idVideo.'.json', 'f');

            $lineContent = '';
            while( $line = fgets($handler) ){
                $lineContent .= $line;
            }
            fclose($handler);

            return( json_decode($lineContent) );
        }
    }

