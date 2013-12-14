<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\WhosWhoBundle\Form\Type;

use Asbo\Bundle\WhosWhoBundle\Form\EventListener\PrincipalResourceListener;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Asbo\Bundle\WhosWhoBundle\Model\Types\PhoneTypes;

/**
 * Phone form type.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class PhoneType extends AbstractType
{
    /**
     * Fully qualified class name.
     *
     * @var string
     */
    private $class;

    /**
     * The event dispatcher.
     *
     * @var EventDispatcherInterface
     */
    protected $dispatcher = null;

    /**
     * Constructor.
     *
     * @param string                   $class      The Phone class name
     * @param EventDispatcherInterface $dispatcher
     */
    public function __construct($class, EventDispatcherInterface $dispatcher)
    {
        $this->class = $class;
        $this->dispatcher = $dispatcher;
    }

    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('number')
            ->add('type', 'choice',
                [
                    'choices' => PhoneTypes::getChoices(),
                ]
            )
            ->add('country', 'country',
                [
                    'preferred_choices' => ['BE', 'FR'],
                ]
            )
        ;

        $builder->addEventSubscriber(new PrincipalResourceListener('phone', $this->dispatcher));
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => $this->class,
            ]
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'asbo_whoswho_phone';
    }
}
