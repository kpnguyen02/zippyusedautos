<?php include("view/header.php") ?>
<?php if ($types) { ?>
    <section>
        <h1>Types List</h1>
        <?php foreach ($types as $type) : ?>
            <div>
                <p><?=$type['type'] ?></p>
            </div>
            <div>
                <form action="." method="post">
                    <input type="hidden" name="action" value="delete_type">
                    <input type="hidden" name="type_id" value="<?= $type['id'] ?>">
                    <button class="remove-button">X</button>
                </form>
            </div>
        <?php endforeach; ?>
    </section>
    <?php } else { ?>
        <p>No types exist yet.</p>
    <?php } ?>

    <section>
        <h2>Add Types</h2>
        <form action="." method="post">
            <input type="hidden" name="action" value="add_type">
            <div>
                <label>Name:</label>
                <input type="text" name="type_name" maxlength="255" placeholder="Name" autofocus required>
            </div>
            <div>
                <button type="submit">Add</button>
            </div>
        </form>
    </section>

    <br>

    <p><a href=".">View/Add Inventory</a></p>
<?php include("view/footer.php") ?>