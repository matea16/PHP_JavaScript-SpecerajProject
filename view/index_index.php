<?php 
require_once __DIR__ . '/_headerLOGIN.php'; 


if( isset($msg) ){
    echo $msg . '<br>';
}
?>
<hr>
<br>

<form action="index.php?rt=login" method="post">
    <label for="username_input">
        Username:
        <input type="text" name="username" id="username_input">
    </label>
    <br>
    <br>
    <label for="password_input">
        Password:
        <input type="password" name="password" id="password_input">
    </label>
    <br>
    <br>
    <button type="submit">Login</button>
</form>

<?php  require_once __DIR__ . '/_footer.php' ?>