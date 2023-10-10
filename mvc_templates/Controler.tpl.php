<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\@@@uModelName@@@;

class @@@uControlerName@@@ extends BaseController
{
	
    protected $@@@modelName@@@;
    protected $validation;
	
	public function __construct()
	{
	    $this->@@@modelName@@@ = new @@@uModelName@@@();
       	$this->validation =  \Config\Services::validation();
		
	}
	
	public function index()
	{

	    $data = [
                'controller'    	=> '@@@controlerName@@@',
                'title'     		=> '@@@crudTitle@@@'				
			];
		
		return view('@@@controlerName@@@', $data);
			
	}

	public function getAll()
	{
 		$response = $data['data'] = array();	

		$result = $this->@@@modelName@@@->select()->findAll();
		
		foreach ($result as $key => $value) {
							
			$ops = '<div class="btn-group">';
			$ops .= '<button type="button" class=" btn btn-sm dropdown-toggle btn-info" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
			$ops .= '<i class="fa-solid fa-pen-square"></i>  </button>';
			$ops .= '<div class="dropdown-menu">';
			$ops .= '<a class="dropdown-item text-info" onClick="save('. $value->@@@primaryKey@@@ .')"><i class="fa-solid fa-pen-to-square"></i>   ' .  lang("Ubah")  . '</a>';
			$ops .= '<div class="dropdown-divider"></div>';
			$ops .= '<a class="dropdown-item text-danger" onClick="remove('. $value->@@@primaryKey@@@ .')"><i class="fa-solid fa-trash"></i>   ' .  lang("Hapus")  . '</a>';
			$ops .= '</div></div>';

			$data['data'][$key] = array(
				@@@ciDataTable@@@
				$ops				
			);
		} 

		return $this->response->setJSON($data);		
	}
	
	public function getOne()
	{
 		$response = array();
		
		$id = $this->request->getPost('@@@primaryKey@@@');
		
		if ($this->validation->check($id, 'required|numeric')) {
			
			$data = $this->@@@modelName@@@->where('@@@primaryKey@@@' ,$id)->first();
			
			return $this->response->setJSON($data);	
				
		} else {
			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}	
		
	}	

	public function add()
	{
        $response = array();

		@@@ciFields@@@

        $this->validation->setRules([
			@@@ciValidation@@@
        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form
			
        } else {

            if ($this->@@@modelName@@@->insert($fields)) {
												
                $response['success'] = true;
                $response['messages'] = lang("Berhasil menambahkan data") ;	
				
            } else {
				
                $response['success'] = false;
                $response['messages'] = lang("Gagal menambahkan data") ;
				
            }
        }
		
        return $this->response->setJSON($response);
	}

	public function edit()
	{
        $response = array();
		
		@@@ciFields@@@

        $this->validation->setRules([
			@@@ciValidation@@@
        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form

        } else {

            if ($this->@@@modelName@@@->update($fields['@@@primaryKey@@@'], $fields)) {
				
                $response['success'] = true;
                $response['messages'] = lang("Berhasil perbarui data");	
				
            } else {
				
                $response['success'] = false;
                $response['messages'] = lang("Gagal Perbarui data");
				
            }
        }
		
        return $this->response->setJSON($response);	
	}
	
	public function remove()
	{
		$response = array();
		
		$id = $this->request->getPost('@@@primaryKey@@@');
		
		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
			
		} else {	
		
			if ($this->@@@modelName@@@->where('@@@primaryKey@@@', $id)->delete()) {
								
				$response['success'] = true;
				$response['messages'] = lang("Berhasil menghapus data");	
				
			} else {
				
				$response['success'] = false;
				$response['messages'] = lang("Gagal menghapus data");
				
			}
		}	
	
        return $this->response->setJSON($response);		
	}	
		
}	
