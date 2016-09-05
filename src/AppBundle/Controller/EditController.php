<?php
/**
 * Created by PhpStorm.
 * User: IvanMatas
 * Date: 08-Jun-16
 * Time: 2:13 PM
 */
namespace AppBundle\Controller;

use AppBundle\Entity\Student;
use AppBundle\Entity\Student1;
use AppBundle\Form\EditProfType;
use AppBundle\Form\EditType;
use AppBundle\Entity\User;
use AppBundle\Repository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;



class EditController extends Controller
{

    /**
     * @Route("/account/edit", name="edit")
     */

    public function editAction(Request $request)
    {

        // 1) build the form
        // $student= new Student1();
        $user = $this->get('security.token_storage')->getToken()->getUser();


        $form = $this->createForm(EditType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        /* $existing_user = $em->getRepository("AppBundle:Student1")->findOneByUsername($student->getUsername());
         $existing_email = $em->getRepository("AppBundle:Student1")->findOneByEmail($student->getEmail());
         if ($existing_user OR $existing_email) {
             echo "Username or email already taken, please try with another username";
         } else {*/

        if ($form->isSubmitted() && $form->isValid()) {

            // 4) save the User!
            $em = $this->getDoctrine()->getManager();

            $repository = $this->getDoctrine()
                ->getRepository('AppBundle:Student1');

            // var_dump($student);
            $existing_student = $em->getRepository("AppBundle:Student1")->findOneById($user->getId());


            $existing_student->setUsername($user->getUsername());
            $existing_student->setPassword($user->getPassword());
            $existing_student->setEmail($form["email"]->getData());
            $existing_student->setFirstname($form["first_name"]->getData());
            $existing_student->setLastname($form->get('last_name')->getData());
            $existing_student->setDateOfBirth($form->get('date_of_birth')->getData());
            $em->persist($user);
            $em->flush();


            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user
            //flashhiraj message

            return $this->redirectToRoute('account');
        }


        return $this->render(
            'default/edit.html.twig',
            array('form' => $form->createView(),
                //"name"=>$name
            )
        );

    }

    /**
     * @Route("/professors/edit", name="prof_edit")
     */

    public function editProfAction(Request $request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $form = $this->createForm(EditProfType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // 4) save the User!
            $em = $this->getDoctrine()->getManager();


            // var_dump($student);
            $existing_professor = $em->getRepository("AppBundle:Professors")->findOneById($user->getId());


            $existing_professor->setUsername($form["username"]->getData());
            $existing_professor->setPassword($user->getPassword());
            $existing_professor->setEmail($form["email"]->getData());
            $existing_professor->setFirstname($form["first_name"]->getData());
            $existing_professor->setLastname($form->get('last_name')->getData());
            $existing_professor->setDateOfBirth($form->get('date_of_birth')->getData());

            $em->persist($user);
            $em->flush();


            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user
            //flashhiraj message

            return $this->redirectToRoute('professors');
        }


        return $this->render(
            'default/editProf.html.twig',
            array('form' => $form->createView(),
                //"name"=>$name
            )
        );

    }
}

