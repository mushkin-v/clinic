<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
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

            return $this->render(':pages:section.html.twig', array('employees' => $employees));

        } else {

            return $this->render(':pages:main.html.twig');
        }
    }

    /**
     * @Route("/publications", name="publications")
     */
    public function publicationsAction()
    {
        return $this->render(':pages:publications.html.twig');
    }

    /**
     * @Route("/rewards", name="rewards")
     */
    public function rewardsAction()
    {
        return $this->render(':pages:rewards.html.twig');
    }

    /**
     * @Route("/appointment", name="appointment")
     */
    public function appointmentAction()
    {
        return $this->render(':pages:appointment.html.twig');
    }

    /**
     * @Route("/contacts", name="contacts")
     */
    public function contactsAction()
    {
        return $this->render(':pages:contacts.html.twig');
    }




}
