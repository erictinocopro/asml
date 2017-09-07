<?php

namespace Asml\Controller;

use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Zend\Form\Element;
use Zend\Form\Form;

class AsmlController extends AsmlAbstractController
{

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
 		]
	);
/*
$data = $this->params()->fromPost();            
$form->setData($data);
var_dump($form->isValid());
*/
	return new ViewModel([
        	'form' => $form,
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

    private function renderJson(array $data)
    {
	    $json = \Zend\Json\Json::encode($data);

	    $response = $this->getResponse();
	    $response->setContent($json);
	    $response->getHeaders()->addHeaders([
			    'Content-Type' => 'application/json',
	    ]);
	    return $this->response;
    }

}
