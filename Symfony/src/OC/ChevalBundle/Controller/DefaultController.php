<?php

namespace OC\ChevalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('OCChevalBundle:Default:index.html.twig');
    }
}
