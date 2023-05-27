<?php
include('./connect.php');
$id = $_GET['id'];
if (isset($_GET['id'])) {
    $sql = "select * from categories where id = $id";
    $statement = $db->query($sql);
    $result = $statement->fetchAll();
}
if (isset($_POST['submit'])) {
    $data = [
        ':id' => $_POST['id'],
        ':name' => $_POST['name'],
        ':description' => $_POST['description'],
        ':status' => $_POST['status'] == 'active'  ? 1 : 0,
    ];
    $sql = "UPDATE categories SET name=:name,description=:description, status=:status WHERE id=:id";
    $statement= $db->prepare($sql);
    $statement->execute($data);
    if($statement){
        header("location: index.php");
    }
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
    <div class="container w-50">
        <h2>Edit Category</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Category Name:</label>
                <input type="text" name="name" class="form-control" value="<?php echo  $result[0]['name'] ?? ""; ?>" placeholder="Enter category name">

            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Category Descripion:</label>
                <textarea class="form-control" name="description" rows="3" placeholder="Enter category description"> <?php echo $result[0]['description'] ?? "" ?></textarea>

            </div>
            <label for="exampleFormControlInput1" class="form-label">Category Status:</label>
            <select class="form-select" name="status" aria-label="Default select example">
                <option value="" selected>Select status</option>
                <option <?php echo  $result[0]['status'] == 1 ? "selected" : "" ?> value="active">Active</option>
                <option <?php echo   $result[0]['status'] == 0 ? "selected" : "" ?> value="inactive">Inactive</option>

            </select>
            <input class="btn btn-primary mt-2" type="submit" name="submit" value="Update">
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>