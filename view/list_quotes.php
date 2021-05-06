<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>

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
                <input type="number" min="1" name="lim">
                <input type="submit" value="Submit" class="button blue button-slim">
            </section>
        </form>

        <?php foreach ($quotes as $post) : ?>
            <div class="row">
                <div class="col">
                    <p><?= $post['quote'] ?></p>
                    <p><?= $post['author_name'] ?></p>
                    <p><?= $post['category_name'] ?></p>
                </div>
            </div>
        <?php endforeach; ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
  </body>
</html>