<div class="login">
  <?php
    //ĆIRILICA
    if ($_COOKIE["slova"]=="cirilica") {
      echo ' <span class="innfo">* Поља морају бити дузине 5-15 карактера. Дозвољена су слова, цифре и _.</span>
          <form class="formlogin">
      	  <p>
            <input type="text" name="userName" id="login1" placeholder="Корисничко име">
          </p>
          <p class="separate"></p>
          <p>
            <input type="password" name="password" id="password" placeholder="Лозинка">
          </p>
          <p class="login-submit">
            <button type="submit" class="login-button"></button>
          </p>

          <p class="forgot-password"><a href="naslovna/mail">Заборавили сте корисничко име или лозинку?</a></p>
          <p class="forgot-password"><a href="registracija">Нисте регистровани?</a></p>
        </form>
        <div class="close" id="logg">

      	<a href="#"><img class="close_slika" src="images/arrowup.png" /></a>

      	</div>';
    }
    //LATINICA
    else{
      echo '<span class="innfo">* Polja moraju biti dužine 5-15 karaktera. Dozvoljena su slova, cifre i _.</span>
            <form class="formlogin">
          <p>
            <input type="text" name="userName" id="login1" placeholder="Korisničko ime">
          </p>
          <p class="separate"></p>
          <p>
            <input type="password" name="password" id="password" placeholder="Lozinka">
          </p>

          <p class="login-submit">
            <button type="submit" class="login-button"></button>
          </p>

          <p class="forgot-password"><a href="naslovna/mail">Zaboravili ste korisničko ime ili lozinku?</a></p>
          <p class="forgot-password"><a href="registracija">Niste registrovani?</a></p>
        </form>
        <div class="close" id="logg">

      	<a href="#"><img class="close_slika" src="images/arrowup.png" /></a>

      	</div>';
    }
  ?>
</div>
