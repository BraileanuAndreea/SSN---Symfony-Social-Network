<?php
// src/Blogger/BlogBundle/Controller/PageController.php

namespace Blogger\BlogBundle\Controller;

use Blogger\BlogBundle\Entity\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ViewController extends Controller
{
    public function numberAction()
    {
        $em = $this->getDoctrine()->getManager();
        $view = $em->getRepository('BloggerBlogBundle:View')->find(1);

        $returnView = View::loadByView($view);

        $ipAddress = $this->container->get('request_stack')->getCurrentRequest()->getClientIp();

        if (!$view) {
            $view = View::loadByValues(1, 0, new \DateTime("2011-07-23 06:12:33"));
        } else {
            $view->setViews($view->getViews() + 1);
        }
        $em->persist($view);
        $em->flush();

        return $this->render('BloggerBlogBundle:View:number.html.twig', array(
            'noViews'       => $returnView->getViews(),
            'lastAccess'    => $returnView->getLastAccess(),
            'ipAddress'     => $ipAddress
        ));
    }
}
