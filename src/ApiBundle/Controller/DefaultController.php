<?php

namespace ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;

class DefaultController extends FOSRestController
{
    public function getVersionAction()
    {
        $data = array("name" => "ARSGHC API","version" => "1.0");
        $view = $this->view($data);
        return $this->handleView($view);
    }
}
