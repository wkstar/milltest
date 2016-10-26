<?php

namespace YoutubeBundle\Controller;

use YoutubeBundle\Form\ShareVideoForm;
use YoutubeBundle\Entity\ShareVideo;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class VideoController extends Controller
{
	const CHANNEL_URL_PATTERN = 'https://www.googleapis.com/youtube/v3/search?key=%s&channelId=%s&part=snippet,id&order=date&maxResults=%d';
    public function showAction()
    {

    	$shareVideo = new ShareVideo();
        $shareVideoForm = $this->createForm(ShareVideoForm::class, $shareVideo);

    	$channel = $this->getParameter('mill_channel');
    	$key = $this->getParameter('youtube_key');
    	$numberOfVideos = 1;

    	$youtubeUrl = sprintf(self::CHANNEL_URL_PATTERN, $key, $channel, $numberOfVideos);

  		$apiRequest = $this->get('apirequest');
  		$jsonResult = $apiRequest->get($youtubeUrl);

  		if (!isset($jsonResult['items'][0]['id']['videoId'])) {
  			throw new \Exception('The API did not return the expected results.');
  		}
  		$videoId = $jsonResult['items'][0]['id']['videoId'];

        return $this->render('YoutubeBundle:Video:show.html.twig',
        	[
        		'video_id' => $videoId,
        		'share_form' => $shareVideoForm->createView()
        	]);
    }
}
