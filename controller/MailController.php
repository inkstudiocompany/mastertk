<?php

	namespace Application\Controller;

	use Application\App;
	use Slim\Http\Response;

	class MailController extends ControllerBase
	{
        private $mailgun;
        private $apiKey;
        private $domain;

        private $toEmail;
        private $fromEmail;
        private $subject;
        private $messaje;

        public function __construct()
        {
            $this->apiKey = $this->getParameter('apiKey');
            $this->domain = $this->getParameter('domain');

            $client         = new \Http\Adapter\Guzzle6\Client();
            $this->mailgun  = new \Mailgun\Mailgun($this->apiKey, $client);
        }

        public function setToEmail($email = null)
        {
            if (true === is_null($email)) {
                return false;
            }
            $this->toEmail = $email;
            return $this;
        }

        public function getToEmail()
        {
            return $this->toEmail;
        }

        public function setFromEmail($email = null)
        {
            if (true === is_null($email)) {
                return false;
            }
            $this->fromEmail = $email;
            return $this;
        }

        public function getFromEmail()
        {
            return $this->fromEmail;
        }

        public function setSubject($subject = null)
        {
            if (true === is_null($subject)) {
                return false;
            }
            $this->subject = $subject;
            return $this;
        }

        public function getSubject()
        {
            return $this->subject;
        }

        public function setMessage($message = null)
        {
            if (true === is_null($message)) {
                return false;
            }
            $this->message = $message;
            return $this;
        }

        public function getMessage()
        {
            return $this->message;
        }

        public function send()
        {
            $this->mailgun->sendMessage(
                $this->domain, array(
                    'from'      => $this->getFromEmail(),
                    'to'        => $this->getToEmail(),
                    'subject'   => $this->getSubject(),
                    'text'      => $this->getMessage(),
                    'html'      => $this->getMessage()
                )
            );
        }

        public function sendMessage($from = null, $to = null, $subject = '', $message = '')
        {
            if (true === is_null($from) || true === is_null($to)) {
                return false;
            }

            $this
                ->setFromEmail($from)
                ->setToEmail($to)
                ->setSubject($subject)
                ->setMessage($message)
                ->send();
        }
	}