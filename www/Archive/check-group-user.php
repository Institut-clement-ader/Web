<?php
$id = get_current_user_id();
echo $id;
if ($id > 0) {
  $user_info = get_userdata($id);
  $user_roles = $user_info->roles;
  foreach ($user_roles as $roles) {
    echo $roles;
  }
}
?>