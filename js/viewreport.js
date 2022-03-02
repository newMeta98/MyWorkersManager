/*!  - v1.0- 2020-07-20
* Copyright MetaSoft - webprograming */
$(document).ready(function(){

  fetch_viewreport();

    function fetch_viewreport()
        {   var name = $('#name').val();
            var action = "fetch_viewreport";
            $.ajax({
                url:"action/serverView.php",
                method: "POST",
                data:{action:action, name:name},
                success:function(data)
                {
                    $('#viewreport').html(data);
                    $('.viewreport').scrollTop($('.viewreport')[0].scrollHeight);
                }
            });
        }

     $('#menu_isplata').click(function(){
        
                $(".dis_zarada").css("display", "none");
                $(".dis_dug").css("display", "none");
                $("#menu_zarada").css("flex", "2");
                $("#menu_dug").css("flex", "2");
                $("#menu_isplata").css("flex", "10");

                $(".dis_isplata").css("display", "block");

     });
    $('#menu_zarada').click(function(){
                $(".dis_isplata").css("display", "none");
                $(".dis_dug").css("display", "none");
                $("#menu_zarada").css("flex", "10");
                $("#menu_dug").css("flex", "2");
                $("#menu_isplata").css("flex", "2");

                $(".dis_zarada").css("display", "block");
               
     });
    $('#menu_dug').click(function(){
                $(".dis_isplata").css("display", "none");
                $(".dis_zarada").css("display", "none");
                $("#menu_zarada").css("flex", "2");
                $("#menu_dug").css("flex", "10");
                $("#menu_isplata").css("flex", "2");

                $(".dis_dug").css("display", "block");
                
     });


    $('#btn_isplata').click(function(){
            var name = $('#name').val();
            var suma = $('#suma1').val();
            var kursEUR = $('#kursEUR1').val();
            var valuta = $('.valuta1').val();
            var opis = $('#opis1').val();
            var action = 'isplata';

            $.ajax({
                url:"action/serverView.php",
                method: "POST",
                data:{action:action, name:name, suma:suma, 
                  valuta:valuta, opis:opis, kursEUR:kursEUR},
                success:function(data)
                {
                   
                    $('#suma1').val('');
                    $('#opis1').val('');
                    fetch_BALANS();
                    fetch_viewreport();
                }
            });            
     });
    $('#btn_zarada').click(function(){
            var name = $('#name').val();
            var suma = $('#suma2').val();
            var kursEUR = $('#kursEUR2').val();
            var valuta = $('.valuta2').val();
            var opis = $('#opis2').val();
            var action = 'zarada';
            $.ajax({
                url:"action/serverView.php",
                method: "POST",
                data:{action:action, name:name, suma:suma, 
                  valuta:valuta, opis:opis, kursEUR:kursEUR},
                success:function(data)
                {
                    
                    $('#suma2').val('');
                    $('#opis2').val('');
                    fetch_BALANS();
                    fetch_viewreport();
                }
            });            
     });
    $('#btn_dug').click(function(){
            var name = $('#name').val();
            var suma = $('#suma3').val();
            var kursEUR = $('#kursEUR3').val();
            var valuta = $('.valuta3').val();
            var opis = $('#opis3').val();
            var action = 'dug';
            $.ajax({
                url:"action/serverView.php",
                method: "POST",
                data:{action:action, name:name, suma:suma, 
                  valuta:valuta, opis:opis, kursEUR:kursEUR},
                success:function(data)
                {
                  $('#suma3').val('');
                  $('#opis3').val('');
                  fetch_BALANS();
                  fetch_viewreport();
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

    $(document).on('click', '.istorija_li', function(){
      
        var id = $(this).attr('id')
        
        var action = 'Edit_istorija';
        $.ajax({
                url:"action/serverView.php",
                method: "POST",
                data:{action:action, id:id},
                success:function(data)
                {   
                    $(".wrap_dis_all").css("display", "none");
                    $('.alert_msg').html(data);
                }
            });

    });
    $(document).on('click', '#edit_back', function(){
            $('.alert_msg').html('');
            $(".wrap_dis_all").css("display", "block");
    });
    $(document).on('click', '.edit_delete', function(){
      
        var id = $(this).attr('id');
        var action = 'edit_delete_istorija';
        $.ajax({
                url:"action/serverView.php",
                method: "POST",
                data:{action:action, id:id},
                success:function(data)
                {   
                    $('.alert_msg').html(data);
                    $(".wrap_dis_all").css("display", "block");
                    fetch_BALANS();
                    fetch_viewreport();
                }
            });

    });
    $(document).on('click', '.edit_save', function(){
      
        var id = $(this).attr('id');
        var payh = $('#edit_din').val();
        var action = 'edit_save_istorija';
        $.ajax({
                url:"action/serverView.php",
                method: "POST",
                data:{action:action, id:id, payh:payh},
                success:function(data)
                {   
                    $('.alert_msg').html(data);
                    $(".wrap_dis_all").css("display", "block");
                    fetch_BALANS();
                    fetch_viewreport();
                }
            });

    });
});