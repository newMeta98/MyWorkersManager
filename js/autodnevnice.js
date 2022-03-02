/*!  - v1.0- 2020-07-20
* Copyright MetaSoft - webprograming */
$(document).ready(function(){

  fetch_viewreport_AutoD();
  displaylastdate();
  
    function readCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }

    function displaylastdate() {
        var curentdate = curentDate();
        
        var lastdate = readCookie('lastDateCoookie');
        
        if (lastdate == curentdate) {

            var text = `Dnevnice su UPISANE danas`;
        }else{
            
            var text = `Dnevnice NISU upisane danas -> ${lastdate}`;
        }
        $('#showdate').text(text);
    }

    function curentDate() {

        var d = new Date();

        var month = d.getMonth()+1;
        var day = d.getDate();

        var output = (day<10 ? '0' : '') + day + '/' +
            (month<10 ? '0' : '') + month + '/' +
            d.getFullYear() ;

        return output;
        
    }

    function fetch_viewreport_AutoD()
        {   
            var action = "fetch_viewreport_AutoD";
            $.ajax({
                url:"action/serverView.php",
                method: "POST",
                data:{action:action},
                success:function(data)
                {
                    $('#viewreport').html(data);
                    $('.viewreport').scrollTop($('.viewreport')[0].scrollHeight);
                }
            });
        }


    $('#btn_upisiD').click(function(){
        var action = 'upisi_Dnevnice';
        $.ajax({
                url:"action/serverView.php",
                method: "POST",
                data:{action:action},
                success:function(data)
                {
                   $('.alert_msg').html(data);
                   var date = curentDate();
                   document.cookie = "lastDateCoookie="+ date;

                }
            });  
        

    });


    function fetch_BALANS() {
        var name = $('#name').val();
        var action = 'fetch_BALANS';
        $.ajax({
                url:"action/serverView.php",
                method: "POST",
                data:{action:action, name:name},
                success:function(data)
                {
                   $('#user_balans').text(data);
                   
                }
            });  
        
    }
    $( "#myUL" ).submit(function( event ) {
      event.preventDefault();
    });


    $('.accordion').click(function(){
        
        var name = $(this).attr('id');
        var action = 'addToSatnice';
        $.ajax({
                url:"action/serverView.php",
                method: "POST",
                data:{action:action, name:name},
                success:function(data)
                {
                    $('.alert_msg').html(data);
                    fetch_viewreport_AutoD();
                }
            });

    });
    $(document).on('click', '.li_satnica', function(){
      
        var id = $(this).attr('id');
        var action = 'Edit_li';
        $.ajax({
                url:"action/serverView.php",
                method: "POST",
                data:{action:action, id:id},
                success:function(data)
                {   
                    $('.alert_msg').html(data);
                }
            });

    });
    $(document).on('click', '#edit_back', function(){
            $('.alert_msg').html('');

    });

    $(document).on('click', '.edit_delete', function(){
      
        var id = $(this).attr('id');
        var action = 'edit_delete';
        $.ajax({
                url:"action/serverView.php",
                method: "POST",
                data:{action:action, id:id},
                success:function(data)
                {   
                    $('.alert_msg').html(data);
                    fetch_viewreport_AutoD();
                }
            });

    });


    $(document).on('click', '.edit_save', function(){
      
        var id = $(this).attr('id');
        var payh = $('#edit_din').val();
        var hours = $('#edit_h').val();
        var description = $('#edit_description').val();
        var action = 'edit_save';
        $.ajax({
                url:"action/serverView.php",
                method: "POST",
                data:{action:action, id:id, payh:payh, hours:hours, description:description},
                success:function(data)
                {   
                    $('.alert_msg').html(data);
                    fetch_viewreport_AutoD();
                }
            });

    });


});