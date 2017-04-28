<?php

namespace AppBundle\Controller;

use  Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Trainee;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/a", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        $trainee = new Trainee();
        $form = $this->createFormBuilder($trainee)
            ->add('name', TextType::class)
            ->add('address', TextType::class)
            ->add('Age', IntegerType::class)
            ->add('Email', TextType::class)
            ->add('Gender', TextType::class)
            ->add('GPA', TextType::class)
            ->add('Mobile', TextType::class)
            ->add('Submit', SubmitType::class, array('label' => 'Submit'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $form->getData();
            $trainee = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $em = $this->getDoctrine()->getManager();
            $em->persist($trainee);
            $em->flush();

            //  return $this->render('default/edit.html.twig', array(
            //    'form' => $form->createView(),
            // ));
            return $this->redirectToRoute('edit', array('id' => $trainee->getId()));
            // return $this->redirect("{{url('edit')}},'1'");
            // return $this->redirect('http://symfony.com/doc');
        }

        return $this->render('default/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/edit/{id}", name="edit")
     */
    public function editAction(Request $request, $id)
    {
        // replace this example code with whatever you need
        $trainee = new Trainee();
        $em = $this->getDoctrine()->getManager();
        $trainee = $em->getRepository('AppBundle:Trainee')->find($id);
        if (!$trainee) {
            throw $this->createNotFoundException(
                'No product found for id ' . $id
            );
        }

        //$test2->setName('New product name!');
        //$em->flush();
        // return $this->redirectToRoute('homepage');
        $form = $this->createFormBuilder($trainee)
            ->add('name', TextType::class)
            ->add('address', TextType::class)
            ->add('Age', IntegerType::class)
            ->add('Email', TextType::class)
            ->add('Gender', TextType::class)
            ->add('GPA', TextType::class)
            ->add('Mobile', TextType::class)
            ->add('Submit', SubmitType::class, array('label' => 'Update'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $form->getData();
            $trainee = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            //  $em->persist($test2);
            $em->flush();
            return $this->redirectToRoute('view', array('id' => $trainee->getId()));
           // return new Response('Updated new product with id ' . $test2->getId());
            // return $this->redirect('http://symfony.com/doc');
        }

        return $this->render('default/edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/view/{id}", name="view")
     */
    public function viewAction(Request $request, $id)
    {
        // replace this example code with whatever you need
        $trainee = new Trainee();
        $em = $this->getDoctrine()->getManager();
        $trainee = $em->getRepository('AppBundle:Trainee')->find($id);
        if (!$trainee) {
            throw $this->createNotFoundException(
                'No product found for id ' . $id
            );
        }

        //$test2->setName('New product name!');
        //$em->flush();
        // return $this->redirectToRoute('homepage');
        $form = $this->createFormBuilder($trainee)
            ->add('name', TextType::class)
            ->add('address', TextType::class)
            ->add('Age', IntegerType::class)
            ->add('Email', TextType::class)
            ->add('Gender', TextType::class)
            ->add('GPA', TextType::class)
            ->add('Mobile', TextType::class)
            //->add('Submit', SubmitType::class, array('label' => 'Update'))
            ->getForm();

        $form->handleRequest($request);

       // var_dump($test2);
       // exit();();
        return $this->render('default/view.html.twig', array(
            'form' => $form->createView(),
        ));
    }


}
