<?php
require 'BaseClass.php';
require dirname(__FILE__).'/../models/CriteriaModel.php';
require dirname(__FILE__).'/../models/FormModel.php';

class Form extends BaseClass
{
	public $criteriaModel;

    function __construct() {
		$this->criteriaModel = new CriteriaModel();
		$this->formModel = new FormModel();
    }

    public function indexAction() {
    	// set data to be passed to view
		$data['forms'] = $this->formModel->getForms();

		// render view
        $this->render('form/list', $data);
    }

    function createAction() {
    
    	if (isset($_POST['submitButton'])) {
    		$categoryName = $_POST['category_name'];
    		$criteriaIds = $_POST['criteriaIds'];

            $link = '/myjurnal/classification_create_form.php';
    		$category = array('name' => $categoryName);
	    	$ins = $this->formModel->insertData($category, $criteriaIds);
	    	if (!$ins)
	    	{
                $_SESSION['error_msg'] = "An error occur. Please try again.";
	    		$this->redirect($link);
	    	}

            $_SESSION['success_msg'] = "Form has been successfully created.";
            $this->redirect($link);
    	}

		// render view
		$data['compulsory'] = $this->criteriaModel->getCriterias();
		$data['optional'] = $this->criteriaModel->getCriterias(0);

        $this->render('form/form', $data);
    }

    function showAction($id) {
        // set data to be passed to view
        $data['form'] = $this->formModel->getForms($id);

        // render view
        $this->render('form/detail', $data);
    }
}
