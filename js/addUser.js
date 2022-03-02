/*!  - v1.0- 2020-07-20
* Copyright MetaSoft - webprograming */
$(document).ready(function(){
var modalReg = document.getElementById("ModalReg");
window.onclick = function(event) {
  if (event.target == modalReg) {
    modalReg.style.display = "none";
  }
}
var spanJoin = document.getElementsByClassName("close")[0];
spanJoin.onclick = function() {
  modalReg.style.display = "none";
}
$('#JoinBtn').click(function(){
  modalReg.style.display = "block";
  $('#addUser')[0].reset();
  $('.modal-title').text("Join");
 });
$('#LoginBtn').click(function(){
  modalLogin.style.display = "block";
  $('#Login_form')[0].reset();
  $('.modal-title').text("Log in");
 }); 

$(document).on('click', '.btn_dodaj_autod', function(){
    var val = $(this).val();
    var wrap = document.getElementById("wrap_autoD");
  if (val == 'uncheck') {
   
    $(this).val('check');
    wrap.style.display = "block";

  }else if(val == 'check'){

    $(this).val('uncheck');
    wrap.style.display = "none"; 

  }
  
  
  
 });
$('#addUser').submit(function(event){
  event.preventDefault();
  var btn_val = $('.btn_dodaj_autod').val();

  var newuser = $('#username').val();
  var job = $('#job').val();
  var password_1 = $('#password_1').val();
  var balans = $('#balans').val();

  var days = '0';
  if (btn_val == 'check') {
    var hours = $('#hours').val();
    var payh = $('#payh').val();
  }else{
    var hours = '0';
    var payh = '0';
  }
  
  
  var action = "reg_user";
    $.ajax({
     url:"action/serverCreate.php",
     method:"POST",
     data:{reg_user:action, newuser:newuser, job:job, password_1:password_1, hours:hours, payh:payh, balans:balans, btn_val:btn_val},
     success:function(data)
     {  
        $('.alert_msg_redd').text(data);
        if (data == '1') {

            window.location.href = 'index.php';
        }
       
     }
    });
 });
});