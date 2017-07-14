<?php
 
namespace Kore\AdminBundle\Validator\Constraints;
 
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
 
class RutValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        $r = strtoupper(str_replace(array(".", "-"), "", $value));
        $sub_rut = substr($r, 0, strlen($r) - 1);
        $sub_dv = substr($r, - 1);
        $x = 2;
        $s = 0;
        for ($i = strlen($sub_rut) - 1; $i >= 0; $i--) {
            if ($x > 7) {
                $x = 2;
            }
            $s += $sub_rut[$i] * $x;
            $x++;
        }
        $dv = 11 - ($s % 11);
        if ($dv == 10) {
            $dv = 'K';
        }
        if ($dv == 11) {
            $dv = '0';
        }
        if ($dv != $sub_dv) {
            $this->context->addViolation($constraint->message, array('%string%' => $value));
        }
    } 
}
