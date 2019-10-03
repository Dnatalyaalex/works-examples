<form class='editForm' action="?section=tours&action=storeAdd" method="post">
    <legend>Добавить тур</legend>
        <fieldset>
        <label for="title"><br>
            <p>Название тура</p>
            <input type="text" name="title" value="<?=isset($tour["title"])?$tour["title"]:""?>">
        </label>

        <label for="country_id"><br>
        <p>Страна (id)</p>
        <input type="text" name="country_id" value="">
        </label>

        <label for="city_id"><br>
        <p>Город (id)</p>
        <input type="text" name="city_id" value="">
        </label>

        <label for="hotel_id"><br>
         <p>Отель (id)</p>
        <input type="text" name="hotel_id" value="">
        </label>

        <label for="checkin_date"><br>
         <p>Дата вылета</p>
        <input type="text" name="checkin_date" value="">
        </label>

        <label for="checkout_date"><br>
            <p>Дата окончания тура</p>
        <input type="text" name="checkout_date" value="">
        </label>

        <label for="price"><br>
            <p>Цена ($)</p>
        <input type="text" name="price" value="">
        </label><br>

        <label for="description"><br>    
            <p>Описание тура</p>
            <textarea name="description" cols="70" rows="15" ><?=$tour["description"]?></textarea>
        </label><br>
    </fieldset>
    <input type="submit" class="submit" value="Send">
</form>

