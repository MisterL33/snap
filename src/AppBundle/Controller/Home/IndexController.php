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
        $em = $this->getDoctrine()->getEntityManager();
        $success = null;
        $failed = null;
        $type = null;
        $location = null;
        
        if($request->request->get('pseudo') !== null){
            $pseudo = $request->request->get('pseudo');
        }else{
            $pseudo = 'TropicalGuy33';
        }

        if($request->request->get('type') !== null){
            $type = $request->request->get('type');
        }else{
            $type = 1;
        }

        if($request->request->get('locations') !== null){
            $location = $request->request->get('locations');
        }else{
            $location = 95;
        }


        
        if (isset($location) && isset($pseudo) && isset($type))
        {
            var_dump('ter la ');
            
            $selectedLocation = $em->getRepository('AppBundle:Location')->find($location);

            if ($this->validatePseudo($pseudo) == false)
            {
                $user = new User();

                $user->setLogin($pseudo);
                $user->setLocation($selectedLocation);
                $user->setHot($type);
                $em->persist($user);
                $success = 'Tu est maintenant dans la liste';
                $em->flush();
                var_dump($success);
         
            }
            else
            {
                $failed = 'Tu est déjà dans la liste';
                var_dump($failed);
            }
        }


        $allLocation = $em->getRepository('AppBundle:Location')->findAll();
        //      var_dump($selectedLocation);
        //$user->setLocation($location);
        // replace this example code with whatever you need
        return $this->render('Home/index.html.twig', array(
                    'locations' => $allLocation,
                    'success' => $success,
                    'failed' => $failed
        ));
    }

    public function validatePseudo($pseudo)
    {

        $em = $this->getDoctrine()->getEntityManager();
        $exist = false;
        $user = $em->getRepository('AppBundle:User')->findBy(array('login' => $pseudo));

        if ($user)
        {
            $exist = true;
            return true;
        }

        return false;
    }

}
