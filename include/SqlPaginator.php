<?php

class SqlPaginator {
  private $page;
  private $limit;
  private $total_page;
  private $min;
  private $max;
  private $params;

  function __construct($page, $limit, $total_records) {
    $this->page = empty($page) ? 1 : $page;
    $this->limit = $limit;
    $this->total_page = ceil($total_records / $limit);
    $this->min = ($page - 3 < $this->total_page && $page - 3 > 0) ? $page - 3 : 1;
    $this->max = ($page + 3 > $this->total_page) ? $this->total_page : $page + 3;
  }

  public function setGetParameters(Array $params) {
    $this->params = $params;
  }

  public function getPagination() {
    $parameter_str = $this->getParametersAsString();
    $pagination_html = '';
    $php_self = $_SERVER['PHP_SELF'];

    $page = $this->page;
    $min = $this->min;
    $max = $this->max;
    $total_page = $this->total_page;

    // Previous
    if ($page != 1) {
      $pageprev = $page - 1;  
      $pagination_html .= "<a href='$php_self?page=$pageprev$parameter_str'>&lt;&lt;Previous</a>&nbsp;";

      if ($min > 1) { 
        $pagination_html .= "<a href='$php_self?page=1$parameter_str'>[1] </a>";
      }

      if ($min > 2) {
        $pagination_html .= '... ';
      }
    } else {
      $pagination_html .= "&lt;&lt;Previous ";
    }
    
    // Body
    for($i=$min; $i<=$max; $i++) {
      if ($i == $page){
        $pagination_html .= "<b>[</b>";
        $pagination_html .= "<b>".$i."</b>";
        $pagination_html .= "<b>]</b>&nbsp;";
      } else {
        $pagination_html .= "[";
        $pagination_html .= "<a href = '$php_self?page=$i$parameter_str'>$i</a>";
        $pagination_html .= "]&nbsp;";
      }
    }

    // Next
    if ($page != $total_page) {
      $pagenext = $page + 1;
      if ($max <= $total_page - 2) {
        $pagination_html .= " ...";    
      }
      if ($max <= $total_page - 1) {
        $pagination_html .= " <a href='$php_self?page=$total_page$parameter_str'>[$total_page]</a>"; 
      }
      $pagination_html .= "<a href = '$php_self?page=$pagenext$parameter_str'>&nbsp;&nbsp;Next&gt;&gt;</a>";
    } else {
      $pagination_html .= " Next&gt;&gt;";
    }

    return $pagination_html;
  }

  private function getParametersAsString() {
    $param_str = '';
    $params = $this->params;

    foreach ($params as $param_key => $param_val) {
      $param_str .= '&'. $param_key. '=' .$param_val;
    }

    return $param_str;
  }
}

