<?php

	namespace Application\Controller;

	use Application\Controller\ControllerBase;
	use Model\ORM\MyTicket as myticket;

	class MyTicketController extends ControllerBase
	{


		public function tickets()
		{
			return $this->render('mistickets/listado.html.twig');
		}


	}