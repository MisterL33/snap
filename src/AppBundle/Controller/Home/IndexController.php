<?php

namespace AppBundle\Controller\Home;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;

class IndexController extends Controller
{

    public function indexAction(Request $request)
    {
        
        return $this->render('Home/index.html.twig', array(

        ));
    }


}
