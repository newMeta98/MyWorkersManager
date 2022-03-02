<div id="ModalReg" class="modal">
  <!-- Modal content -->
    <div class="modal-content join-content">
      <span class="close">&times;</span>
    <form id="addUser" method="post"> 
     <p>Korisnicko Ime<input type="text" name="username" id="username" placeholder="Korisnicko Ime" /></p>
     <p>Radno mesto<input type="text" name="job" id="job" placeholder="Radno mesto" /></p>
     
     <p>Sifra<input type="password" name="password_1" id="password_1" placeholder="Sifra" /></p>
     <p>Balans<input type="number" name="balans" id="balans" placeholder="din." /></p>
 
     <button class="btn_dodaj_autod" type="button" value="uncheck">Dodja na listu Auto-Dnevnica</button>
<div class="wrap_auto_d" id="wrap_autoD">
    <p>Radnih sati u danu<select id="hours" name="days">
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
  <option value="6">6</option>
  <option value="7">7</option>
  <option value="8">8</option>
  <option value="9">9</option>
  <option selected="selected" value="10">10</option>
</select></p>
  <p>Satnica<input type="text" name="payh" id="payh" placeholder="Satnica" /></p>
</div>   
<div class='alert_msg_redd'></div>
  <input type="submit" class="subbmit_btn" name="createacc" id="createacc" value="Dodaj Korisnika" class="btn btn-info" />
   


    </form>
    </div>
</div>