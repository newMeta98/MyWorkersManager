/*!  - v1.0- 2020-07-20
* Copyright MetaSoft - webprograming */
$(document).ready(function(){

 fetch_viewreport();
setInterval(function(){ 
    fetch_BALANS(); 
}, 1000);


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
      
        var id = $(this).attr('id');
        
        var action = 'Edit_istorijaUser';
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
    $(document).on('click', '#profile_img', function(){
            
        var val = $(this).val();
        var form = document.getElementById("image_form");

          if (val == 'uncheck') {
            
            $(this).val('check');
            form.style.display = "block";

          }else if(val == 'check'){
            
            $(this).val('uncheck');
            form.style.display = "none"; 
            }
    });

$('#image_form').submit(function(event){
  event.preventDefault();
    var image_name = $('#image').val();
    var name = $('#name').val(); 

  if(image_name == '')
  {
   alert("Please Select Image");
   return false;
  }
  else
  {
   var extension = $('#image').val().split('.').pop().toLowerCase();
   if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
   {
    alert("Invalid Image File");
    $('#image').val('');
    return false;
   }
   else
   {
    $.ajax({
     url:"action/serverView.php",
     method:"POST",
     data:new FormData(this),
     contentType:false,
     processData:false,
     success:function(data)
     {  
        window.location.reload();
     }
    });
   }
  }
 });

   
});