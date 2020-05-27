<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Firebase\JWT\JWT;

class SecurityController extends AbstractController
{
    /**
     * @Route("/api/login", name="login", methods={"POST"})
     */
    public function login(): Response
    {
        $user = $this->getUser();
        $token = JWT::encode([
            'sub' => $user->getUsername(),
            'aud' => $user->getRoles(),
            'exp' => time() + 15 * 60,
            'iat' => time(),
        ], $_ENV['APP_SECRET']);

        return new Response($token);
    }
}
