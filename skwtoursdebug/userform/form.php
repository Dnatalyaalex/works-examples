<form class = 'editForm' action='?store' method='post'>
      <input type='hidden' name='link' value='http://skwtoursdebug/?tour=<?=$_GET["orderTour"]?>'>
        <h5><b>Заполните поля и наш агент свяжется с вами</b></h5><br>
      <label for='name'>
      <p>Имя</p>
        <input type='text' name='name'>
      </label>
      <label for='phone'>
      <p>Номер телефона</p>
        <input type='text' name='phone'>
      </label>
      <input class="submit" type="submit" value="Send">
</form>