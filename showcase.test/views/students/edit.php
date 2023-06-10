<?php   error_reporting(E_ALL);
   ini_set('display_errors', 1);
   ini_set('display_startup_errors', 1);
   ?>

<form action="/update" method="post" class="update">
    <input type="hidden" name="id" value="<?= $student->id ?>">
    <input type="text" name="name" value="<?= $student->name ?>">
    <input type="submit" value="Update">
</form>