<?php

namespace App\User\Application\Register;

use App\User\Domain\Model\InvalidEmailException;
use App\User\Domain\Model\UserAlreadyExistsException;
use App\User\Domain\Model\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\WithHttpStatus;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
class RegisterController extends AbstractController
{

    public function __construct(private readonly RegisterUserService $signUpUserService)
    {
    }

    #[Route('/signup', methods: ['POST'])]
    public function signUpAction(Request $request) : JsonResponse
    {
        $requestData = json_decode($request->getContent(), true);
        try {
            $response = $this->signUpUserService->execute(
                new RegisterUserRequest(
                    $requestData['email'],
                    $requestData['firstName'],
                    $requestData['lastName'],
                    $requestData['password'],
                )
            );
        } catch (UserAlreadyExistsException $e) {
            return $this->json(['error' => 'user already exists'], 409);
        } catch (InvalidEmailException $e) {
            return $this->json(['error' => 'email is not valid'], 422);
        }

        return $this->json([''], 201);
    }
}
