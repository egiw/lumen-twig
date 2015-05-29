<?php

namespace LumenTwig\Extensions;

use Twig_Extension;
use Twig_SimpleFunction;
use Laravel\Lumen\Routing\UrlGenerator;

class Url extends Twig_Extension {

    private $url;

    public function __construct(UrlGenerator $url) {
        $this->url = $url;
    }

    public function getName() {
        return 'Twig_Url';
    }

    public function getFunctions() {
        return array(
            new Twig_SimpleFunction('asset', [$this->url, 'asset'], ['is_safe' => ['html']]),
            new Twig_SimpleFunction('action', [$this->url, 'action'], ['is_safe' => ['html']]),
            new Twig_SimpleFunction('url', [$this, 'url'], ['is_safe' => ['html']]),
            new Twig_SimpleFunction('route', [$this->url, 'route'], ['is_safe' => ['html']]),
            new Twig_SimpleFunction('secure_url', [$this->url, 'secure'], ['is_safe' => ['html']]),
            new Twig_SimpleFunction('secure_asset', [$this->url, 'secureAsset'], ['is_safe' => ['html']]),
        );
    }

}
