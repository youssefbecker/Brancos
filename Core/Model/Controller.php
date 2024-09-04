<?php
/**
 * Created by PhpStorm.
 * User: Poizon
 * Date: 17/07/2015
 * Time: 12:40
 */

namespace Projet\Model;


use Projet\Database\Besoin;
use Projet\Database\Settings;

class Controller {

    protected $viewPath;
    protected $template;
    protected $session;
    protected $setting;
    protected $besoins;
    protected $auth;

    public function __construct(){
        $this->session = Session::getInstance();
        $this->auth = App::getDBAuth();
        $this->setting = Settings::find(1);
        $this->besoins = Besoin::searchType();
    }

    public function render($view, $variables=[]){
        ob_start();
        $sess = ['session'=>$this->session];
        $aut = ['auth'=>$this->auth];
        $set = ['setting'=>$this->setting];
        $bes = ['besoins'=>$this->besoins];
        $variables = array_merge($sess,$bes,$set,$aut,$variables);
        extract($variables);
        $page = explode('.',$view);
        require($this->viewPath .ucfirst($page[0]).'/'.ucfirst($page[1]).'/'.$page[2].'.php');
        $content = ob_get_clean();
        require ($this->viewPath . $this->template . '.php');
    }

    protected function getOS() {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $os_platform    =   "Unknown OS Platform";
        $os_array       =   array(
            '/windows nt 10/i'     =>  'Windows 10',
            '/windows nt 6.3/i'     =>  'Windows 8.1',
            '/windows nt 6.2/i'     =>  'Windows 8',
            '/windows nt 6.1/i'     =>  'Windows 7',
            '/windows nt 6.0/i'     =>  'Windows Vista',
            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
            '/windows nt 5.1/i'     =>  'Windows XP',
            '/windows xp/i'         =>  'Windows XP',
            '/windows nt 5.0/i'     =>  'Windows 2000',
            '/windows me/i'         =>  'Windows ME',
            '/win98/i'              =>  'Windows 98',
            '/win95/i'              =>  'Windows 95',
            '/win16/i'              =>  'Windows 3.11',
            '/macintosh|mac os x/i' =>  'Mac OS X',
            '/mac_powerpc/i'        =>  'Mac OS 9',
            '/linux/i'              =>  'Linux',
            '/ubuntu/i'             =>  'Ubuntu',
            '/iphone/i'             =>  'iPhone',
            '/ipod/i'               =>  'iPod',
            '/ipad/i'               =>  'iPad',
            '/android/i'            =>  'Android',
            '/blackberry/i'         =>  'BlackBerry',
            '/webos/i'              =>  'Mobile'
        );
        foreach ($os_array as $regex => $value) {
            if (preg_match($regex, $user_agent)) {
                $os_platform    =   $value;
            }
        }
        return $os_platform;
    }

    protected function getBrowser() {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $browser        =   "Unknown Browser";
        $browser_array  =   array(
            '/msie/i'       =>  'Internet Explorer',
            '/firefox/i'    =>  'Firefox',
            '/safari/i'     =>  'Safari',
            '/chrome/i'     =>  'Chrome',
            '/edge/i'       =>  'Edge',
            '/opera/i'      =>  'Opera',
            '/netscape/i'   =>  'Netscape',
            '/maxthon/i'    =>  'Maxthon',
            '/konqueror/i'  =>  'Konqueror',
            '/mobile/i'     =>  'Handheld Browser'
        );
        foreach ($browser_array as $regex => $value) {

            if (preg_match($regex, $user_agent)) {
                $browser    =   $value;
            }

        }
        return $browser;
    }

}