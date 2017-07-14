<?php

namespace Kore\AdminBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ExisteRut extends Constraint
{
    public $message = 'El Rut {{ string }} no está registrado.';
}