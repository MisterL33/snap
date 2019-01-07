<?php

namespace AppBundle\Controller\Liste;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ListeController extends Controller
{

    public function indexAction(Request $request, $type)
    {

        $em = $this->getDoctrine()->getEntityManager();

        $locations = $em->getRepository('AppBundle:Location')->findAll();
        $allUsers = $em->getRepository('AppBundle:User')->findAll();
        $locationSelected = 1;


       
        if($request->request->get('location')){

            $location = $request->request->get('location');
            $searchUsers = $em->getRepository('AppBundle:User')->findBy(array('location' => $location));
            $allUsers = $searchUsers;
            $locationSelected = $location;

        }

        if($type == 'hot'){
            return $this->render('@App/Liste/liste.html.twig', array(
                'locations' => $locations,
                'users' => $allUsers,
                'hot' => 'true',
                'locationSelected' => $locationSelected
            ));
        }else{
            return $this->render('@App/Liste/liste.html.twig', array(
                'locations' => $locations,
                'users' => $allUsers,
                'hot' => 'false',
                'locationSelected' => $locationSelected
            ));
        }

    }



}
