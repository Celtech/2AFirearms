<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;

class UserProfileController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/profile/{id}", name="profile")
     */
    public function index($id)
    {
        $profile = $this->entityManager->getRepository(User::class)->find($id);
        return $this->render('pages/profile/index.html.twig', [
            'profile' => $profile,
        ]);
    }

    /**
     * @Route("/profile/edit/{id}", name="profile_edit")
     */
    public function edit($id)
    {
        $profile = $this->entityManager->getRepository(User::class)->find($id);
        $currentUser = $this->getUser();

        if (isset($currentUser) && ($currentUser->getId() == $id || $this->isGranted("ROLE_ADMIN"))) {
            return $this->render('pages/profile/edit.html.twig', [
                'profile' => $profile,
            ]);
        } else {
            return $this->redirectToRoute("index");
        }
    }
}
