<form class='editForm' action="?section=hotels&action=store" method="post">
   <legend>Редактировать отель</legend>
    <input type="hidden" name="id" value="<?=$hotel["id"]?>">
    <fieldset>
        <label for="title"><br>
            <p>Отель</p>
            <input type="text" name="title" value="<?=isset($hotel["title"])?$hotel["title"]:""?>">
        </label>
        <label for="city"><br>
            <p>Город (id)</p>
            <input type="text" name="city" value="<?=isset($hotel['city_id'])?$hotel['city_id']:''?>">
        </label>
        <label for="category"><br>
            <p>Категория</p>
            <input type="text" name="category" value="<?=isset($hotel['category'])?$hotel['category']:""?>">
        </label><br>
        
        <label for="description"><br>
            <p>Описание отеля</p>
            <textarea name="description" cols="70" rows="15"><?=$hotel["description"]?></textarea>
        </label>
    </fieldset><br>
    <input class="submit" type="submit" value="Send">
</form>


