<?php

namespace AppBundle\Controller\Register;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;

class RegisterController extends Controller
{

    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $success = null;
        $failed = null;
        $type = null;
        $gender = null;
        $age = null;
        $bio = null;
        $location = null;
        
        if($request->request->get('pseudo') !== null){
            $pseudo = $request->request->get('pseudo');
        }

        if($request->request->get('type') !== null){
            $type = $request->request->get('type');
        }else{
            $type = 1;
        }

        if($request->request->get('gender') !== null){
            $gender = $request->request->get('gender');
        }

        if($request->request->get('age') !== null){
            $age = $request->request->get('age');
        }

        if($request->request->get('bioText') !== null){
            $bio = $request->request->get('bioText');
        }

        if($request->request->get('locations') !== null){
            $location = $request->request->get('locations');
        }else{
            $location = 95;
        }

        if($type == 2){
            if ( isset($location) && isset($pseudo) && isset($type) && isset($age) && isset($bio) && isset($gender))
            {
                $selectedLocation = $em->getRepository('AppBundle:Location')->find($location);
                if ($this->validatePseudo($pseudo, $type) == false)
                {
                    
                    $user = new User();
                    $user->setLogin($pseudo);
                    $user->setLocation($selectedLocation);
                    $user->setHot($type);
                    $user->setGenre($gender);
                    $user->setDescription($bio);
                    $user->setAge($age);
                    $em->persist($user);
                    $success = 'Tu est maintenant dans la liste';
                    $em->flush();
                }
            }
        }else{
            if (isset($location) && isset($pseudo) && isset($type))
            {
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
                }
            }
        }
        


        $allLocation = $em->getRepository('AppBundle:Location')->findAll();
        //      var_dump($selectedLocation);
        //$user->setLocation($location);
        // replace this example code with whatever you need
        return $this->render('@App/Register/register.html.twig', array(
                    'locations' => $allLocation,
                    'success' => $success,
                    'failed' => $failed
        ));
    }

    public function validatePseudo($pseudo,$type) // si l'user existe mais qu'il veux s'inscrire dans un liste différente
    {
        
        $em = $this->getDoctrine()->getEntityManager();
        $exist = false;
        $user = $em->getRepository('AppBundle:User')->findOneBy(array('login' => $pseudo));
        dump($type);
        
        if ($user && $type == $user->getHot())
        {
            die(dump($user));
            $exist = true;
            return true;
        }
        
        
        return false;
    }

}
