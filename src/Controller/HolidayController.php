<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;
use Cake\I18n\Time;

/**
 * Holiday Controller
 *
 * @property \App\Model\Table\ExpansesTable $Expanses
 */
class HolidayController extends AppController
{

    public function index()
    {
        $dat = date("Y-d-m");
        $holidayTbl = TableRegistry::get('holiday');
        $query    =  $holidayTbl->find()->contain([
                
                    ]);
                   
        $query->select(['holiday_id']);
        $query->select(['offDate']);
        $query->select(['oType']);
        $query->select(['description']);
        $query->select(['status']);
        $query->where(['status' => '1']);
        $query->group('holiday_id');
        $query->orderDesc('holiday_id');
       // $query->where(['expanse_date'=>date("Y-d-m H:i:s", strtotime($dat))]);
        $query->orderAsc('holiday_id');
        $holidays = $query->ToArray();

        $now = Time::now();

        /*echo "<pre";
        print_r($now);
        echo "</pre";
        exit();*/
        
            $this->set(compact('holidays'));
        
    }

    public function isAuthorized($user) {
        $action = $this->request->params['action'];

        // The add and index actions are always allowed.
        if (in_array($action, ['index', 'add', 'delete','getdetails'])&& $this->request->session()->read('Auth.User.role_id')==1 || $this->request->session()->read('Auth.User.role_id')==2 || $this->request->session()->read('Auth.User.role_id')==3 || $this->request->session()->read('Auth.User.role_id')==5 || $this->request->session()->read('Auth.User.role_id')==6) {
            return true;
        }
        // All other actions require an id.
        if (empty($this->request->params['pass'][0])) {
            return false;
        }


        return parent::isAuthorized($user);
    }

   
    public function add()
    {
        
       
        $hol = TableRegistry::get('holiday');
        $query = $hol->find();
       
        if ($this->request->is('post')) {
            
            $mData = $this->request->data['description'];
            $sdate = $this->request->data['start_date'];
            $edate = $this->request->data['end_date'];
            $oType = $this->request->data['off_type'];


            foreach($mData as $row){
                $holiday = $hol->newEntity();
                //$holiday->holiday_id = $holiday_id;
                //$holiday->offDate = $row['offDate'];
                //$holiday->end_Date = $row['end'];
                $holiday->offType = $row['oType'];
                $holiday->description = $row['description'];
                $holiday->offDate = date("Y-m-d H:i:s", strtotime($sdate));
                $holiday->from_date = date("Y-m-d H:i:s", strtotime($this->request->data['from_date']));
                    $concession->to_date = date("Y-m-d H:i:s", strtotime($this->request->data['to_date'])); 
                //$holiday->created_by = $this->request->session()->read('Auth.User.id');
                
                /*echo "<pre";
                print_r($holiday);
                echo "</pre";
                exit(); */
                $hol->save($holiday);
                
                
            }
           
            $msg ='Success|The holiday has been saved.';
        }

        
        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
    }

  
    
   
    public function delete($id = null)
    {
        if(!empty($this->request->data['id'])){
            $inquirytbl = TableRegistry::get('holiday');
            $query = $inquirytbl->query();
            $query->update()
                ->set(['status' => '0'])
                ->where(['holiday_id' => $this->request->data['id']])
                ->execute();

                 
            $msg = 'Success|The Holiday has been deleted.';
        } else {
            $msg = 'Success|The Holiday could not be closed. Please, try again.';
        }

        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
    }
    
    
    public function getdetails(){
        
        $voucher_no = $this->request->data['vo'];
        $expansestbl = TableRegistry::get('expenses');
        $query = $expansestbl->find('all');
        $query->where(['voucher_number ='=> $voucher_no]);
        $query->hydrate(false);
        $data = $query->ToArray();
        $this->set(compact('data'));
        $this->set('_serialize', ['data']);
    }
    
    
}
