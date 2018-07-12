<?php
   namespace App\Controller;
   use App\Controller\AppController;
   use Cake\Log\Log;

   class LogexsController extends AppController{
       
    public function isAuthorized($user) {
        $action = $this->request->params['action'];
        echo $this->request->params['controller'];exit;
        // The add and index actions are always allowed.
        if (in_array($action, ['index'])){
            return true;
        }
        // All other actions require an id.
        if (empty($this->request->params['pass'][0])) {
            return false;
        }

        return parent::isAuthorized($user);
    }
       
       
       
      public function index(){
         /*The first way to write to log file.*/
         Log::write('debug',"Something didn't work.");
         
         /*The second way to write to log file.*/
         $this->log("Something didn't work.",'debug');
      }
   }
?>