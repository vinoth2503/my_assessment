<?php
declare(strict_types=1);

use App\Application\Actions\Pet\ListPetsAction;
use App\Application\Actions\Pet\ViewPetAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use Slim\Views\PhpRenderer;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Wipfli LLP Assessment');
        return $response;
    });

    $app->group('/pets', function (Group $group) {
        $group->get('', ListPetsAction::class);
        $group->get('/{id}', ViewPetAction::class);
    });

    // $app->get('/pets', function ($request, $response, $args) {
    //     $renderer = new PhpRenderer(__DIR__ . '/../src/Templates/pets');
    //     return $renderer->render($response, "list.phtml", $args);
    // })->setName('profile');

    // $app->get('/pets/{id}', function ($request, $response, $args) {
    //     $renderer = new PhpRenderer(__DIR__ . '/../src/Templates/pets');
    //     return $renderer->render($response, "view.phtml", $args);
    // })->setName('profile');
};
