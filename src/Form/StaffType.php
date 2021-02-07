<?php 
namespace App\Form;

use App\Entity\Staff;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Constraints\DateValidator;

class StaffType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
	$builder
		->add('firstname', TextType::class)
		->add('lastname', TextType::class)
		->add('dob', DateType::class, [
			'widget' => 'single_text',
			'html5' => false,
			'format' => 'dd/MM/yy',
			'attr' => [
				'placeholder' => 'DD/MM/YY',
				'maxlength' => 8,
			],
			'constraints' => [
				new NotBlank(),
				new Type(\DateTime::class),
			]
		])
		->add('email', TextType::class)
		->add('submit',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Staff::class,
	    'attr' => ['id' => 'staffType']
        ]);
    }
}
