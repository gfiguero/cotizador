<?php 
 
namespace Kore\AdminBundle\Validator\Constraints;
 
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Exception\MissingOptionsException;

class Rut extends Constraint
{
    public $message = 'Este valor no es un RUT válido.';

    public function __construct($options = null)
    {
        parent::__construct($options);
    }
}