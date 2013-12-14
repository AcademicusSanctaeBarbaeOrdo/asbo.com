<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\MigrationBundle\Schema;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class AbstractSchema
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
abstract class AbstractSchema
{
    /**
     * @var array
     */
    protected $data;

    /**
     * Constructor.
     *
     * @param OptionsResolverInterface $resolver
     * @param array                    $data
     */
    public function __construct(OptionsResolverInterface $resolver, array $data = array())
    {
        $this->setSchema($resolver);
        $this->setNormalizers($resolver);
        $this->setAllowedTypes($resolver);
        $this->setAllowedValues($resolver);
        $this->data = $resolver->resolve($data);
    }

    /**
     * Set the schema of entity
     *
     * @param  OptionsResolverInterface $options
     * @return mixed
     */
    abstract protected function setSchema(OptionsResolverInterface $options);

    protected function setNormalizers(OptionsResolverInterface $resolver)
    {

    }

    protected function setAllowedTypes(OptionsResolverInterface $resolver)
    {

    }

    protected function setAllowedValues(OptionsResolverInterface $resolver)
    {

    }

    public function getData()
    {
        return $this->data;
    }
}
