<?php 
require_once __DIR__ . '/_headerLOGIN.php'; 


if( isset($msg) ){
    echo $msg . '<br>';
}
?>
<hr>
<br>

<form action="index.php?rt=login/addUser" method="post">
    <label for="username_input" class="text">
        Username:
        <input type="text" name="username_signup" id="username_inp" class="text">
    </label>
    <br>
    <br>
    <label for="password_input" class="text">
        Password:
        <input type="password" name="password_signup" id="password_inp" class ="text">
    </label>
	<br>
    <br>
	<label for="email_input" class="text">
        E-mail:
        <input type="text" name="email" id="email_input" class ="text">
    </label>
    <br>
    <br>
    <button class = "text" type="submit">Sign up</button>
</form>

<?php  require_once __DIR__ . '/_footer.php' ?>