<?php 
// INSERT INTO `notes` (`sno`, `title`, `description`, `tstamp`) VALUES (NULL, 'Helllooo', 'I am a succesful soul alwaysss!!!', CURRENT_TIMESTAMP);
$insert = false;
$update = false;
$delete = false;

$servername = "localhost";
$username = "root";
$password = "";
$database = "notes";

$conn = mysqli_connect($servername,$username,$password,$database);

if(!$conn){
  die("sorry we failed to connect: ". mysqli_connect_error());
}
// else{
//   echo "connection was successful<br>";
// }


if(isset($_GET['delete'])){ 
  $sno = $_GET['delete'];
  // echo $sno;
  $delete = true;
  $sql = "DELETE FROM notes WHERE sno = $sno";
  $result = mysqli_query($conn, $sql);
}


if($_SERVER['REQUEST_METHOD'] == 'POST'){
  if(isset($_POST['snoEdit'])){
   // update records
   $sno = $_POST["snoEdit"];
   $title = $_POST["titleEdit"];
   $description = $_POST["descriptionEdit"];
 
   $sql = "UPDATE notes SET title = '$title', description = '$description' WHERE notes.sno = $sno";
   $result = mysqli_query($conn,$sql);
   
   if($result){
    // echo "The record has been inserted successfully!<br>";
    $update = true;
  }
  else{
    echo "The record was not inserted successfully Bcoz of this error ----> ". mysqli_error($conn);
  }
  }
  else{
    // insert records
  $title = $_POST["title"];
  $description = $_POST["description"];

  $sql = "INSERT INTO notes (title, description) VALUES ('$title', '$description')";
  $result = mysqli_query($conn,$sql);

  if($result){
    // echo "The record has been inserted successfully!<br>";
    $insert = true;
  }
  else{
    echo "The record was not inserted successfully Bcoz of this error ----> ". mysqli_error($conn);
  }
}
}


?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>iNotes - Note's taking made easy</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">



</head>

<body>

  <!-- Edit modal -->
  <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
  Edit Modal
</button> -->

  <!-- Edit Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="editModalLabel">Edit this Note</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

        </div>
        <div class="modal-body">
          <form action="/crud/index.php" method="post">
            <input type="hidden" name="snoEdit" id="snoEdit">
            <div class="mb-3">
              <label for="title" class="form-label">Note Title</label>
              <input type="text" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
              <label for="description" class="form-label">Note Description</label>
              <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="3"></textarea>
            </div>
            <!-- <button type="submit" class="btn btn-primary">Update Note</button> -->
        </div>

        <div class="modal-footer d-block mr-auto">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>

        </form>
      </div>
    </div>
  </div>


  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">iNotes</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact Us</a>
          </li>

        </ul>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>

  <?php
    if($insert){
      echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success!!</strong> Your note has been inserted successfully.
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>
";
    }
  ?>

<?php
    if($update){
      echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success!!</strong> Your note has been updated successfully.
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>
";
    }
  ?>

<?php
    if($delete){
      echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success!!</strong> Your note has been deleted successfully.
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>
";
    }
  ?>

  <div class="container my-4">
    <h2>Add a Note to iNotes App</h2>
    <form action="/crud/index.php" method="post">
      <div class="mb-3">
        <label for="title" class="form-label">Note Title</label>
        <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
      </div>
      <div class="mb-3">
        <label for="description" class="form-label">Note Description</label>
        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Add Note</button>
    </form>
  </div>

  <div class="container my-4">
    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">S.No</th>
          <th scope="col">Title</th>
          <th scope="col">Description</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "select * from notes";
        $result = mysqli_query($conn,$sql);
        $sno = 0;
        while( $row = mysqli_fetch_assoc($result)){
          $sno = $sno + 1;
          echo "<tr>
          <th scope='row'>". $sno ."</th>
          <td>". $row['title'] ."</td>
          <td>". $row['description'] ."</td>
          <td>  <button class='edit btn btn-sm btn-primary' id=".$row['sno']." >Edit</button> <button class='delete btn btn-sm btn-primary' id=d".$row['sno']." >Delete</button></td>
        </tr>";
    
        }
        ?>
       
      </tbody>
    </table>
  </div>
  <hr>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <!-- // from jquery cdn , datatable is 2nd 1st is jquery -->
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
  <!-- // I use this below links by this link, https://datatables.net/ -->
  <link rel="stylesheet" href="//cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">
  <script src="//cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
  <script>
    let table = new DataTable('#myTable');
    //       $(document).ready( function () {
    //     $('#myTable').DataTable();
    // } );
  </script>

<script>
  edits=document.getElementsByClassName('edit');
  Array.from(edits).forEach((element)=>{
     element.addEventListener("click",(e)=>{
      console.log("edit",);
      tr = e.target.parentNode.parentNode;
      title = tr.getElementsByTagName("td")[0].innerText;
      description = tr.getElementsByTagName("td")[1].innerText;
      console.log(title,description);
      titleEdit.value = title;
      descriptionEdit.value = description;
      snoEdit.value = e.target.id;
      console.log(e.target.id);
      $('#editModal').modal('toggle');
     })
  })

  deletes=document.getElementsByClassName('delete');
  Array.from(deletes).forEach((element)=>{
     element.addEventListener("click",(e)=>{
      console.log("edit",);
      sno = e.target.id.substr(1,);

      if(confirm("Are you sure you want to delete this note!")){
        console.log("yes");
        window.location = `/crud/index.php?delete=${sno}`;
        // if someone directly come to this url so ,
        // TODO : create a form and use post request to submit a form
        // User authentication system , like before delete cheak user is login or not
      }
      else{
        console.log("No");
      }
     })
  })
</script>

</body>

</html>