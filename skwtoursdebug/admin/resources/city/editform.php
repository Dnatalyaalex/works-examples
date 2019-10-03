<form class='editForm' action="?section=cities&action=store" method="post">
   
   <legend>Редактировать город</legend>
   <fieldset>
        <input type="hidden" name="id" value="<?=$city["id"]?>">
        <label for="title">
            <p>Город</p>
            <input type="text" name="title" value="<?=isset($city["title"])?$city["title"]:""?>">
        </label>
        <label for="country">
            <p>Страна (id)</p>
            <input type="text" name="country" value="<?=isset($city["country_id"])?$city["country_id"]:""?>">
        </label>
    </fieldset>
    <input  class="submit" type="submit" value="Send">
</form>
