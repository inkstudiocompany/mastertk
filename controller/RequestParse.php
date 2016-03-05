<?php
	namespace Application\Controller;

	use Slim\Http\Request;

	class RequestParse
	{
		protected $request = null;
		protected $params = null;

		public function __construct(Request $request)
		{
			$this->request = $request;
			$this->params = $this->request->getParsedBody();
		}

		public function get($nombre = '')
		{
			$response = ''; 

			if (isset($this->params[$nombre])) {
				$response = $this->params[$nombre];
			}
			
			return $response;
		}
	}

