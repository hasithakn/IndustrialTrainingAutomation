<?php
/**
 * Created by PhpStorm.
 * User: acer
 * Date: 12/22/2016
 * Time: 1:21 PM
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Company;
use AppBundle\RepositoryORM;
use AppBundle\Entity\Trainee;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;


class AdminController extends Controller
{

    /**
     * @Route("/admin", name="admin")
     */
    public function adminAction()
    {
        // return $this->render('admin/indexTrainees.html.twig', array('trainees' => $trainee));
        return $this->redirectToRoute(('admin_home'));

    }

    /**
     * @Route("/admin/company", name="admin_company_index")
     */
    public function indexCompanyAction()
    {
        $company = new Company();
        $em = $this->getDoctrine()->getManager();
        $company = $em->getRepository('AppBundle:Company')->findAll();
        //var_dump($test2);
        //exit();
        return $this->render('admin/indexCompany.html.twig', array('company' => $company));

    }

    /**
     * @Route("/admin/trainee", name="admin_trainee_index")
     */
    public function indexTraineeAction()
    {
        $trainee = new Trainee();
        $em = $this->getDoctrine()->getManager();
        $trainee = $em->getRepository('AppBundle:Trainee')->findAll();
        //var_dump($test2);
        //exit();
        return $this->render('admin/indexTrainees.html.twig', array('trainees' => $trainee));

    }

    /**
     * @Route("/admin/company/viewAppliedTrainees/{id}", name="admin_company_viewAppliedTrainees")
     */

    public function viewAppliedTraineesAction($id)
    {
        $company = new Company();
        $em = $this->getDoctrine()->getManager();
        $company = $em->getRepository('AppBundle:Company')->find($id);
        $traineeRepo = $em->getRepository('AppBundle:Trainee');
        $traineeList = $traineeRepo->getGPATraineeList($company);
        $traineeList2 = $traineeRepo->getLuckListTraineeList($company);

//        foreach ($traineeList as $ab)
//        {
//            var_dump($ab->getId());
//        }

//        var_dump($traineeList);
//        var_dump($traineeList2);
        return $this->render('admin/viewAppliedTrainees.html.twig', array('traineeList' => $traineeList, 'company' => $company, 'luckList' => $traineeList2));
        //var_dump($traineeList);
        //exit();
        //  return $this->render('admin/indexCompany.html.twig', array('company' => $company));

    }

    /**
     * @Route("/admin/autoSelect/{id}", name="autoSelect")
     */

    public function autoSelect($id)
    {
        $company = new Company();
        $em = $this->getDoctrine()->getManager();
        $company = $em->getRepository('AppBundle:Company')->find($id);

        $traineeRepo = $em->getRepository('AppBundle:Trainee');
        $gpaList = $traineeRepo->getGPATraineeList($company);
        $luckList = $traineeRepo->getLuckListTraineeList($company);

        $selectedList = [];
        $k = 0;
        while (sizeof($selectedList) < $company->getNoOfTrainees()) {
            if (sizeof($gpaList) > $k && $gpaList[$k] != null) {
                $trainee = $em->getRepository('AppBundle:Trainee')->find($gpaList[$k]->getId());
                if ($trainee->getSelectedCompany() == null) {
                    $gpaList[$k]->setSelectedCompany($company);
                    array_push($selectedList, $gpaList[$k]);
                }

            }
            if (sizeof($selectedList) >= $company->getNoOfTrainees()) {
                break;
            }
            if (sizeof($luckList) > $k && $luckList[$k] != null) {
                $trainee = $em->getRepository('AppBundle:Trainee')->find($luckList[$k]->getId());
                if ($trainee->getSelectedCompany() == null) {
                    $luckList[$k]->setSelectedCompany($company);
                    array_push($selectedList, $luckList[$k]);
                }

            }
            $k++;
        }

//        for ($k = 0; $k < $company->getNoOfTrainees(); $k++) {
//            // var_dump($gpaList[$k]);
//
//
//        }
        foreach ($selectedList as $slt) {
            $em->persist($slt);
            $em->flush();
        }


        //  return $this->render('default/edit.html.twig', array(
        //    'form' => $form->createView(),
        // ));
        return $this->redirectToRoute('admin_company_viewAppliedTrainees', array('id' => $id));
        //die('done');
//        return $this->render('admin/viewAppliedTrainees.html.twig', array('traineeList' => $traineeList, 'company' => $company, 'luckList' => $traineeList2));
        //  return $this->render('admin/indexCompany.html.twig', array('company' => $company));
    }

    /**
     * @Route("/admin/home", name="admin_home")
     */
    public function tAction()
    {
        return $this->render('admin/home.html.twig');
    }

    /**
     * @Route("/admin/resetSelectedCompanies", name="admin_reset")
     */
    public function resetAction()
    {
        $trainee = new Trainee();
        $em = $this->getDoctrine()->getManager();
        $trainee = $em->getRepository('AppBundle:Trainee')->findAll();
        //var_dump($test2);
        foreach ($trainee as $t) {
            $t->setSelectedCompany(null);
            $em->persist($t);
            $em->flush();
        }
        return $this->render('admin/home.html.twig');
        //exit();
        //return $this->render('admin/indexTrainees.html.twig', array('trainees' => $trainee));

    }
}