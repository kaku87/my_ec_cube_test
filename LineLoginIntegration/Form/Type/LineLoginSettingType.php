<?php

namespace Plugin\LineLoginIntegration\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

class LineLoginSettingType extends AbstractType
{

    private $app;

    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $config = $this->app['config'];
        $builder
                ->add('line_channel_id', 'text', array(
                    'label' => 'line_channel_id',
                    'required' => false,
                    'constraints' => array(
                        new Assert\Length(array('max' => $config['stext_len'])),
                    ),
                ))
                ->add('line_channel_secret', 'text', array(
                    'label' => 'line_channel_secret',
                    'required' => false,
                    'constraints' => array(
                        new Assert\Length(array('max' => $config['stext_len'])),
                    ),
                ))
                ->addEventSubscriber(new \Eccube\Event\FormEventSubscriber());
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'line_setting';
    }
}
