<form class='editForm' action="?section=tours&action=store" method="post">
   
   <legend>Редактировать тур</legend>
    <input type="hidden" name="id" value="<?=$tour["id"]?>">
    <fieldset>
       
        <label for="title"><br>
            <p>Название тура</p>
            <input type="text" name="title" value="<?=isset($tour["title"])?$tour["title"]:""?>">
        </label>

        <label for="country_id"><br>
           <p>Страна (id)</p>
            <input type="text" name="country_id" value="<?=$tour["country_id"]?>">
        </label>

        <label for="city_id"><br>
           <p>Город (id)</p>
            <input type="text" name="city_id" value="<?=$tour["city_id"]?>">
        </label>

        <label for="hotel_id"><br>
           <p>Отель (id)</p>
            <input type="text" name="hotel_id" value="<?=$tour["hotel_id"]?>">
        </label>

        <label for="checkin_date"><br>
           <p>Дата выылета</p>
            <input type="text" name="checkin_date" value="<?=$tour["checkin_date"]?>">
        </label>

        <label for="checkout_date"><br>
           <p>Дата отъезда</p>
            <input type="text" name="checkout_date" value="<?=$tour["checkout_date"]?>">
        </label>

        <label for="price"><br>
           <p>Цена</p>
            <input type="text" name="price" value="<?=$tour["price"]?>">
        </label><br>

        <label for="description"><br>
            <p>Описание тура</p>
            <textarea name="description" cols='70' rows="15"><?=$tour["description"]?></textarea>
        </label><br>
        
    </fieldset>
    <input type="submit" class="submit" value="Send">
</form>

