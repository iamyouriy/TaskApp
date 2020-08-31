<br>
<div class="header">
  <div class="row">
    <div class="alertBlock col-7" >
    </div>
    <div class="buttonBlock col-5">
    <button class="btn btn-light btn-sm" id="defSort"><nobr>Default sort</nobr></button>
    <?
    
      if( isset($_SESSION['admin']) and $_SESSION['admin'] == true):
        echo '<button class="btn btn-primary  " id="logOut">Log out</button>';
      else:
        echo '<button class="btn btn-primary goToSignIn " data-toggle="modal" data-target="#exampleModal">Sign In</button>';
      endif
    ?>
    </div>
  </div>
</div>
<br>
<table class="table">
<thead>
    <tr>
      <form id="form-add" action="" method="post" >
          <th scope="col">  
            <input type="text" class="form-control was-validated" id="InputName" name="usr_name" placeholder="Enter name" >
          </th>
          <th scope="col">  
            <input type="email" class="form-control was-validated" id="InputEmail" name="email" placeholder="Enter email">
          </th>
          <th scope="col">  
            <input type="text" class="form-control was-validated" id="InputTask" name="task_desc" placeholder="Enter Task"> 
          </th>
        
        <th><button type="submit" form='form-add' class="btn btn-primary">Add</button></th>
      </form>
    </tr>
  </thead>
  <thead class="task-table">
    <tr>
      <th scope="col" class="sort" >
          Name 
          <button type="button" class="btn btn-light btn-sm sortBtn" data-sort="usr_name">
              <small class="text-muted"><? if($orderBy == "usr_name"):echo $sort; else: echo "Sort"; endif?>
              </small>
          </button>
        </th>
      <th scope="col" class="sort" >
        Email 
        <button type="button" class="btn btn-light btn-sm sortBtn" data-sort="email">
          <small class="text-muted"><? if($orderBy == "email"):echo $sort; else: echo "Sort";  endif?>
          </small>
        </button>
      </th>
      <th scope="col" class="sort" >
        Task 
        <button type="button" class="btn btn-light btn-sm sortBtn" data-sort="task_desc">
          <small class="text-muted"><? if($orderBy == "task_desc"):echo $sort; else: echo "Sort";  endif?>
          </small>
        </button>
      </th>
      <th scope="col" >Status</th>
    </tr>
  </thead>
  <tbody class="task-table">
<?php foreach ($taskList as $val):?>
   
    <tr >
      <td><?=$val['usr_name']?></td>
      <td><?=$val['email']?></td>
      <td >
        <p class="task edit" data-id_task=<?=$val['id_task']?>><?=$val['task_desc']?></p>
        <small class="text-muted">
          <? 
            if($val['is_edit']):
              echo 'edited by admin';
            endif
          ?>
        </small>
      </td>
      
      <td class="status" data-id_status=<?=$val['id_task']?> data-status=<?=$val['complet']?> >
        <?
            if($val['complet']):
                echo '<img src="public/img/true.png">';
            else:
                echo '<img src="public/img/false.png">';
            endif
        ?>
      </td>
    </tr>
<?php endforeach?>

</tbody>
</table>
<?=$pagination?>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Sign In</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="alertLogin"></div>
      <form id="form-login" action="" method="post">
        <input type="text" id="login" class="form-control was-validated child"  name="login" placeholder="Enter login" required="true">
        <input type="text" id="password" class="form-control was-validated child" name="pass" placeholder="Enter password" required="true">
        <button type="submit" form='form-login' class="btn btn-primary child login-btn">Sign In</button>
      </form>
      </div>
    </div>
  </div>
</div>