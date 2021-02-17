<?php
	include "connect.php";
	$sql = "select * from wp_giohangnhanvien";
    $aps = mysqli_query($link,$sql);
    
    $soluonggio = "select count(*) as df from wp_giohangnhanvien";
    $abc = mysqli_query($link,$soluonggio);

    while($record = $abc->fetch_array())
    { $tong = $record['df']; } 
 ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nhập Số Lượng</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="ThemGio.css">
    <script type="text/javascript" src="js/muahang.js"></script>
</head>

<body>
<?php
include	'../connect.php';
session_start();

if(!isset($_SESSION['user']) or ($_SESSION['phanquyen']==0))
{
?>

    <form action="../dangnhap/dn.php" method="post">
        <span>
            <p>Username: <input type="text" name="username"></p> <br>
            <p>Password: <input type="password" name="password"></p> <br>
        </span>
        <input name="login" type="submit" value="Đăng Nhập" /><br>
    </form>
    <?php
}
?>
    <div class="khung1">
        <ul class="khung11">
            <li>
                <a href="../index.php">
                    <h1 style="color: #006633">mây<h1 style="color: #FF0000">book<h1 style="color: #006633">.com</h1>
                        </h1>
                    </h1>
                </a>
            </li>
        </ul>
        <div class="form1">
            <input type="text" placeholder="  Tìm kiếm tựa sách,tác giả">
        </div>
        <div class="form2">
            <input type="button" value="Tìm sách">
        </div>
        <div class="Image1">
            <?php
        include "../connect.php";
            $username = $_SESSION['user'];
	        $sql = "select * from wp_dangnhap where user='$username'";
		    $result = mysqli_query($link,$sql);
		    $row = mysqli_fetch_array($result);?>
            <a href=""><img src="../images/<?php echo $row['hinhanh']; ?>"
                    style="width: 60px; height:60px;"></a>
        </div>
        <div class="khung12">
            <a href="">Chào Bạn <?= $_SESSION['user']?><a href="../dangnhap/logout.php"> | Thoát</a></a>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="khung121">
        <div class="khug"></div>
        <div class="khung2" style="height:60px;">
            <h1 style="text-align:center;color:white;">Nhân Viên <a href="" style="color:red;"><?= $_SESSION['user']?> <a href="GioHang.php"><img width="50" height="50"
                        src="https://cdn.pixabay.com/photo/2015/10/22/16/42/icon-1001596_960_720.png" alt=""></a></a></h1>
                
        </div>
    </div>
    <div class="clefix"></div>
    </div>

    <div class="ABX">
        <div class="DangNhap">
            <table border="1" style="width:500px;background-color:white;text-align:center;">
                <tr style="color:#003333;background-color:#99CCCC;">
                    <th>Tên SP</th>
                    <th>Giá</th>
                    <th>Số Lượng</th>
                    <th>Thành Tiền</th>
                </tr>
                <?php
        $total=0;
        $total1=0;
		while($uys = mysqli_fetch_array($aps)){
			# code...
	    ?>
                <tr style="text-align: center;">
                    <td> <?php echo $uys['tensp']; ?></td>
                    <td><?php echo $uys['gia']; ?></td>
                    <td> <?php echo $uys['soluongsp']; ?></td>
                    <td> <?php echo $uys['thanhtien']; ?></td>
                </tr>
                <?php 
            $total += $uys['soluongsp']; 
            $total1 += $uys['thanhtien']; 
        }
    ?>
                <tr style="background-color:#CCCCCC;color:#3366FF;font-size:25px;text-align: center;">
                    <td colspan="2" style="">Tổng số : </td>
                    <td><?php echo $total?></td>
                    <td><?php echo $total1?></td>
            </table>
            <div>
                <h2 style="color: red;  text-align:center;">Nhập Thông Tin Khách Hàng</h2>
            </div>

            <form method="post" name="frm" onsubmit=" return nhapthongtin()" action="">
                <table border="1" style="width:500px;margin-top:20px;background-color:white">
                    <tr>
                        <td style="width:300px;background-color:#99CCCC;font-weight:bold;padding-left:10px;">Họ Và Tên*
                            : </td>
                        <td><input type="text" name="hoten" size="40" placeholder="Mời nhập Họ Tên"></td>
                    </tr>
                    <tr>
                        <td style="background-color:#99CCCC;font-weight:bold;padding-left:10px;">Điện Thoại* : </td>
                        <td><input type="text" name="dienthoai" size="40" placeholder="Mời nhập Số Điện Thoại"></td>
                    </tr>
                    <tr>
                        <td style="background-color:#99CCCC;font-weight:bold;padding-left:10px;">Email* : </td>
                        <td><input type="text" name="email" size="40" placeholder="Mời nhập Email"></td>
                    </tr>
                    <tr>
                        <td style="background-color:#99CCCC;font-weight:bold;padding-left:10px;">Điạ Chỉ* : </td>
                        <td><input type="text" name="diachi" size="40" placeholder="Mời nhập Số Địa Chỉ"></td>
                    </tr>
                    <tr style="background-color:#99CCCC;">
                        <td colspan="2"><input
                                style="border:white;margin :2px 0px 2px 200px;color:white;font-weight:bold;background-color:#009900;font-size:17px;"
                                type="submit" name="submit" value="Đặt Hàng"></td>
                    </tr>
                </table>
            </form>

            <?php 
        include 'connect.php';
            if(isset($_POST['submit']))
            {
	            $hoten=$_POST['hoten'];
                $dienthoai =$_POST['dienthoai'];
                $email=$_POST['email'];
	            $diachi =$_POST['diachi'];
		        $ngay=date("Y").":".date("m").":".date("d").":".date("H").":".date("i").":".date("s");
                   
                
                $insert1="INSERT INTO wp_hoadon(idnd,hoten,diachi,dienthoai,email,ngaydathang,manv) VALUES ('0','$hoten', '$diachi', '$dienthoai', '$email', '$ngay','$username')";

                $insert2="INSERT INTO wp_cthoadon(idsp,tensp,gia,soluong,thanhtien,idnd,hoten,ngaydat) select idsp,tensp,gia,soluongsp,thanhtien,'$0','$hoten','$ngay' from wp_giohangnhanvien" ;                
                
                $insert3="Delete from wp_giohangnhanvien";                

                $query=mysqli_query($link,$insert1);
                $query=mysqli_query($link,$insert2);
                $query=mysqli_query($link,$insert3);

                if($query) 
                {
                    echo "
                    <script language='javascript'>
                        alert('Đặt Hàng Thành Công !');
                        window.open('NhanVien.php','_self', 1);
                    </script>
                ";
                }
}
?>
            <script language="javascript">
            function nhapthongtin() {
                if (frm.hoten.value == "") {
                    alert("Bạn chưa nhập họ tên. Vui lòng kiểm tra lại");
                    return false;
                }
                if (frm.dienthoai.value == "") {
                    alert("Bạn chưa nhập số điện thoại. Vui lòng kiểm tra lại");
                    frm.dienthoai.focus();
                    return false;
                }
                if (frm.email.value == "") {
                    alert("Bạn chưa nhập email. Vui lòng kiểm tra lại");
                    frm.email.focus();
                    return false;
                }
                if (frm.diachi.value == "") {
                    alert("Bạn chưa nhập địa chỉ . Vui lòng kiểm tra lại");
                    frm.diachi.focus();
                    return false;
                }
            }
            </script>
        </div>
    </div>

    <div class="clearfix"></div>
    </div>
    <br>
    <div class="khungend" style="background-color: #006633;">
        <ul class="khungend1">
            <li style="color: white;">ĐĂNG KÝ NHẬN EMAIL <br>
                Đăng kí nhận thông tin sách mới,sách bán</li>
            <li>
                <input type="text" placeholder="Tên sách của bạn">
            </li>
            <li>
                <input type="text" placeholder="Nhận email của bạn">
            </li>
            <li>
                <select style="width: 200px;height: 35px;">
                    <option value="1">Thể loại yêu thích</option>
                    <option value="2">Tất cả</option>
                    <option value="3">Kỹ Năng Sống</option>
                    <option value="3">Kinh Tế</option>
                    <option value="3">Văn Học</option>
                    <option value="3">Khoa Học - Công Nghệ</option>
                    <option value="3">Danh Nhân - Văn Hóa - Du Lịch</option>
                    <option value="3">Y Học - Sức Khỏe</option>
                    <option value="3">Ngoại Ngữ</option>
                </select>
            </li>
            <li>
                <input style="width: 200px;height: 35px; color: #006633" type="submit" value="ĐĂNG KÝ NGAY">
            </li>
        </ul>

        <div class="clearfix"></div>
    </div>
    </div>
    <div class="khungEnd">
        <table style="margin-left: 300px; font-weight: 100; font-size: 14px; width: 1300px; background-color: white;">
            <br>
            <tr>
                <td><b>HỖ TRỢ KHÁCH HÀNG</b></td>
                <td><b>VỀ MÂYBOOK</b></td>
                <td><b>HỢP TÁC VÀ LIÊN KẾT</b></td>
                <td><b>PHƯƠNG THỨC THANH TOÁN</b></td>
                <td><b>KẾT NỐI VỚI CHÚNG TÔI</b></td>
            </tr>
            <tr>
                <td><b style="color:brown;"> <br> Hotline chăm sóc khách hàng: 1900-1234</b></td>
                <td><br>Giới thiệu MâyBook</td>
                <td><br>Quy chế hoạt động sàn GDTMĐT</td>
                <td rowspan="4"><br> <img src="../Ảnh/Anh37.pnj.png"></td>
                <td rowspan="2"> <br><a href="https://www.facebook.com/"><img width="25" src="../Ảnh/AnhFB.pnj.jpg"></a>
                    <a style="padding-left: 10px;" href="https://www.youtube.com/"><img width="25" height="27px"
                            src="../Ảnh/Anh38.pnj.jpg"></a>
                </td>
                </td>
            </tr>
            <tr>
                <td>(1000đ/phút,8-21h kể cả T7,CN</td>
                <td>Tuyển Dụng</td>
                <td>Bán hàng cùng MâyBook</td>
            </tr>
            <tr>
                <td>Các câu hỏi thường gặp</td>
                <td>Chính sách bảo mật thanh toán</td>

            </tr>
            <tr>
                <td>Giử yêu cầu hỗ trợ</td>
                <td>Chính sách bảo mật thông tin cá nhân</td>
                <td></td>
                <td><b>TẢI ỨNG DỤNG</b></td>
            </tr>
            <tr>
                <td>Hướng dẫn đặt hàng</td>
                <td>Chính sách giải quyết khiếu lại</td>
                <td></td>
                <td><b>THANH TOÁN AN TOÀN</b></td>
                <td rowspan="3"><a href="https://www.apple.com/vn/ios/app-store/"><img width="120px"
                            src="../Ảnh/Anh39.pnj.png"></a> <br>
                    <a href="https://play.google.com/store"><img width="120px" src="../Ảnh/Anh40.pnj.png"></a>
                </td>
            </tr>
            <tr>
                <td>Phương thức vận chuyển</td>
                <td>Điều khoản sử dụng</td>
                <td></td>
                <td rowspan="3"><img src="../Ảnh/Anh41.pnj.png" alt=""></td>

            </tr>
            <tr>
                <td>Chính sách đổi trả</td>
                <td>Hội sách online</td>

            </tr>
            <tr>
                <td>Hướng dẫn mua trả góp</td>
                <td>Giới thiệu MâyBook xu</td>
            </tr>
            <tr>
                <td>Chính sách hàng nhập khẩu</td>
                <td>MâyBook tư vấn</td>
            </tr>
            <tr>
                <td>Hỗ trợ khách hàng hotro@mây.vn</td>
                <td>Bán hàng doanh nghiệp</td>
            </tr>
            <tr>
                <td>Báo lỗi bảo mật security@mây.vn</td>
            </tr>
        </table>
        <br><br>
        <div class="clearfix"></div>
        <br>
        <div class="khungEnd1">
            <p><b style="padding-left: 350px;">THƯỜNG ĐƯỢC TÌM KIẾM</b></p>
            <table style="background-color: white;margin-left:200px;">
                <tr>
                    <td>tryện dan brown</td>
                    <td>sách warren buffelt</td>
                    <td>sách digital marketing</td>
                    <td>truyện mới của nguyễn nhật ánh</td>
                    <td>sách cho con</td>
                </tr>
                <tr>
                    <td>giáo trình tiếng anh trẻ em</td>
                    <td>sách hay về kinh tế</td>
                    <td>sách hay về đầu tư</td>
                    <td>sách doanh nhân</td>
                    <td>sách hay về gia đình</td>
                </tr>
                <tr>
                    <td>sách học tiếng trung</td>
                    <td>tiểu thuyết tình yêu</td>
                    <td>sách y học</td>
                    <td>tủ sách gia đình</td>
                    <td>sách dãy kĩ năng giao tiếp</td>
                </tr>
                <tr>
                    <td>sách blockchain</td>
                    <td>sách du học</td>
                    <td>sách kỹ năng mềm</td>
                    <td>sách làm giàu</td>
                    <td>sách phong thủy cổ</td>
                </tr>
                <tr>
                    <td>sách khởi nghiệp</td>
                    <td>sách bán hàng</td>
                    <td>sách về đầu tư chứng khoán</td>
                    <td>sách dạy nấu ăn</td>
                    <td>sách tâm lý về tình yêu</td>
                </tr>
                <tr>
                    <td>sách quản lý nhân sự</td>
                    <td>sách quản trị kinh doanh</td>
                    <td>sách tài chính</td>
                    <td>sách cho thiếu nhi</td>
                    <td>sách tự học tiếng anh giao tiếp</td>
                </tr>
            </table>
        </div>
        <div class="clearfix"></div>
    </div>
    <br>
    <div class="khungEnd2" style="background-color: black; height: 50px;">
        <h4 style="text-align:center;color:white;padding-top:15px;">Bản quyền thuộc MâyBook !!!</h4>
    </div>
    </div>
    </div>
</body>

</html>