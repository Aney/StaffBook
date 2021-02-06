<?php

namespace App\Form;

use App\Entity\Staff;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class StaffType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

	// need to convert DOB into text to disply
	$builder
		->add('firstname', TextType::class)
		->add('lastname', TextType::class)
		->add('dob', TextType::class, [
			'attr' => [
				'placeholder' => 'DD/MM/YY'
			]
		])
		->add('email', TextType::class)
		->add('submit',SubmitType::class)
        ;

	// need to convert DOB from text to date to store
	$builder
		->get('dob')
	;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Staff::class,
        ]);
    }
}
