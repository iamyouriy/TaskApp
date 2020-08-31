$(document).ready(function()
    {
       
        $('#form-add').submit(function(event)
            {
                var json;
                event.preventDefault();
                $.ajax(
                    {
                        type: $(this).attr('method'),
                        url: $(this).attr('action'),
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(result)
                            {
                                json = jQuery.parseJSON(result);
                                console.log(result);
                                if(json.url)
                                    {
                                        window.location.href = json.url;
                                      
                                    }
                                else
                                    {
                                       if(json.status == 'addFalse')
                                            {
                                                html = '';
                                                html += "<div class='alert alert-danger' role='alert'>";
                                                html += "All fields must be filled";
                                                html += "</div>";
                                                $(".alertBlock").html(html);
                                            }else{
                                                html = '';
                                                html += "<div class='alert alert-success' role='alert'>";
                                                html += "Add success";
                                                html += "</div>";
                                                $(".alertBlock").html(html);
                                                setTimeout(function(){ window.location.reload(); }, 1000);
                                            }
                                        
                                        /*let html = '';
                                        html += '<tr >';
    
                                        html += '<td>'+json.message.usr_name+'</td>';
                                        html += '<td>'+json.message.email+'</td>';
                                        html += '<td class="task edit" data-id_task='+json.message.id+'>'+json.message.task_desc+'</td>';
                                        html += '<td class="status" data-id_status='+json.message.id+'><img src="public/img/false.png"></td>';
                                        html += '</tr>';
                                        $('tbody').prepend(html);*/
                                        
                                    }
                            },
                    });
            });

            $('#form-login').submit(function(event)
            {
                var json;
                console.log(new FormData(this));
                event.preventDefault();
                $.ajax(
                    {
                        type: $(this).attr('method'),
                        url: $(this).attr('action'),
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(result)
                            {
                                json = jQuery.parseJSON(result);
                                console.log(result);
                                if(json.url)
                                    {
                                        window.location.href = json.url;
                                      
                                    }
                                else
                                    {
                                        if(json.status == 'incorrect')
                                            {
                                                html = '';
                                                html += "<div class='alert alert-danger' role='alert'>";
                                                html += "Incorrect login or password";
                                                html += "</div>";
                                                $(".alertLogin").html(html);
                                            }else{
                                                window.location.reload();
                                            }
                                        
                                        
                                    }
                            },
                    });
            });
            $(document).on('click','#logOut', function(){
            
                var json;
                event.preventDefault();
                $.ajax(
                    {
                        type: 'post',
                        url: '',
                        data: {'logout' : true},
                        success: function(result)
                            {
                                json = jQuery.parseJSON(result);
                                console.log(result);
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