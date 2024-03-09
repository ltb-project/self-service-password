<?php
function auditlog($file, $dn, $admin, $action, $result) {
  $log = array (
    "date" => date_format(date_create(), "D, d M Y H:i:s"),
    "ip" => $_SERVER['REMOTE_ADDR'],
    "user_dn" => $dn,
    "done_by" => $admin,
    "action" => $action,
    "result" => $result
  );
  file_put_contents($file, json_encode($log, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . PHP_EOL, FILE_APPEND | LOCK_EX);
}
?>
