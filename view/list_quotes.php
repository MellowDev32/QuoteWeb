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
            <div class="mb-3">
            <?php if ($authors) { ?>
                <label>Author:</label>
                <select class="form-select" name="authorID">
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
            </div>

            <div class="mb-3">
            <?php if ($categories) { ?>
                <label>Categories:</label>
                <select class="form-select" name="categoryID">
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
            </div>    

            <div class="mb-3">
                <label class="form-label">Limit: </label>
                <input class="form-control" type="number" min="1" name="lim">
            </div>
            <div class="mb-3">
                <input type="submit" value="Submit" class="btn btn-success">
            </div>
        </form>
        <div class="row">
            <?php foreach ($quotes as $post) : ?>
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <blockquote class="card-text"><?= $post['quote'] ?></blockquote>
                            <p><i>-<?= $post['author_name'] ?></i></p>
                            <p style="color: blue"><small><?= $post['category_name'] ?></small></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
  </body>
</html>