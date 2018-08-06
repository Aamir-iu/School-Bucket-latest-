<?php

namespace App\Controller;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;

/**
 * MasterGallery Controller
 *
 * @property \App\Model\Table\MasterGalleryTable $MasterGallery
 */
class MasterGalleryController extends AppController {

    public function isAuthorized($user) {
        $action = $this->request->params['action'];

        // The add and index actions are always allowed.
        if (in_array($action, ['index', 'add', 'edit', 'viewPhotos', 'delete', 'upload', 'uploads'])) {
            return true;
        }
        // All other actions require an id.
        if (empty($this->request->params['pass'][0])) {
            return false;
        }
        return parent::isAuthorized($user);
    }

    public function index() {
        $path = "/var/www/html/SMS_Latest/webroot/img/photo_gallery";
        if(!is_dir($path)) {
           mkdir($path);
        }        
        $path = "/var/www/html/SMS_Latest/webroot/img/org";
        if(!is_dir($path)) {
            mkdir($path);
        }
        
        $files = glob('/var/www/html/SMS_Latest/webroot/img/org/*'); // get all file names
        foreach($files as $file){ // iterate files
          if(is_file($file))
            unlink($file); // delete file
        }
        
        
        $masterGallery = $this->MasterGallery->find();

        $this->set(compact('masterGallery'));
        $this->set('_serialize', ['masterGallery']);
    }

