<?php
class BaseClass
{
    function render($viewFile = '', $data = array()) {

        // get the file with path
        $file = dirname(__FILE__) . '/../views/' . $viewFile . '.php';

        if (file_exists($file)) {

            // data is the variables passed to views
            // extract $data into seperate variables based on its key
            foreach ($data as $key => $value) {
                $$key = $value;
            }

            // include the view file
            include_once ($file);
        }
        else {
            die('View file not exists at ' . $file);
        }
    }

    function alert($message) {
        echo '
        <script type="text/javascript">
            alert("' . $message . '")
        </script>';
    }

    function redirect($url) {
        echo '
        <script type="text/javascript">
            window.location = "' . $url . '"
        </script>';
    }

    function json($array) {
        echo json_encode($array);
    }
}
