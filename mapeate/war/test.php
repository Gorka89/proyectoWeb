<?php phpinfo();
$ch = curl_init("http://mapeate.appspot.com/jsp/login.jsp");


curl_exec($ch);
curl_close($ch);

?>