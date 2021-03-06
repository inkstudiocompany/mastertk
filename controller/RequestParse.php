<?php
	namespace Application\Controller;

	use Slim\Http\Request;

	class RequestParse
	{
		protected $request = null;
		protected $params = null;
		protected $args = null;

		public function __construct(Request $request, $args = [])
		{
			$this->request = $request;
			$this->params = $this->request->getParsedBody();
			$this->args = $args;
		}

		public function get($nombre = '')
		{
			$response = false;

			if ($this->request->isPost() === true) {
				if (isset($this->params[$nombre])) {
					$response = $this->params[$nombre];
				}

				if (isset($this->args[$nombre])) {
					$response = $this->args[$nombre];
				}	
			}

			if ($this->request->isGet() === true) {
				$response = $this->request->getParam($nombre);

				if (isset($this->args[$nombre])) {
					$response = $this->args[$nombre];
				}
			}
			
			return $response;
		}
	}

