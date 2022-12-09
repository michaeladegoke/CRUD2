<?php
 include 'inc/config.php'; 
 $id = $_GET['id'];

// Set vars to empty values
$first_name = $last_name = $email = $gender = '';
$first_nameErr = $last_nameErr = $emailErr = $genderErr = '';

// Form submit
if (isset($_POST['submit'])) {
    // Validate first-name
    if (empty($_POST['first_name'])) {
        $first_nameErr = 'First-Name is required';
    } else {
        // $name = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $first_name = filter_input(
            INPUT_POST,
            'first_name',
            FILTER_SANITIZE_FULL_SPECIAL_CHARS
        );
    }
    // Validate Second-name
    if (empty($_POST['last_name'])) {
        $second_nameErr = 'last-Name is required';
    } else {
        // $name = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $second_name = filter_input(
            INPUT_POST,
            'last_name',
            FILTER_SANITIZE_FULL_SPECIAL_CHARS
        );
    }
    // Validate email
    if (empty($_POST['email'])) {
        $emailErr = 'Email is required';
    } else {
        // $name = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_input(
            INPUT_POST,
            'email',
            FILTER_SANITIZE_EMAIL
        );
    }
    // Validate gender
    if (empty($_POST['gender'])) {
        $genderErr = 'Pls click a gender';
    } else {
        // $name = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $gender = filter_input(
            INPUT_POST,
            'gender',
            FILTER_SANITIZE_FULL_SPECIAL_CHARS
        );
    }

    if (empty($first_nameErr) && empty($last_nameErr) &&  empty($emailErr) && empty($genderErr)) {
        // add to database
        $sql = "UPDATE 'crud' SET 'first_name'='$first_name', 'last_name'='$last_name', 
        'email'='$email', 'gender'='$gender', WHERE id=$id";

        if (mysqli_query($conn, $sql)) {
            // success
            header('Location: index.php?msg=updated succesfully');
        } else {
            // error
            echo 'Error: ' . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!---Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!---font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>PHP crud Operation</title>
</head>

<body>
    <center>
        <nav class="nav-bar navbar-light item-align-center fs-3 mb-5" style="background-color: #00ff5573;">
            PHP Complete CRUD Application
        </nav>
    </center>
    <div class="container">
        <div class="text-center mb-4">
            <h3>Edit user information</h3>
            <p class="text-muted">Click update after editing any user information</p>
        </div>


        <?php
        $sql = "SELECT * FROM 'crud' WHERE id = $id LIMIT 1";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        ?>

        <div class="container d-flex justify-content-center">
            <form action="<?php echo $name = htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" style="width: 50vw; min-width: 300px;">
                <div class="row mb-3">
                    <div class="col">
                        <label for="first_name" class="form-label">First-Name</label>
                        <input type="text" name="first_name" class="form-control <?php echo $first_nameErr ?
                                                                                        'is-invalid' : null; ?>" value="<?php echo $row['first_name'] ?>">
                        <div class="is-invalid">
                            <?php echo $first_nameErr; ?>
                        </div>
                    </div>

                    <div class="col">
                        <label for="last-name" class="form-label">Last_Name</label>
                        <input type="text" name="last_name" class="form-control <?php echo $last_nameErr ?
                                                                                    'is-invalid' : null; ?>" value="<?php echo $row['last_name'] ?>">
                        <div class="is-invalid">
                            <?php echo $last_nameErr; ?>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control <?php echo $emailErr ?
                                                                                'is-invalid' : null; ?>" value="<?php echo $row['email'] ?>">
                    <div class="is-invalid">
                        <?php echo $emailErr; ?>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label>Gender:</label>
                    <input type="radio" class="form-check-input <?php echo $genderErr ? 'is-invalid' : null; ?>" name="gender" id="male" value="male" <?php echo ($row['gender'] == 'male') ? "checked" : ""; ?>>
                    <label for="male" class="form-input-label">Male</label>&nbsp;
                    <input type="radio" class="form-check-input <?php echo $genderErr ? 'is-invalid' : null; ?>" name="gender" id="female" value="female" <?php echo ($row['gender'] == 'female') ? "checked" : ""; ?>>
                    <label for="female" class="form-input-label">female</label>&nbsp;
                </div>

                <div class="mb-3">
                    <button type="submit" name="submit" class="btn btn-success" href="index.php">Update</button>
                    <a href="index.php" class="btn btn-danger">Cancel</a>
                </div>
        </div>

        <!---Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>