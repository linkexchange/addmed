<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Upload extends MX_Controller{
    public function index(){
        header('Content-type: application/json');
        $folder = base_url().'uploads/images/';
        $config['upload_path'] = './uploads/images/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']	= '100000';
        //$config['max_width']  = '1024';
        //$config['max_height']  = '768';
        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload("userfile"))
        {
            echo $this->upload->display_errors();
            //$msg.="Gallery Item $item : ".$this->input->post('articleTitle_'.$item)." Not added. ".$this->upload->display_errors()."<br/>";
        }
        else
        {
            $data['image_data'] = array('upload_data' => $this->upload->data());
            $uploaded_file=$data['image_data']['upload_data']['file_name'];
            //$articleData['articleImage']=$uploaded_file;
            $link = array("link" => $folder.$uploaded_file);
           echo json_encode($link);
        }  
    }
}
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
