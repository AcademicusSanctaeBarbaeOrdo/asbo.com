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

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Asbo\Bundle\WhosWhoBundle\Util\AnnoManipulator;
use Asbo\Bundle\WhosWhoBundle\Form\EventListener\EditFraListener;
use Asbo\Bundle\WhosWhoBundle\Model\Types\FraTypes;
use Asbo\Bundle\WhosWhoBundle\Model\Status\FraStatus;

/**
 * Fra form type.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class FraType extends AbstractType
{
    /**
     * Fully qualified class name.
     *
     * @var string
     */
    private $class;

    /**
     * Constructor.
     *
     * @param string $class The Fra class name
     */
    public function __construct($class)
    {
        $this->class = $class;
    }

    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname')
            ->add('lastname')
            ->add('nickname')
            ->add('gender', 'choice',
                [
                    'choices' =>
                        [
                            'm' => 'Homme',
                            'f' => 'Femme',
                        ],
                ]
            )
            ->add('birthday', 'birthday')
            ->add('birthplace')
            ->add('type', 'choice', [
                    'choices' => FraTypes::getChoices(),
                ]
            )
            ->add('status', 'choice', [
                    'choices' => FraStatus::getChoices(),
                ]
            )
            ->add('anno', 'choice', [
                    'choices' => AnnoManipulator::getAnnos(),
                ]
            )
            ->add('pontif', 'checkbox',
                [
                    'required' => false,
                ]
            )
        ;

        $builder->addEventSubscriber(new EditFraListener());
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            [
                'cascade_validation' => true,
                'data_class' => $this->class,
            ]
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'asbo_whoswho_fra';
    }
}
