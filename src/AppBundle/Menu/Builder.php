<?php

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;

class Builder
{
    public function createSideMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root')
            ->setChildrenAttributes(array('class' => 'nav', 'id' => 'side-menu'));


        $menu->addChild('Dashboard', array(
            'icon' => 'dashboard',
            'route' => 'homepage',
        ));

        return $menu;
    }

    public function createRightMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root')
            ->setChildrenAttribute('class', 'nav navbar-top-links navbar-right');

        $userMenu = $menu->addChild('', array(
            'icon' => 'user',
            'dropdown' => true,
            'caret' => true
        ));

        $userMenu->addChild('Profile', array(
            'icon' => 'user',
            'route' => 'fos_user_profile_show'
        ));

        $userMenu->addChild('Change Password', array(
            'icon' => 'cogs',
            'route' => 'fos_user_change_password'
        ));

        $userMenu->addChild('', array(
            'divider' => true
        ));

        $userMenu->addChild('Logout', array(
            'icon' => 'sign-out',
            'route' => 'fos_user_security_logout',
        ));

        return $menu;
    }
}
