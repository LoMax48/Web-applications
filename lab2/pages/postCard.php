  
<div class="card center-block" style="width: 100%;">
    <div class="card-body">
        <form action = "../method/goToPost.php" style="width: 100%;">
            <textarea readonly name="postName" class="postName"><?=$post['Name']?></textarea><br>
            Автор: <textarea readonly name="postAuthor"><?=$post['Author']?></textarea><br>
            Дата добавления: <textarea readonly name="postTime"><?=$post['Time']?></textarea><br>
            <button class="btn btn-primary" type="submit">Подробнее</a>
        </form>
    </div>
</div><br>