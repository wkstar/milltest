<?php

namespace YoutubeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
    	
        return $this->render('YoutubeBundle:Default:index.html.twig');
    }
}
