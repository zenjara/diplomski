<?php
/**
 * Created by PhpStorm.
 * User: IvanMatas
 * Date: 07-Jun-16
 * Time: 11:33 AM
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Student1;
use AppBundle\Form\EditType;
use AppBundle\Form\UserType;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class RegistrationController extends Controller
{
    /**
     * @Route("/register", name="user_registration")
     */
    public function registerAction(Request $request)
    {
        // 1) build the form
        $student = new Student1();

        $form = $this->createForm(UserType::class, $student);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $existing_student= $em->getRepository("AppBundle:Student1")->findOneByUsername($student->getUsername());
        $existing_email= $em->getRepository("AppBundle:Student1")->findOneByEmail($student->getEmail());
       if($existing_student OR $existing_email){
            echo "Username or email already taken, please try with another username";
        }else {
           if ($form->isSubmitted() && $form->isValid()) {

               // 3) Encode the password (you could also do this via Doctrine listener)
               $password = $this->get('security.password_encoder')
                   ->encodePassword($student, $student->getPlainPassword());
               $student->setPassword($password);

             /*  $student = new Student();
               $student->setUser($user);

*/
               // 4) save the User!
               $em = $this->getDoctrine()->getManager();

               $em->persist($student);
               $em->flush();


               // ... do any other work - like sending them an email, etc
               // maybe set a "flash" success message for the user

               return $this->redirectToRoute('success');
           }
       }


        return $this->render(
            'registration/register.html.twig',
            array('form' => $form->createView())
        );
    }
    /**
     * @Route("/success", name="success")
     */
    public function successAction(){
        return $this->render(
            'registration/success.html.twig'
        );
    }


}