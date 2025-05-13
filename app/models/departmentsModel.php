<?php

    class departmentsModel extends Model{
        
        public function get_all_departments(){
            $this->database->table('departments as t1');
            $this->database->join('left', 'users as t2', 't1.updated_by = t2.id');
            $this->database->fetch(Database::PDO_FETCH_MULTI);
            $query = $this->database->runSelectQuery( 't1.*, t2.first_name as admin_fname, t2.last_name as admin_lname' );
            return $query;
        }

        public function get_department_by_id($id){
            $this->database->table('departments as t1');
            $this->database->join('left', 'users as t2', 't1.updated_by = t2.id');
            $this->database->where('t1.id', $id);
            $this->database->fetch(Database::PDO_FETCH_SINGLE);
            $query = $this->database->runSelectQuery( 't1.*, t2.first_name as admin_fname, t2.last_name as admin_lname' );
            return $query;
        }

        public function add_department($description, $admin_id){
            date_default_timezone_set('Asia/Manila');

            $row = array(
                'description' => $description,
                'updated_by' => $admin_id,
                'date_created' => date('Y-m-d H:i:s'),
                'date_updated' => date('Y-m-d H:i:s')
            );

            $this->database->table('departments');
            $query = $this->database->runInsertQuery( $row );
            return $query;
        }

        public function edit_department($department_id, $description, $admin_id){
            date_default_timezone_set('Asia/Manila');

            $row = array(
                'description' => ucwords($description),
                'updated_by' => $admin_id,
                'date_updated' => date('Y-m-d H:i:s')
            );

            $this->database->table('departments');
            $this->database->where('id', $department_id);
            $query = $this->database->runUpdateQuery( $row );
            return 1;
        }

        public function delete_department($id){
            $this->database->table('departments');
            $this->database->where('id', $id);
            $this->database->runDeleteQuery();
            return 1;

        }

        public function get_employees_with_no_department(){

            //get_all_employees
            $this->database->table('users');
            $this->database->where('is_staff', 1);
            $this->database->fetch(Database::PDO_FETCH_MULTI);
            $query1 = $this->database->runSelectQuery( 'id' );

            //get_employees_with_departments
            $this->database->table('employees');
            $this->database->fetch(Database::PDO_FETCH_MULTI);
            $query2 = $this->database->runSelectQuery('employee_id');

            $query1_arr = [];
            $query2_arr = [];

            if($query1){
                foreach($query1 as $q1){
                    $query1_arr[] = $q1['id'];
                }
            }

            if($query2){
                foreach($query2 as $q2){
                    $query2_arr[] = $q2['employee_id'];
                }
            }


            $no_departments = array_diff($query1_arr, $query2_arr);
            $nd_user = [];

            foreach($no_departments as $nd){
                $this->database->table('users');
                $this->database->where('id', $nd);
                $this->database->fetch(Database::PDO_FETCH_SINGLE);
                $query = $this->database->runSelectQuery( 'id, first_name, last_name' );
                $nd_user[] = $query;
            }

            return $nd_user;

        }

        public function add_employee_department($dept_id, $emp_id){
            $row = array(
                'employee_id' => $emp_id,
                'department_id' => $dept_id
            );

            $this->database->table('employees');
            $query = $this->database->runInsertQuery( $row );

            return $query;
        }

        public function get_all_employees($department = null){

            $this->database->table('employees as t1');
            $this->database->join('left', 'users as t2', 't1.employee_id = t2.id');

            if($department){
                $this->database->where('department_id', $department);
            }

            $this->database->fetch(Database::PDO_FETCH_MULTI);
            $query = $this->database->runSelectQuery( 't2.id as emp_id, t2.first_name as emp_first_name, t2.last_name as emp_last_name, t2.email as emp_email' );
            return $query;
        }

        public function remove_employee_from_department($dept, $emp){
            $this->database->table('employees');
            $this->database->where('employee_id', $emp);
            $this->database->where('department_id', $dept, 'AND');
            $this->database->runDeleteQuery();
            return 1;
        }

        public function check_department_if_has_employee($id){
            $this->database->table('employees');
            $this->database->where('department_id', $id);
            $this->database->fetch(Database::PDO_FETCH_MULTI);
            $query = $this->database->runSelectQuery(' id ');
            return count($query);
        }

        public function check_department_name($desc){
            $this->database->table('departments');
            $this->database->where('description', $desc);
            $this->database->fetch(Database::PDO_FETCH_SINGLE);
            $query = $this->database->runSelectQuery( 'id' );
            return $query;
        }
    }

?>

