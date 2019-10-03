<?php

class ContactsController extends Controller {

    public function ContactInformation() 
    {
        echo "<div class='contacts'>
        <div id='about'>
            <h4><strong>Мы всегда рады Вам!</strong></h4>
            <p>Туристическая фирма Via Travel, готова организовать Ваш отдых или путешествие от А до Я. Уникальная программа поиска туров, позволяет менеджерам туристического отдела за считанные минуты подобрать горящий или заранее запланированный тур по наиболее интересной цене. </p>
            <p>Наши партнёры это лидеры туристической индустрии – поэтому Вы можете быть уверенны, что спектр предлагаемых нами услуг будет предоставлен на высшем уровне.</p>
        </div>
        
        <div class='phones'>
            <h6 class='text-uppercase mb-4 font-weight-bold'>Контакты</h6>
              <i class='fas fa-home mr-3'></i> Харьков, ул. Пушкинская 128<br>
              <i class='fas fa-envelope mr-3'></i> info@gmail.com<br>
              <i class='fas fa-phone mr-3'></i> + 38 (096) 852 41 18<br>
              <i class='fas fa-print mr-3'></i> + 38 (063) 852 41 18<br>
        </div>
        
        <div class='form'>
            <form method='post' action=''>
                <h6><strong>НАПИШИТЕ НАМ СООБЩЕНИЕ</strong></h6>
                <div class='form-group'>
                    <label for='exampleFormControlInput1'>Email</label>
                    <input type='email' class='form-control' id='exampleFormControlInput1' placeholder='name@example.com'><br>
                    <label for='exampleFormControlTextarea1'>Сообщение</label><br>
                    <textarea class='form-control' id='exampleFormControlTextarea1' rows='4'></textarea>
                    <input type='submit' class='btn-primary' id='button' value='Отправить'>
                </div>
            </form>
        </div>
        
        </div>
        
        ";
    }
}
?>