    /**
     * View method
     *
     * @param string|null $id Master Gallery id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $masterGallery = $this->MasterGallery->get($id, [
            'contain' => ['GalleryDetails']
        ]);

        $this->set('masterGallery', $masterGallery);
        $this->set('_serialize', ['masterGallery']);
    }

    public function viewPhotos($id = null) {
        
        $this->loadModel('GalleryDetails');
        $masterGallery = $this->GalleryDetails->find();
        $masterGallery->where(['master_gallery_id' => $id]);

       
        $this->set(compact('masterGallery','id'));
        $this->set('_serialize', ['masterGallery','id']);
        
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $masterGallery = $this->MasterGallery->newEntity();
        if ($this->request->is('post')) {
            $masterGallery = $this->MasterGallery->patchEntity($masterGallery, $this->request->data);
            if ($this->MasterGallery->save($masterGallery)) {
                $this->Flash->success(__('The master gallery has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The master gallery could not be saved. Please, try again.'));
        }
        $this->set(compact('masterGallery'));
        $this->set('_serialize', ['masterGallery']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Master Gallery id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $masterGallery = $this->MasterGallery->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $masterGallery = $this->MasterGallery->patchEntity($masterGallery, $this->request->data);
            if ($this->MasterGallery->save($masterGallery)) {
                $this->Flash->success(__('The master gallery has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The master gallery could not be saved. Please, try again.'));
        }
        $this->set(compact('masterGallery'));
        $this->set('_serialize', ['masterGallery']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Master Gallery id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $id = $this->request->data['id'];
        $pic = $this->request->data['pic'];
        $this->loadModel('GalleryDetails');
        $query = $this->GalleryDetails->query();
                        $query->delete()
                        ->where(['id_gallery_details' => $id])
                        ->execute();
        if ($query) {
            unlink('/var/www/html/SMS_Latest/webroot/img/photo_gallery/'.$pic);
            $msg = 'Success|The photo has been deleted.';
        } else {
            $msg = 'Error|The master gallery could not be deleted. Please, try again.';
        }
       
        $this->set(compact('msg'));
        $this->set('_serialize', ['msg']);
    }

    public function upload($id = null) {

        if ($_POST['submit'] == 'mu') {
            // multi file upload ! 
            // pretty much the same lol
            foreach ($_FILES["images"]["tmp_name"] as $key => $tmp_name) {
                $resource = [
                    'name' => $_FILES['images']['name'][$key],
                    'type' => $_FILES['images']['type'][$key],
                    'tmp_name' => $tmp_name,
                    'error' => $_FILES['images']['error'][$key],
                    'size' => $_FILES['images']['size'][$key]
                ];
              
                $upload = $this->uploads($resource);
                if (is_numeric($upload)) {
                    // upload function return an error number if there's an error while upload 
                    $error = $this->upload_error($upload);
                   // echo '[' . $key . ']' . $error . "<br />";
                    $this->Flash->error(__('The master gallery could not be saved. Please, try again.'));
                     return $this->redirect(['action' => 'viewPhotos',$id]);
                } else {
                    $table = TableRegistry::get('gallery_details');
                    foreach ($upload as $row) {
                        
                        $master = $table->newEntity();
                        $master->master_gallery_id = $id;
                        $master->pic = $row;
                        $table->save($master);
                       
                    }
            
                }
            }
            
            $this->Flash->success(__('The master gallery has been saved.'));
            return $this->redirect(['action' => 'viewPhotos',$id]);
        }

        exit;
    }

    public function uploads($resource = null) {
        if ($resource === null) {
            $resource = isset($_FILES['image']) ? $_FILES['image'] : false;
            if ($resource === false) {
                return 5;
            }
        }

        if ($resource['error'] === 0) {
            $accept = ["image/png",
                "image/jpeg",
                "image/gif",
                "image/bmp"
            ];
            $info = getimagesize($resource['tmp_name']);
            if (!$info) {
                return 0;
            }

            if (in_array($resource['type'], $accept) && $info[0] >= 150 && $info[1] >= 150) {
                $info = @getimagesize($resource['tmp_name']);
                if (!$info)
                    return 0;
                $mime = $info['mime'];
                $w = $info[0];
                $h = $info[1];
                $ar = explode('.', $resource['name']);
                $ext = end($ar);
                $newname = uniqid() . md5($resource['name']) . '.' . $ext;

                if (in_array($mime, $accept)) {

                    switch ($mime) {
                        case 'image/gif':
                            $src = @imagecreatefromgif($resource['tmp_name']);
                            if (!$src)
                                return 4;
                            $save = 'imagegif';
                            $create = 'imagecreatefromgif';
                            break;
                        case 'image/png':
                            $src = @imagecreatefrompng($resource['tmp_name']);
                            if (!$src)
                                return 4;
                            $save = 'imagepng';
                            $create = 'imagecreatefrompng';
                            break;
                        case 'image/jpeg':
                            $src = @imagecreatefromjpeg($resource['tmp_name']);
                            if (!$src)
                                return 4;
                            $save = 'imagejpeg';
                            $create = 'imagecreatefromjpeg';
                            break;
                        case 'image/bmp':
                            $src = @imagecreatefrombmp($resource['tmp_name']);
                            if (!$src)
                                return 4;
                            $save = 'imagebmp';
                            $create = 'imagecreatefrombmp';
                            break;
                    }

                    if ($h > $w) {
                        $s = $h;
                        $x = ($s - $w) / 2;
                        $y = 0;
                    } else {
                        $s = $w;
                        $x = 0;
                        $y = ($s - $h) / 2;
                    }


                    $r = $g = $b = 0;

                    for ($i = 3; $i > 1; $i = $i - 1) {
                        $rgb = imagecolorat($src, (int) $w / 2, (int) $h / $i);
                        $r = (($rgb >> 16) & 0xFF) + $r;
                        $g = (($rgb >> 8) & 0xFF) + $g;
                        $b = ($rgb & 0xFF) + $b;
                    }


                    list($r, $g, $b) = [$r / 2, $g / 2, $b / 2];

                    $thumb = imagecreatetruecolor($s, $s);
                    $color = imagecolorallocate($thumb, $r, $g, $b);
                    imagefill($thumb, 0, 0, $color);
                    imagecopyresampled($thumb, $src, $x, $y, 0, 0, $w, $h, $w, $h);


                    $save($thumb, '/var/www/html/SMS_Latest/webroot/img/org/' . $newname);
                    imagedestroy($thumb);
                    imagedestroy($src);
                    $src = $create('/var/www/html/SMS_Latest/webroot/img/org/' . $newname);

                    $sizes = [
                        300
                    ];
                    $myphotos = array();
                    foreach ($sizes as $size) {
                        // calculating the part of the image to use for thumbnail
                        $nthumb = imagecreatetruecolor($size, $size);
                        imagefill($nthumb, 0, 0, $color);

                        imagecopyresampled($nthumb, $src, 0, 0, 0, 0, $size, $size, $s, $s);

                        $pathtosave = '/var/www/html/SMS_Latest/webroot/img/photo_gallery/' . $newname;
                        if ($resource['type'] == 'image/png') {
                            $qu = 9;
                        } else {
                            $qu = 100;
                        }
                        $saving = $save($nthumb, $pathtosave);
                        if (!$saving) {
                            return 5;
                        }
                        $myphotos[] = $newname;
                        imagedestroy($nthumb);
                        
                    }
                    imagedestroy($src);
                    return $myphotos;
                } else {

                    return 3;
                }
            } else {
                if ($info[1] < 150 || $info[0] < 150)
                    return 2;
                else
                    return 3;
            }

            return 1;
        }
    }

    function upload_error($int = 6) {

        $errors = [
            0 => 'Failed to upload avatar : file you are trying to upload is not an image',
            1 => 'Failed to upload avatar : Unsupported file type',
            2 => 'Failed to upload avatar : Image is so small [min: 150x150]',
            3 => 'Failed to upload avatar : Unsupported file type',
            4 => 'Error Loading avatar, Please try again',
            5 => 'Error Saving image, Please try again',
            6 => 'Ops ! Unknown Error. Please try again'
        ];

        if (in_array($int, $errors)) {
            return $errors[$int];
        } else {
            return $errors[6];
        }
    }

}
