<?php

namespace Beryldev\EmailLabs\Transport;

use Swift_Mime_Message;
use GuzzleHttp\Post\PostFile;
use GuzzleHttp\ClientInterface;
use Illuminate\Mail\Transport\Transport;

class EmailLabsTransport extends Transport
{
	/**
	 * Guzzle client instance.
	 *
	 * @var GuzzleHttp\ClientInterface
	 **/
	protected $client;

	/**
	 * The EmailLabs API Secret Key
	 *
	 * @var string
	 **/
	protected $secret;

	/**
	 * The EmailLabs smtp account name
	 *
	 * @var string
	 **/
	protected $smtpAccount;

	/**
	 * The EmailLabs API App Key
	 *
	 * @var string
	 **/
	protected $key;

	public function __construct(ClientInterface $client, array $config)
	{
		$this->client = $client;
		$this->secret = $config['secret'];
		$this->key = $config['key'];
		$this->smtpAccount = $config['smtp'];
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author Sebastian
	 **/
	public function send(Swift_Mime_Message $message, &$failedRecipients = null)
	{
		$data = [
			'smtp_account' => $this->smtpAccount,
			'to' => $this->getAddresses($message->getTo()),
			'cc' => $this->getAddresses($message->getCc()),
			'bcc' => $this->getAddresses($message->getBcc()),
			'subject' => $message->getSubject(),
			'from' => $this->getFromAddress($message),
			'from_name' => $this->getFromName($message),
			'html' => $message->getBody()
		];

		if (version_compare(ClientInterface::VERSION, '6') === 1) {
            $options = ['form_params' => $data];
        } else {
            $options = ['body' => $data];
        }

        $options['auth'] = [$this->key, $this->secret];

		try
		{
			$result = $this->client->post('https://api.emaillabs.net.pl/api/sendmail', $options);
			return $result->getBody();
		}
		catch(\Exception $e)
		{
			\Log::error($e);
		}
	}

	/**
	 * Get all the addresses this message should be sent to.
	 *
	 * @param  array|null $addresses
	 * @return array
	 * @author 
	 **/
	protected function getAddresses($addresses)
	{
		$to = [];

		if($addresses)
			$to = array_merge($to, array_keys($addresses));

		return $to;
	}

	/**
	 * undocumented function
	 *
	 * @param  \Swift_Mime_Message $message
	 * @return string
	 * @author 
	 **/
	protected function getFromAddress(Swift_Mime_Message $message)
	{
		$from = '';
		if($message->getFrom())
			$from = array_keys($message->getFrom())[0];

		return $from;
	}

	/**
	 * undocumented function
	 *
	 * @param  \Swift_Mime_Message $message
	 * @return string
	 * @author 
	 **/
	protected function getFromName(Swift_Mime_Message $message)
	{
		$from = '';
		if($message->getFrom())
			$from = array_values($message->getFrom())[0];


		return $from;
	}

	/**
	 * Get API key
	 *
	 * @return string
	 * @author Sebastian
	 **/
	public function getKey()
	{
		return $this->key;
	}

	/**
	 * Set API key
	 *
	 * @return string $key
	 * @author Sebastian
	 **/
	public function setKey($key)
	{
		return $this->key = $key;
	}
}