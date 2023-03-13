<?php

namespace App\Controller;

use App\Entity\Visiteurs;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class InitController extends AbstractController
{
    #[Route('/init', name: 'app_init')]
    public function index(ManagerRegistry $doctrine, UserPasswordHasherInterface $passwordHasher): Response
    {
        $entityManager = $doctrine->getManager();
        $admin = new Visiteurs();
        $admin->setUsername('admin');

        $admin->setPassword(
            $passwordHasher->hashPassword(
                $admin,
                'admin'
            )
        );
        $admin->setPrenom('valentin');
        $admin->setNom('chailloux');
        $admin->setAdresse('12 rue des fleurs');
        $admin->setCp('74000');
        $admin->setVille('Annecy');
        $admin->setMatricule('123456789');
        $entityManager->persist($admin);
        $entityManager->flush();

        return $this->render('init/index.html.twig', [
            'controller_name' => 'InitController',
            'user' => $admin,
        ]);
    }
}
