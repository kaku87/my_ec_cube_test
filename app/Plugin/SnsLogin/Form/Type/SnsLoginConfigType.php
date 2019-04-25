<?php

/*
 * This file is part of the SnsLogin
 *
 * Copyright (C) 2018 kaku
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\SnsLogin\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class SnsLoginConfigType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('key', 'text', array(
                'label' => 'APP KEY',
                'required' => true,
                'constraints' => array(
                    new Assert\NotBlank(),
                ),
            ))
            ->add('secret', 'text', array(
                'label' => 'APP SECRET',
                'required' => true,
                'constraints' => array(
                    new Assert\NotBlank(),
                ),
            ));
    }

    public function getName()
    {
        return 'snslogin_config';
    }

}
