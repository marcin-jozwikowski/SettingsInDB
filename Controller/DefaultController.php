<?php

namespace MarcinJozwikowski\SettingsInDBBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('SettingsInDBBundle:Default:index.html.twig', array('name' => $name));
    }
}
