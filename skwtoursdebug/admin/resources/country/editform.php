<form class='editForm' action="?section=countries&action=store" method="post">
   <legend>Редактировать страну</legend>
   <fieldset>
        <input type="hidden" name="id" value="<?=$country["id"]?>">
        <label for="title">
            <p>Название страны</p>
            <input type="text" name="title" value="<?=isset($country["title"])?$country["title"]:""?>">
        </label><br>
        <label for="description"><br>
            <p>Описание страны</p>
            <textarea name="description" cols="70" rows="15" ><?=$country["description"]?></textarea>
        </label>
    </fieldset>
    <input  class="submit" type="submit" value="Send">
</form>
