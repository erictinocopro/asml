<?php

namespace Asml\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Authentication\Result;
use Zend\Uri\Uri;
use Asml\Form\LoginForm;
use Asml\Entity\User;

/**
 * This controller is responsible for letting the user to log in and log out.
 */
class AsmlAuthController extends AbstractActionController
{
    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager 
     */
    private $entityManager;
    
    /**
     * Auth manager.
     * @var Asml\Service\AuthManager 
     */
    private $authManager;
    
    /**
     * Auth service.
     * @var \Zend\Authentication\AuthenticationService
     */
    private $authService;

    /**
     * Config array
     * @var array
     */
    
    /**
     * Constructor.
     */
    public function __construct($entityManager
        , \Asml\Service\AuthManager $authManager
        , \Zend\Authentication\AuthenticationService $authService
        , array $config = null)
    {
        $this->entityManager = $entityManager;
        $this->authManager = $authManager;
        $this->authService = $authService;
        $this->config = $config;
    }
    
    /**
     * Authenticates user given email address and password credentials.     
     */
    public function loginAction()
    {
        // Retrieve the redirect URL (if passed). We will redirect the user to this
        // URL after successfull login.
        $redirectUrl = (string)$this->params()->fromQuery('redirectUrl', '');
        if (strlen($redirectUrl)>2048) {

            throw new \Exception("Too long redirectUrl argument passed");
        }
        
        // Create login form
        $form = new LoginForm(); 
        $form->get('redirect_url')->setValue($redirectUrl);
        
        // Store login status.
        $isLoginError = false;
        
        // Check if user has submitted the form
        if ($this->getRequest()->isPost()) {
            
            // Fill in the form with POST data
            $data = $this->params()->fromPost();            
            
            $form->setData($data);
            
            // Validate form
            $isLoginError = true;
            if($form->isValid()) {
                
                // Get filtered and validated data
                $data = $form->getData();
                
                // Perform login attempt.
                $result = $this->authManager->login($data['email'], 
                        $data['password'], $data['remember_me']);
                
                // Check result.
                if ($result->getCode() == Result::SUCCESS) {
                    
                    // Get redirect URL.
                    $redirectUrl = $this->params()->fromPost('redirect_url', '');
                    
                    if (!empty($redirectUrl)) {

                        $uri = new Uri($redirectUrl);
                        if (!$uri->isValid() || $uri->getHost()!=null) {
                            throw new \Exception('Incorrect redirect URL: ' . $redirectUrl);
                        }

                    }

                    if(empty($redirectUrl)) {

                        return $this->redirect()->toRoute('home');
                    } 
                    return $this->redirect()->toUrl($redirectUrl);
                }                
            }           
        } 
        
        $uidGa = $this->config['GA']['ID'];
        $googleCaptcha = $this->config['googleCaptcha'];
        return new ViewModel([
            'form' => $form,
            'uidGA' => $uidGa,
            'googleCaptcha' => $googleCaptcha,
            'isLoginError' => $isLoginError,
            'redirectUrl' => $redirectUrl
        ]);
    }
    
    /**
     * The "logout" action performs logout operation.
     */
    public function logoutAction() 
    {        
        $this->authManager->logout();
        
        return $this->redirect()->toRoute('login');
    }
}
