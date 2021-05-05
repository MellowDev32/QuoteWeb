<?php foreach ($quotes as $post){ ?>
<div class="row">
    <div class="col">
        <p><?= $post['quote'] ?></p>
        <p><?= $post['author_name'] ?></p>
        <p><?= $post['category_name'] ?></p>
    </div>
</div>

<?php } ?>