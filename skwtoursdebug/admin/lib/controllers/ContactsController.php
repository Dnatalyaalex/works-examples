<?php

class ContactsController extends Controller {

    public function ContactInformation() 
    {
        echo "<div class='contacts'>
        <div id='about'>
            <h6><strong>СВЯЖИТЕСЬ С НАМИ!</strong></h6>
            <p>Мы хотим убедиться, что ваша поездка - это все, о чем вы могли мечтать. Если вы хотите получить вдохновение и руководство при планировании вашего следующего приключения или вам нужна помощь с существующим бронированием, наши эксперты по туризму всегда готовы помочь.</p>
            <p>Отправьте нам электронное письмо или позвоните нашей команде, чтобы забронировать билеты, спланировать свое приключение или получить помощь по любым проблемам, с которыми вы столкнетесь на этом пути. Наша команда Global Travel Help всегда готова помочь с любыми возникшими у вас проблемами.</p>
        </div>
        
        <div class='phones'>
            <h6 class='text-uppercase mb-4 font-weight-bold'>Контакты</h6>
              <i class='fas fa-home mr-3'></i> Харьков, ул. Пушкинская 128<br>
              <i class='fas fa-envelope mr-3'></i> info@gmail.com<br>
              <i class='fas fa-phone mr-3'></i> + 38 (096) 852 41 18<br>
              <i class='fas fa-print mr-3'></i> + 38 (063) 852 41 18<br>
        </div>
        
        <div class='form'>
            <h6><strong>НАПИШИТЕ НАМ СООБЩЕНИЕ</strong></h6><br><br>
            <form>
                <div class='form-group'>
                    <label for='exampleFormControlInput1'>Email</label>
                    <input type='email' class='form-control' id='exampleFormControlInput1' placeholder='name@example.com'><br><br>
                    <label for='exampleFormControlTextarea1'>Сообщение</label><br>
                    <textarea class='form-control' id='exampleFormControlTextarea1' rows='4'></textarea>
                </div>
            </form>
        </div>
        
        </div>
        
        ";
    }
}
?>