/*!  - v1.0- 2020-07-20
* Copyright MetaSoft - webprograming */
$(document).ready(function(){

    $('#search').keyup(function(){
        var txt = $(this).val();
        if (txt != '') 
        {   
            action = 'search'; 
            $.ajax({
            url:"action/serverSearch.php",
            method:"POST",
            data:{action:action, search:txt},
            dataType:"text",
            success:function(data)
              { 
                $('#myUL').html(data);
              }
            });
        }else
        {
            action = 'veiw'; 
            $.ajax({
            url:"action/serverSearch.php",
            method:"POST",
            data:{action:action, search:txt},
            dataType:"text",
            success:function(data)
              { 
                $('#myUL').html(data);
              }
            });
        }
    });
});