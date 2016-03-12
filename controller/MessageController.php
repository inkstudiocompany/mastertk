<?php

	namespace Application\Controller;

	use Application\Controller\ControllerBase;

	class MessageController extends ControllerBase
	{
		public function confirm($params = [])
		{
			return $this->render('common/modal/confirm_body.html.twig', $params);
		}
	}