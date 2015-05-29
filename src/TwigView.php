<?php

namespace LumenTwig;

use Illuminate\Contracts\View\View;

/**
 * Description of TwigView
 *
 * @author EGIW
 */
class TwigView implements View {

    private $view;
    private $data;
    private $factory;

    public function __construct(TwigFactory $factory, $view, $data = []) {
        $this->factory = $factory;
        $this->data = $data;
        $this->view = $view;
    }

    public function name() {
        return $this->view;
    }

    public function render() {
        return $this->factory->render($this->view, $this->data);
    }

    public function with($key, $value = null) {
        $this->data[$key] = $value;

        return $this;
    }

    public function __toString() {
        return $this->render();
    }

}
