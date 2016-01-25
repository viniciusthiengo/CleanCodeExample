<?php

    /*if( !ini_get('display_errors') ){
        ini_set('display_errors', 1);
    }*/

    include('util/DownloadUtil.php');
    include('VideoIframe.php');
    include('VideoIframeConstantsImpl.php');
    include('VideoIframeAbstract.php');
    include('VideoIframeFactory.php');

    include('YouTubeIframeConstantsImpl.php');
    include('YouTubeIframe.php');
    include('VimeoIframeConstantsImpl.php');
    include('VimeoIframe.php');


    // TEST

    $youTubeIframe = new VideoIframe();
    $youTubeIframe->tag = '<iframe width="420" height="315" src="https://www.youtube.com/embed/Z980dZEzgzY" frameborder="0" allowfullscreen></iframe>';
    $youTubeIframe->setSize( VideoIframe::THUMB_SMALL );
    echo $youTubeIframe->getThumb().'<br>';

    $vimeoIframe = new VideoIframe();
    $vimeoIframe->tag = '<iframe src="https://player.vimeo.com/video/152614354?color=ffffff&title=0&byline=0&portrait=0" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
    $vimeoIframe->setSize( VideoIframe::THUMB_SMALL );
    echo $vimeoIframe->getThumb().'<br><br>';


    $youTubeVideoThumb = VideoIframeFactory::create('<iframe width="420" height="315" src="https://www.youtube.com/embed/Z980dZEzgzY" frameborder="0" allowfullscreen></iframe>');
    $youTubeVideoThumb->setThumbSize( VideoIframeConstantsImpl::THUMB_LARGE );
    echo $youTubeVideoThumb->getThumb().'<br>';

    $vimeoVideoThumb = VideoIframeFactory::create('<iframe src="https://player.vimeo.com/video/152614354?color=ffffff&title=0&byline=0&portrait=0" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>');
    $vimeoVideoThumb->setThumbSize( VideoIframeConstantsImpl::THUMB_LARGE );
    echo $vimeoVideoThumb->getThumb().'<br><br>';