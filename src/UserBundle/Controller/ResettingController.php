<?php

namespace UserBundle\Controller;

use FOS\UserBundle\Controller\ResettingController as BaseResettingController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ResettingController extends BaseResettingController
{
    /**
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function checkEmailAction(Request $request)
    {
        $email = $request->query->get('email');

        if (empty($email)) {
            // the user does not come from the sendEmail action
            return new RedirectResponse($this->generateUrl('fos_user_resetting_request'));
        }

        $emailParts = explode('@', $email);
        $url = filter_var('http://'.$emailParts[1], FILTER_SANITIZE_URL);
        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            $url = null;
        }

        return $this->render(
            'FOSUserBundle:Resetting:checkEmail.html.twig',
            array(
                'email' => $email,
                'providerUrl' => $url
            )
        );
    }
}
