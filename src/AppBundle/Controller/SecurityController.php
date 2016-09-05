<?php
/**
 * Created by PhpStorm.
 * User: IvanMatas
 * Date: 07-Jun-16
 * Time: 12:30 PM
 */
namespace AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        //$name = $_POST["_username"];
        $student = $this->get('security.token_storage')->getToken()->getUser();
        return $this->render(
            'security/login.html.twig',
            array(
                // last username entered by the user
                'last_username' => $lastUsername,
                //'last_username' => $_POST["_username"],
                'error'         => $error,
              //  "name"=> $name
            )
        );
    }

    /**
     * @Route("/login_check", name="login_check")
     */
    public function loginCheckAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();


        /*if($request->getMethod() == 'POST'){
            return $this->render(
                'security/login.html.twig',
                array(
                    // last username entered by the user
                    // 'last_username' => $lastUsername,
                    'last_username' => $_POST["_username"],
                    'error'         => $error,

                )
            );
        }*/
        return $this->render(
            'security/login.html.twig',
            array(
                // last username entered by the user
                'last_username' => $lastUsername,
                'error'         => $error,

            )
        );
    }

    /**
     * @Route("/professors/login_check", name="professors_login_check")
     */
    public function loginProfCheckAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();


        /*if($request->getMethod() == 'POST'){
            return $this->render(
                'security/login.html.twig',
                array(
                    // last username entered by the user
                    // 'last_username' => $lastUsername,
                    'last_username' => $_POST["_username"],
                    'error'         => $error,

                )
            );
        }*/
        return $this->render(
            'security/loginProf.html.twig',
            array(
                // last username entered by the user
                'last_username' => $lastUsername,
                'error'         => $error,

            )
        );
    }
    /**
     * @Route("/professors/login", name="professors_login")
     */
    public function loginProfAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();


        /*if($request->getMethod() == 'POST'){
            return $this->render(
                'security/login.html.twig',
                array(
                    // last username entered by the user
                    // 'last_username' => $lastUsername,
                    'last_username' => $_POST["_username"],
                    'error'         => $error,

                )
            );
        }*/
        return $this->render(
            'security/loginProf.html.twig',
            array(
                // last username entered by the user
                'last_username' => $lastUsername,
                'error'         => $error,

            )
        );
    }
}