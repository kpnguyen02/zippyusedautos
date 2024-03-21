<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Makes</title>
</head>
<body>
    <h1>Manage Makes</h1>
    <form method="post">
        <label>Add New Make:</label>
        <input type="text" name="make" required>
        <button type="submit" name="add_make">Add Make</button>
    </form>
    <ul>
        <?php foreach ($makes as $make) : ?>
            <li><?= $make['make'] ?>
                <form method="post">
                    <input type="hidden" name="make_id" value="<?= $make['id'] ?>">
                    <button type="submit" name="delete_make">Delete</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
