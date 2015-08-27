<?php
require_once 'BaseClass.php';
require_once dirname(__FILE__).'/../models/JournalModel.php';
require_once dirname(__FILE__).'/../models/CriteriaModel.php';
require_once dirname(__FILE__).'/../models/FormModel.php';

class Journal extends BaseClass
{
	public $journalModel;
	public $limit = 50;

    function __construct() {
    	$this->journalModel = new JournalModel();
    	$this->criteriaModel = new CriteriaModel();
    	$this->formModel = new FormModel();
    }

    function indexAction() {
    
    	// get parameters
		$search = isset($_GET['search']) ? $_GET['search'] : '';
		$page = isset($_GET['page']) ? $_GET['page'] : 1;
		$offset = ($page - 1) * $this->limit;

		// get total records
		$total = $this->journalModel->getCount($search);

		// get list of journals with pagination limit
    	$journals = $this->journalModel->getJournals($this->limit, $offset, $search);

		// setup pagination
    	$paginator = new SqlPaginator($page, $this->limit, $total);
		$paginator_params = array(
		  'search' => $search,
		);
		$paginator->setGetParameters($paginator_params);
		$pagination = $paginator->getPagination();

		// set data to be passed to view
		$data['journals'] = $journals;
		$data['pagination'] = $pagination;
		$data['offset'] = $offset;

		// render view
        $this->render('journal/list', $data);
    }

    function evaluateAction() {

    	$id = $_GET['id'];

    	// add current evaluation to database
    	if (isset($_POST['submitButton'])) {
    		echo '<pre>';
    		print_r($_POST);
    		echo '</pre>';

    	}

    	// show evaluation form
    	$data['journal'] = $this->journalModel->getJournal($id);
    	$data['disciplineName'] = $this->journalModel->getDiscipline($data['journal']['discipline_id']);
    	$data['compulsory'] = $this->criteriaModel->getCriterias();
		$data['optional'] = $this->criteriaModel->getCriterias(0);
    	$this->render('journal/evaluation_form', $data);
    }

    function evaluatedJournalsAction() {
    
    	// get parameters
		$search = isset($_GET['search']) ? $_GET['search'] : '';
		$page = isset($_GET['page']) ? $_GET['page'] : 1;
		$offset = ($page - 1) * $this->limit;

		// get total records
		$total = $this->journalModel->getCount($search);

		// get list of journals with pagination limit
    	$journals = $this->journalModel->getJournals($this->limit, $offset, $search);

		// setup pagination
    	$paginator = new SqlPaginator($page, $this->limit, $total);
		$paginator_params = array(
		  'search' => $search,
		);
		$paginator->setGetParameters($paginator_params);
		$pagination = $paginator->getPagination();

		// set data to be passed to view
		$data['journals'] = $journals;
		$data['pagination'] = $pagination;
		$data['offset'] = $offset;

		$data['forms'] = $this->formModel->getForms();

		// render view
        $this->render('journal/result_list', $data);
    }

	/* IMAL - EDIT DUMMY VIEW */
	
	function editJournal() {
    
		// render view
        $this->render('journal/detail');
    }
	
	
	/* IMAL - EXPORT */
	
	function toPDF() {
    
    	// get parameters
		$search = isset($_GET['search']) ? $_GET['search'] : '';
		$page = isset($_GET['page']) ? $_GET['page'] : 1;
		$offset = ($page - 1) * $this->limit;

		// get total records
		$total = $this->journalModel->getCount($search);

		// get list of journals with pagination limit
    	$journals = $this->journalModel->getJournalsFullList($search);

		// set data to be passed to view
		$data['journals'] = $journals;
		$data['forms'] = $this->formModel->getForms();

		// render view
        $this->render('journal/render_list_pdf', $data);
    }
	
	function toPDFDetail() {
		// render view
        $this->render('journal/render_detail_pdf');
    }
	
	function toExcelDetail() {
		// render view
        $this->render('journal/render_detail_excel');
    }
	
	function toExcel() {
    
    	// get parameters
		$search = isset($_GET['search']) ? $_GET['search'] : '';
		$page = isset($_GET['page']) ? $_GET['page'] : 1;
		$offset = ($page - 1) * $this->limit2;

		// get total records
		$total = $this->journalModel->getCount($search);

    	$journals = $this->journalModel->getJournalsFullList($search);

		$data['journals'] = $journals;
		
		$data['offset'] = $offset;

		$data['forms'] = $this->formModel->getForms();

		// render view
        $this->render('journal/render_list_excel', $data);
    }
}
