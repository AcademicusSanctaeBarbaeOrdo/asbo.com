<?php

namespace spec\Asbo\Bundle\QuizzBundle\Model;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class QuizzTypesSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Asbo\Bundle\QuizzBundle\Model\QuizzTypes');
    }

    function it_return_array_of_choices()
    {
        $this
            ->getChoices()
            ->shouldBeArray()
        ;

        $this
            ->getChoices()
            ->shouldHaveKeys(array('optional', 'required'))
        ;
    }

    function it_returns_the_array_keys()
    {
        self::getCallBackValidation()->shouldBeArray();
        self::getCallBackValidation()->shouldHaveValues(['optional', 'required']);
    }

    function it_returns_a_Validity_of_a_value()
    {
        self::isValid('optional')->shouldReturn(true);
        self::isValid('required')->shouldReturn(true);
        self::isValid(uniqid())->shouldReturn(false);
    }

    public function getMatchers()
    {
        return [
            'haveKey' => function($subject, $key) {
                    return array_key_exists($key, $subject);
                },
            'haveKeys' => function($subject, $keys) {
                    foreach ($keys as $key) {
                        if (!array_key_exists($key, $subject)) {
                            return false;
                        }
                    }

                    return true;
                },
            'haveValues' => function($subject, $values) {

                    foreach ($values as $value) {
                        if (!in_array($value, $subject)) {
                            return false;
                        }
                    }

                    return true;
                },
        ];
    }
}
