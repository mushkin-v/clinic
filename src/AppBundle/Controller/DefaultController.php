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
        $publications = $this->getDoctrine()->getManager()->getRepository('AppBundle:Post')->findAll();

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
}
