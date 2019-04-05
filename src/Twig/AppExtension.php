<?php
/**
 * AppExtension.php
 *
 * guns-product-id is a microservice for querying POS systems, pulling down
 * the data and mapping it to a usable JSON array for use with the products
 * microservice.
 *
 * Copyright 2019 Guns.com, All rights reserved.
 * ---------------------------
 * Date: 2019-03-19
 * Url: http://guns.com
 */

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\Users;

/**
 * Class AppExtension
 * @package App\Twig
 */
class AppExtension extends AbstractExtension
{
    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    public function _breadcrumbs()
    {
        $request = $this->requestStack->getCurrentRequest();

        $link = '/';
        $breadcrumbs = array();
        $path = array_filter(explode('/', parse_url($request->getRequestUri(), PHP_URL_PATH)));

        if (count($path) > 0) {
            if (!(count($path) == 1 && $path[1] == "dashboard")) {
                $breadcrumbs[] = '<li class="breadcrumb-item"><a href="/">Home</a></li>';
                $last = end($path);
                foreach ($path AS $x => $crumb) {
                    $title = ucwords(str_replace(Array('.php', '_'), Array('', ' '), $crumb));
                    $title = (strtolower($crumb) == 'ffl') ? strtoupper($crumb) : ucfirst($crumb);

                    $link .= $crumb;
                    if ($crumb != $last) {
                        $breadcrumbs[] = '<li class="breadcrumb-item"><a href="' . $link . '">' . $title . '</a></li>';
                    } else {
                        $breadcrumbs[] = '<li class="breadcrumb-item active" aria-current="page"><a href="' . $link . '">' . $title . '</a></li>';
                    }
                    $link .= '/';
                }
            } else {
                $breadcrumbs[] = '<li class="breadcrumb-item active" aria-current="page">Home</li>';
            }
        } else {
            $breadcrumbs[] = '<li class="breadcrumb-item active" aria-current="page">Home</li>';
        }

        return $breadcrumbs;
    }

    public function _getUser(UserInterface $user)
    {
        $userDb = $this->getDoctrine()
            ->getRepository(Users::class)
            ->findOneBy(['email' => $user->getUsername()]);
        $username = $userDb->getFirstName() . " " . $userDb->getLastName();
        return "Tim Hinz";
    }

    public function getFunctions()
    {
        return array(
            new \Twig\TwigFunction('breadcrumbs', array($this, '_breadcrumbs'))
        );
    }
}