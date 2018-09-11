<?php

namespace AppBundle\Controller\Home;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;
use Symfony\Component\HttpFoundation\JsonResponse;

class IndexController extends Controller
{

    public function indexAction(Request $request)
    {

        return $this->render('Home/index.html.twig', array(

        ));
    }

    public function chatAction(Request $request)
    {
        
        
        $function = $this->get('request')->request->get('function');
        $log = array();

        switch($function) {
        
           case('getState'):
               if (file_exists('chat.txt')) {
                   $lines = file('chat.txt');
               }
               $log['state'] = count($lines); 
               break;  
          
            case('update'):
              $state = $this->get('request')->request->get('state');
              if (file_exists('chat.txt')) {
                 $lines = file('chat.txt');
              }
              $count =  count($lines);
              if ($state == $count){
                 $log['state'] = $state;
                 $log['text'] = false;
              } else {
                 $text= array();
                 $log['state'] = $state + count($lines) - $state;
                 foreach ($lines as $line_num => $line) {
                     if ($line_num >= $state){
                           $text[] =  $line = str_replace("\n", "", $line);
                     }
                 }
                 $log['text'] = $text; 
              }
                
              break;
           
            case('send'):
                $nickname = htmlentities(strip_tags($_POST['nickname']));
             $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
             $message = htmlentities(strip_tags($_POST['message']));
             if (($message) != "\n") {
               if (preg_match($reg_exUrl, $message, $url)) {
                  $message = preg_replace($reg_exUrl, '<a href="'.$url[0].'" target="_blank">'.$url[0].'</a>', $message);
               } 
                  fwrite(fopen('chat.txt', 'a'), "<span>". $nickname . "</span>" . $message = str_replace("\n", " ", $message) . "\n"); 
             }
                break;
        }
        return new JsonResponse(array('log' => $log));
    }


}
