<?php
require_once('../database/config.php');
// To address
$to = "me@example.com";

// Subject
$subject = 'HTML Email Test';

$name = "Mark Bowen";

// message
$message = '';


$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";


$headers .= 'To: Mary <shabista.sarwer@com.com>, Kelly <kelly@example.com>' . "\r\n";
$headers .= 'From: Example <shabista.sarwer@com.com>' . "\r\n";


mail($to, $subject, $message, $headers);
?>

<html>
<head>
  <title>$name</title>
</head>
<body>
  Here are the birthdays upcoming in August!
  <table>
    <tr>
      <th>Person</th><th>Day</th><th>Month</th><th>Year</th>
    </tr>
    <tr>
      <td>Joe</td><td>3rd</td><td>August</td><td>1970</td>
    </tr>
    <tr>
      <td>Sally</td><td>17th</td><td>August</td><td>1973</td>
    </tr>
  </table>
</body>
</html>

