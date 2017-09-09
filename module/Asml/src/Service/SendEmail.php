<?php

namespace Asml\Service ;

use \Mailjet\Resources;

class SendEmail extends AsmlAbstractService 
{
    /*
     * var $sendmailClient instance of \Mailjet\Client
     */
    private $sendmailClient = null;

    /**
     * Constructor
     * @param object \Mailjet\Client 
     *
     */
    public function __construct(\Mailjet\Client $sendmailClient)
    {
        $this->sendmailClient = $sendmailClient;
    } 

	/**
     * Send email
     * @param array $recipients
     * @param array $emailVariables
     *
     */
    public function sendEmail(array $recipients, array $emailVariables) {

        try {

            $mjConfig = $this->getServiceManager()->get('Config')['Mailjet'];
            $body = [ 
                'Messages' => [
                    [
    			        'From' => [ 'Email' => $mjConfig['email']['fromEmail'],'Name' => $mjConfig['email']['fromName'] ],
                        'To' => $recipients,
                        'TemplateID' => $mjConfig['email']['templateId'],
                        'TemplateLanguage' => true,
                        'Variables' => $emailVariables,  
                        'Subject' => $mjConfig['email']['subject'],
			        ],
                ],
            ];
            $response = $this->sendmailClient->post(Resources::$Email, ['body' => $body]); 
            return $response->success();
        } catch (\Exception $exception) {

            //$logger->log('Exception occured ' . $exception->getMessage());
            return false;
        }
    }
}
