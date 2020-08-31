<?php
namespace app\controllers;

use app\core\Controller;
use app\lib\Pagination;

class HomeController extends Controller
{
    public $db;
    public function loadPage()
        {
            $pagination = new Pagination($this->route, $this->model->taskCount(), 3);
            $taskList = $this->model->taskList($this->route);

            if(!empty($_POST) and isset($_POST['defaultSort']))
                {
                    $_SESSION['orderBy'] = 'id_task';
                    $_SESSION['sort'] = 'DESC';
                    $this->view->message($_SESSION['orderBy']);
                }

            if(!empty($_POST) and isset($_POST['sort']))
                {
                    $_SESSION['orderBy'] = $_POST['sort'];
                    
                    if(isset($_SESSION['sort']) and $_SESSION['sort'] == 'ASC')
                        {
                            $_SESSION['sort'] = 'DESC';
                        }else{
                            $_SESSION['sort'] = 'ASC';
                        }
                    $this->view->message($_SESSION['orderBy']);
                }
            if(isset($_SESSION['orderBy']) ) 
                {
                    $taskList = $this->model->taskList($this->route, $_SESSION['orderBy'], $_SESSION['sort']);
                }               
            if(!empty($_POST) and isset($_POST['usr_name']))
                {   
                    if($_POST['usr_name'] == '' or $_POST['email'] == '' or $_POST['task_desc'] == '')
                        {
                            $this->view->message("addFalse");
                        }else{
                            $_POST['id'] = $this->model->addTask()[0]['LAST_INSERT_ID()'];
                            $this->view->message("add", $_POST);
                        }
                   
                }elseif (!empty($_POST) and isset($_POST['task_edit']) )
                {
                    if($_SESSION['admin'] == true)
                        {
                            $this->model->editTask();
                            $this->view->message("edit", $_POST);
                        }else{
                            $this->view->message("dontedit");
                        }
                   

                }elseif (!empty($_POST) and isset($_POST['complet']) and $_SESSION['admin'] == true)
                {

                    $this->model->editStatus();
                    $this->view->message("editStatus", $_POST);

                }elseif (!empty($_POST) and isset($_POST['login']))
                {
                    if(!empty($_POST) and $_POST['login'] == 'admin' and $_POST['pass'] == 123)
                        {

                            $_SESSION['admin'] = true; 
                            $this->view->message("login");

                        }elseif(!empty($_POST) and $_POST['login'] == '' and $_POST['pass'] == '')
                        {

                            $this->view->message("emptyField");

                        }elseif(!empty($_POST)){

                            $this->view->message("incorrect");

                        }
                                      
                }elseif (!empty($_POST) and isset($_POST['logout']))
                {
                    $_SESSION['admin'] = false; 
                    $this->view->message("logout");
                }
            
            $vars = 
                [
                    'pagination' => $pagination->get(),
                    'taskList' => $taskList,
                    'sort' => $_SESSION['sort'] ?? 'DESK',
                    'orderBy' => $_SESSION['orderBy'] ?? 'id_task'

                ];

            $this->view->render("Task App", $vars);
           
        }
}

