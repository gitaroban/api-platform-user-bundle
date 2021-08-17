<?php

namespace Aroban\Bundle\UtilisateurBundle\Controller;

use ApiPlatform\Core\Api\IriConverterInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class SecurityController extends AbstractController
{
    public function __construct(
        private IriConverterInterface $iriConverter
    )
    {}

    public function login()
    {
        if (!$this->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->json([
                'error' => 'Invalid login request: check that the Content-Type header is "application/json".'
            ], 400);
        }

        return new Response(null, 204, [
            'Location' => $this->iriConverter->getIriFromItem($this->getUser()),
        ]);
    }

    public function logout()
    {
        throw new \Exception('should not be reached!');
    }
}
