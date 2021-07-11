<?php 
require_once __DIR__ . '/_headerLOGIN.php'; 


if( isset($msg) ){
    echo $msg . '<br>';
}
?>
<hr>
<br>

<form action="index.php?rt=login" method="POST">
    <label for="username_input" class="text">
        Username:
        <input type="text" name="username" id="username_input" class="text">
    </label>
    <br>
    <br>
    <label for="password_input" class="text">
        Password:
        <input type="password" name="password" id="password_input" class ="text">
    </label>
    <br>
    <br>
    <button class = "text" type="submit">Login</button>
</form>

<?php  require_once __DIR__ . '/_footer.php' ?>