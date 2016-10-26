<?php

namespace YoutubeBundle\Controller;

use YoutubeBundle\Form\ShareVideoForm;
use YoutubeBundle\Entity\ShareVideo;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class VideoController extends Controller
{
	const CHANNEL_URL_PATTERN = 'https://www.googleapis.com/youtube/v3/search?key=%s&channelId=%s&part=snippet,id&order=date&maxResults=%d';

    public function showAction(Request $request)
    {
    	$shareVideo = new ShareVideo();
        $shareVideoForm = $this->createForm(ShareVideoForm::class, $shareVideo);

		$shareVideoForm->handleRequest($request);

		if ($shareVideoForm->isSubmitted() && $shareVideoForm->isValid()) {

			$data = $shareVideoForm->getData();
  			$emailer = $this->get('emailsender');

			$subject = 'Check out this video';
  			$body = sprintf ('Hi %s. %s thinks you should should watch this video- %s', $data->getRecipientName(), $data->getName(), $request->getUri());

  			$emailer->send($subject, $data->getEmail(), $data->getRecipientEmail(), $body);


  			$this->addFlash(
	            'notice',
	            'Email was sent!'
	        );

  			//Wipe data now it's submitted
	        unset($shareVideoForm);
  			unset($shareVideo);

  			//I don't like repeating myself. But needs must. I'd prefer to move these to class properties and have a method initialise them.
    		$shareVideo = new ShareVideo();
	        $shareVideoForm = $this->createForm(ShareVideoForm::class, $shareVideo);
   		}



    	$channel = $this->getParameter('mill_channel');
    	$key = $this->getParameter('youtube_key');
    	$numberOfVideos = 1;

    	$youtubeUrl = sprintf(self::CHANNEL_URL_PATTERN, $key, $channel, $numberOfVideos);

  		$apiRequest = $this->get('apirequest');
  		$jsonResult = $apiRequest->get($youtubeUrl);

  		if (!isset($jsonResult['items'][0]['id']['videoId'])) {
  			//Usually I'd do something more user friendly with this.
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
