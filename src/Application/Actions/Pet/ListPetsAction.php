<?php
declare(strict_types=1);

namespace App\Application\Actions\Pet;

use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\PhpRenderer;

class ListPetsAction extends PetAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $options = $this->request->getQueryParams();
        if ($options) {
            $pets = $this->petRepository->findBySearchAndFilter($options);
        } else {
            $pets = $this->petRepository->findAll();
        }
        return $this->respondWithData($pets);
    }
}
