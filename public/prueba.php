<?php
$base_url = "http://$_SERVER[HTTP_HOST]" . dirname($_SERVER['REQUEST_URI'])."/";
echo $base_url;