<?php
namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use libphonenumber\PhoneNumberUtil;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/api/user/me", name="user_me", methods={"GET"})
     */
    public function me(PhoneNumberUtil $phone_util): JsonResponse
    {
        $user = $this->getUser();

        return $this->json([
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'phone_number' => $phone_util->format($user->getPhoneNumber(), 'INTERNATIONAL'),
            'roles' => $user->getRoles(),
        ]);
    }

    /**
     * @Route("/api/user", name="user_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $em, PhoneNumberUtil $phone_util): JsonResponse
    {
        $users = $em->getRepository(User::class)->findAll();
        $output = [];

        foreach ($users as $user) {
            array_push($output, [
                'id' => $user->getId(),
                'email' => $user->getEmail(),
                'phone_number' => $phone_util->format($user->getPhoneNumber(), 'INTERNATIONAL'),
                'roles' => $user->getRoles(),
            ]);
        }

        return $this->json($output);
    }
}
