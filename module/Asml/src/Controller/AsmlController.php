<?php

namespace Asml\Controller;

use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Zend\Form\Element;
use Zend\Form\Form;
use Zend\Session\Container;
use Asml\Service\AsmlGoogleFileInterfaceService ;
use Asml\Service\AsmlGoogleXLInterfaceService;

class AsmlController extends AsmlAbstractController
{

    private $config = [];

    /**
     * Main constructor
     *
     * @param array $config
     *
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function indexAction()
    {
	    $form = new Form('asml');
 	    $form->add([
     		'type' => 'Zend\Form\Element\Csrf',
     		'name' => 'ctok',
     		'options' => [
                'csrf_options' => [
                    'timeout' => 600,
				    'salt' => 'lmsa',
                ],
     		],
 		]);
        /*
            $data = $this->params()->fromPost();            
            $form->setData($data);
            var_dump($form->isValid());
        */

        $uidGa = $this->config['GA']['ID'];
        $googleCaptcha = $this->config['googleCaptcha'];
        $rebateConditions = $this->config['rebateConditionsLink'];
	    return new ViewModel([
        	'form' => $form,
            'uidGA' => $uidGa,
            'googleCaptcha' => $googleCaptcha,
            'rebateConditions' => $rebateConditions,
    	]);
    }

    public function sectionsListAction()
    {
	    try{
		    $request = $this->getRequest();
		    if ($request->isPost()){
			    $postData = $request->getContent(); 
			    if ($postData != null){
				    $json = \Zend\Json\Json::decode($postData, \Zend\Json\Json::TYPE_OBJECT);
				    if (isset($json->section)) {

					    $asmlActivitiesService = $this->getServiceManager()->get('Service\AsmlActivities');
					    $sectionList = $asmlActivitiesService->getSections($json->section);
				    }
			    }
		    }
		    if (!isset($sectionList)) {
		    	throw new \Exception('er');
		    }
	    }catch(\Exception $e){
		    $sectionList = ["error"    =>  $e->getMessage(),];
	    }
	    return $this->renderJson($sectionList);
    }

    public function activitiesListAction()
    {
	    try{
		    $request = $this->getRequest();
		    if ($request->isPost()){
			    $postData = $request->getContent(); 
			    if ($postData != null){
				    $json = \Zend\Json\Json::decode($postData, \Zend\Json\Json::TYPE_OBJECT);
				    if (isset($json->activite)) {

					    $asmlActivitiesService = $this->getServiceManager()->get('Service\AsmlActivities');
					    $activitiesList = $asmlActivitiesService->getActivities($json->activite);
				    }
			    }
		    }
		    if (!isset($activitiesList)) {
		        throw new \Exception('er');
            }
	    }catch(\Exception $e){
		    $activitiesList = ["error" => $e->getMessage(),];
	    }
	    return $this->renderJson($activitiesList);
    }

    /**
     * Outputs JSON data with no tpl needed
     * @param array $data
     * @param int $httpCode 
     *
     */
    private function renderJson(array $data, $httpCode=200)
    {
	    $json = \Zend\Json\Json::encode($data);

        $response = $this->getResponse();
        $response->setStatusCode($httpCode);
	    $response->setContent($json);
	    $response->getHeaders()->addHeaders([
			'Content-Type' => 'application/json',
	    ]);
	    return $this->response;
    }

    public function saveDataAction()
    {
        try{
		    $request = $this->getRequest();
		    if ($request->isPost()){
			    $postData = $request->getContent(); 
			    if ($postData != null){
				    $json = \Zend\Json\Json::decode($postData, \Zend\Json\Json::TYPE_OBJECT); 
                    if (!empty($json->currentPos)&&!empty($json->currentStep)) {

                        $container = $this->getServiceManager();
                        $sessionContainer = $container->get('UserRegistration');
                        if ($json->currentPos==1&&$json->currentStep=='step1'){

                            $sessionContainer->formData = [];
                        }
                        $sessionContainer->formData['pos'.$json->currentPos] = [$json->currentStep => (array)$json->formData];
                        $answer = $sessionContainer->formData;
                        if ($json->currentStep=='step4'){

                            $answer = [];
                            $storageAnswer = $this->storeDataGoogle($sessionContainer->formData);

                            if (true!==$storageAnswer) {

                                return $this->renderJson((array)$storageAnswer, 403);
                            }
                            if (!empty($sessionContainer->formData['pos1']['step4']['cheque_novembre'])) {

                                $reglement .= '<br /> - un chèque de '.intval($sessionContainer->formData['pos1']['step4']['cheque_novembre']).'€';
                            }
                            if (!empty($sessionContainer->formData['pos1']['step4']['cheque_janvier'])) {

                                $reglement .= '<br /> - un chèque de '.intval($sessionContainer->formData['pos1']['step4']['cheque_janvier']).'€';
                            }
                            if (!empty($sessionContainer->formData['pos1']['step4']['cheque_avril'])) {

                                $reglement .= '<br /> - un chèque de '.intval($sessionContainer->formData['pos1']['step4']['cheque_avril']).'€';
                            }
                            if (!empty($sessionContainer->formData['pos1']['step4']['montantancv'])) {

                                $reglement .= '<br />'.intval($sessionContainer->formData['pos1']['step4']['montantancv']).'€ en chèque vacances ou coupon sport';
                            }
                            $sendemailService = $this->getServiceManager()->get('Service\SendEmail');
                            $recipient = [[ 'Email' => $sessionContainer->formData['pos1']['step4']['email'], ],];
                            $emailVariables = [ 'prenom' => $sessionContainer->formData['pos1']['step4']['prenom'],
                            'reglement' => $reglement ];
					        $response = $sendemailService->sendEmail($recipient, $emailVariables);
                        }
                        return $this->renderJson($answer);
                    }
			    }
		    }
	    }catch(\Exception $e){
	    }
        return $this->renderJson([$json], 503);
    }

    public function cleanDataAction()
    {
        try{
		    $request = $this->getRequest();
		    if ($request->isPost()){
			    $postData = $request->getContent(); 
			    if ($postData != null){
				    $json = \Zend\Json\Json::decode($postData, \Zend\Json\Json::TYPE_OBJECT); 

                    if (!empty($json->currentPos)&&!empty($json->currentStep)) {
                        $container = $this->getServiceManager();
                        $sessionContainer = $container->get('UserRegistration');
                        unset($sessionContainer->formData[$json->currentPos][$json->currentStep]);
                        return $this->renderJson([]);
                    }
			    }
		    }
	    }catch(\Exception $e){
	    }
        return $this->renderJson([], 503);
    }

    public function uploadPhotoAction()
    {
        $photoFile = $this->params()->fromFiles('photo'); 
        if (!empty($photoFile)) {

            $folderExtension = uniqid();
            $email = $this->params()->fromPost('email', false);
            if (!empty($email)) {

                $folderExtension = trim($email);
            }
            $tmp_name = $photoFile['tmp_name'];
            $fileParts = explode('.', $photoFile['name']);

            $configArr = [ 'google' =>
                [
                    'auth' => [ 
                        'service-accounts' => [ 
                            'spreadsheet' => [ 
                                'keyFilePath' => __DIR__.'/../../../../config/ASML-spreadsheet-03635eeac513.json', 
                            ], 
                        ], 
                    ], #  path to service account JSON file
                ],
            ];
            $asmlService = new ASMLGoogleFileInterfaceService( $configArr );

            try {
                try {
                    $mainFolderId = $asmlService->getObjectId($folderExtension);
                } catch (\Exception $exception) {
                    if ($exception->getCode()<>-1) {

                        return $this->renderJson([$exception->getMessage()], 504);
                    }
                    $mainFolderId = $asmlService->createFolder($folderExtension);
                }
                $fileId = $asmlService->createFile('photo.'.end($fileParts)
                    , file_get_contents($tmp_name)
                    , image_type_to_mime_type($photoFile['tmp_name'])
                    , $mainFolderId
                );
                return $this->renderJson(['localPath' => base64_encode($fileId)]);
            } catch (\Exception $exception) {

                return $this->renderJson([$exception->getMessage()], 504);
            }
        }
        return $this->renderJson(['error' => 'aucune photo à télécharger'], 504);
    }

    private function storeDataGoogle($formData)
    {
        if (empty($formData)) {

            return ['error' => 'no data'];
        }
        $numberCells = count((array)$formData);
        $endLetter = '';
        while($numberCells>0) {

            if ($numberCells>26) {
                $endLetter .= 'A';
                $numberCells = $numberCells - 26;
                continue;
            }
            $endLetter .= chr(64 + $numberCells);
            $numberCells = $numberCells - 26;
        }

        $configArr = [ 'google' => 
            [ 
                'spreadsheetKey' => '1Bi2oPai5F9XgT1Y51uYB4PXyj3sxAo_kai9JLAFOO9Q', # ID of the google spreasheet file
                'worksheet' => 'data1', # name of the worksheet to work with
                'worksheet-data-cells-range' => 'A5:'.$endLetter, # the range of data cells (excluding header cells) - for example A2:AH - it hsould not include the right bottom cell row number, as it is calculated based on the data
                'auth' => [ 'service-accounts' => [ 'spreadsheet' => [ 'keyFilePath' => __DIR__.'/../../../../config/ASML-spreadsheet-03635eeac513.json', ], ], ], #  path to service account JSON file
            ],
        ];
        $asmlService = new AsmlGoogleXLInterfaceService( $configArr );
        $result = true;
        foreach ($formData as $userData) {

            $results = [];
            foreach ($userData as $columnName => $formValue) {
                if (is_array($formValue)) {

                    foreach ($formValue as $index => $value) {

                        $results[] = $value;
                    }
                    continue;
                }
                $results[] = $formValue;
            }
            $result = $result && $asmlService->publishRow($results);
        }
        return $result;
    }
}
