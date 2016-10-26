 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Blog_model extends CI_Model {
        

        public function num_entries(){
            return $this->db->get('entries')->num_rows();
        }


        public function get_entries($per_page){
              $this->db->order_by('dat DESC');
              $datos= $this->db->get('entries',$per_page, $this->uri->segment(3));
              return $datos->result();
        }

        public function entry_espec($id){
            $this->db->select('*');
            $this->db->from('entries');
            $this->db->where('id',$id);
            $query = $this->db->get();
            $resu = $query->row();
            return $resu;

        }

        // cehcar para hacerlo por medio del cuerpo.
        public function del_entri($fecha){
           $this->db->where('dat',$fecha);
            return $this->db->delete('entries');
        }



        public function insert_entries($table, $data){
            return $this->db->insert($table, $data);
        }

         public function update_entries($id,$title,$body,$filename)
        {
            $data = array(
            'title' =>$title,
            'body' => $body,
            'filename' =>$filename        );
        $this->db->where('id', $id);
        return $this->db->update('entries', $data);

        }
        public function delete_entries($id){
            $this->db->where('id',$id);
            return $this->db->delete('entries');
        }

        public function call_entrie($fecha){
            $this->db->select('*');
            $this->db->from('entries');
            //$this->db->where('title',$titulo);
            $this->db->where('dat',$fecha);
            $query = $this->db->get();
            $fila = $query->row();
            return $fila;

        }







        public function num_comments($entri){
            $this->db->where('entry_id',$entri);
            $this->db->where('report !=',"si");
            return $this->db->get('comments')->num_rows();
        }

        public function get_comments($per_page){

        	$this->db->where('entry_id', $this->uri->segment(3));
            $this->db->where('report !=',"si");
        	$this->db->order_by('dat DESC');
			$data = $this->db->get('comments',$per_page, $this->uri->segment(4));
            return $data->result();
        }

        public function get_commentsb(){
            $this->db->where('report',"si");
            $this->db->order_by('author DESC');
            $data = $this->db->get('comments');
            return $data->result();
        }
        public function cont_commentsb(){
            $this->db->where('report',"si");
            return  $data = $this->db->get('comments')->num_rows;
            
        }

        public function delbann($cont){
            
            return $this->db->where('body',$cont)->delete('comments');
        }
        public function updbann($cont){
            $report = array(
                'report'=> "no");
            return $this->db->where('body',$cont)->update('comments',$report);

        }
        public function bannuser($user){
            $datos = array(
                'bann'=>"si");
            return $this->db->where('user',$user)->update('users',$datos);
        }

      /*  public function get_comment($per_page){
            $this->db->order_by('dat DESC');
            $data = $this->db->get('comments',$per_page, $this->uri->segment(3));
            return $data->result();

        }*/
        public function insert_comments($table,$data){
        	return $this->db->insert($table,$data);
        }
       // public function delete_comments($id){
         //   $this->db->where('id',$id);
           // return $this->db->delete('comments');
        //}




//registro de usuario
        public function check_user_ex($user,$mail){
            $this->db->from('users');
            $this->db->where('user',$user);
            $this->db->or_where('email',$mail);
            $data = $this->db->get();
            if($data->num_rows() > 0){
                return false;
            }else{
                return true;
            }
        }

        public function insert_user($table,$data){
        	return $this->db->insert($table,$data);
        }

        public function logeous($user){
        	$this->db->select('*');
        	$this->db->from('users');
        	$this->db->where('user',$user);
        	$query = $this->db->get();
            $resu = $query->row();
            return $resu;
        	

        }
        public function reportar($author,$body){
            $data = array(
                'report' => "si");
            $this->db->where('author',$author);
            $this->db->where('body',$body);
            $this->db->update('comments',$data);
        }




        public function get_users(){
            return $this->db->where('bann',"si")->get('users')->result();
        }
       
       public function rm_ban($user){
        $data = array(
            'bann'=>"no");
        return $this->db->where('user',$user)->update('users',$data);
       }
       public function rm_user($user){
        return $this->db->where('user',$user)->delete('users');
       }

       public function get_usersa(){
        $this->db->where('type_user',"user");
        return $this->db->get('users')->result();
       }
       public function user_admin($user){
        $data = array(
            'type_user' => "admin");
        return $this->db->where('user',$user)->update('users',$data);
       }
        
    }
