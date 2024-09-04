<?php
/**
 * Created by PhpStorm.
 * User: Poizon
 * Date: 17/07/2015
 * Time: 13:14
 */

namespace Projet\Controller\Page;

use Projet\Model\Controller;

class PageController extends Controller {

    protected $template = 'Templates/default';

    public function __construct(){
        parent::__construct();
        $this->viewPath = 'Views/';
    }

}