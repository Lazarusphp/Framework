
<?php
use App\System\Classes\ErrorHandler\Errors;
?>

<?php
if($errors->hasErrors())
{
    foreach($errors->getErrors() as $error)
    {
        echo $error . "<br>";
    }
}
?>

<form action="/users/update/save" method="post">
    <input type="hidden" name="id" placeholder="id" value="<?php echo $user->id; ?>">
    <input type="text" name="username" placeholder="username" value="<?php echo $user->username; ?>">
    <button>Save</button>
</form>