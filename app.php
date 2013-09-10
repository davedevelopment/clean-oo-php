<?php

require "vendor/autoload.php";

use Dflydev\Silex\Provider\DoctrineOrm\DoctrineOrmServiceProvider;
use Silex\Application;
use Silex\Provider\DoctrineServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpFoundation\Request;

$app = new Application;

$app->register(new SessionServiceProvider());
$app->register(new DoctrineServiceProvider, array(
    "db.options" => array(
        "driver" => "pdo_sqlite",
        "path" => __DIR__.'/db.sqlite',
    ),
));

$app->register(new DoctrineOrmServiceProvider, array(
    "orm.proxies_dir" => __DIR__.'/cache/proxies',
    "orm.em.options" => array(
        "mappings" => array(
            array(
                "type" => "yml",
                "namespace" => "Clean\Entity",
                "path" => __DIR__."/config/doctrine/mappings"
            ),
        ),
    ),
));


// stub current user
$app->before(function (Request $request) {
    $request->attributes->set("current_user_id", 1);
});

$app->on(KernelEvents::VIEW, function ($event) use ($app) {
    $view = $event->getControllerResult();
    if (!($view instanceof CleanWeb\View)) {
        return;
    }

    $event->setResponse($view->render());
});

$app->post("/user/{user_id}/friendship-requests", function (Application $app, Request $request) {

    // convert our HTTP request in to a application request
    $usecaseRequest = new Clean\UseCase\FriendshipRequestRequest(
        $request->attributes->get("current_user_id"), 
        $request->attributes->get("user_id")
    );

    // create something to deal with the output of our use case
    $view = new CleanWeb\View($request->getSession());
    $usecaseResponder = new CleanWeb\FriendshipRequestPresenter($view);

    // create our use case, wrapping it in a transaction and execute it
    $usecase = new CleanWeb\Transaction(
        $app['orm.em'],
        [new Clean\UseCase\FriendshipRequest($app['orm.em']->getRepository("Clean\Entity\User")), "execute"]
    );
    $usecase->execute($usecaseRequest, $usecaseResponder);

    // return the view
    return $view;
});

return $app;
