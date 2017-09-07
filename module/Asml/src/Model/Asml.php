<?php

namespace Asml\Model;

use DomainException;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Filter\ToInt;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\StringLength;

class Asml implements InputFilterAwareInterface
{

    private $inputFilter;

    public function exchangeArray(array $data)
    {
    }

}
