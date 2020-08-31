<?php

namespace app\model;

use app\lib\Db;

class Model
{
    
    public $db;

    public function __construct()
        {
            $this->db = new Db;
        }

    public function getAllTasks()
        {
            return $this->db->row('SELECT * FROM task ORDER BY id_task DESC');
        }
        
    public function addTask()
        { 
            $this->db->query("INSERT INTO task (usr_name, email, task_desc)  VALUES (:usr_name, :email, :task_desc)", $_POST);
            return $this->db->row("SELECT LAST_INSERT_ID()");
        }

    public function editTask()
        {
            $this->db->query("UPDATE task  SET task_desc=:task_edit , is_edit=1 WHERE id_task=:id_task", $_POST); 
        }

    public function editStatus()
        {  
            $this->db->query("UPDATE task   SET complet=:complet WHERE id_task=:id_task", $_POST); 
        }

    public function taskCount()
        {
            return $this->db->column('SELECT COUNT(id_task) FROM task');
        }

    public function taskList($route, $order = 'id_task', $sort = 'DESC')
        {
            $max = 3;
            $params = 
                [
                    'maxTask' => $max,
                    'getStart' => ((($route['page'] ?? 1) - 1) * $max), 
                ];
            return $this->db->row('SELECT * FROM task ORDER BY '.$order.' '.$sort.' LIMIT :getStart, :maxTask', $params);
        }
}