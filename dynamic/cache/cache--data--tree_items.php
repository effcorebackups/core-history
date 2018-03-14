<?php

namespace effcore { # cache for data--tree_items

  cache::$data['data--tree_items']['core']['admin'] = new \effcore\tree_item();
  cache::$data['data--tree_items']['core']['admin']->id = 'admin';
  cache::$data['data--tree_items']['core']['admin']->id_parent = 'main';
  cache::$data['data--tree_items']['core']['admin']->parent_is_tree = true;
  cache::$data['data--tree_items']['core']['admin']->title = 'Administer';
  cache::$data['data--tree_items']['core']['admin']->attributes['class']['admin'] = 'admin';
  cache::$data['data--tree_items']['core']['admin']->access = new \stdClass();
  cache::$data['data--tree_items']['core']['admin']->access->roles['admins'] = 'admins';
  cache::$data['data--tree_items']['core']['modules'] = new \effcore\tree_item();
  cache::$data['data--tree_items']['core']['modules']->id = 'modules';
  cache::$data['data--tree_items']['core']['modules']->id_parent = 'admin';
  cache::$data['data--tree_items']['core']['modules']->title = 'Modules';
  cache::$data['data--tree_items']['core']['modules']->attributes['href'] = '/admin/modules';
  cache::$data['data--tree_items']['core']['modules']->attributes['class']['modules'] = 'modules';
  cache::$data['data--tree_items']['core']['modules']->access = new \stdClass();
  cache::$data['data--tree_items']['core']['modules']->access->roles['admins'] = 'admins';
  cache::$data['data--tree_items']['core']['info'] = new \effcore\tree_item();
  cache::$data['data--tree_items']['core']['info']->id = 'info';
  cache::$data['data--tree_items']['core']['info']->id_parent = 'admin';
  cache::$data['data--tree_items']['core']['info']->title = 'Information';
  cache::$data['data--tree_items']['core']['info']->attributes['href'] = '/admin/info';
  cache::$data['data--tree_items']['core']['info']->attributes['class']['info'] = 'info';
  cache::$data['data--tree_items']['core']['info']->weight = 100;
  cache::$data['data--tree_items']['core']['info']->access = new \stdClass();
  cache::$data['data--tree_items']['core']['info']->access->roles['admins'] = 'admins';
  cache::$data['data--tree_items']['develop']['develop'] = new \effcore\tree_item();
  cache::$data['data--tree_items']['develop']['develop']->id = 'develop';
  cache::$data['data--tree_items']['develop']['develop']->id_parent = 'main';
  cache::$data['data--tree_items']['develop']['develop']->parent_is_tree = true;
  cache::$data['data--tree_items']['develop']['develop']->title = 'Develop';
  cache::$data['data--tree_items']['develop']['develop']->attributes['class']['develop'] = 'develop';
  cache::$data['data--tree_items']['develop']['develop']->access = new \stdClass();
  cache::$data['data--tree_items']['develop']['develop']->access->roles['admins'] = 'admins';
  cache::$data['data--tree_items']['develop']['demo'] = new \effcore\tree_item();
  cache::$data['data--tree_items']['develop']['demo']->id = 'demo';
  cache::$data['data--tree_items']['develop']['demo']->id_parent = 'develop';
  cache::$data['data--tree_items']['develop']['demo']->title = 'Demo';
  cache::$data['data--tree_items']['develop']['demo']->attributes['href'] = '/develop/demo';
  cache::$data['data--tree_items']['develop']['demo']->attributes['class']['demo'] = 'demo';
  cache::$data['data--tree_items']['develop']['demo']->access = new \stdClass();
  cache::$data['data--tree_items']['develop']['demo']->access->roles['admins'] = 'admins';
  cache::$data['data--tree_items']['develop']['classes'] = new \effcore\tree_item();
  cache::$data['data--tree_items']['develop']['classes']->id = 'classes';
  cache::$data['data--tree_items']['develop']['classes']->id_parent = 'develop';
  cache::$data['data--tree_items']['develop']['classes']->title = 'Classes';
  cache::$data['data--tree_items']['develop']['classes']->attributes['href'] = '/develop/classes';
  cache::$data['data--tree_items']['develop']['classes']->attributes['class']['classes'] = 'classes';
  cache::$data['data--tree_items']['develop']['classes']->access = new \stdClass();
  cache::$data['data--tree_items']['develop']['classes']->access->roles['admins'] = 'admins';
  cache::$data['data--tree_items']['page']['decoration'] = new \effcore\tree_item();
  cache::$data['data--tree_items']['page']['decoration']->id = 'decoration';
  cache::$data['data--tree_items']['page']['decoration']->id_parent = 'admin';
  cache::$data['data--tree_items']['page']['decoration']->title = 'Decoration';
  cache::$data['data--tree_items']['page']['decoration']->attributes['href'] = '/admin/decoration';
  cache::$data['data--tree_items']['page']['decoration']->attributes['class']['decoration'] = 'decoration';
  cache::$data['data--tree_items']['page']['decoration']->access = new \stdClass();
  cache::$data['data--tree_items']['page']['decoration']->access->roles['admins'] = 'admins';
  cache::$data['data--tree_items']['user']['login'] = new \effcore\tree_item();
  cache::$data['data--tree_items']['user']['login']->id = 'login';
  cache::$data['data--tree_items']['user']['login']->id_parent = 'user_anonymous';
  cache::$data['data--tree_items']['user']['login']->parent_is_tree = true;
  cache::$data['data--tree_items']['user']['login']->title = 'login';
  cache::$data['data--tree_items']['user']['login']->attributes['href'] = '/user/login';
  cache::$data['data--tree_items']['user']['login']->attributes['class']['login'] = 'login';
  cache::$data['data--tree_items']['user']['login']->weight = -20;
  cache::$data['data--tree_items']['user']['login']->access = new \stdClass();
  cache::$data['data--tree_items']['user']['login']->access->roles['anonymous'] = 'anonymous';
  cache::$data['data--tree_items']['user']['registration'] = new \effcore\tree_item();
  cache::$data['data--tree_items']['user']['registration']->id = 'registration';
  cache::$data['data--tree_items']['user']['registration']->id_parent = 'user_anonymous';
  cache::$data['data--tree_items']['user']['registration']->parent_is_tree = true;
  cache::$data['data--tree_items']['user']['registration']->title = 'registration';
  cache::$data['data--tree_items']['user']['registration']->attributes['href'] = '/user/registration';
  cache::$data['data--tree_items']['user']['registration']->attributes['class']['registration'] = 'registration';
  cache::$data['data--tree_items']['user']['registration']->weight = -10;
  cache::$data['data--tree_items']['user']['registration']->access = new \stdClass();
  cache::$data['data--tree_items']['user']['registration']->access->roles['anonymous'] = 'anonymous';
  cache::$data['data--tree_items']['user']['user_edit'] = new \effcore\tree_item();
  cache::$data['data--tree_items']['user']['user_edit']->id = 'user_edit';
  cache::$data['data--tree_items']['user']['user_edit']->id_parent = 'user_logged_in';
  cache::$data['data--tree_items']['user']['user_edit']->parent_is_tree = true;
  cache::$data['data--tree_items']['user']['user_edit']->title = 'edit';
  cache::$data['data--tree_items']['user']['user_edit']->attributes['href'] = '/user/%%_id_user/edit';
  cache::$data['data--tree_items']['user']['user_edit']->attributes['class']['user-edit'] = 'user-edit';
  cache::$data['data--tree_items']['user']['user_edit']->weight = -20;
  cache::$data['data--tree_items']['user']['user_edit']->access = new \stdClass();
  cache::$data['data--tree_items']['user']['user_edit']->access->roles['admins'] = 'admins';
  cache::$data['data--tree_items']['user']['user_edit']->access->roles['registered'] = 'registered';
  cache::$data['data--tree_items']['user']['logout'] = new \effcore\tree_item();
  cache::$data['data--tree_items']['user']['logout']->id = 'logout';
  cache::$data['data--tree_items']['user']['logout']->id_parent = 'user_logged_in';
  cache::$data['data--tree_items']['user']['logout']->parent_is_tree = true;
  cache::$data['data--tree_items']['user']['logout']->title = 'logout';
  cache::$data['data--tree_items']['user']['logout']->attributes['href'] = '/user/logout';
  cache::$data['data--tree_items']['user']['logout']->attributes['class']['logout'] = 'logout';
  cache::$data['data--tree_items']['user']['logout']->weight = -10;
  cache::$data['data--tree_items']['user']['logout']->access = new \stdClass();
  cache::$data['data--tree_items']['user']['logout']->access->roles['registered'] = 'registered';
  cache::$data['data--tree_items']['user']['roles'] = new \effcore\tree_item();
  cache::$data['data--tree_items']['user']['roles']->id = 'roles';
  cache::$data['data--tree_items']['user']['roles']->id_parent = 'admin';
  cache::$data['data--tree_items']['user']['roles']->title = 'Roles';
  cache::$data['data--tree_items']['user']['roles']->attributes['href'] = '/admin/roles';
  cache::$data['data--tree_items']['user']['roles']->attributes['class']['roles'] = 'roles';
  cache::$data['data--tree_items']['user']['roles']->access = new \stdClass();
  cache::$data['data--tree_items']['user']['roles']->access->roles['admins'] = 'admins';
  cache::$data['data--tree_items']['user']['users'] = new \effcore\tree_item();
  cache::$data['data--tree_items']['user']['users']->id = 'users';
  cache::$data['data--tree_items']['user']['users']->id_parent = 'admin';
  cache::$data['data--tree_items']['user']['users']->title = 'Users';
  cache::$data['data--tree_items']['user']['users']->attributes['href'] = '/admin/users';
  cache::$data['data--tree_items']['user']['users']->attributes['class']['users'] = 'users';
  cache::$data['data--tree_items']['user']['users']->access = new \stdClass();
  cache::$data['data--tree_items']['user']['users']->access->roles['admins'] = 'admins';
  cache::$data['data--tree_items']['user']['users_select'] = new \effcore\tab_item();
  cache::$data['data--tree_items']['user']['users_select']->id = 'users_select';
  cache::$data['data--tree_items']['user']['users_select']->id_parent = 'users';
  cache::$data['data--tree_items']['user']['users_select']->title = 'Select';
  cache::$data['data--tree_items']['user']['users_select']->attributes['href'] = '/admin/users/select';
  cache::$data['data--tree_items']['user']['users_select']->attributes['class']['users-select'] = 'users-select';
  cache::$data['data--tree_items']['user']['users_select']->access = new \stdClass();
  cache::$data['data--tree_items']['user']['users_select']->access->roles['admins'] = 'admins';
  cache::$data['data--tree_items']['user']['users_insert'] = new \effcore\tab_item();
  cache::$data['data--tree_items']['user']['users_insert']->id = 'users_insert';
  cache::$data['data--tree_items']['user']['users_insert']->id_parent = 'users';
  cache::$data['data--tree_items']['user']['users_insert']->title = 'Insert';
  cache::$data['data--tree_items']['user']['users_insert']->attributes['href'] = '/admin/users/insert';
  cache::$data['data--tree_items']['user']['users_insert']->attributes['class']['users-insert'] = 'users-insert';
  cache::$data['data--tree_items']['user']['users_insert']->access = new \stdClass();
  cache::$data['data--tree_items']['user']['users_insert']->access->roles['admins'] = 'admins';
  cache::$data['data--tree_items']['user']['users_update'] = new \effcore\tab_item();
  cache::$data['data--tree_items']['user']['users_update']->id = 'users_update';
  cache::$data['data--tree_items']['user']['users_update']->id_parent = 'users';
  cache::$data['data--tree_items']['user']['users_update']->title = 'Update';
  cache::$data['data--tree_items']['user']['users_update']->attributes['href'] = '/admin/users/update';
  cache::$data['data--tree_items']['user']['users_update']->attributes['class']['users-update'] = 'users-update';
  cache::$data['data--tree_items']['user']['users_update']->access = new \stdClass();
  cache::$data['data--tree_items']['user']['users_update']->access->roles['admins'] = 'admins';
  cache::$data['data--tree_items']['user']['users_delete'] = new \effcore\tab_item();
  cache::$data['data--tree_items']['user']['users_delete']->id = 'users_delete';
  cache::$data['data--tree_items']['user']['users_delete']->id_parent = 'users';
  cache::$data['data--tree_items']['user']['users_delete']->title = 'Delete';
  cache::$data['data--tree_items']['user']['users_delete']->attributes['href'] = '/admin/users/delete';
  cache::$data['data--tree_items']['user']['users_delete']->attributes['class']['users-delete'] = 'users-delete';
  cache::$data['data--tree_items']['user']['users_delete']->access = new \stdClass();
  cache::$data['data--tree_items']['user']['users_delete']->access->roles['admins'] = 'admins';

}