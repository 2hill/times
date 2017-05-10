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
      $memory = $request->getSession()->getFlashBag()->get('result');
      $y = !empty($memory) ? $memory[0] : 1;
      $result = $x * $y;
      $request->getSession()->getFlashBag()->clear();
      $this->addFlash('result', $result);
      return new Response($result);
    }

   /**
    * @Route("/times/{x}/{y}", name="times", requirements={"x": "\d+", "y": "\d+"})
    */
    public function timesAction($x, $y, Request $request) {
      $result = $x * $y;
      $request->getSession()->getFlashBag()->clear();
      $this->addFlash('result', $result);
      return new Response($result);
    }

    /**
     * @Route("/times/{x}/{word}", name="repeat", requirements={"x": "\d+"})
     */
     public function repeatAction($x, $word) {
       $result = str_repeat($word . " ", $x);
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
         $params = preg_split("/\//", $many);
         $result = 1;
         foreach($params as $p){
           $result = $result * $p;
         }
         return new Response($result);
       }
}
