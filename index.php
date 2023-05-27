<?php
include("./connect.php");

try {
    $statement = $db->query("SELECT * FROM categories order by created_at");
    $categories = $statement->fetchAll();
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kaven</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-2">
    <h2>Categories</h2>
        <div class="row">
            <div class="col-6">
                <?php include('./add.php') ?>
            </div>
            <div class="col-6">
            <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $key=>$cat) : ?>
                    <tr>
                        <th scope="row"><?php echo $key+ + 1  ?></th>
                        <td><?php echo $cat['name']  ?></td>
                        <td><?php echo $cat['description']  ?></td>
                        <td><?php echo  $cat['status'] == 1 ? "<p class='text-success'>Active</p>" : "<p class='text-danger'>InActive</p>";  ?></td>
                        <td>
                        <a href="edit.php?id=<?php echo $cat['id'] ?>" class="btn btn-info">Edit</a>
                        <a href="delete.php?id=<?php echo $cat['id']?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>