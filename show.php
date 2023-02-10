<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "message";

$conn = mysqli_connect($hostname, $username, $password, $database);

if (!$conn) {
    die("Connection failed" . mysqli_connect_error());
}
// echo "Connected successfully";
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Data Siswa | SMKN 2 KARANGANYAR</title>

    <!-- Img Title -->
    <link href="img/1670048304573.png" rel="icon">

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="css/style.css">

    <!-- Font -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

    <style>
        .sidebar-header .h3 .img {
            width: 140px;
            height: 140px;
        }
    </style>
</head>

<body>

    <!-- Page Content  -->
    <div id="content">

        <!-- Table -->
        <?php
        if (isset($_GET['msg'])) {
            $msg = $_GET['msg'];
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            ' . $msg . '
            </div>';
        }
        ?>
        <div class="col-3 mt-5">
            <form class="d-flex" role="search">
                <input class="form-control me-2" name="cari" type="search" placeholder="Search" autocomplete="off" aria-label="Search" value="<?php if (isset($_GET['cari'])) {
                                                                                                                                                    echo $_GET['cari'];
                                                                                                                                                } ?>">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>

        <table id="example" class="table table-striped text-center" style="width:100%; margin-top: 2rem;">
            <thead class="table-dark border">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">No Hp</th>
                    <th scope="col">Messgae</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($_GET['cari'])) {
                    global $conn;
                    $pencarian = mysqli_real_escape_string($conn, $_GET['cari']);
                    $query = "SELECT * FROM message WHERE name like '%" . $pencarian . "%' or email like '%" . $pencarian . "%' or no_hp like '%" . $pencarian . "%'";
                } else {
                    $query = "SELECT * FROM message";
                }
                $no = 1;
                $ambildata = mysqli_query($conn, $query);
                while ($tampil = mysqli_fetch_array($ambildata)) {
                ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $tampil['name'] ?></td>
                        <td><?= $tampil['email'] ?></td>
                        <td><?= $tampil['no_hp'] ?></td>
                        <td><?= $tampil['message'] ?></td>
                        <td>
                            <!-- <a href="updatesiswa.php?update=<?= $tampil['nis']; ?>" class="link-primary"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a> -->
                            <a href="show.php?delete=<?= $tampil['name']; ?>" class="link-danger" onclick="return confirm('yakin mau menghapus ?')"><i class="fa-solid fa-trash fs-5 me-3"></i></a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <?php
        if (isset($_GET['delete'])) {
            mysqli_query($conn, "DELETE FROM `message` WHERE name='$_GET[delete]'")
                or die(mysqli_error($conn));
            echo "<script>
                    alert('Data Berhasil terhapus');
                    window.location = 'show.php';
                </script>";

            // header("Location: show.php?msg=Data Telah Terhapus");
            // echo "<meta http-equiv=refresh content=2;URL='show.php'>";
        }
        ?>
    </div>
    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
</body>

</html>