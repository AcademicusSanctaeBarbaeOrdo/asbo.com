<?php

namespace Asbo\Bundle\ContactBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class EnquiryType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('destination', 'choice', array(
                                     'choices' => array('comite' => 'Comité',
                                                         'xxxx' => 'Chancellerie',
                                                         'fsb' => 'Fondation Sainte-Barbe',
                                                         'cavasbo' => 'Comité des Anciens',
                                                        'webmaster' => 'Webmaster'),
                                     'required'  => true));
        $builder->add('name');
        $builder->add('email', 'email');
        $builder->add('subject');
        $builder->add('body', 'textarea');
    }

    public function getName()
    {
        return 'contact';
    }
}
