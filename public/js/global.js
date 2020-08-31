$(document).ready(function()
    {
        if($('body').hasClass('admin')){
            $(document).on('click','.edit', function(){
                if(!$(this).hasClass('proccesEdited'))
                    {
                        $(this).addClass('proccesEdited');
                        let form = document.createElement('form');
                            form.name = 'form-edit';
                            form.id = 'form-edit';

                        let editArea = document.createElement('input');
                            editArea.value = this.innerHTML;
                        let buttonEdit = document.createElement('button');
                            buttonEdit.form = 'form-edit';
                            buttonEdit.id = 'btnnnn';
                            buttonEdit.type = 'submit'
                            buttonEdit.classList = 'btn btn-primary btn-sm editbtn';
                            buttonEdit.innerHTML = 'Save';

                        this.innerHTML = '';
                        this.appendChild(form);
                        form.appendChild(editArea);
                        form.appendChild(buttonEdit);
                        form.addEventListener('submit', 
                            (event)=>
                            {
                                event.preventDefault();
                                edit(this.dataset.id_task, editArea.value);
                            });
                    }
            });
        let edit = (id, value)=>
            {
                dataEdit = {"id_task":id, "task_edit" : value};
                var json;
                $.ajax(
                    {
                        url: '',
                        type: "POST",
                        data: dataEdit,
                        success: function(result)
                            {
                                json = jQuery.parseJSON(result);
                                if(json.url)
                                    {
                                        window.location.href = json.url;
                                    }
                                else
                                    {

                                        if(json.status == 'dontedit')
                                        {
                                            html = '';
                                                html += "<div class='alert alert-danger' role='alert'>";
                                                html += "You must sign in";
                                                html += "</div>";
                                                $(".alertBlock").html(html);
                                        }else{
                                            $('*[data-id_task="'+json.message.id_task+'"]').html(json.message.task_edit);
                                            $('*[data-id_task="'+json.message.id_task+'"]').removeClass('proccesEdited');
                                        }
                                    }
                            },
                    });
            };
            $(document).on('click','.status', function(){
                let status;
                let elDataStatus = this.dataset.status;
                if(elDataStatus == 0)
                    {
                        status = 1
                    }else{
                            status = 0;
                        }
                let el = this;
                dataStatus = {'id_task': this.dataset.id_status, 'complet': status}
                var json;
                $.ajax(
                    {
                        url: '',
                        type: "POST",
                        data: dataStatus,
                        success: function(result)
                            {
                                json = jQuery.parseJSON(result);
                                if(json.url)
                                    {
                                        window.location.href = json.url;
                                    }
                                else
                                    {
                                        if(json.message.complet == 0)
                                            {
                                                $('*[data-id_status="'+json.message.id_task+'"]').html('<img src="public/img/false.png">');
                                                $('*[data-id_status="'+json.message.id_task+'"]').attr('data-status', 0)
                                                
                                            
                                                
                                            }
                                        else if(json.message.complet == 1)
                                            {
                                                
                                                $('*[data-id_status="'+json.message.id_task+'"]').html('<img src="public/img/true.png">');
                                                $('*[data-id_status="'+json.message.id_task+'"]').attr('data-status', 1)
                                            }
                                            
                                    }
                            },
                    });
            });
           
        }
        $(document).on('click','.sortBtn', function(){
            var json;
            console.log(this.dataset.sort);
            $.ajax(
                {
                    url: '',
                    type: "POST",
                    data: {'sort': this.dataset.sort},
                    success: function(result)
                        {
                            json = jQuery.parseJSON(result);
                            if(json.url)
                                {
                                    window.location.href = json.url;
                                }
                            else
                                {
                                    window.location.reload();
                                }
                        },
                });
        });
        $(document).on('click','#defSort', function(){
            var json;
            console.log(this.dataset.sort);
            $.ajax(
                {
                    url: '',
                    type: "POST",
                    data: {'defaultSort' : 'true'},
                    success: function(result)
                        {
                            json = jQuery.parseJSON(result);
                            if(json.url)
                                {
                                    window.location.href = json.url;
                                }
                            else
                                {
                                    window.location.reload();
                                }
                        },
                });
        });
    });