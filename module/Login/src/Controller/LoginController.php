<?php

namespace Login\Controller;

use Login\Form\LoginForm;
use Login\Model\User;
use Login\Model\UserTable;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class LoginController extends AbstractActionController
{
    // Add this property:
    private UserTable $table;

    // Add this constructor:
    public function __construct(UserTable $table)
    {
        $this->table = $table;
    }

    public function indexAction()
    {
        $form = new LoginForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();

        if (! $request->isPost()) {
            return ['form' => $form];
        }

        $user = new User();
        $form->setInputFilter($user->getInputFilter());
        $form->setData($request->getPost());

        if (! $form->isValid()) {
            return ['form' => $form];
        }

        $user->exchangeArray($form->getData());
        $this->table->saveAlbum($user);
        return $this->redirect()->toRoute('login');
    }

}