<?php

namespace LumenTwig;

use Illuminate\Support\ServiceProvider;
use LumenTwig\Extensions\Url;
use Illuminate\Support\Str;
use Twig_SimpleFunction;

/**
 * Description of TwigServiceProvider
 *
 * @author EGIW
 */
class TwigServiceProvider extends ServiceProvider {

    public function register() {
        $this->app->extend('view', function($factory, $app) {
            $options = [
                'debug' => env('APP_DEBUG'),
                'cache' => $app['config']['view.compiled']
            ];

            $loader = new \Twig_Loader_Filesystem($app['config']['view.paths']);
            $twig = new \Twig_Environment($loader, $options);

            $twig->addExtension(new \Twig_Extension_Debug());
            $twig->addGlobal('URL', app('url'));
            $twig->addGlobal('request', app('request'));
			$twig->addGlobal('session', app('session'));
			
            foreach (get_class_methods('Illuminate\Support\Str') as $method) {
                $twig->addFunction(new Twig_SimpleFunction($method, ['Illuminate\Support\Str', $method]));
            }

            $twig->addGlobal('app', $app);

            return new TwigFactory($twig);
        });
    }

}
