<?php

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

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $student = $this->get('security.token_storage')->getToken()->getUser(); // uzima objekt usera preko tokena
        if(!is_string($student)){ // ako je vracen string, znaci da je anonimni posjetitelj
            //$this->redirect($this->generateUrl("account"));


//                $this->redirectToRoute("user_first"); // preusmjeri na account rutu s potrebnim podacima
                $this->generateUrl("user_first");
                return $this->render('default/account.html.twig', array(
                    "name" => $student->getUsername(),
                    "yearOfStudy"=>$student->getYearOfStudy(),
                    "semestar"=>$student->getSemestar(),
                    "subjects"=>$student->getSubjects()
                ));


        }else {


            return $this->render('default/index.html.twig'); // ako nije logiran prikazi mu pocetnu stranicu
        }
    }

    /**
     * @Route("/account", name="account")
     */
    public function accountAction()
    {
        $user=$this->get("security.token_storage")->getToken()->getUser();
        $subjects=$user->getSubjects();

        $year_of_study=$user->getYearOfStudy();

        $semestar=$user->getSemestar();
        return $this->render('default/account.html.twig', array( // pocetna strana za korisnike s potrebnim podacima
           // "name" => $name
            "user"=>$user,
            "subjects"=>$subjects,
            "yearOfStudy"=>$year_of_study,
            "semestar"=>$semestar

        ));
    }

    /**
     * @Route("/account/enroll", name="enroll")
     */
    public function enrollAction(Request $request)
    {

        // 1) build the form

        $student = $this->get('security.token_storage')->getToken()->getUser();
        $grade = new Grade(); // instanciranje klase Grade


        $form = $this->createForm(EnrollType::class, $student); // kreiranje forme odredjenog tipa s userom

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);



        $em = $this->getDoctrine()->getManager();

        $yearOfStudy= $student->getYearOfStudy();
        $semestar= $student->getSemestar();

        $subjects = $em->getRepository("AppBundle:Subjects")->findBy( // pronalaze se predmeti koji odgovaraju godini i semestru korisnika
            array('yearOfStudy' => $yearOfStudy,
                'semestar' => $semestar
            )
        );


        $form->handleRequest($request);

        if($request->getMethod() == 'POST') { // ako je POST metoda
            $form->handleRequest($request); // <== THIS


            for($i=1;$i<=count($subjects);$i++){
                if(isset($_POST["{$i}"])){ // ako je pritisnut botun enroll za pojedini ponudjeni predmet
                    $subject = $em->getRepository("AppBundle:Subjects")->findOneById($i); // pronadji taj subject
                    $grade->setStudent($student); //postavi studenta i predmet
                    $grade->setSubject($subject);
                    $student->addSubject($subject); // povezi predmet sa studentom
                    $em->persist($grade); // saveaj ocjenu i studenta
                    $em->persist($student);
                    $em->flush(); // flushaj
                    $this->addFlash( // dodaj flash msg
                        'notice',
                        'Enrolled!'
                    );
                }
            }

            return $this->render('default/enroll.html.twig', array(
                "subjects" => $subjects
            ));


        }else {
            return $this->render('default/enroll.html.twig', array(
                "subjects" => $subjects
            ));
        }

    }


    /**
     * @Route("/account/grades", name="account_grade")
     */
    public function accountGradesAction()
    {
        $user=$this->get("security.token_storage")->getToken()->getUser();
        $id= $user->getId();
        $subjects=$user->getSubjects();
        if($subjects) { // ako postoje predmeti vezani za usera, pronadji sve ocjene za sve predmete korisnika odredjenog id-a
            $em = $this->getDoctrine()->getManager();
            //foreach ($subjects as $subject)
                $grades = $em->getRepository("AppBundle:Grade")->findBy(array(
                    "student" => $id,
                ));

        }


        return $this->render('default/accountGrade.html.twig', array(
           // "name" => $name
            "user"=>$user,
            "subjects"=>$subjects,
            "grades"=>$grades
        ));
    }

    /**
     * @Route("/professors", name="professors")
     */
    public function professorsAction()
    {
        $professor = $this->get('security.token_storage')->getToken()->getUser(); //pocetna strana za profesore s potrebnim podacima
        $subjects=$professor->getSubjects();
        return $this->render('default/accountProf.html.twig', array(
           "professor" => $professor,
            "subjects" =>$subjects
        ));
    }







    /**
     * @Route("/done", name="done")
     */
    public function doneAction(Request $request)
{
    $student = $this->get('security.token_storage')->getToken()->getUser();


    $form = $this->createForm(EnrollType::class, $student);

    // 2) handle the submit (will only happen on POST)
    $form->handleRequest($request);



    $em = $this->getDoctrine()->getManager();

    $subjects = $em->getRepository("AppBundle:Subjects")->findAll();

   /* foreach ($subjects as $subject) {
        $show = $this->formShow()->createView();
        $arrayForms[] = $show;
    }*/
    $form->handleRequest($request);
    var_dump($request->getMethod());
    if($request->getMethod() == 'POST') {
        $form->handleRequest($request); // <== THIS


        for($i=0;$i<count($subjects);$i++){
            if(isset($_POST["{$i}"])){
                $subject = $em->getRepository("AppBundle:Subjects")->find($i);
                $student->addSubject($subject);
                $em->flush();
            }
        }

        return $this->render('default/enroll.html.twig', array(
            //"form" => $form->createView(),
            //"name" => $name,
            "subjects" => $subjects
        ));


    }


   /* if (isset($value)) {

        // 4) save the User!
        // $number=$form->get("id");
        $subject = $em->getRepository("AppBundle:Subjects")->find(4);
        $student->addSubject($subject);
        $em->flush();
        /*elseif(isset($_POST["4"])) {
            $subject = $em->getRepository("AppBundle:Subjects")->find(4);
            $student->addSubject($subject);
            $em->flush();
        }else{

        }*/


   // }



        // ... do any other work - like sending them an email, etc
        // maybe set a "flash" success message for the user
        //flashhiraj message




    else {
        return $this->render('default/enroll.html.twig', array(
            //"form" => $form->createView(),

            "subjects" => $subjects
        ));
    }
}

   /* private function formShow()
    {
        $show = $this->createFormBuilder()
            ->setAction($this->generateUrl('done'))
            ->setMethod('POST')
            ->add('id', "hidden")
            ->add('button', SubmitType::class)
            ->getForm();

        return $show;
    }*/






}


