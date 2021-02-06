<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Staff;
use App\Form\StaffType;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/hellouser", name="HelloUser")
     */
    public function helloUser(Request $request){

	// Create a new member of staff
	$staff = new Staff(); // New object based off the Staff entity
//		$staff->setFirstname("mr2");
//		$staff->setLastname("epic");
//		$staff->setDob(\DateTime::createFromFormat('Y-m-d', "2008-02-01"));
//		$staff->setemail("email");

	// Form
	$form = $this->createForm(StaffType::class, $staff, [
			'action' => $this->generateURL('HelloUser'),
			'method' => 'POST',
		]);

	// Convert the text into date

	// Create Entity Manager
	$em = $this->getDoctrine()->getManager();

	// Handle Request
	$form->handleRequest($request);

	if ($form->isSubmitted() && $form->isValid()){
		// Testing
		var_dump($staff); die;

		// Creates/Builds the to add staff SQL
		$em->persist($staff); // Insert

		// Execute the SQL with flush
		$em->flush(); 
	}

	
	// Returns the Staff Entities stored in the DB
	$getAllStaff = $em->getRepository(Staff::class)
		   ->findAll();

	return $this->render('home/hello.html.twig', [
		'staff'			=> $getAllStaff,
		'form'			=> $form->createView(),
		'controller_name' 	=> 'HomeController',
    	]);
    }
}
