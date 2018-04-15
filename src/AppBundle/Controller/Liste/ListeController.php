<?php

namespace AppBundle\Controller\Liste;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ListeController extends Controller
{

    public function indexAction(Request $request)
    {

        $em = $this->getDoctrine()->getEntityManager();

        $locations = $em->getRepository('AppBundle:Location')->findAll();
        $allUsers = $em->getRepository('AppBundle:User')->findAll();
       
        if($request->request->get('location')){
            $location = $request->request->get('location');
            $searchUsers = $em->getRepository('AppBundle:User')->findBy(array('location' => $location));
            $allUsers = $searchUsers;
        }

        
        // replace this example code with whatever you need
        return $this->render('Liste/liste.html.twig', array(
                    'locations' => $locations,
                    'users' => $allUsers,
                    'hot' => 'false',
        ));
    }

    public function hotListeAction(Request $request)
    {

        $em = $this->getDoctrine()->getEntityManager();

        $locations = $em->getRepository('AppBundle:Location')->findAll();
        $allUsers = $em->getRepository('AppBundle:User')->findAll();
       
        if($request->request->get('location')){
            $location = $request->request->get('location');
            $searchUsers = $em->getRepository('AppBundle:User')->findBy(array('location' => $location));
            $allUsers = $searchUsers;
        }


        // replace this example code with whatever you need
        return $this->render('Liste/liste.html.twig', array(
                    'locations' => $locations,
                    'users' => $allUsers,
                    'hot' => 'true',
        ));
    }


}
