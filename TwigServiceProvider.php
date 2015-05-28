<?php

namespace LumenTwig;

use Illuminate\Support\ServiceProvider;
use App\Providers\Twig\Extensions\Url;
use Illuminate\View\Factory;

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
            $twig->addExtension(new Url($app->url));

            $twig->addGlobal('app', $app);

            return new TwigFactory($twig);
        });
    }
}
