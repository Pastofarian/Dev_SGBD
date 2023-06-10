<?php    
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
include('../views/layout/top.php'); ?>
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($students as $student): ?>
            <tr>
                <td><?= $student->name; ?></td>
                <td><button class="xhr show" _id="<?= $student->id; ?>">Show</button></td>
                <td><button class="xhr edit" _id="<?= $student->id; ?>">Edit</button></td>
                <td><button class="xhr delete" _id="<?= $student->id; ?>">Delete</button></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<button class="xhr create">New Student</button>
<?php include('../views/layout/bottom.php'); ?>