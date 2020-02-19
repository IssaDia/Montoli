<?php

namespace App\Controller;

use App\Entity\Contact;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class MainController extends Controller
{
    /**
     * @Route("/home", name="home")
     */
    public function home()
    {
        return $this->render('pages/home.html.twig');
    }

    /**
     * @Route("/mission", name="mission")
     */
    public function mission()
    {
        return $this->render('pages/mission.html.twig');
    }

    /**
     * @Route("/visions", name="vision")
     */
    public function vision()
    {
        return $this->render('pages/visions.html.twig');
    }

    /**
     * @Route("/collaborations", name="collaborations")
     */
    public function collaboration()
    {
        return $this->render('pages/collaborations.html.twig');
    }

    /**
     * @Route("/expertise", name="expertise")
     */
    public function expertise()
    {
        return $this->render('pages/expertise.html.twig');
    }

    /**
     * @Route("/competences", name="competence")
     */
    public function competence()
    {
        return $this->render('pages/competences.html.twig');
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function formContact(Request $request, EntityManagerInterface $manager)
    {
        $contact = new Contact();
        $form = $this->createFormBuilder($contact)
                     ->add('nom',TextType::class, [
                         'attr'=> [
                            'placeholder' => 'votre nom',
                            'class'=>'form-control']
                     ])
                     ->add('email',TextType::class, [
                        'attr'=> [
                            'placeholder' => 'votre email',
                            'class'=>'form-control']
                    ])
                     ->add('sujet', TextType::class, [
                        'attr'=> [
                            'placeholder' => 'votre sujet',
                            'class'=>'form-control']
                    ])
                     ->add('message',TextareaType::class, [
                        'attr'=> [
                            'placeholder' => 'votre message',
                            'class'=>'form-control']
                    ])
                     ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
           
            $manager->persist($contact);    
            $manager->flush();
    
            return $this->redirectToRoute('home');
    
            }

        return $this->render('pages/contact.html.twig', [
            'form'=>$form->createView()
        ]);
    }

    

}