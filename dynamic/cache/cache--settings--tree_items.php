<?php

namespace effectivecore { # cache for settings--tree_items

  cache::$data['settings--tree_items']['core']['home'] = new \effectivecore\tree_item();
  cache::$data['settings--tree_items']['core']['home']->id = 'home';
  cache::$data['settings--tree_items']['core']['home']->id_parent = 'main';
  cache::$data['settings--tree_items']['core']['home']->parent_is_tree = true;
  cache::$data['settings--tree_items']['core']['home']->title = 'Home';
  cache::$data['settings--tree_items']['core']['home']->attributes['href'] = '/';
  cache::$data['settings--tree_items']['core']['home']->attributes['class']['home'] = 'home';
  cache::$data['settings--tree_items']['core']['admin'] = new \effectivecore\tree_item();
  cache::$data['settings--tree_items']['core']['admin']->id = 'admin';
  cache::$data['settings--tree_items']['core']['admin']->id_parent = 'main';
  cache::$data['settings--tree_items']['core']['admin']->parent_is_tree = true;
  cache::$data['settings--tree_items']['core']['admin']->title = 'Administer';
  cache::$data['settings--tree_items']['core']['admin']->attributes['class']['admin'] = 'admin';
  cache::$data['settings--tree_items']['core']['admin']->access = new \stdClass();
  cache::$data['settings--tree_items']['core']['admin']->access->roles['admins'] = 'admins';
  cache::$data['settings--tree_items']['core']['modules'] = new \effectivecore\tree_item();
  cache::$data['settings--tree_items']['core']['modules']->id = 'modules';
  cache::$data['settings--tree_items']['core']['modules']->id_parent = 'admin';
  cache::$data['settings--tree_items']['core']['modules']->title = 'Modules';
  cache::$data['settings--tree_items']['core']['modules']->attributes['href'] = '/admin/modules';
  cache::$data['settings--tree_items']['core']['modules']->attributes['class']['modules'] = 'modules';
  cache::$data['settings--tree_items']['core']['modules']->access = new \stdClass();
  cache::$data['settings--tree_items']['core']['modules']->access->roles['admins'] = 'admins';
  cache::$data['settings--tree_items']['develop']['develop'] = new \effectivecore\tree_item();
  cache::$data['settings--tree_items']['develop']['develop']->id = 'develop';
  cache::$data['settings--tree_items']['develop']['develop']->id_parent = 'main';
  cache::$data['settings--tree_items']['develop']['develop']->parent_is_tree = true;
  cache::$data['settings--tree_items']['develop']['develop']->title = 'Develop';
  cache::$data['settings--tree_items']['develop']['develop']->attributes['class']['develop'] = 'develop';
  cache::$data['settings--tree_items']['develop']['develop']->access = new \stdClass();
  cache::$data['settings--tree_items']['develop']['develop']->access->roles['admins'] = 'admins';
  cache::$data['settings--tree_items']['develop']['demo'] = new \effectivecore\tree_item();
  cache::$data['settings--tree_items']['develop']['demo']->id = 'demo';
  cache::$data['settings--tree_items']['develop']['demo']->id_parent = 'develop';
  cache::$data['settings--tree_items']['develop']['demo']->title = 'Demo';
  cache::$data['settings--tree_items']['develop']['demo']->attributes['href'] = '/develop/demo';
  cache::$data['settings--tree_items']['develop']['demo']->attributes['class']['demo'] = 'demo';
  cache::$data['settings--tree_items']['develop']['demo']->access = new \stdClass();
  cache::$data['settings--tree_items']['develop']['demo']->access->roles['admins'] = 'admins';
  cache::$data['settings--tree_items']['page']['decoration'] = new \effectivecore\tree_item();
  cache::$data['settings--tree_items']['page']['decoration']->id = 'decoration';
  cache::$data['settings--tree_items']['page']['decoration']->id_parent = 'admin';
  cache::$data['settings--tree_items']['page']['decoration']->title = 'Decoration';
  cache::$data['settings--tree_items']['page']['decoration']->attributes['href'] = '/admin/decoration';
  cache::$data['settings--tree_items']['page']['decoration']->attributes['class']['decoration'] = 'decoration';
  cache::$data['settings--tree_items']['page']['decoration']->access = new \stdClass();
  cache::$data['settings--tree_items']['page']['decoration']->access->roles['admins'] = 'admins';
  cache::$data['settings--tree_items']['user']['anonymous'] = new \effectivecore\tree_item();
  cache::$data['settings--tree_items']['user']['anonymous']->id = 'anonymous';
  cache::$data['settings--tree_items']['user']['anonymous']->id_parent = 'user';
  cache::$data['settings--tree_items']['user']['anonymous']->parent_is_tree = true;
  cache::$data['settings--tree_items']['user']['anonymous']->title = 'Anonymous';
  cache::$data['settings--tree_items']['user']['anonymous']->attributes['class']['anonymous'] = 'anonymous';
  cache::$data['settings--tree_items']['user']['anonymous']->access = new \stdClass();
  cache::$data['settings--tree_items']['user']['anonymous']->access->roles['anonymous'] = 'anonymous';
  cache::$data['settings--tree_items']['user']['login'] = new \effectivecore\tree_item();
  cache::$data['settings--tree_items']['user']['login']->id = 'login';
  cache::$data['settings--tree_items']['user']['login']->id_parent = 'anonymous';
  cache::$data['settings--tree_items']['user']['login']->title = 'login';
  cache::$data['settings--tree_items']['user']['login']->attributes['href'] = '/user/login';
  cache::$data['settings--tree_items']['user']['login']->attributes['class']['login'] = 'login';
  cache::$data['settings--tree_items']['user']['login']->weight = -80;
  cache::$data['settings--tree_items']['user']['login']->access = new \stdClass();
  cache::$data['settings--tree_items']['user']['login']->access->roles['anonymous'] = 'anonymous';
  cache::$data['settings--tree_items']['user']['registration'] = new \effectivecore\tree_item();
  cache::$data['settings--tree_items']['user']['registration']->id = 'registration';
  cache::$data['settings--tree_items']['user']['registration']->id_parent = 'anonymous';
  cache::$data['settings--tree_items']['user']['registration']->title = 'registration';
  cache::$data['settings--tree_items']['user']['registration']->attributes['href'] = '/user/registration';
  cache::$data['settings--tree_items']['user']['registration']->attributes['class']['registration'] = 'registration';
  cache::$data['settings--tree_items']['user']['registration']->weight = -60;
  cache::$data['settings--tree_items']['user']['registration']->access = new \stdClass();
  cache::$data['settings--tree_items']['user']['registration']->access->roles['anonymous'] = 'anonymous';
  cache::$data['settings--tree_items']['user']['user'] = new \effectivecore\tree_item();
  cache::$data['settings--tree_items']['user']['user']->id = 'user';
  cache::$data['settings--tree_items']['user']['user']->id_parent = 'user';
  cache::$data['settings--tree_items']['user']['user']->parent_is_tree = true;
  cache::$data['settings--tree_items']['user']['user']->title = '%%_nick';
  cache::$data['settings--tree_items']['user']['user']->attributes['href'] = '/user/%%_id_user';
  cache::$data['settings--tree_items']['user']['user']->attributes['class']['user'] = 'user';
  cache::$data['settings--tree_items']['user']['user']->access = new \stdClass();
  cache::$data['settings--tree_items']['user']['user']->access->roles['admins'] = 'admins';
  cache::$data['settings--tree_items']['user']['user']->access->roles['registered'] = 'registered';
  cache::$data['settings--tree_items']['user']['user_edit'] = new \effectivecore\tree_item();
  cache::$data['settings--tree_items']['user']['user_edit']->id = 'user_edit';
  cache::$data['settings--tree_items']['user']['user_edit']->id_parent = 'user';
  cache::$data['settings--tree_items']['user']['user_edit']->title = 'edit';
  cache::$data['settings--tree_items']['user']['user_edit']->attributes['href'] = '/user/%%_id_user/edit';
  cache::$data['settings--tree_items']['user']['user_edit']->attributes['class']['user-edit'] = 'user-edit';
  cache::$data['settings--tree_items']['user']['user_edit']->weight = -100;
  cache::$data['settings--tree_items']['user']['user_edit']->access = new \stdClass();
  cache::$data['settings--tree_items']['user']['user_edit']->access->roles['admins'] = 'admins';
  cache::$data['settings--tree_items']['user']['user_edit']->access->roles['registered'] = 'registered';
  cache::$data['settings--tree_items']['user']['logout'] = new \effectivecore\tree_item();
  cache::$data['settings--tree_items']['user']['logout']->id = 'logout';
  cache::$data['settings--tree_items']['user']['logout']->id_parent = 'user';
  cache::$data['settings--tree_items']['user']['logout']->title = 'logout';
  cache::$data['settings--tree_items']['user']['logout']->attributes['href'] = '/user/logout';
  cache::$data['settings--tree_items']['user']['logout']->attributes['class']['logout'] = 'logout';
  cache::$data['settings--tree_items']['user']['logout']->weight = -40;
  cache::$data['settings--tree_items']['user']['logout']->access = new \stdClass();
  cache::$data['settings--tree_items']['user']['logout']->access->roles['registered'] = 'registered';
  cache::$data['settings--tree_items']['user']['roles'] = new \effectivecore\tree_item();
  cache::$data['settings--tree_items']['user']['roles']->id = 'roles';
  cache::$data['settings--tree_items']['user']['roles']->id_parent = 'admin';
  cache::$data['settings--tree_items']['user']['roles']->title = 'Roles';
  cache::$data['settings--tree_items']['user']['roles']->attributes['href'] = '/admin/roles';
  cache::$data['settings--tree_items']['user']['roles']->attributes['class']['roles'] = 'roles';
  cache::$data['settings--tree_items']['user']['roles']->access = new \stdClass();
  cache::$data['settings--tree_items']['user']['roles']->access->roles['admins'] = 'admins';
  cache::$data['settings--tree_items']['user']['users'] = new \effectivecore\tree_item();
  cache::$data['settings--tree_items']['user']['users']->id = 'users';
  cache::$data['settings--tree_items']['user']['users']->id_parent = 'admin';
  cache::$data['settings--tree_items']['user']['users']->title = 'Users';
  cache::$data['settings--tree_items']['user']['users']->attributes['href'] = '/admin/users';
  cache::$data['settings--tree_items']['user']['users']->attributes['class']['users'] = 'users';
  cache::$data['settings--tree_items']['user']['users']->access = new \stdClass();
  cache::$data['settings--tree_items']['user']['users']->access->roles['admins'] = 'admins';

}