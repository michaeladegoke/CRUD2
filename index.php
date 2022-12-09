<?php include 'inc/config.php' ?>
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
  <nav class="navba-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573; text-align: center">
    PHP Complete CRUD Application
  </nav>

  <div class="container">
  <?php
    if (isset($_GET['msg'])) {
      $msg = $_GET['msg'];
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
   ' . $msg . '
   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
   </div>';
    }

    ?>
    <a href="add_new.php" class="btn btn-dark mb-3">Add New</a>
       
    <table class="table table-hover table-center">
      <thead class="table-dark">
        <tr>
          <th scope="col">id</th>
          <th scope="col">First-Name</th>
          <th scope="col">Last-Name</th>
          <th scope="col">Email</th>
          <th scope="col">Gender</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>

        <?php

        $sql = 'SELECT * FROM crud';
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
          <tr>
            <td><?php echo $row['id'] ?></td>
            <td><?php echo $row['first_name'] ?></td>
            <td><?php echo $row['last_name'] ?></td>
            <td><?php echo $row['email'] ?></td>
            <td><?php echo $row['gender'] ?></td>
            <td>
              <a href="edit.php?id=<?php echo $row['id'] ?>" class="link-dark">
                <i class="fa-solid fa-pen-to-square fs-5 me-3">
                </i></a>
              <a href="delete.php?id=<?php echo $row['id'] ?>" class="link-dark">
                <i class="fa-solid fa-trash fs-5">
                </i></a>
            </td>
          </tr>
        <?php
        }

        ?>


      </tbody>
    </table>
  </div>

  <!---Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>