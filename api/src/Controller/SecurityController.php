<?php
namespace App\Controller;

use App\Entity\User;
use App\Form\Type\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Firebase\JWT\JWT;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/api/signup", name="signup", methods={"POST"})
     */
    public function signup(Request $request, EntityManagerInterface $em, UserPasswordEncoderInterface $encoder): Response
    {
        $user = new User();

        $body = $this->createForm(UserType::class, $user);
        $body->submit($request->request->all());

        if (!$body->isSubmitted()) {
            return $this->json([
                'error' => 'You have not submitted any data to the endpoint!',
            ], Response::HTTP_BAD_REQUEST);
        }

        if (!$body->isValid()) {
            return $this->json([
                'error' => 'Invalid data submitted to the endpoint!',
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $user = $body->getData();
        $user->setPassword($encoder->encodePassword($user, $user->getPassword()));

        $em->persist($user);
        $em->flush();

        $token = JWT::encode([
            'sub' => $user->getUsername(),
            'aud' => $user->getRoles(),
            'exp' => time() + 15 * 60,
            'iat' => time(),
        ], $_ENV['APP_SECRET']);

        return new Response($token, Response::HTTP_CREATED);
    }

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
