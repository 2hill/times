<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TimesController extends Controller
{
  /**
   * @Route("/time", name="time")
   */
   public function timeAction() {
     return new Response("Il est " . date('H:i'));
   }

   /**
    * @Route("/times/{x}", name="timesMemory", requirements={"x": "\d+"})
    */
    public function timesMemoryAction($x, Request $request) {
      // We retrieve "result" from the session flash
      $memory = $request->getSession()->getFlashBag()->get('result');
      // if $memory is defined, it's an array, that's why
      // we retrieves its first element $memory[0]
      // 1 is a default value
      $y = !empty($memory) ? $memory[0] : 1;
      $result = $x * $y;
      // We have to explicitely clear the session flash
      // so that the result array remains with only one element
      $request->getSession()->getFlashBag()->clear();
      // and then add the new result
      $this->addFlash('result', $result);
      return new Response($result);
    }

   /**
    * @Route("/times/{x}/{y}", name="times", requirements={"x": "\d+", "y": "\d+"})
    */
    public function timesAction($x, $y, Request $request) {
      $result = $x * $y;
      // We clear the session flash before adding the result to it
      // NB: when we retrieve the session flash in twig, it is
      // automatically cleared just after being used, but it is
      // the case in controllers
      $request->getSession()->getFlashBag()->clear();
      $this->addFlash('result', $result);
      return new Response($result);
    }

    /**
     * @Route("/times/{x}/{word}", name="repeat", requirements={"x": "\d+"})
     */
     public function repeatAction($x, $word) {
       $result = str_repeat($word . " ", $x);
       // We remove the last " " space
       $result = substr($result, 0, -1);
       return new Response($result);
     }

     /**
      * @Route("/times", name="timesQuery")
      */
      public function timesQueryAction(Request $request) {
        $result = $request->query->get('x') * $request->query->get('y');
        return new Response($result);
      }

      /**
       * @Route("/times/{many}", name="timesMany", requirements={"many": "(\d|\/)+"})
       */
       public function timesManyAction($many, Request $request) {
         // $many is a string, for example "3/2/4/1"
         // and we split it using "/" as the split character
         $params = preg_split("/\//", $many);
         $result = 1;
         foreach($params as $p){
           $result = $result * $p;
         }
         return new Response($result);
       }
}
