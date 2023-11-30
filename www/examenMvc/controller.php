<?php
declare(strict_types=1);
require_once 'model.php';
require_once 'view.php';

public class Controller {
    private Model $model;
    private View $view;

    public function __construct(Model $model, View $view) {
        $this->model = $model;
        $this->view = $view;
    }



}