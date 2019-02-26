<?php       
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    function receipt_mail($order_content, $or_no) {
        $bodymsg = '';
        $bodymsg .= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
        $bodymsg .= '<html xmlns="http://www.w3.org/1999/xhtml">';
        $bodymsg .= '<head>';
        $bodymsg .= '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
        $bodymsg .= '<title>GoLive: Email Template</title>';
        $bodymsg .= '<meta name="viewport" content="width=device-width, initial-scale=1.0"/>';
        $bodymsg .= '</head>';
        $bodymsg .= '<body style="margin: 0; padding: 0;">';
        $bodymsg .= '<table border="0" cellpadding="0" cellspacing="0" width="100%">';
        $bodymsg .= '<tr>';
        $bodymsg .= '<td>';
        $bodymsg .= '<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse;">';
        $bodymsg .= '<tr>';
        $bodymsg .= '<td align="center">';
        $bodymsg .= '<img src="https://i.imgur.com/UMpd8nj.png" alt="GoLive" style="display: block; width: 100%; max-width: 600px; height: 100%; max-height: 300px;" />';
        $bodymsg .= '</td>';
        $bodymsg .= '</tr>';
        $bodymsg .= '<tr>';
        $bodymsg .= '<td>';
        $bodymsg .= '<table border="0" cellpadding="0" cellspacing="0" width="100%" style="font-family: Arial, sans-serif;">';
        $bodymsg .= '<tr>';
        $bodymsg .= '<td style="padding: 15px 0px 10px 30px; font-size: 24px;">';
        $bodymsg .= '<b><u>Order Summary</u></b>';
        $bodymsg .= '</td>';
        $bodymsg .= '</tr>';
        $bodymsg .= '<tr>';
        $bodymsg .= '<td style="padding: 10px 5px 0px 20px;">';
        $bodymsg .= '<b style="font-size: 17px;">STATUS:</b>';
        $bodymsg .= '<p id="uncurdate" style="font-size: 15px;">&emsp;APPROVED</p>';
        $bodymsg .= '<b style="font-size: 17px;">O.R. No.:</b>';
        $bodymsg .= '<p id="uncurdate" style="font-size: 15px;">&emsp;'.$or_no.'</p>';
        $bodymsg .= '<b style="font-size: 17px;">DATE:</b>';
        $bodymsg .= '<p id="uncurdate" style="font-size: 15px;">&emsp;'.date('F d, Y').'</p>';
        $bodymsg .= '<p>&emsp;Below are the transacted item(s) to your account. This serves as a official copy of your package order.</p>';
        $bodymsg .= '</td>';
        $bodymsg .= '</tr>';
        $bodymsg .= '</tr>';
        $bodymsg .= '<tr>';
        $bodymsg .= ' <td style="padding: 10px 10px 10px 10px;">';
        $bodymsg .= '<table border="1" cellpadding="0" cellspacing="0" width="100%" style="font-family: Arial, sans-serif; font-size: 16px;">';
        $bodymsg .= '<tr>';
        $bodymsg .= '<th>Package Type</th>';
        $bodymsg .= '<th>Duration</th>';
        $bodymsg .= '<th>Price</th>';
        $bodymsg .= '</tr>';
        $bodymsg .= '<tr style="text-align: center;"> <!-- Mock data for summary description -->'; //start row
        for ($i=0; $i<count($order_content); $i++){
            $bodymsg .= '<td>'.$order_content[$i].'</td>';
        }
        $bodymsg .= '</tr>'; //end row
        $bodymsg .= '</table>';
        $bodymsg .= '</td>';
        $bodymsg .= '</tr>';
        $bodymsg .= '<tr>';
        $bodymsg .= '<td>';
        $bodymsg .= '<table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #2C3E50; padding: 20px 20px 20px 20px; color: white;">';
        $bodymsg .= '<tr style="font-family: Arial, sans-serif; font-size: 12px;">';
        $bodymsg .= '<td>GoLive: Live Streaming Platform for Filipino Business Entrepreneurs</td>';
        $bodymsg .= '<td>&copy; '.date("Y"). ' ' .'Timestamp: '.date("h:i:sa").'</td>';
        $bodymsg .= '</tr>';
        $bodymsg .= '</table>';
        $bodymsg .= '</td>';
        $bodymsg .= '</tr>';
        $bodymsg .= '</table>';
        $bodymsg .= '</td>';
        $bodymsg .= '</tr>';
        $bodymsg .= '</table>';
        $bodymsg .= '</td>';
        $bodymsg .= '</tr>';
        $bodymsg .= '</table>';
        $bodymsg .= '</body>';
        $bodymsg .= '</html>';
        return $bodymsg;
    }

    function confirm_email() {
        $bodymsg = '';
        $bodymsg .= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
        $bodymsg .= '<html xmlns="http://www.w3.org/1999/xhtml">';
        $bodymsg .= '<head>';
        $bodymsg .= '<meta http-equiv="Content-Type" content="text/html charset=UTF-8" />';
        $bodymsg .= '<title>GoLive: Email Template</title>';
        $bodymsg .= '<meta name="viewport" content="width=device-width, initial-scale=1.0"/>';
        $bodymsg .= '</head>';
        $bodymsg .= '<body style="margin: 0; padding: 0;">';
        $bodymsg .= '<table border="0" cellpadding="0" cellspacing="0" width="100%">';
        $bodymsg .= '<tr>';
        $bodymsg .= '<td>';
        $bodymsg .= '<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse;">';
        $bodymsg .= '<tr>';
        $bodymsg .= '<td align="center">';
        $bodymsg .= '<img src="https://i.imgur.com/UMpd8nj.png" alt="GoLive Logo" style="display: block; width: 100%; max-width: 600px; height: 100%; max-height: 300px;"/>';
        $bodymsg .= '</td>';
        $bodymsg .= '</tr>';
        $bodymsg .= '<tr>';
        $bodymsg .= '<td>';
        $bodymsg .= '<table border="0" cellpadding="0" cellspacing="0" width="100%" style="font-family: Arial, sans-serif;">';
        $bodymsg .= '<tr>';
        $bodymsg .= '<td style="padding: 15px 0px 10px 30px; font-size: 24px;">';
        $bodymsg .= '<b><u>Notification</u></b>';
        $bodymsg .= '</td>';
        $bodymsg .= '</tr>';
        $bodymsg .= '<tr>';
        $bodymsg .= '<td style="padding: 10px 5px 0px 20px;">';
        $bodymsg .= '<b style="font-size: 17px;">DATE:</b>';
        $bodymsg .= '<p id="uncurdate" style="font-size: 15px;">&emsp;'.date('F d, Y').'</p>';
        $bodymsg .= '<p style="font-size: 15px;">&emsp;Your GoLive account has been confirmed.</p>';
        $bodymsg .= '</td>';
        $bodymsg .= '</tr>';
        $bodymsg .= '<tr>';
        $bodymsg .= '<td>';
        $bodymsg .= '<table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #2C3E50; padding: 20px 20px 20px 20px; color: white">';
        $bodymsg .= '<tr style="font-family: Arial, sans-serif; font-size: 12px;">';
        $bodymsg .= '<td>GoLive: Live Streaming Platform for Filipino Business Entrepreneurs </td>';
        $bodymsg .= '<td>&copy; '.date("Y"). ' ' .'Timestamp: '.date("h:i:sa").'</td>';
        $bodymsg .= '</tr>';
        $bodymsg .= '</table>';
        $bodymsg .= '</td>';
        $bodymsg .= '</tr>';
        $bodymsg .= '</table>';
        $bodymsg .= '</td>';
        $bodymsg .= '</tr>';
        $bodymsg .= '</table>';
        $bodymsg .= '</td>';
        $bodymsg .= '</tr>';
        $bodymsg .= '</table>';
        $bodymsg .= '</body>';
        $bodymsg .= '</html>';
        return $bodymsg;
    }

    function email_handler($email_to, $email_subj, $email_body) {
        try {
            //item list
            //header - GoLive: Live Streaming Platform for Filipino Business Entrepreneurs

            //php-mailer object
            $mailobj = new PHPMailer(TRUE);
            //setup
            $mailobj->IsSMTP();
            // $mailobj->SMTPDebug = 4;
            $mailobj->Host = "relay-hosting.secureserver.net";
            $mailobj->Port = 25;
            $mailobj->SMTPAuth = false;
            $mailobj->SMTPSecure = 'none';
            //authentication
            $mailobj->Username = "jeromerayos00@gmail.com";
            $mailobj->Password = '8UJhT5JuXnBkJ2X';
            //sending portion
            $mailobj->setFrom('admin@golivevideostreaming.com', 'GoLive');
            $mailobj->AddReplyTo('admin@golivevideostreaming.com', 'GoLive');
            $mailobj->addAddress($email_to);
            $mailobj->Subject = $email_subj;
            $mailobj->IsHTML(true);
            $mailobj->Body = $email_body;

            // $mailobj->addCustomHeader('X-MSMail-Priority: High'); 

            if($mailobj->send() == true) {
                return true;
            } else {
                return false;
            }
            
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

?>