<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="js/index.js"></script>    
    <script src="https://kit.fontawesome.com/2dad7caf54.js" crossorigin="anonymous"></script>
    <title>โบราณสถาน</title>
</head>

<body>
    <?php
        session_start();

        if (!isset($_SESSION["username"])) {
            
            header("Location: login.php");
            exit();
        }

        $loggedInUsername = $_SESSION["username"];

        $host = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "miniprojectct319";

        $conn = mysqli_connect($host, $dbUsername, $dbPassword, $dbName);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $query = "SELECT username FROM user WHERE username='$loggedInUsername'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $usernameFromDatabase = $row["username"];
        }

        mysqli_close($conn);
    ?>

    <main>

        <div class="top_bar">
            <div class="allbut">
                <div class="hide">
                    <button id="loginButton" type="button">เข้าสู่ระบบ</button>
                </div>
                <div class="search">
                    <div class="searchBox">
                        <div class="searhIn">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            <input id="searchInput" type="text" placeholder="ค้นหาทั้งหมด">
                        </div>
                        <button id="searchButton" type="button">ค้นหา</button>
                    </div>
                    <div class="selectTypeBox">
                        <select name="" id="typeCW">
                            <option value="" selected>ทุกจังหวัด</option>
                            <option value="">จันทบุรี</option>
                            <option value="">ชลบุรี</option>
                        </select>
                    </div>
                </div>
                <div class="login">
                    <div class="shownameLog"><b><?php echo $usernameFromDatabase; ?></b></div>
                    <form id="logoutForm" action="logout.php" method="post">
                        <button id="logoutButton" type="submit">ออกจากระบบ</button>
                        <input type="hidden" name="logout" value="1">
                    </form>
                </div>
            </div>
        </div>

        <div class="content">
            <button type="button" id="addNewButton" onclick="addNewData()">เพิ่มข้อมูลโบราณสถาน</button>

            <div id="modalAddnew" class="modalAddnew">
                <div id="modalAddData" class="modalAddData">
                    <div class="modalTop">
                        <span class="closeHidden">&times;</span>
                        <a>เพิ่มข้อมูลโบราณสถาน</a>
                        <span class="close" onclick="closeModalAddnew()">&times;</span>
                    </div>
                    <div class="modalContent">
                        <form id="" action="" method="post">
                            <div class="nameBox">
                                <a>ชื่อโบราณสถาน :</a><br>
                                <input name="nameLocation" id="nameLocation" class="form-control" type="text" required>
                            </div>
                            <div class="provinceBox">
                                <a>จังหวัด :</a><br>
                                <input name="province" id="province" class="form-control" type="email" required>
                            </div>
                            <div class="detailsBox">
                                <a>รายละเอียด :</a><br>
                                <textarea name="details" id="details" class="form-control"></textarea>
                            </div>
                            <div class="imgBox">
                                <a>รูป :</a><br>
                                <input name="imgFile" id="imgFile" type="file">
                                <label class="custom-file-upload" for="imgFile">Choose File</label>
                                <p id="file-selected"></p>
                            </div>
                            <div class="modalFooter">
                                <div class="addnewButton">
                                    <button id="addnewButton" type="submit">เพิ่มข้อมูล</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>