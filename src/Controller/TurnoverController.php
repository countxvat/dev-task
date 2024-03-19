<?php

namespace App\Controller;

use App\Entity\Turnover;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/turnover/", name="app_turnover_")
 */
class TurnoverController extends AbstractFOSRestController
{
    /**
     * @Route("{turnover}/show", name="show")
     */
    public function show(Turnover $turnover): Response
    {
        $view = $this->view($turnover, Response::HTTP_OK);
        $view->getContext()->addGroup('api');

        return $this->handleView($view);
    }
}
