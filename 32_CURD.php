<?php
//INSERT INTO `notes` (`sno`, `title`, `description`, `T_stamp`) VALUES ('1', 'i will get job of 12 Lpa', 'job job', current_timestamp());

// connecting to Data-Base
$insert = false ;
$Update1 = false ;
$del = false ;
$servername = "localhost";
$username = "root";
$password = "";
$database = "user";


// creat a connection

$conn = mysqli_connect($servername,$username,$password,$database);


// die if connection fail
if (!$conn) {
    # code...
    die("sorry we failed to connect: ".mysqli_connect_error());
}
// **********Get/POST****************





if (isset( $_GET['delete'])) {
    # code...
            $delSno = $_GET['delete'] ;
            // echo $delSno ;
            $sql = "DELETE FROM `notes` WHERE `sno` = $delSno;";

            $result = mysqli_query($conn,$sql) ;

            // alert k liye
            if ($result) {
                # code...
                $del = true ;}

        }



if ($_SERVER['REQUEST_METHOD']=='POST') {
    # code...
    

















    if (isset($_POST['snoEdit'])) {
        # code...
        // echo "yes";
        $title = $_POST['titleEdit'];
        $desc = $_POST['descEdit'];
        $snoEdit = $_POST['snoEdit'];

        $sql = "UPDATE `notes` SET `title` = '{$title}', `description` = '{$desc}' WHERE `notes`.`sno` = $snoEdit;";

        $result = mysqli_query($conn,$sql) ;

        // alert k liye
        if ($result) {
            # code...
            $Update1 = true ;
        }


        
        


    }else{



            $title = $_POST['title'];
            $desc = $_POST['desc'];

            $sql = "INSERT INTO `notes` ( `title`, `description`, `T_stamp`) VALUES ( '$title', '$desc', current_timestamp());";

            $result = mysqli_query($conn,$sql) ;
            if ($result) {
                # code...
                $insert = true ;
            }
        }

}



?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iNotes -Notes taking made easy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

    
    
  </head>
  <body>
<!-- edit trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
  edit modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editModalLabel">Edit this Note</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>


      <!-- inner form -->

      <form action="./32_CURD.php" method="post">
              <div class="modal-body">

                    <input type="hidden" name="snoEdit" id="snoEdit">
                    <div class="mb-3">
                        <label for="note_title" class="form-label">Edit Title</label>
                        <input type="text" class="border border-dark form-control" id="titleEdit" name="titleEdit" aria-describedby="Note Title" required>
                        
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Edit description</label>
                        <textarea class="form-control border border-dark" id="descEdit" name="descEdit" rows="3"></textarea>
                    </div>
                    
                    <!-- <button type="submit" class="btn btn-primary">Change Note</button> -->
                    
                    
                    <!-- inner form -->
                    
                  </div>
                  <div class="modal-footer d-flex ">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <div class="ms-auto"></div>
                </div>
        </form>
    </div>
  </div>
</div>







    <!-- navbar -->
<div class="sticky-top">
    <nav class="navbar bg-primary navbar-expand-lg bg-body-tertiary "  data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img src="./pencil.png" height="40px" alt=""></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="./32_CURD.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contect us</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" aria-disabled="true">Disabled</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
    </nav>

</div>

<!-- alert -->
<?php

if ($insert) {
    # code...
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Succes!</strong> your note has been inserted
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";
}

if ($Update1) {
    # code...
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Succes!</strong> your note has been <strong>Updated!</strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    
}

if ($del) {
    # code...
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Succes!</strong> your note has been <strong>Deleted successfully!</strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    
}

?>

<!-- form -->
<div class="container my-5">
    <h2>Add Note To iNotes</h2>
    <form action="./32_CURD.php" method="post">
    <div class="mb-3">
        <label for="note_title" class="form-label">Note Title</label>
        <input type="text" class="border border-dark form-control" id="title" name="title" aria-describedby="Note Title" required>
        
    </div>
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Note description</label>
        <textarea class="form-control border border-dark" id="desc" name="desc" rows="3"></textarea>
    </div>
    
    <button type="submit" class="btn btn-primary">Add Note</button>
    </form>

</div>

<!-- display -->

<div class="container my-5">
    <?php  ?>
<!-- table -->
<table class="table" id="myTable">
  <thead>
    <tr>
      <th scope="col">Sno</th>
      <th scope="col">Title</th>
      <th scope="col">Desc</th>
      <th scope="col">Action</th>
    </tr>
    
  </thead>
  <tbody>
    <?php
    // using select quary on database
    $sql = "SELECT * FROM `notes`";
    $result = mysqli_query($conn,$sql);

    $n = 0 ;
    // display data
    while ($row = mysqli_fetch_assoc($result)) {
        $n++ ;
        // echo "{$row['sno']}. Title {$row['title']} Desc is {$row['description']} ";
        // echo "<br>";
        echo "<tr>
        <th scope='row'> ". $n ." </th>
        <td>". $row['title'] ."</td>
        <td>". $row['description'] ."</td>
        <td>     <button class='edit btn btn-sm btn-primary' id='{$row["sno"]}' data-bs-toggle='modal' data-bs-target='#editModal'>Edit</button>  
                 &nbsp;&nbsp; 
                 <button class='delete btn btn-sm btn-primary' id='d{$row["sno"]}' name='delSno' >Delete</button>
        </td>
      </tr> ";
        
    }
    ?>
   

    
   
  </tbody>
</table>





</div>
<hr>








 <!-- for edit button -->
    <script>
            edits =document.getElementsByClassName('edit')
            Array.from(edits).forEach((element)=>{
                element.addEventListener("click",(e)=>{
                    console.log("edit ");
                    tr = e.target.parentNode.parentNode ;
                    title = tr.getElementsByTagName("td")[0].innerText ;
                    desc = tr.getElementsByTagName("td")[1].innerText ;
                    console.log(title,desc);
                    titleEdit.value = title ; 
                    descEdit.value = desc ; 
                    snoEdit.value = e.target.id ;
                    console.log(snoEdit.value);


                    
                })
            })


            deletes =document.getElementsByClassName('delete')
            Array.from(deletes).forEach((element)=>{
                element.addEventListener("click",(e)=>{
                    console.log("edit ");
                    delSno = e.target.id.substr(1,) ;

                    if (confirm("Press a button!")) {
                        
                        console.log("Yes");
                        console.log(delSno);
                        window.location = `/32_CURD_PROJECT/32_CURD.php?delete=${delSno} `;
                        
                    }
                    else{
                        console.log("No");
                        console.log(delSno);
                    }
                    
                    
                    


                    
                })
            })


    </script>





<!-- j-Quary -->
<!--  order
1. j-Quary
2. data-table script
3. exicutable code
4. css inside hade
 -->
<script
  src="https://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous"></script>


  <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js">
</script>

  <script>
        let table = new DataTable('#myTable');
    </script>
<!-- j-Quary -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

   



  </body>
</html>