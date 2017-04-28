<?php
/**
 * Created by PhpStorm.
 * User: acer
 * Date: 12/21/2016
 * Time: 9:06 AM
 */
namespace AppBundle\Controller;

use AppBundle\Entity\Company;
use Doctrine\DBAL\Types\FloatType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use  Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Trainee;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Request;

class ToDoContoller extends Controller
{
    /**
     * @Route("/todo", name="todo_index")
     */
    public function todoAction()
    {
        $trainee = new Trainee();
        $em = $this->getDoctrine()->getManager();
        $trainee = $em->getRepository('AppBundle:Trainee')->findAll();
        //var_dump($trainee);
        //exit();
        return $this->render('todo/todo.html.twig', array('trainees' => $trainee));
    }

    /**
     * @Route("/todo/create", name="todo_create")
     */
    public function createAction(Request $request)
    {
        $trainee1 = new Trainee();
        // exit();

        $form = $this->createFormBuilder($trainee1)
            ->add('name', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:5px')))
            ->add('address', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:5px')))
            ->add('Age', IntegerType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:5px')))
            ->add('Email', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:5px')))
            ->add('Gender', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:5px')))
            ->add('Gpa', TextType::class, array('label' => 'GPA', 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:5px')))
            ->add('Mobile', TextType::class, array('label' => 'Mobile', 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:5px')))
            ->add('gpaCompany', null, array('label' => 'GPA Company', 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:5px')))
            ->add('luckListCompany', null, array('label' => 'Luck List Company', 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:5px')))
            ->add('Submit', SubmitType::class, array('label' => 'Create', 'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-bottom:5px')))
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $luckNo = $random = random_int(1, 300);
            //var_dump($luckNo);
            $trainee = $em->getRepository('AppBundle:Trainee')->findOneBy(array("luckNo" => $luckNo));
            //var_dump($trainee);
            while ($trainee != null) {
                $luckNo = $random = random_int(1, 300);
                //var_dump($luckNo);
                $trainee = $em->getRepository('AppBundle:Trainee')->findOneBy(array("luckNo" => $luckNo));
            }
            var_dump($luckNo);
            $trainee1->setLuckNo($luckNo);
            //var_dump($trainee1);

            $form->getData();
            $trainee1 = $form->getData();
            //var_dump($trainee1);
            //exit();
            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $em = $this->getDoctrine()->getManager();
            $em->persist($trainee1);
            $em->flush();

            //  return $this->render('default/edit.html.twig', array(
            //    'form' => $form->createView(),
            // ));
            return $this->redirectToRoute('todo_view', array('id' => $trainee1->getId()));
            //die('done');
            // return $this->redirectToRoute(('todo_index'));
            // return $this->redirect("{{url('edit')}},'1'");
            // return $this->redirect('http://symfony.com/doc');
        }
        return $this->render('todo/create.html.twig', array(
            'form' => $form->createView()));
    }

    /**
     * @Route("/todo/edit/{id}", name="todo_edit")
     */
    public function editAction($id, Request $request)
    {
        $trainee = new Trainee();
        $em = $this->getDoctrine()->getManager();
        $trainee = $em->getRepository('AppBundle:Trainee')->find($id);
        //var_dump($trainee);
        //exit();
        $form = $this->createFormBuilder($trainee)
            ->add('name', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:5px')))
            ->add('address', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:5px')))
            ->add('Age', IntegerType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:5px')))
            ->add('Email', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:5px')))
            ->add('Gender', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:5px')))
            ->add('Gpa', TextType::class, array('label' => 'GPA', 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:5px')))
            ->add('Mobile', TextType::class, array('label' => 'Mobile', 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:5px')))
            ->add('gpaCompany', null, array('label' => 'GPA Company', 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:5px')))
            ->add('luckListCompany', null, array('label' => 'Luck List Company', 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:5px')))
            ->add('Submit', SubmitType::class, array('label' => 'Update', 'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-bottom:5px')))
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $form->getData();
            $trainee = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            // $em = $this->getDoctrine()->getManager();
            $em->persist($trainee);
            $em->flush();

            //  return $this->render('default/edit.html.twig', array(
            //    'form' => $form->createView(),
            // ));
            //return $this->redirectToRoute('edit', array('id' => $test2->getId()));
            //die('done');
            return $this->redirectToRoute('todo_view', array('id' => $trainee->getId()));
            // return $this->redirect("{{url('edit')}},'1'");
            // return $this->redirect('http://symfony.com/doc');
        }
        return $this->render('todo/edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/todo/view/{id}", name="todo_view")
     */
    public function viewAction($id)
    {
        $trainee = new Trainee();
        $em = $this->getDoctrine()->getManager();
        $trainee = $em->getRepository('AppBundle:Trainee')->find($id);
        //var_dump($test2);
        //exit();
        return $this->render('todo/view.html.twig', array('trainees' => $trainee));
    }

    /**
     * @Route("/todo/delete/{id}", name="todo_delete")
     */
    public function deleteAction($id)
    {
        $trainee = new Trainee();
        $em = $this->getDoctrine()->getManager();
        $trainee = $em->getRepository('AppBundle:Trainee')->find($id);
        //var_dump($test2);
        //exit();
        $em->remove($trainee);
        $em->flush();
        return $this->redirectToRoute(('todo_index'));

    }
}