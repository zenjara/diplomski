<?php
/**
 * Created by PhpStorm.
 * User: IvanMatas
 * Date: 08-Jun-16
 * Time: 8:05 PM
 * {}@]
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends Controller
{
    /**
     * @Route("/search", name="search")
     */
    public function searchAction()
    {
        $em= $this->getDoctrine()->getManager();
        $students = $em->getRepository("AppBundle:Student1")->findAll();
        $professors= $em->getRepository("AppBundle:Professors")->findAll();

        return $this->render("default/search.html.twig",array(
            "students"=> $students,
            "professors"=>$professors
        ));
    }

    /**
     * @Route("professors/search", name="profSearch")
     */
    public function professorSearchAction()
    {
        $em= $this->getDoctrine()->getManager();
        $students = $em->getRepository("AppBundle:Student1")->findAll();
        $professors= $em->getRepository("AppBundle:Professors")->findAll();

        return $this->render("default/profSearch.html.twig",array(
            "students"=> $students,
            "professors"=>$professors
        ));
    }
}
