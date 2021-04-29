<form action="../pages/addPostPage.php">
    <button class="btn btn-outline-info me-2" type="submit">Добавить запись</button>
</form>
<form action="../method/logoutUser.php">
    <button class="btn btn-outline-danger me-2" type="submit">Выход</button>
</form>
<?php
    echo $_SESSION['username'];
?>