<?php 
namespace App\Form;

use App\Entity\Staff;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Validator\Constraints;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Constraints\DateValidator;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

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
				'placeholder' => 'DD / MM / YY',
				'maxlength' => 8,
			],
			'constraints' => [
				new NotBlank(),
				new Constraints\Callback(function($object, ExecutionContextInterface $context) {
					if (!is_a($object, \DateTime::class)) {
						$context
							->buildViolation('must be a date')
							->addViolation();
						}
					}),
			],
			'invalid_message' => 'Format your date DD/MM/YY'
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

	private function isDate($string) {
	    $matches = array();
	    $pattern = '/^([0-9]{1,2})\\/([0-9]{1,2})\\/([0-9]{4})$/';
	    if (!preg_match($pattern, $string, $matches)) return false;
	    if (!checkdate($matches[2], $matches[1], $matches[3])) return false;
	    return true;
	}
}
