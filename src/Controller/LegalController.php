<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LegalController extends AbstractController
{
    /**
     * @Route("/legal/privacy_policy", name="privacy")
     */
    public function privacy()
    {
        return $this->render('pages/legal/privacy.html.twig', [
        ]);
    }

    /**
     * @Route("/legal/Terms_and_conditions", name="terms")
     */
    public function terms()
    {
        return $this->render('pages/legal/terms.html.twig', [
        ]);
    }
}
