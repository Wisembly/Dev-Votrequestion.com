<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of status
 *
 * @author nicolas
 * `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(32) NOT NULL,
  `class_css` varchar(32) NOT NULL,
 */
class Status extends User {
    private $status_id;
    private $value;
    private $class_css;

    public function __construct()
    {
        parent::__construct();
    }

    private function get_list_status()
    {
        
    }

}
?>
