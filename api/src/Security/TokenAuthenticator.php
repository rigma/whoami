<?php
namespace App\Security;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;

class TokenAuthenticator extends AbstractGuardAuthenticator
{
    /**
     * @var \Doctrine\ORM\EntityManagerInterface
     */
    private $em;

    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManagerInterface $em The entity manager of the application.
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function supports(Request $request)
    {
        return $request->headers->has('Authorization');
    }

    public function getCredentials(Request $request): ?object
    {
        $authorization = $request->headers->get('Authorization');
        if ($authorization === null || strpos($authorization, 'Bearer ') !== 0) {
            return null;
        }

        $token = substr($authorization, 7);
        try {
            return JWT::decode($token, $_ENV['APP_SECRET'], ['HS256']);
        } catch (ExpiredException $e) {
            return null;
        }
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        if ($credentials === null) {
            return null;
        }

        return $this->em->getRepository(User::class)
            ->findOneBy([
                'email' => $credentials->sub,
            ]);
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        return $credentials !== null;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        return new JsonResponse([
            'message' => 'Invalid or expired JWT token provided!',
        ], Response::HTTP_UNAUTHORIZED);
    }

    public function start(Request $request, AuthenticationException $authException = null)
    {
        return new JsonResponse([
            'message' => 'Authentication required!',
        ], Response::HTTP_UNAUTHORIZED);
    }

    public function supportsRememberMe()
    {
        return false;
    }
}
