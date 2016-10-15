<?php

namespace CodeEmailMKT\Application\InputFilter;

use Zend\Filter\StringTrim;
use Zend\InputFilter\InputFilter;
use Zend\Validator\EmailAddress;
use Zend\Validator\NotEmpty;

class LoginInputFilter extends InputFilter
{
    public function __construct()
    {
        $this->add([
            'name' => 'email',
            'required' => true,
            'filters' => [
                ['name' => StringTrim::class]
            ],
            'validators' => [
                [
                    'name' => NotEmpty::class,
                    'break_chain_on_failure' => true,
                    'options' => [
                        'messages' => [
                            NotEmpty::IS_EMPTY => "Este campo é obrigatório"
                        ]
                    ]
                ],
                [
                    'name' => EmailAddress::class,
                    'options' => [
                        'messages' => [
                            EmailAddress::INVALID => "O email informado é inválido",
                            EmailAddress::INVALID_FORMAT => "Seu email deve estar no formato nome@exemplo.com"
                        ]
                    ]
                ]
            ]
        ]);

        $this->add([
            'name' => 'password',
            'required' => true,
            'validators' => [
                [
                    'name' => NotEmpty::class,
                    'options' => [
                        'messages' => [
                            NotEmpty::IS_EMPTY => "Este campo é obrigatório"
                        ]
                    ]
                ]
            ]
        ]);
    }

}