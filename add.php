<?php
include("./connect.php");
$status = "";
$errors = array("name" => "", "description" => "", "status" => "");
if (isset($_POST['submit'])) {
    //for name
    if (empty($_POST['name'])) {
        $errors['name'] = "Name is requered!<br>";
    } else {
        $name = $_POST['name'];
    }
    //for description
    if (empty($_POST['description'])) {
        $errors['description'] = "Description is requered!<br>";
    } else {
        $description = $_POST['description'];
    }
    //for status
    if (empty($_POST['status'])) {
        $errors['status'] = "Status is requered!<br>";
    } else {
        $status = $_POST['status'] == 'active' ? 1 : 0;
    }

    if (!array_filter($errors)) {
        $sql = "insert into categories (name,description,status) values (:name,:description,:status)";
        $statement = $db->prepare($sql);
        $statement->execute([
            "name" => $name,
            "description" => $description,
            "status" => $status,
        ]);
        $description = "";
        $status = "";
        $name = "";
        if($statement){
            header("location: index.php");
        }
    }
}
?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Category Name:</label>
                <input type="text" name="name" class="form-control" value="<?php echo $name ?? ""; ?>" placeholder="Enter category name">
                <div class="text-danger">
                    <?php echo $errors['name'] ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Category Descripion:</label>
                <textarea class="form-control" name="description" value="<?php echo $description ?? ""; ?>" id="exampleFormControlTextarea1" rows="3" placeholder="Enter category description"></textarea>
                <div class="text-danger">
                    <?php echo $errors['description'] ?>
                </div>
            </div>
            <label for="exampleFormControlInput1" class="form-label">Category Status:</label>
            <select class="form-select" name="status" aria-label="Default select example">
                <option value="" selected>Select status</option>
                <option <?php echo   $status == 1 ? "selected" : "" ?> value="active">Active</option>
                <option <?php echo   $status == 0 ? "selected" : "" ?> value="inactive">Inactive</option>

            </select>
            <div class="text-danger">
                <?php echo $errors['status'] ?>
            </div>
            <input class="btn btn-primary mt-2" type="submit" name="submit" value="Create Category">
        </form>
   