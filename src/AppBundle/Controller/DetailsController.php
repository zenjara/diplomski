<?php
/**
 * Created by PhpStorm.
 * User: IvanMatas
 * Date: 13-Jun-16
 * Time: 9:22 PM
 */
namespace AppBundle\Controller;


use AppBundle\Entity\Student1;
use AppBundle\Form\EditProfType;
use AppBundle\Form\EditType;
use AppBundle\Entity\User;
use AppBundle\Repository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DetailsController extends Controller
{
    /**
     * @Route("/description/{account}", name="user_description")
     */

    public function DescriptionAction(Request $request,$account)
    {
        $user=$this->get("security.token_storage")->getToken()->getUser();
        if($user->getIsProfessor()==1){
            $visitorIsProfessor=1;
        }else{
            $visitorIsProfessor=0;
        }
        $em=$this->getDoctrine()->getManager();
        $requested_user=$em->getRepository("AppBundle:Student1")->findOneByUsername($account);
        $requested_professor=$em->getRepository("AppBundle:Professors")->findOneByUsername($account);
        if($requested_professor){
            $isProfessor=1;
            $subjects=$requested_professor->getSubjects();
            $email=$requested_professor->getEmail();
        }else{
            $isProfessor=0;
            $subjects=null;
            $email=$requested_user->getEmail();
        }

        if($request->getMethod() == 'POST') {
            if($_POST["send"]){
                $message = \Swift_Message::newInstance()
                    ->setSubject($_POST["subject"])
                    ->setFrom($_POST["email"])
                    ->setTo($email)
                    ->setBody($_POST["message"]);
                $this->get('mailer')->send($message);


            }
        }

        return $this->render('default/description.html.twig',array(
            "visitor"=>$user,
            "visitorIsProfessor"=>$visitorIsProfessor,
            "isProfessor"=>$isProfessor,
            "accountProfessor"=>$requested_professor,
            "accountStudent"=>$requested_user,
            "subjects"=>$subjects
        ));
    }



    /**
     * @Route("professors/description/{account}", name="prof_user_description")
     */

    public function ProfessorsDescriptionAction(Request $request,$account)
    {
        $user=$this->get("security.token_storage")->getToken()->getUser();
        if($user->getIsProfessor()==1){
            $visitorIsProfessor=1;
        }else{
            $visitorIsProfessor=0;
        }
        $em=$this->getDoctrine()->getManager();
        $requested_user=$em->getRepository("AppBundle:Student1")->findOneByUsername($account);
        $requested_professor=$em->getRepository("AppBundle:Professors")->findOneByUsername($account);
        if($requested_professor){
            $isProfessor=1;
            $subjects=$requested_professor->getSubjects();
            $email=$requested_professor->getEmail();
        }else{
            $isProfessor=0;
            $subjects=null;
            $email=$requested_user->getEmail();
        }

        if($request->getMethod() == 'POST') {

            if($_POST["send"]){
                $message = \Swift_Message::newInstance()
                    ->setSubject($_POST["subject"])
                    ->setFrom("zenjara12@gmail.com")
                    ->setTo("ivan.matas2@gmail.com")
                    ->setBody($_POST["message"]);
                $this->get('mailer')->send($message);

                return $this->render('default/description.html.twig',array(
                    "visitor"=>$user,
                    "visitorIsProfessor"=>$visitorIsProfessor,
                    "isProfessor"=>$isProfessor,
                    "accountProfessor"=>$requested_professor,
                    "accountStudent"=>$requested_user,
                    "subjects"=>$subjects
                ));

            }
        }

        return $this->render('default/description.html.twig',array(
            "visitor"=>$user,
            "visitorIsProfessor"=>$visitorIsProfessor,
            "isProfessor"=>$isProfessor,
            "accountProfessor"=>$requested_professor,
            "accountStudent"=>$requested_user,
            "subjects"=>$subjects
        ));
    }
}