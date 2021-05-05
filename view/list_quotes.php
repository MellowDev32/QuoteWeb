<form action="." method="get" id="make_selection">
        <section id="dropmenus" class="dropmenus">
            <?php if ($authors) { ?>
            <label>Author:</label>
            <select name="authorID">
                <option value="0">View All Authors</option>
                <?php foreach ($authors as $auth) : ?>
                <?php if ($auth['id'] == $authorID) { ?>
                <option value="<?= $auth['id']; ?>" selected>
                    <?php } else { ?>
                <option value="<?= $auth['id']; ?>">
                    <?php } ?>
                    <?= $auth['author']; ?>
                </option>
                <?php endforeach; ?>
            </select>
            <?php } ?>


            <?php if ($categories) { ?>
            <label>Categories:</label>
            <select name="categoryID">
                <option value="0">View All Categories</option>
                <?php foreach ($categories as $cat) : ?>
                <?php if ($cat['id'] == $categoryID) { ?>
                <option value="<?= $cat['id']; ?>" selected>
                    <?php } else { ?>
                <option value="<?= $cat['id']; ?>">
                    <?php } ?>
                    <?= $cat['category']; ?>
                </option>
                <?php endforeach; ?>
            </select>
            <?php } ?>
            <label>Limit: </label>
            <input type="number" min="1">
            <input type="submit" value="Submit" class="button blue button-slim">
        </section>
    </form>

<?php foreach ($quotes as $post) : ?>
    <?php if($authorID && $categoryID){ ?>
        <?php if($authorID == $post['authorID'] && $categoryID == $post['categoryID']){ ?>
            <div class="row">
                <div class="col">
                    <p><?= $post['quote'] ?></p>
                    <p><?= $post['author_name'] ?></p>
                    <p><?= $post['category_name'] ?></p>
                </div>
            </div>
        <?php } ?>
    <?php } else if ($authorID){ ?>
        <?php if($authorID == $post['authorID']){ ?>
            <div class="row">
                <div class="col">
                    <p><?= $post['quote'] ?></p>
                    <p><?= $post['author_name'] ?></p>
                    <p><?= $post['category_name'] ?></p>
                </div>
            </div>
        <?php } ?>
    <?php } else if ($categoryID){ ?>
        <?php if($categoryID == $post['categoryID']){ ?>
            <div class="row">
                <div class="col">
                    <p><?= $post['quote'] ?></p>
                    <p><?= $post['author_name'] ?></p>
                    <p><?= $post['category_name'] ?></p>
                </div>
            </div>
        <?php } ?>
    <?php } else { ?>
        <div class="row">
                <div class="col">
                    <p><?= $post['quote'] ?></p>
                    <p><?= $post['author_name'] ?></p>
                    <p><?= $post['category_name'] ?></p>
                </div>
            </div>
    <?php } ?>
<?php endforeach; ?>