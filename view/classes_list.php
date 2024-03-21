<?php include("view/header.php") ?>
<?php if ($classes) { ?>
    <section>
        <h1>Classes List</h1>
        <?php foreach ($classes as $class) : ?>
            <div>
                <p><?=$class['class'] ?></p>
            </div>
            <div>
                <form action="." method="post">
                    <input type="hidden" name="action" value="delete_class">
                    <input type="hidden" name="class_id" value="<?= $class['id'] ?>">
                    <button class="remove-button">X</button>
                </form>
            </div>
        <?php endforeach; ?>
    </section>
    <?php } else { ?>
        <p>No classes exist yet.</p>
    <?php } ?>

    <section>
        <h2>Add Classes</h2>
        <form action="." method="post">
            <input type="hidden" name="action" value="add_class">
            <div>
                <label>Name:</label>
                <input type="text" name="class_name" maxlength="255" placeholder="Name" autofocus required>
            </div>
            <div>
                <button type="submit">Add</button>
            </div>
        </form>
    </section>

    <br>

    <p><a href=".">View/Add Inventory</a></p>
<?php include("view/footer.php") ?>