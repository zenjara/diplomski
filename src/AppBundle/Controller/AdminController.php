<?php
/**
 * Created by PhpStorm.
 * User: IvanMatas
 * Date: 13-Jun-16
 * Time: 4:17 PM
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{

    /**
     * @Route("/admin", name="admin")
     */
    public function AdminAction()
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('Hello Email')
            ->setFrom('ivan.matas2@gmail.com')
            ->setTo('zenjara12@gmail.com')
            ->setBody("stari jel radi");
        $this->get('mailer')->send($message);

        return $this->render('default/admin.html.twig',array(
            ));
        }

}