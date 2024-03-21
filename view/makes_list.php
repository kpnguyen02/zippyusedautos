<?php include('header.php') ?>
<?php if ($makes) { ?>
    <section>
        <h1>Makes List</h1>
        <!-- Display makes -->
        <?php foreach ($makes as $make) : ?>
            <div>
                <p><?= $make['make'] ?></p>
            </div>
            <div>
            <form action="." method="post">
                <input type="hidden" name="action" value="delete_make">
                <input type="hidden" name="make_id" value="<?= $make['id'] ?>">
                <button class="remove-button">X</button>
            </form>
        </div>
        <?php endforeach; ?>
        <?php } else { ?>
            <p>No classes exist yet.</p>
        <?php } ?>
    </section>

    <section>
        <h2>Add Makes</h2>
        <form action="." method="post">
            <input type="hidden" name="action" value="add_make">
            <div>
                <label>Name:</label>
                <input type="text" name="make_name" maxlength="255" placeholder="Name" autofocus required>
            </div>
            <div>
                <button type="submit">Add</button>
            </div>
        </form>
    </section>

    <br>

    <p><a href=".">View/Add Inventory</a></p>

<?php include('view/footer.php') ?>
