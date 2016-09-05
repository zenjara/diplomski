<?php
/**
 * Created by PhpStorm.
 * User: IvanMatas
 * Date: 13-Jun-16
 * Time: 4:47 PM
 */
namespace AppBundle\Controller;

use AppBundle\Entity\Grade;
use AppBundle\Form\EnrollType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;


use Symfony\Component\HttpFoundation\Response;

class SubjectController extends Controller
{
    /**
     * @Route("/professors/descriptions/{subject}", name="subject_lists")
     */
    public function subjectListAction(Request $request,$subject)
    {
        $professor = $this->get("security.token_storage")->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $requested_subject = $em->getRepository("AppBundle:Subjects")->findOneBySubjectName($subject);
        $subject_id = $requested_subject->getId();
        $professorOfASubject = $requested_subject->getProfessors();
        $students = $requested_subject->getStudents();
        if ($professor === $professorOfASubject) {
            $abilityToGrade = 1;
        } else {
            $abilityToGrade = 0;
        }
        if ($request->getMethod() == 'POST') {
            foreach ($students as $oneStudent) {
                $id = $oneStudent->getId();
                if (isset($_POST["{$id}"])) {
                    // $student = $em->getRepository("AppBundle:Student1")->findOneById($i);
                    $student = $em->getRepository("AppBundle:Grade")->findOneBy(array(
                        "student" => $id,
                        "subject" => $subject_id
                    ));
                    if (($_POST["{$id}prvi"])) {
                        $student->setKolokvij1($_POST["{$id}prvi"]);
                        $em->flush();
                    }
                    if (($_POST["{$id}drugi"])) {
                        $student->setKolokvij2($_POST["{$id}drugi"]);
                        $em->flush();
                    }
                    if (($_POST["{$id}treci"])) {
                        $student->setIspit1($_POST["{$id}treci"]);
                        $em->flush();
                    }
                    if (($_POST["{$id}cetvrti"])) {
                        $student->setIspit2($_POST["{$id}cetvrti"]);
                        $em->flush();
                    }
                    $em->flush();
                }
            }

        }
            return $this->render('default/subjectList.html.twig', array(
                "subject" => $requested_subject,
                "students" => $students,
                "professor" => $professorOfASubject,
                "abilityToGrade" => $abilityToGrade

            ));

    }

    /**
     * @Route("/description/professors/{subject}", name="subject_list")
     */
    public function subjectListAAction(Request $request,$subject)
    {
        $professor= $this->get("security.token_storage")->getToken()->getUser();
        $em= $this->getDoctrine()->getManager();
        $requested_subject= $em->getRepository("AppBundle:Subjects")->findOneBySubjectName($subject);
        $subject_id=$requested_subject->getId();
        $professorOfASubject= $requested_subject->getProfessors();
        $students = $requested_subject->getStudents();
        if($professor=== $professorOfASubject){
            $abilityToGrade=1;
        }else{
            $abilityToGrade=0;
        }
        if($request->getMethod() == 'POST') {
            for ($i = 0; $i < count($students); $i++) {
                if (isset($_POST["{$i}"])) {
                    // $student = $em->getRepository("AppBundle:Student1")->findOneById($i);
                    $student = $em->getRepository("AppBundle:Grade")->findOneBy(array(
                        "student"=>$i,
                        "subject"=>$subject_id
                    ));
                    if(($_POST["prvi"])){
                        $student->setKolokvij1($_POST["prvi"]);
                        $em->flush();
                    }
                    if(($_POST["drugi"])){
                        $student->setKolokvij2($_POST["drugi"]);
                        $em->flush();
                    }
                    if(($_POST["treci"])){
                        $student->setIspit1($_POST["treci"]);
                        $em->flush();
                    }
                    if(($_POST["cetvrti"])){
                        $student->setIspit2($_POST["cetvrti"]);
                        $em->flush();
                    }
                    $em->flush();
                }
            }
        }
        return $this->render('default/subjectList.html.twig',array(
            "subject"=>$requested_subject,
            "students"=>$students,
            "professor"=>$professorOfASubject,
            "abilityToGrade"=>$abilityToGrade

        ));
    }
}