 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Blog_model extends CI_Model {
        

        public function num_entries(){
            try {
                $data = $this->db->get('entries')->num_rows();
                if($data>0){
                    return $data;
                }else{
                    return false;
                }
            } catch (Exception $e) {
                echo "error al contar el numero de entradas";
            }
        }


        public function get_entries($per_page){
            try {
                 $this->db->order_by('dat DESC');
              $datos= $this->db->get('entries',$per_page, $this->uri->segment(3));
              return $datos->result();
            } catch (Exception $e) {
                echo "Error al hacer la consulta de las entradas";
            }
             
        }

        public function entry_espec($id){
            try {
                 $this->db->select('*');
                $this->db->from('entries');
                $this->db->where('id',$id);
                $query = $this->db->get();
                $resu = $query->row();
                return $resu;
            } catch (Exception $e) {
                echo "Error al traer la entrada del post";
            }
           

        }

        // cehcar para hacerlo por medio del cuerpo.
        public function del_entri($fecha){
            try {
                 $this->db->where('dat',$fecha);
            return $this->db->delete('entries');
            } catch (Exception $e) {
                echo "no se elimino la entrada";
            }
          
        }



        public function insert_entries($table, $data){
            try {
               return $this->db->insert($table, $data); 
            } catch (Exception $e) {
                echo "No se inserto la entrada";
            }
        }

         public function update_entries($id,$title,$body,$filename)
        {try {
             $data = array(
            'title' =>$title,
            'body' => $body,
            'filename' =>$filename        );
        $this->db->where('id', $id);
        return $this->db->update('entries', $data);
        } catch (Exception $e) {
            echo "error al actualizar la entrada";
        }
           

        }
        public function delete_entries($id){
            try {
                 $this->db->where('id',$id);
            return $this->db->delete('entries');
            } catch (Exception $e) {
                echo "Error al eliminar la entrada";
            }
           
        }

        public function call_entrie($fecha){
            try {
                $this->db->select('*');
                $this->db->from('entries');
                //$this->db->where('title',$titulo);
                $this->db->where('dat',$fecha);
                $query = $this->db->get();
                $fila = $query->row();
                return $fila; 
            } catch (Exception $e) {
                echo "Error al traer la informacion de la entrada especifica";
            }
           

        }







        public function num_comments($entri){
            try {
                 $this->db->where('entry_id',$entri);
            $this->db->where('report !=',"si");
            $data = $this->db->get('comments')->num_rows();
                if ($data>0) {
                    return $data;
                }else{
                    return false;
                }
            
            } catch (Exception $e) {
                echo "Error al contar los comentarios";
            }
          
        }

        public function get_comments($per_page){
            try {
                $this->db->where('entry_id', $this->uri->segment(3));
            $this->db->where('report !=',"si");
            $this->db->order_by('dat DESC');
            $data = $this->db->get('comments',$per_page, $this->uri->segment(4));
            return $data->result();
            } catch (Exception $e) {
                echo "Error al mostrar los comentarios";
            }
        	
        }

        public function get_commentsb(){
            try {
                  $this->db->where('report',"si");
            $this->db->order_by('author DESC');
            $data = $this->db->get('comments');
            return $data->result();
            } catch (Exception $e) {
               echo "error al mostrar los comentarios baneados"; 
            }
          
        }
        public function cont_commentsb(){
            try {
                $this->db->where('report',"si");
                $data = $this->db->get('comments')->num_rows;
                if ($data>0) {
                    return $data;
                }else{
                    return false;
                }

            } catch (Exception $e) {
                echo "Error al contar los comentarios baneados";
            }
            
            
        }

        public function con_usera(){
            try {
                $this->db->where('type_user',"user");
                $data = $this->db->get('users')->num_rows;
                if ($data>0) {
                    return $data;
                }else{
                    return false;
                }

            } catch (Exception $e) {
                echo "Error al contar los comentarios baneados";
            }
        }

        public function cont_user_ban(){
            try {
                $this->db->where('bann','si');
                $data = $this->db->get('users')->num_rows;
                if($data>0){
                    return $data;
                }else{
                    return false;
                }
            } catch (Exception $e) {
                
            }
        }

        public function delbann($cont){
            try {
                return $this->db->where('body',$cont)->delete('comments');
            } catch (Exception $e) {
                echo "Error al eleminiar el comentario baneado";
            }
        }
        public function updbann($cont){
            try {
                  $report = array(
                'report'=> "no");
            return $this->db->where('body',$cont)->update('comments',$report);

            } catch (Exception $e) {
                echo "Error al quitar el banneo del comentario";
            }
          
        }
        public function bannuser($user){
            try {
                $datos = array(
                'bann'=>"si");
            return $this->db->where('user',$user)->update('users',$datos); 
            } catch (Exception $e) {
                echo "Error al bannear al usuario";
            }
           
        }

      /*  public function get_comment($per_page){
            $this->db->order_by('dat DESC');
            $data = $this->db->get('comments',$per_page, $this->uri->segment(3));
            return $data->result();

        }*/
        public function insert_comments($table,$data){
            try {
                return $this->db->insert($table,$data);  
            } catch (Exception $e) {
                echo "Error al insertar el comentario";
            }
        }
       // public function delete_comments($id){
         //   $this->db->where('id',$id);
           // return $this->db->delete('comments');
        //}




//registro de usuario
        public function check_user_ex($user,$mail){
            try {
                 $this->db->from('users');
            $this->db->where('user',$user);
            $this->db->or_where('email',$mail);
            $data = $this->db->get();
                if($data->num_rows() > 0){
                    return false;
                }else{
                    return true;
                }
            } catch (Exception $e) {
               echo "Error al checar registros duplicados"; 
            }
           
        }

        public function insert_user($table,$data){
            try {
                return $this->db->insert($table,$data);
            } catch (Exception $e) {
                echo "Error al insertar el usuario";
            }
        }

        public function logeous($user){
            try {
                $this->db->select('*');
            $this->db->from('users');
            $this->db->where('user',$user);
            $query = $this->db->get();
            $resu = $query->row();
            return $resu;
            } catch (Exception $e) {
                echo "Error al hacer el match de logeo";
            }
        	
        	

        }
        public function reportar($author,$body){
            try {
                  $data = array(
                'report' => "si");
            $this->db->where('author',$author);
            $this->db->where('body',$body);
            $this->db->update('comments',$data);
            } catch (Exception $e) {
                echo "Error al reportar el comentario";
            }
          
        }




        public function get_users(){
            try {
              return $this->db->where('bann',"si")->get('users')->result();  
            } catch (Exception $e) {
                echo "Error al mostrar los usuarios";
            }
        }
       
       public function rm_ban($user){
        try {
             $data = array(
            'bann'=>"no");
        return $this->db->where('user',$user)->update('users',$data);
        } catch (Exception $e) {
            echo "Error al quitar el banneo";
        }
       
       }
       public function rm_user($user){
        try {
            return $this->db->where('user',$user)->delete('users');
        } catch (Exception $e) {
            echo "Error al Expulsar usuario";
        }
       }

       public function get_usersa(){
        try {
             $this->db->where('type_user',"user");
        return $this->db->get('users')->result();
        } catch (Exception $e) {
            echo "Error al traer a los usuarios";
        }
       
       }
       public function user_admin($user){
        try {
             $data = array(
            'type_user' => "admin");
        return $this->db->where('user',$user)->update('users',$data);
        } catch (Exception $e) {
           echo "Error al actualizar a los usuarios para ser administrador"; 
        }
       
       }
        
    }
