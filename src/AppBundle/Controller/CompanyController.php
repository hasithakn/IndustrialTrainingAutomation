<?php
/**
 * Created by PhpStorm.
 * User: acer
 * Date: 12/22/2016
 * Time: 10:21 AM
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Company;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use  Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;

class CompanyController extends Controller
{
    /**
     * @Route("/company/create", name="company_create")
     */
    public function createAction(Request $request)
    {
        $company = new Company();
        $form = $this->createFormBuilder($company)
            ->add('name', TextType::class, array('label' => 'Name', 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:5px')))
            ->add('noOfTrainees', IntegerType::class, array('label' => 'No of Trainees', 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:5px')))
            ->add('address', TextType::class, array('label' => 'Address', 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:5px')))
            ->add('contactNo', TextType::class, array('label' => 'Contact', 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:5px')))
            ->add('email', TextType::class, array('label' => 'Email', 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:5px')))
            ->add('discription', TextareaType::class, array('label' => 'Description', 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:5px')))
            ->add('Submit', SubmitType::class, array('label' => 'Create', 'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-bottom:5px')))
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $form->getData();
            $company = $form->getData();

            // ..ljh. perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $em = $this->getDoctrine()->getManager();
            $em->persist($company);
            $em->flush();

            //  return $this->render('default/edit.html.twig', array(
            //    'form' => $form->createView(),
            // ));
            return $this->redirectToRoute('company_view', array('id' => $company->getId()));
            // var_dump($company);
            // exit();
            //die('done');
            // return $this->redirectToRoute(('todo_index'));
            // return $this->redirect("{{url('edit')}},'1'");
            // return $this->redirect('http://symfony.com/doc');
        }
        return $this->render('company/create.html.twig', array(
            'form' => $form->createView()));
    }

    /**
     * @Route("/company/edit/{id}", name="company_edit")
     */
    public function editAction($id, Request $request)
    {
        $company = new Company();
        $em = $this->getDoctrine()->getManager();
        $company = $em->getRepository('AppBundle:Company')->find($id);
       // var_dump($company);
        //exit();
        $form = $this->createFormBuilder($company)
            ->add('name', TextType::class, array('label' => 'Name', 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:5px')))
            ->add('noOfTrainees', IntegerType::class, array('label' => 'No of Trainees', 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:5px')))
            ->add('address', TextType::class, array('label' => 'Address', 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:5px')))
            ->add('contactNo', TextType::class, array('label' => 'Contact', 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:5px')))
            ->add('email', TextType::class, array('label' => 'Email', 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:5px')))
            ->add('discription', TextareaType::class, array('label' => 'Description', 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:5px')))
            ->add('Submit', SubmitType::class, array('label' => 'Update', 'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-bottom:5px')))
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $form->getData();
            $company = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            // $em = $this->getDoctrine()->getManager();
            $em->persist($company);
            $em->flush();

            //  return $this->render('default/edit.html.twig', array(
            //    'form' => $form->createView(),
            // ));
            //return $this->redirectToRoute('edit', array('id' => $test2->getId()));
            //die('done');
            return $this->redirectToRoute('company_view', array('id' => $company->getId()));
            // return $this->redirect("{{url('edit')}},'1'");
            // return $this->redirect('http://symfony.com/doc');
        }
        return $this->render('company/edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    /**
     * @Route("/company", name="company_index")
     */
    public function indexAction()
    {
        $company = new Company();
        $em = $this->getDoctrine()->getManager();
        $company = $em->getRepository('AppBundle:Company')->findAll();
        //var_dump($test2);
        //exit();
        return $this->render('company/index.html.twig', array('company' => $company));

    }
    /**
     * @Route("/company/view/{id}", name="company_view")
     */
    public function viewAction($id)
    {
        $company = new Company();
        $em = $this->getDoctrine()->getManager();
        $company = $em->getRepository('AppBundle:Company')->find($id);
        //var_dump($test2);
        //exit();
        return $this->render('company/view.html.twig', array('company' => $company));

    }
    /**
     * @Route("/company/delete/{id}", name="company_delete")
     */
    public function deleteAction($id)
    {
        $company = new Company();
        $em = $this->getDoctrine()->getManager();
        $company = $em->getRepository('AppBundle:Company')->find($id);
        //var_dump($test2);
        //exit();
        $em->remove($company);
        $em->flush();
        return $this->redirectToRoute(('company_index'));

    }
}