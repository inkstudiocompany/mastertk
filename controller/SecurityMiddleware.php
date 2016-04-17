<?php

namespace Application\Controller;

use Application\App;
use Application\Routes;
use Slim\Http\Response;
use Slim\Http\Uri;

class SecurityMiddleware
{
    private $router;

    public function __construct($app)
    {
        $this->router = $app;
    }

    /**
     * Example middleware invokable class
     *
     * @param  \Psr\Http\Message\ServerRequestInterface $request  PSR7 request
     * @param  \Psr\Http\Message\ResponseInterface      $response PSR7 response
     * @param  callable                                 $next     Next middleware
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke($request, $response, $next)
    {
        $sessionCookie = null;

        if (false === $this->isDisabled($request->getUri()->getPath())) {
            $response = $this->callme($request, $response, $next);
        }

        if (true === $this->isDisabled($request->getUri()->getPath())) {
            $response = $next($request, $response);
        }

        return $response;
    }

    public function callme($request, $response, $next)
    {
        if ($request->getUri()->getPath() === '/login') {
            if (SecurityController::AppAuthorization() === true) {
                return $response->withRedirect('/home');
            }
        }

        if ($request->getUri()->getPath() !== '/login') {
            if (SecurityController::AppAuthorization() === false) {
                return $response->withRedirect('/login');
            }
        }

        $response = $next($request, $response);

        return $response;
    }



    public function getSessionId($request)
    {
        $sessionId = false;
        foreach($request->getHeaders()['HTTP_COOKIE'] As $cookie)
        {
            $cookie = explode('=', $cookie);
            if($cookie[0] === 'mastertkSecurity') {
                $sessionId = $cookie[1];
                break;
            }
        }
        return $sessionId;
    }

    private function isDisabled($path)
    {
        $path_conf = explode('/', $path);
        $routes = Routes::getRoutes();

        $disabledSecurityPaths = Array(
            'auth',
            'logout'
        );

        foreach ($disabledSecurityPaths As $keyPath) {
            if (isset($routes[$keyPath]) && isset($path_conf[1])) {
                if (stristr($routes[$keyPath], $path_conf[1])) {
                    return true;
                }
            }
        }

        return false;
    }
}