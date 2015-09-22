<?php

namespace UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

class ProfileFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->remove('current_password')
            ->add('firstName', null, array('label' => 'profile.show.firstName'))
            ->add('lastName', null, array('label' => 'profile.show.lastName'))
            ->add(
                'profilePicture',
                'vich_image',
                array(
                    'label' => 'profile.show.profilePicture',
                    'allow_delete' => true,
                    'download_link' => false
                )
            )
            ->add('current_password', 'password', array(
                'label' => 'form.current_password',
                'translation_domain' => 'FOSUserBundle',
                'mapped' => false,
                'constraints' => new UserPassword(),
            ))
        ;
    }

    public function getName()
    {
        return 'user_profile';
    }
    public function getParent()
    {
        return 'fos_user_profile';
    }
}
