<?php


namespace app\controllers;

use Pheasant;
use Latte\Engine;

class BaseController {

    private $config;
    private $latte;
    
    public function __construct() {
        $this->loadConfig();
        $this->initDB();
        $this->initTpl();
    }
	
    private function loadConfig() {
        global $config;
        $this->config = $config;
        
    }
    
    private function initDB() {
        
        Pheasant::setup($this->config['dsn']);
        
    }
    
    public function initTpl() {
        
        $this->latte = new Engine();
        $this->latte->setTempDirectory(APP_ROOT.'/storage/views');
        $set = new \Latte\Macros\MacroSet($this->latte->getCompiler());
        $set->addMacro('url',function($writer){
                return $writer->write('echo "'.SITE_URL.'"node.args'.'"');
        });
    }
    
    public function render($name,array $param = [],$block = null) {
        $param['sitename'] = 'mvc framework';
        $tplFile = APP_ROOT.'/views/'.$name.'.latte';
        $this->latte->render($tplFile,$param,$block);
    }
    
}