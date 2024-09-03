
<?php
foreach ($users as $user)
{
    echo $user->username . "| <a href='/users/delete/".base64_encode($user->id)."'>Delete</a> <br>";
}
?>

<form action="/users/create" method="post">
    <input type="`text" name="username">
</form>