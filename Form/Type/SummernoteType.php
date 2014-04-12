<?php

namespace Solilokiam\SummernoteBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SummernoteType extends AbstractType
{
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {

    }

    public function getParent()
    {
        return 'textarea';
    }

    public function getName()
    {
        return 'summernote';
    }
} 