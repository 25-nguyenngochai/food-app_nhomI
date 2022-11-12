
<?php
include  "PHPMailer/src/PHPMailer.php";
include  "PHPMailer/src/Exception.php";
include  "PHPMailer/src/OAuth.php";
include  "PHPMailer/src/POP3.php";
include  "PHPMailer/src/SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer
{
    public function dathangmail($tenshop,$tieude, $noidung,$total,$maildathang, $tenKhachHang,$titleShop,$foodterShop)
    {
        $mail = new PHPMailer(true);
        $mail->CharSet = ('UTF-8');
        try {
            //Server settings
            $mail->SMTPDebug = 0;                                 
            $mail->isSMTP();                                     
            $mail->Host = 'smtp.gmail.com;'; 
            $mail->SMTPAuth = true;                               
            $mail->Username = 'bangbang01213@gmail.com';                
            $mail->Password = 'gfkwttcbapneqlkh';                           
            $mail->SMTPSecure = 'tls';                            
            $mail->Port = 587;                                  

            //Recipients
            $mail->setFrom('bangbang01213@gmail.com', 'OGANI');
            $mail->addAddress($maildathang, $tenKhachHang);     
            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');
            $mail->isHTML(true);                             
            $mail->Subject = $tenshop;
            $mail->Body  = 
            " ".$titleShop."
            ".$tieude."
            <table style='text-align: center;margin-left: 31%;'>
                <colgroup>
                    <col style='background-color: #bae6fd' span='2'/>
                    <col style='background-color: #bae6fd' span='2' />
                </colgroup>
                <tr>
                    <th>ID</th>
                    <th>Tên Sản Phẩm</th>
                    <th>Số Lượng</th>
                    <th>Giá Tiền</th>
                </tr>
                " . $noidung . "
                <tr>
                </tr>
                    <td></td>
                    <td>Tổng Tiền:</td>
                    <td></td>
                    <td>  " . number_format($total) . " VND</td>
                <tr>
            </table>
            ".$foodterShop."
            ";
            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    }
}
