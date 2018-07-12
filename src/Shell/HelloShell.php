<?php
namespace App\Shell;

use Cake\Console\Shell;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;
use Cake\I18n\Time;


class HelloShell extends Shell
{
    public function main()
    {
        $this->out('Hello Moto.');
    }

    public function updateCronJob($name = 'Anonymous')
    {
    	$conn = ConnectionManager::get('default');
    	$conn->execute("
           	INSERT INTO cronjobs (name) VALUES ('$name')
        ");
       // $this->out('Hey there ' . $name);
    }
    
    
}