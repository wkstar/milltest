<?php

namespace YoutubeBundle\Tests\Util;

use YoutubeBundle\Util\APIRequest;

class APIRequestTest extends \PHPUnit_Framework_TestCase
{
    public function testGet()
    {
    	$apiUrl = 'https://www.googleapis.com/youtube/v3/search?key=AIzaSyBt4cU1mJ9Y8lxUES0ad6HoPVgFiMTHQmQ&channelId=UCPJZo6tTnvIBROdmeovhP8A&part=snippet,id&order=date&maxResults=20';
    	$json = '{"tom": 123}';

    	$guzzleResponseMock = $this->getMockBuilder('\GuzzleHttp\Response')
	                              ->disableOriginalConstructor()
	                              ->setMethods(['getBody'])
	                              ->getMock();

  		$guzzleResponseMock->expects($this->once())
                 ->method('getBody')
                 ->will($this->returnValue($json));



    	$guzzleClientMock = $this->getMockBuilder('\GuzzleHttp\Client')
	                              ->disableOriginalConstructor()
	                              ->setMethods(['get'])
	                              ->getMock();

  		$guzzleClientMock->expects($this->once())
                 ->method('get')
                 ->with($this->equalTo($apiUrl))
                 ->will($this->returnValue($guzzleResponseMock));

        $apiTester = new APIRequest($guzzleClientMock);
        $result = $apiTester->get($apiUrl);

        $this->assertEquals(["tom" => 123], $result);
    }
}