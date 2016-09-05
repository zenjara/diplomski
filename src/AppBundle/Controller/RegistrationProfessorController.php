<?php
/**
 * Created by PhpStorm.
 * User: IvanMatas
 * Date: 10-Jun-16
 * Time: 6:42 PM
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Professors;
use AppBundle\Form\EditType;
use AppBundle\Form\ProfessorType;
use AppBundle\Form\UserType;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class RegistrationProfessorController extends Controller
{
    /**
     * @Route("/registerProfessor", name="professor_registration")
     */
    public function registerProfessorAction(Request $request)
    {
        // 1) build the form
        $professor = new Professors();

        $form = $this->createForm(ProfessorType::class, $professor);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);


            if ($form->isSubmitted() && $form->isValid()) {

                // 3) Encode the password (you could also do this via Doctrine listener)
                $password = $this->get('security.password_encoder')
                    ->encodePassword($professor, $professor->getPlainPassword());
                $professor->setPassword($password);




                // 4) save the User!
                $em = $this->getDoctrine()->getManager();

                $em->persist($professor);
                $em->flush();


                // ... do any other work - like sending them an email, etc
                // maybe set a "flash" success message for the user

                return $this->redirectToRoute('success');
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