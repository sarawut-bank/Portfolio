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
                    <button id="loginButton" type="button" onclick="LoginButton()">เข้าสู่ระบบ</button>
                </div>
            </div>
        </div>

        <div id="modalLog" class="modalLog" >
            <div id="modalLogin" class="modalLogin">
                <div class="modalTop">
                    <span class="closeHidden">&times;</span>
                    <a>เข้าสู่ระบบ</a>
                    <span class="close" onclick="closeModal()">&times;</span>
                </div>
                <div class="modalContent">
                    <form id="loginForm" action="login.php" method="post">
                        <div class="usernameBox">
                            <a>ชื่อผู้ใช้</a><br>
                            <input name="usernameLog" id="username" class="form-control" type="text" required>
                        </div>
                        <div class="passwordBox">
                            <a>รหัสผ่าน</a><br>
                            <input name="passwordLog" id="password" class="form-control" type="password" required>
                        </div>
                        <div class="modalFooter">
                            <div class="logButton">
                                <button id="logButton" type="button" onclick="submitForm()">เข้าสู่ระบบ</button>
                            </div>
                            <div class="regisButton">
                                <button id="regisButton" type="button" onclick="registerButton()">สมัครสมาชิก</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div id="modalRegister" class="modalRegister">
            <div id="modalRegis" class="modalRegis">
                <div class="modalTop">
                    <span class="closeHidden">&times;</span>
                    <a>สมัครสมาชิก</a>
                    <span class="close" onclick="closeModal()">&times;</span>
                </div>
                <div class="modalContent">
                    <form id="regisForm" action="register.php" method="post">
                        <div class="usernameBox">
                            <a>ชื่อผู้ใช้</a><br>
                            <input name="usernameRegis" id="usernameRegis" class="form-control" type="text" required>
                        </div>
                        <div class="nameBox">
                            <div class="name">
                                <a>ชื่อ</a><br>
                                <input name="nameRegis" id="nameRegis" class="form-control" type="text" required>
                            </div>
                            <div class="surename">
                                <a>นามสกุล</a><br>
                                <input name="surenameRegis" id="surenameRegis" class="form-control" type="text" required>
                            </div>
                        </div>
                        <div class="email">
                            <a>อีเมล</a><br>
                            <input name="emailRegis" id="emailRegis" class="form-control" type="email" required>
                        </div>
                        <div class="passwordBox">
                            <a>รหัสผ่าน</a><br>
                            <input name="passwordRegis" id="passwordRegis" class="form-control" type="password" required>
                        </div>
                        <div class="modalFooter">
                            <div class="regisButton">
                                <button id="registerButton" type="submit">สมัครสมาชิก</button>
                            </div>
                            <div class="logButton">
                                <button id="loginButton" type="button" onclick="LoginButton()">เข้าสู่ระบบ</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="content">
            <button type="button" id="addNewButton" onclick="LoginButton()">เพิ่มข้อมูลโบราณสถาน</button>
            <div class="dataBox">
                <div class="dataLists">
                    <div class="boxImg">
                        <img src="images/bg.jpg" alt="">
                    </div>
                    <div class="boxData">
                        <div class="nameTopic">
                            <b>ชื่อสถานที่</b>
                        </div>
                        <div class="nameCW">
                            <b>จังหวัด :</b>
                        </div>
                        <br>
                        <div class="details">
                            <textarea id="dataDetails" cols="73"
                                rows="5">รายละเอียดย่อยรายละเอียดย่อยรายละเอียดย่อยรายละเอียดย่อยรายละเอียดย่อยรายละเอียดย่อยรายละเอียดย่อยรายละเอียดย่อยรายละเอียดย่อยรายละเอียดย่อยรายละเอียดย่อยรายละเอียดย่อยรายละเอียดย่อยรายละเอียดย่อยรายละเอียดย่อยรายละเอียดย่อย</textarea>
                        </div>
                        <div class="seemoreButton">
                            <button id="seemore" type="button">ดูเพิ่มเติม</button>
                        </div>
                    </div>
                </div>
                <div class="dataLists">
                    <div class="boxImg">
                        <img src="images/bg.jpg" alt="">
                    </div>
                    <div class="boxData">
                        <div class="nameTopic">
                            <b>ชื่อสถานที่</b>
                        </div>
                        <div class="nameCW">
                            <b>จังหวัด :</b>
                        </div>
                        <br>
                        <div class="details">
                            <textarea id="dataDetails" cols="73"
                                rows="5">รายละเอียดย่อยรายละเอียดย่อยรายละเอียดย่อยรายละเอียดย่อยรายละเอียดย่อยรายละเอียดย่อยรายละเอียดย่อยรายละเอียดย่อยรายละเอียดย่อยรายละเอียดย่อยรายละเอียดย่อยรายละเอียดย่อยรายละเอียดย่อยรายละเอียดย่อยรายละเอียดย่อยรายละเอียดย่อย</textarea>
                        </div>
                        <div class="seemoreButton">
                            <button id="seemore" type="button">ดูเพิ่มเติม</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


</body>

</html>