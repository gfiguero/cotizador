<?php

namespace Kore\AdminBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ExisteRutValidator extends ConstraintValidator
{
    protected $em;

    function __construct($em) {
        $this->em = $em;
    }

    public function validate($value, Constraint $constraint)
    {
        $persona = $this->em->getRepository('Kore\AdminBundle\Entity\Persona')->findByRut($value);

        if (!$persona) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ string }}', $value)
                ->addViolation();
        }
    }
}