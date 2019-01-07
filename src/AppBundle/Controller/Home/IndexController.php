<?php

namespace AppBundle\Controller\Home;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends Controller
{

    public function indexAction(Request $request)
    {
        
        return $this->render('@App/Home/index.html.twig', array(

        ));
    }


}
