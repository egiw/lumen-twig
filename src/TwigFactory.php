<?php

namespace LumenTwig;

use Illuminate\Contracts\View\Factory;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TwigFactory
 *
 * @author EGIW
 */
class TwigFactory implements Factory {

    /**
     *
     * @var \Twig_Environment
     */
    private $twig;

    public function __construct(\Twig_Environment $twig) {
        $this->twig = $twig;
    }

    public function addNamespace($namespace, $hints) {
        
    }

    public function composer($views, $callback, $priority = null) {
        
    }

    public function creator($views, $callback) {
        
    }

    public function exists($view) {
        return $this->twig->getLoader()->exists($view);
    }

    public function file($path, $data = array(), $mergeData = array()) {
        if (!file_exists($path)) {
            return false;
        }

        $filePath = dirname($path);
        $fileName = basename($path);

        $this->twig->getLoader()->addPath($filePath);

        return new TwigView($this, $fileName, $data);
    }

    public function make($view, $data = array(), $mergeData = array()) {
        $data = array_merge($mergeData, $data);

        return new TwigView($this, $view, $data);
    }

    public function render($view, $data) {
        return $this->twig->render($view, $data);
    }

    public function share($key, $value = null) {
        $this->twig->addGlobal($key, $value);
    }

//put your code here
}
