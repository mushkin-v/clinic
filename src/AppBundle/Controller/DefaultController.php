<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
//use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder; for PASS GENERATOR

class DefaultController extends Controller
{
    public function loginAction()
    {
        $request = $this->get('request');
        $session = $this->get('session');

        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->render(':default:login.html.twig', array(
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
        ));
    }

//      PASS GENERATOR
//    /**
//     * @Route("/pass", name="pass")
//     */
//    public function passAction()
//    {
//        $messageDigestPasswordEncoder= new MessageDigestPasswordEncoder;
//
//        var_dump($messageDigestPasswordEncoder); // you'll see the default options
//        var_dump($messageDigestPasswordEncoder->encodePassword('password', ''));
//
//    }

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        return $this->render(':pages:main.html.twig');
    }

    /**
     * @Route("/sections", name="sections")
     */
    public function sectionsAction()
    {
        $sections = $this->getDoctrine()->getManager()->getRepository('AppBundle:Category')->findAll();

        return $this->render(':pages:sections.html.twig', array('sections' => $sections));
    }

    /**
     * @Route("/section/{slug}", name="section")
     */
    public function sectionAction($slug)
    {
        if ($slug) {
            $section = $this->getDoctrine()->getManager()->getRepository('AppBundle:Category')->findBySlug($slug);

            $employees = $this->getDoctrine()->getManager()->getRepository('AppBundle:Employee')->findByCategory($section);

            return $this->render(':pages:section.html.twig', array('employees' => $employees, 'section' => $section));
        } else {
            return $this->render(':pages:main.html.twig');
        }
    }

    /**
     * @Route("/publications", name="publications")
     */
    public function publicationsAction()
    {
        $publications = $this->getDoctrine()->getManager()->getRepository('AppBundle:Post')->findBy(array(),array('createdAt' => 'DESC'));;

        return $this->render(':pages:publications.html.twig', array('publications' => $publications));
    }

    /**
     * @Route("/publication/{slug}", name="publication")
     */
    public function publicationAction($slug)
    {
        if ($slug) {
            $publication = $this->getDoctrine()->getManager()->getRepository('AppBundle:Post')->findBySlug($slug);

            return $this->render(':pages:publication.html.twig', array('publication' => $publication));
        } else {
            return $this->render(':pages:main.html.twig');
        }
    }

    /**
     * @Route("/rewards", name="rewards")
     */
    public function rewardsAction()
    {
        return $this->render(':pages:rewards.html.twig');
    }

    /**
     * @Route("/appointment_1", name="appointment_1")
     */
    public function appointment1Action()
    {
        return $this->render(':pages:appointment_1.html.twig');
    }

    /**
     * @Route("/appointment_2", name="appointment_2")
     */
    public function appointment2Action()
    {
        return $this->render(':pages:appointment_2.html.twig');
    }

    /**
     * @Route("/appointment_3", name="appointment_3")
     */
    public function appointment3Action()
    {
        return $this->render(':pages:appointment_3.html.twig');
    }

    /**
     * @Route("/appointment_4", name="appointment_4")
     */
    public function appointment4Action()
    {
        return $this->render(':pages:appointment_4.html.twig');
    }

    /**
     * @Route("/contact-form", name="contact-form")
     */
    public function contactFormAction()
    {
        if(isset($_POST['email'])) {
            $email_to = "clinica5.ck.ua@gmail.com";
            $email_subject = "Інтернет-приймальня";
            function died($error) {
                echo 'ПОМИЛКА!<br />';
                echo $error."<br /><br />";
                die();
            }
            if(!isset($_POST['name']) ||
                !isset($_POST['email']) ||
                !isset($_POST['message'])) {
                died('Ваша інфрмація містить помилку!<br />');
            }
            $name = $_POST['name']; // required
            $email_from = $_POST['email']; // required
            $message = $_POST['message']; // required
            $error_message = "";
            $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
            if(!preg_match($email_exp,$email_from)) {
                $error_message .= 'Ваш email не вірний!<br />';
            }
            $string_exp = "/^[A-Za-z .'-]+$/";
            if(!preg_match($string_exp,$name)) {
                $error_message .= 'Ваше Ім\'я містить помилку!<br />';
            }
            if(strlen($message) < 2) {
                $error_message .= 'Ваше повідомлення повинно мати більше 2 символів!<br />';
            }
            if(strlen($error_message) > 0) {
                died($error_message);
            }
            $email_message = "Повідомлення з Інтернет-приймальні.\n";
            function clean_string($string) {
                $bad = array("content-type","bcc:","to:","cc:","href");
                return str_replace($bad,"",$string);
            }
            $email_message .= "Відправник: ".clean_string($name)."\n";
            $email_message .= "Email: ".clean_string($email_from)."\n";
            $email_message .= "Повідомлення:\n ".clean_string($message)."\n";

            $headers = 'From: '.$email_from."\r\n".
                'Reply-To: '.$email_from."\r\n" .
                'X-Mailer: PHP/' . phpversion();
            @mail($email_to, $email_subject, $email_message, $headers);
        }

        return $this->render(':pages:contact-form.html.twig');
    }

    /**
     * @Route("/contacts", name="contacts")
     */
    public function contactsAction()
    {
        return $this->render(':pages:contacts.html.twig');
    }

    /**
     * @Route("/services", name="services")
     */
    public function servicesAction()
    {
        return $this->render(':pages:services.html.twig');
    }

    /**
     * @Route("/budget", name="budget")
     */
    public function budgetAction()
    {
        return $this->render(':pages:budget.html.twig');
    }

    /**
     * @Route("/drugs", name="drugs")
     */
    public function drugsAction()
    {
        return $this->render(':pages:drugs.html.twig');
    }
}
