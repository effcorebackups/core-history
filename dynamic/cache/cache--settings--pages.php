<?php

namespace effectivecore { # cache for settings--pages

  cache_factory::$data['settings--pages']['core']['page_front'] = new \effectivecore\page();
  cache_factory::$data['settings--pages']['core']['page_front']->title = 'Front page';
  cache_factory::$data['settings--pages']['core']['page_front']->content['block_tree_main'] = new \stdClass();
  cache_factory::$data['settings--pages']['core']['page_front']->content['block_tree_main']->region = 'nav';
  cache_factory::$data['settings--pages']['core']['page_front']->content['block_tree_main']->type = 'link';
  cache_factory::$data['settings--pages']['core']['page_front']->content['block_tree_main']->npath = 'trees/core/main';
  cache_factory::$data['settings--pages']['core']['page_front']->content['block_tree_user'] = new \stdClass();
  cache_factory::$data['settings--pages']['core']['page_front']->content['block_tree_user']->region = 'nav';
  cache_factory::$data['settings--pages']['core']['page_front']->content['block_tree_user']->type = 'link';
  cache_factory::$data['settings--pages']['core']['page_front']->content['block_tree_user']->npath = 'trees/user/user';
  cache_factory::$data['settings--pages']['core']['page_front']->content['block_wellcome'] = new \stdClass();
  cache_factory::$data['settings--pages']['core']['page_front']->content['block_wellcome']->region = 'content_1_1';
  cache_factory::$data['settings--pages']['core']['page_front']->content['block_wellcome']->type = 'text';
  cache_factory::$data['settings--pages']['core']['page_front']->content['block_wellcome']->content = 'Wellcome to our site!';
  cache_factory::$data['settings--pages']['core']['page_front']->display = new \stdClass();
  cache_factory::$data['settings--pages']['core']['page_front']->display->url = new \stdClass();
  cache_factory::$data['settings--pages']['core']['page_front']->display->url->match = '%^/$%';
  cache_factory::$data['settings--pages']['core']['page_installation'] = new \effectivecore\page();
  cache_factory::$data['settings--pages']['core']['page_installation']->title = 'Installation';
  cache_factory::$data['settings--pages']['core']['page_installation']->access = new \stdClass();
  cache_factory::$data['settings--pages']['core']['page_installation']->access->roles['anonymous'] = 'anonymous';
  cache_factory::$data['settings--pages']['core']['page_installation']->content['block_tree_main'] = new \stdClass();
  cache_factory::$data['settings--pages']['core']['page_installation']->content['block_tree_main']->region = 'nav';
  cache_factory::$data['settings--pages']['core']['page_installation']->content['block_tree_main']->type = 'link';
  cache_factory::$data['settings--pages']['core']['page_installation']->content['block_tree_main']->npath = 'trees/core/main';
  cache_factory::$data['settings--pages']['core']['page_installation']->content['block_tree_user'] = new \stdClass();
  cache_factory::$data['settings--pages']['core']['page_installation']->content['block_tree_user']->region = 'nav';
  cache_factory::$data['settings--pages']['core']['page_installation']->content['block_tree_user']->type = 'link';
  cache_factory::$data['settings--pages']['core']['page_installation']->content['block_tree_user']->npath = 'trees/user/user';
  cache_factory::$data['settings--pages']['core']['page_installation']->content['form_installation'] = new \stdClass();
  cache_factory::$data['settings--pages']['core']['page_installation']->content['form_installation']->region = 'content_1_1';
  cache_factory::$data['settings--pages']['core']['page_installation']->content['form_installation']->type = 'link';
  cache_factory::$data['settings--pages']['core']['page_installation']->content['form_installation']->npath = 'forms/core/installation';
  cache_factory::$data['settings--pages']['core']['page_installation']->display = new \stdClass();
  cache_factory::$data['settings--pages']['core']['page_installation']->display->url = new \stdClass();
  cache_factory::$data['settings--pages']['core']['page_installation']->display->url->match = '%^/install$%';
  cache_factory::$data['settings--pages']['core']['page_modules'] = new \effectivecore\page();
  cache_factory::$data['settings--pages']['core']['page_modules']->title = 'Modules';
  cache_factory::$data['settings--pages']['core']['page_modules']->access = new \stdClass();
  cache_factory::$data['settings--pages']['core']['page_modules']->access->roles['admins'] = 'admins';
  cache_factory::$data['settings--pages']['core']['page_modules']->content['block_tree_main'] = new \stdClass();
  cache_factory::$data['settings--pages']['core']['page_modules']->content['block_tree_main']->region = 'nav';
  cache_factory::$data['settings--pages']['core']['page_modules']->content['block_tree_main']->type = 'link';
  cache_factory::$data['settings--pages']['core']['page_modules']->content['block_tree_main']->npath = 'trees/core/main';
  cache_factory::$data['settings--pages']['core']['page_modules']->content['block_tree_user'] = new \stdClass();
  cache_factory::$data['settings--pages']['core']['page_modules']->content['block_tree_user']->region = 'nav';
  cache_factory::$data['settings--pages']['core']['page_modules']->content['block_tree_user']->type = 'link';
  cache_factory::$data['settings--pages']['core']['page_modules']->content['block_tree_user']->npath = 'trees/user/user';
  cache_factory::$data['settings--pages']['core']['page_modules']->content['block_admin_modules'] = new \stdClass();
  cache_factory::$data['settings--pages']['core']['page_modules']->content['block_admin_modules']->region = 'content_1_1';
  cache_factory::$data['settings--pages']['core']['page_modules']->content['block_admin_modules']->type = 'code';
  cache_factory::$data['settings--pages']['core']['page_modules']->content['block_admin_modules']->handler = '\\effectivecore\\events_page::on_show_admin_modules';
  cache_factory::$data['settings--pages']['core']['page_modules']->display = new \stdClass();
  cache_factory::$data['settings--pages']['core']['page_modules']->display->url = new \stdClass();
  cache_factory::$data['settings--pages']['core']['page_modules']->display->url->match = '%^/admin/modules$%';
  cache_factory::$data['settings--pages']['develop']['page_demo'] = new \effectivecore\page();
  cache_factory::$data['settings--pages']['develop']['page_demo']->title = 'Demo';
  cache_factory::$data['settings--pages']['develop']['page_demo']->access = new \stdClass();
  cache_factory::$data['settings--pages']['develop']['page_demo']->access->roles['admins'] = 'admins';
  cache_factory::$data['settings--pages']['develop']['page_demo']->content['block_tree_main'] = new \stdClass();
  cache_factory::$data['settings--pages']['develop']['page_demo']->content['block_tree_main']->region = 'nav';
  cache_factory::$data['settings--pages']['develop']['page_demo']->content['block_tree_main']->type = 'link';
  cache_factory::$data['settings--pages']['develop']['page_demo']->content['block_tree_main']->npath = 'trees/core/main';
  cache_factory::$data['settings--pages']['develop']['page_demo']->content['block_tree_user'] = new \stdClass();
  cache_factory::$data['settings--pages']['develop']['page_demo']->content['block_tree_user']->region = 'nav';
  cache_factory::$data['settings--pages']['develop']['page_demo']->content['block_tree_user']->type = 'link';
  cache_factory::$data['settings--pages']['develop']['page_demo']->content['block_tree_user']->npath = 'trees/user/user';
  cache_factory::$data['settings--pages']['develop']['page_demo']->content['form_demo'] = new \stdClass();
  cache_factory::$data['settings--pages']['develop']['page_demo']->content['form_demo']->region = 'content_1_1';
  cache_factory::$data['settings--pages']['develop']['page_demo']->content['form_demo']->type = 'link';
  cache_factory::$data['settings--pages']['develop']['page_demo']->content['form_demo']->npath = 'forms/develop/demo';
  cache_factory::$data['settings--pages']['develop']['page_demo']->content['block_demo_static'] = new \stdClass();
  cache_factory::$data['settings--pages']['develop']['page_demo']->content['block_demo_static']->region = 'content_1_1';
  cache_factory::$data['settings--pages']['develop']['page_demo']->content['block_demo_static']->type = 'link';
  cache_factory::$data['settings--pages']['develop']['page_demo']->content['block_demo_static']->npath = 'blocks/develop/block_demo';
  cache_factory::$data['settings--pages']['develop']['page_demo']->content['block_demo_dynamic'] = new \stdClass();
  cache_factory::$data['settings--pages']['develop']['page_demo']->content['block_demo_dynamic']->region = 'content_1_1';
  cache_factory::$data['settings--pages']['develop']['page_demo']->content['block_demo_dynamic']->type = 'code';
  cache_factory::$data['settings--pages']['develop']['page_demo']->content['block_demo_dynamic']->handler = '\\effectivecore\\modules\\develop\\events_page::on_show_block_demo_dynamic';
  cache_factory::$data['settings--pages']['develop']['page_demo']->display = new \stdClass();
  cache_factory::$data['settings--pages']['develop']['page_demo']->display->url = new \stdClass();
  cache_factory::$data['settings--pages']['develop']['page_demo']->display->url->match = '%^/develop/demo$%';
  cache_factory::$data['settings--pages']['page']['page_decoration'] = new \effectivecore\page();
  cache_factory::$data['settings--pages']['page']['page_decoration']->title = 'Decoration';
  cache_factory::$data['settings--pages']['page']['page_decoration']->access = new \stdClass();
  cache_factory::$data['settings--pages']['page']['page_decoration']->access->roles['admins'] = 'admins';
  cache_factory::$data['settings--pages']['page']['page_decoration']->content['block_tree_main'] = new \stdClass();
  cache_factory::$data['settings--pages']['page']['page_decoration']->content['block_tree_main']->region = 'nav';
  cache_factory::$data['settings--pages']['page']['page_decoration']->content['block_tree_main']->type = 'link';
  cache_factory::$data['settings--pages']['page']['page_decoration']->content['block_tree_main']->npath = 'trees/core/main';
  cache_factory::$data['settings--pages']['page']['page_decoration']->content['block_tree_user'] = new \stdClass();
  cache_factory::$data['settings--pages']['page']['page_decoration']->content['block_tree_user']->region = 'nav';
  cache_factory::$data['settings--pages']['page']['page_decoration']->content['block_tree_user']->type = 'link';
  cache_factory::$data['settings--pages']['page']['page_decoration']->content['block_tree_user']->npath = 'trees/user/user';
  cache_factory::$data['settings--pages']['page']['page_decoration']->content['form_admin_decoration'] = new \stdClass();
  cache_factory::$data['settings--pages']['page']['page_decoration']->content['form_admin_decoration']->region = 'content_1_1';
  cache_factory::$data['settings--pages']['page']['page_decoration']->content['form_admin_decoration']->type = 'link';
  cache_factory::$data['settings--pages']['page']['page_decoration']->content['form_admin_decoration']->npath = 'forms/page/decoration';
  cache_factory::$data['settings--pages']['page']['page_decoration']->display = new \stdClass();
  cache_factory::$data['settings--pages']['page']['page_decoration']->display->url = new \stdClass();
  cache_factory::$data['settings--pages']['page']['page_decoration']->display->url->match = '%^/admin/decoration$%';
  cache_factory::$data['settings--pages']['user']['page_admin_roles'] = new \effectivecore\page();
  cache_factory::$data['settings--pages']['user']['page_admin_roles']->title = 'Roles';
  cache_factory::$data['settings--pages']['user']['page_admin_roles']->access = new \stdClass();
  cache_factory::$data['settings--pages']['user']['page_admin_roles']->access->roles['admins'] = 'admins';
  cache_factory::$data['settings--pages']['user']['page_admin_roles']->constants['items_per_page'] = 50;
  cache_factory::$data['settings--pages']['user']['page_admin_roles']->content['block_tree_main'] = new \stdClass();
  cache_factory::$data['settings--pages']['user']['page_admin_roles']->content['block_tree_main']->region = 'nav';
  cache_factory::$data['settings--pages']['user']['page_admin_roles']->content['block_tree_main']->type = 'link';
  cache_factory::$data['settings--pages']['user']['page_admin_roles']->content['block_tree_main']->npath = 'trees/core/main';
  cache_factory::$data['settings--pages']['user']['page_admin_roles']->content['block_tree_user'] = new \stdClass();
  cache_factory::$data['settings--pages']['user']['page_admin_roles']->content['block_tree_user']->region = 'nav';
  cache_factory::$data['settings--pages']['user']['page_admin_roles']->content['block_tree_user']->type = 'link';
  cache_factory::$data['settings--pages']['user']['page_admin_roles']->content['block_tree_user']->npath = 'trees/user/user';
  cache_factory::$data['settings--pages']['user']['page_admin_roles']->content['block_admin_roles'] = new \stdClass();
  cache_factory::$data['settings--pages']['user']['page_admin_roles']->content['block_admin_roles']->region = 'content_1_1';
  cache_factory::$data['settings--pages']['user']['page_admin_roles']->content['block_admin_roles']->type = 'code';
  cache_factory::$data['settings--pages']['user']['page_admin_roles']->content['block_admin_roles']->handler = '\\effectivecore\\modules\\user\\events_page::on_show_block_admin_roles';
  cache_factory::$data['settings--pages']['user']['page_admin_roles']->display = new \stdClass();
  cache_factory::$data['settings--pages']['user']['page_admin_roles']->display->url = new \stdClass();
  cache_factory::$data['settings--pages']['user']['page_admin_roles']->display->url->match = '%^/admin/roles$%';
  cache_factory::$data['settings--pages']['user']['page_admin_users'] = new \effectivecore\page();
  cache_factory::$data['settings--pages']['user']['page_admin_users']->title = 'Users';
  cache_factory::$data['settings--pages']['user']['page_admin_users']->access = new \stdClass();
  cache_factory::$data['settings--pages']['user']['page_admin_users']->access->roles['admins'] = 'admins';
  cache_factory::$data['settings--pages']['user']['page_admin_users']->constants['items_per_page'] = 50;
  cache_factory::$data['settings--pages']['user']['page_admin_users']->content['block_tree_main'] = new \stdClass();
  cache_factory::$data['settings--pages']['user']['page_admin_users']->content['block_tree_main']->region = 'nav';
  cache_factory::$data['settings--pages']['user']['page_admin_users']->content['block_tree_main']->type = 'link';
  cache_factory::$data['settings--pages']['user']['page_admin_users']->content['block_tree_main']->npath = 'trees/core/main';
  cache_factory::$data['settings--pages']['user']['page_admin_users']->content['block_tree_user'] = new \stdClass();
  cache_factory::$data['settings--pages']['user']['page_admin_users']->content['block_tree_user']->region = 'nav';
  cache_factory::$data['settings--pages']['user']['page_admin_users']->content['block_tree_user']->type = 'link';
  cache_factory::$data['settings--pages']['user']['page_admin_users']->content['block_tree_user']->npath = 'trees/user/user';
  cache_factory::$data['settings--pages']['user']['page_admin_users']->content['block_admin_users'] = new \stdClass();
  cache_factory::$data['settings--pages']['user']['page_admin_users']->content['block_admin_users']->region = 'content_1_1';
  cache_factory::$data['settings--pages']['user']['page_admin_users']->content['block_admin_users']->type = 'code';
  cache_factory::$data['settings--pages']['user']['page_admin_users']->content['block_admin_users']->handler = '\\effectivecore\\modules\\user\\events_page::on_show_block_admin_users';
  cache_factory::$data['settings--pages']['user']['page_admin_users']->display = new \stdClass();
  cache_factory::$data['settings--pages']['user']['page_admin_users']->display->url = new \stdClass();
  cache_factory::$data['settings--pages']['user']['page_admin_users']->display->url->match = '%^/admin/users$%';
  cache_factory::$data['settings--pages']['user']['page_admin_users_delete_n'] = new \effectivecore\page();
  cache_factory::$data['settings--pages']['user']['page_admin_users_delete_n']->title = 'Delete profile %%_user_email_context{4}?';
  cache_factory::$data['settings--pages']['user']['page_admin_users_delete_n']->access = new \stdClass();
  cache_factory::$data['settings--pages']['user']['page_admin_users_delete_n']->access->roles['admins'] = 'admins';
  cache_factory::$data['settings--pages']['user']['page_admin_users_delete_n']->content['block_tree_main'] = new \stdClass();
  cache_factory::$data['settings--pages']['user']['page_admin_users_delete_n']->content['block_tree_main']->region = 'nav';
  cache_factory::$data['settings--pages']['user']['page_admin_users_delete_n']->content['block_tree_main']->type = 'link';
  cache_factory::$data['settings--pages']['user']['page_admin_users_delete_n']->content['block_tree_main']->npath = 'trees/core/main';
  cache_factory::$data['settings--pages']['user']['page_admin_users_delete_n']->content['block_tree_user'] = new \stdClass();
  cache_factory::$data['settings--pages']['user']['page_admin_users_delete_n']->content['block_tree_user']->region = 'nav';
  cache_factory::$data['settings--pages']['user']['page_admin_users_delete_n']->content['block_tree_user']->type = 'link';
  cache_factory::$data['settings--pages']['user']['page_admin_users_delete_n']->content['block_tree_user']->npath = 'trees/user/user';
  cache_factory::$data['settings--pages']['user']['page_admin_users_delete_n']->content['check_access_user_n_delete'] = new \stdClass();
  cache_factory::$data['settings--pages']['user']['page_admin_users_delete_n']->content['check_access_user_n_delete']->region = 'content_1_1';
  cache_factory::$data['settings--pages']['user']['page_admin_users_delete_n']->content['check_access_user_n_delete']->type = 'code';
  cache_factory::$data['settings--pages']['user']['page_admin_users_delete_n']->content['check_access_user_n_delete']->handler = '\\effectivecore\\modules\\user\\events_access::on_check_access_user_n_delete';
  cache_factory::$data['settings--pages']['user']['page_admin_users_delete_n']->content['form_user_n_delete'] = new \stdClass();
  cache_factory::$data['settings--pages']['user']['page_admin_users_delete_n']->content['form_user_n_delete']->region = 'content_1_1';
  cache_factory::$data['settings--pages']['user']['page_admin_users_delete_n']->content['form_user_n_delete']->type = 'link';
  cache_factory::$data['settings--pages']['user']['page_admin_users_delete_n']->content['form_user_n_delete']->npath = 'forms/user/form_user_n_delete';
  cache_factory::$data['settings--pages']['user']['page_admin_users_delete_n']->display = new \stdClass();
  cache_factory::$data['settings--pages']['user']['page_admin_users_delete_n']->display->url = new \stdClass();
  cache_factory::$data['settings--pages']['user']['page_admin_users_delete_n']->display->url->match = '%^/admin/users/delete/[0-9]+$%';
  cache_factory::$data['settings--pages']['user']['page_admin_users_delete_n']->display->url->args['user_id'] = 4;
  cache_factory::$data['settings--pages']['user']['page_user_login'] = new \effectivecore\page();
  cache_factory::$data['settings--pages']['user']['page_user_login']->title = 'Login';
  cache_factory::$data['settings--pages']['user']['page_user_login']->access = new \stdClass();
  cache_factory::$data['settings--pages']['user']['page_user_login']->access->roles['anonymous'] = 'anonymous';
  cache_factory::$data['settings--pages']['user']['page_user_login']->content['block_tree_main'] = new \stdClass();
  cache_factory::$data['settings--pages']['user']['page_user_login']->content['block_tree_main']->region = 'nav';
  cache_factory::$data['settings--pages']['user']['page_user_login']->content['block_tree_main']->type = 'link';
  cache_factory::$data['settings--pages']['user']['page_user_login']->content['block_tree_main']->npath = 'trees/core/main';
  cache_factory::$data['settings--pages']['user']['page_user_login']->content['block_tree_user'] = new \stdClass();
  cache_factory::$data['settings--pages']['user']['page_user_login']->content['block_tree_user']->region = 'nav';
  cache_factory::$data['settings--pages']['user']['page_user_login']->content['block_tree_user']->type = 'link';
  cache_factory::$data['settings--pages']['user']['page_user_login']->content['block_tree_user']->npath = 'trees/user/user';
  cache_factory::$data['settings--pages']['user']['page_user_login']->content['form_login'] = new \stdClass();
  cache_factory::$data['settings--pages']['user']['page_user_login']->content['form_login']->region = 'content_1_1';
  cache_factory::$data['settings--pages']['user']['page_user_login']->content['form_login']->type = 'link';
  cache_factory::$data['settings--pages']['user']['page_user_login']->content['form_login']->npath = 'forms/user/login';
  cache_factory::$data['settings--pages']['user']['page_user_login']->https = true;
  cache_factory::$data['settings--pages']['user']['page_user_login']->display = new \stdClass();
  cache_factory::$data['settings--pages']['user']['page_user_login']->display->url = new \stdClass();
  cache_factory::$data['settings--pages']['user']['page_user_login']->display->url->match = '%^/user/login$%';
  cache_factory::$data['settings--pages']['user']['page_user_logout'] = new \effectivecore\page();
  cache_factory::$data['settings--pages']['user']['page_user_logout']->title = 'Logout from the system';
  cache_factory::$data['settings--pages']['user']['page_user_logout']->access = new \stdClass();
  cache_factory::$data['settings--pages']['user']['page_user_logout']->access->roles['registered'] = 'registered';
  cache_factory::$data['settings--pages']['user']['page_user_logout']->content['block_tree_main'] = new \stdClass();
  cache_factory::$data['settings--pages']['user']['page_user_logout']->content['block_tree_main']->region = 'nav';
  cache_factory::$data['settings--pages']['user']['page_user_logout']->content['block_tree_main']->type = 'link';
  cache_factory::$data['settings--pages']['user']['page_user_logout']->content['block_tree_main']->npath = 'trees/core/main';
  cache_factory::$data['settings--pages']['user']['page_user_logout']->content['block_tree_user'] = new \stdClass();
  cache_factory::$data['settings--pages']['user']['page_user_logout']->content['block_tree_user']->region = 'nav';
  cache_factory::$data['settings--pages']['user']['page_user_logout']->content['block_tree_user']->type = 'link';
  cache_factory::$data['settings--pages']['user']['page_user_logout']->content['block_tree_user']->npath = 'trees/user/user';
  cache_factory::$data['settings--pages']['user']['page_user_logout']->content['form_user_logout'] = new \stdClass();
  cache_factory::$data['settings--pages']['user']['page_user_logout']->content['form_user_logout']->region = 'content_1_1';
  cache_factory::$data['settings--pages']['user']['page_user_logout']->content['form_user_logout']->type = 'link';
  cache_factory::$data['settings--pages']['user']['page_user_logout']->content['form_user_logout']->npath = 'forms/user/logout';
  cache_factory::$data['settings--pages']['user']['page_user_logout']->display = new \stdClass();
  cache_factory::$data['settings--pages']['user']['page_user_logout']->display->url = new \stdClass();
  cache_factory::$data['settings--pages']['user']['page_user_logout']->display->url->match = '%^/user/logout$%';
  cache_factory::$data['settings--pages']['user']['page_user_n'] = new \effectivecore\page();
  cache_factory::$data['settings--pages']['user']['page_user_n']->title = 'User profile %%_user_email_context{2}';
  cache_factory::$data['settings--pages']['user']['page_user_n']->access = new \stdClass();
  cache_factory::$data['settings--pages']['user']['page_user_n']->access->roles['admins'] = 'admins';
  cache_factory::$data['settings--pages']['user']['page_user_n']->access->roles['registered'] = 'registered';
  cache_factory::$data['settings--pages']['user']['page_user_n']->content['block_tree_main'] = new \stdClass();
  cache_factory::$data['settings--pages']['user']['page_user_n']->content['block_tree_main']->region = 'nav';
  cache_factory::$data['settings--pages']['user']['page_user_n']->content['block_tree_main']->type = 'link';
  cache_factory::$data['settings--pages']['user']['page_user_n']->content['block_tree_main']->npath = 'trees/core/main';
  cache_factory::$data['settings--pages']['user']['page_user_n']->content['block_tree_user'] = new \stdClass();
  cache_factory::$data['settings--pages']['user']['page_user_n']->content['block_tree_user']->region = 'nav';
  cache_factory::$data['settings--pages']['user']['page_user_n']->content['block_tree_user']->type = 'link';
  cache_factory::$data['settings--pages']['user']['page_user_n']->content['block_tree_user']->npath = 'trees/user/user';
  cache_factory::$data['settings--pages']['user']['page_user_n']->content['block_user_n'] = new \stdClass();
  cache_factory::$data['settings--pages']['user']['page_user_n']->content['block_user_n']->region = 'content_1_1';
  cache_factory::$data['settings--pages']['user']['page_user_n']->content['block_user_n']->type = 'code';
  cache_factory::$data['settings--pages']['user']['page_user_n']->content['block_user_n']->handler = '\\effectivecore\\modules\\user\\events_page::on_show_block_user_n';
  cache_factory::$data['settings--pages']['user']['page_user_n']->https = true;
  cache_factory::$data['settings--pages']['user']['page_user_n']->display = new \stdClass();
  cache_factory::$data['settings--pages']['user']['page_user_n']->display->url = new \stdClass();
  cache_factory::$data['settings--pages']['user']['page_user_n']->display->url->match = '%^/user/[0-9]+$%';
  cache_factory::$data['settings--pages']['user']['page_user_n']->display->url->args['user_id'] = 2;
  cache_factory::$data['settings--pages']['user']['page_user_n_edit'] = new \effectivecore\page();
  cache_factory::$data['settings--pages']['user']['page_user_n_edit']->title = 'Edit profile %%_user_email_context{2}';
  cache_factory::$data['settings--pages']['user']['page_user_n_edit']->access = new \stdClass();
  cache_factory::$data['settings--pages']['user']['page_user_n_edit']->access->roles['admins'] = 'admins';
  cache_factory::$data['settings--pages']['user']['page_user_n_edit']->access->roles['registered'] = 'registered';
  cache_factory::$data['settings--pages']['user']['page_user_n_edit']->content['block_tree_main'] = new \stdClass();
  cache_factory::$data['settings--pages']['user']['page_user_n_edit']->content['block_tree_main']->region = 'nav';
  cache_factory::$data['settings--pages']['user']['page_user_n_edit']->content['block_tree_main']->type = 'link';
  cache_factory::$data['settings--pages']['user']['page_user_n_edit']->content['block_tree_main']->npath = 'trees/core/main';
  cache_factory::$data['settings--pages']['user']['page_user_n_edit']->content['block_tree_user'] = new \stdClass();
  cache_factory::$data['settings--pages']['user']['page_user_n_edit']->content['block_tree_user']->region = 'nav';
  cache_factory::$data['settings--pages']['user']['page_user_n_edit']->content['block_tree_user']->type = 'link';
  cache_factory::$data['settings--pages']['user']['page_user_n_edit']->content['block_tree_user']->npath = 'trees/user/user';
  cache_factory::$data['settings--pages']['user']['page_user_n_edit']->content['check_access_user_n_edit'] = new \stdClass();
  cache_factory::$data['settings--pages']['user']['page_user_n_edit']->content['check_access_user_n_edit']->region = 'content_1_1';
  cache_factory::$data['settings--pages']['user']['page_user_n_edit']->content['check_access_user_n_edit']->type = 'code';
  cache_factory::$data['settings--pages']['user']['page_user_n_edit']->content['check_access_user_n_edit']->handler = '\\effectivecore\\modules\\user\\events_access::on_check_access_user_n_edit';
  cache_factory::$data['settings--pages']['user']['page_user_n_edit']->content['form_user_n_edit'] = new \stdClass();
  cache_factory::$data['settings--pages']['user']['page_user_n_edit']->content['form_user_n_edit']->region = 'content_1_1';
  cache_factory::$data['settings--pages']['user']['page_user_n_edit']->content['form_user_n_edit']->type = 'link';
  cache_factory::$data['settings--pages']['user']['page_user_n_edit']->content['form_user_n_edit']->npath = 'forms/user/user_n_edit';
  cache_factory::$data['settings--pages']['user']['page_user_n_edit']->https = true;
  cache_factory::$data['settings--pages']['user']['page_user_n_edit']->display = new \stdClass();
  cache_factory::$data['settings--pages']['user']['page_user_n_edit']->display->url = new \stdClass();
  cache_factory::$data['settings--pages']['user']['page_user_n_edit']->display->url->match = '%^/user/[0-9]+/edit$%';
  cache_factory::$data['settings--pages']['user']['page_user_n_edit']->display->url->args['user_id'] = 2;
  cache_factory::$data['settings--pages']['user']['page_user_registration'] = new \effectivecore\page();
  cache_factory::$data['settings--pages']['user']['page_user_registration']->title = 'Registration';
  cache_factory::$data['settings--pages']['user']['page_user_registration']->access = new \stdClass();
  cache_factory::$data['settings--pages']['user']['page_user_registration']->access->roles['anonymous'] = 'anonymous';
  cache_factory::$data['settings--pages']['user']['page_user_registration']->content['block_tree_main'] = new \stdClass();
  cache_factory::$data['settings--pages']['user']['page_user_registration']->content['block_tree_main']->region = 'nav';
  cache_factory::$data['settings--pages']['user']['page_user_registration']->content['block_tree_main']->type = 'link';
  cache_factory::$data['settings--pages']['user']['page_user_registration']->content['block_tree_main']->npath = 'trees/core/main';
  cache_factory::$data['settings--pages']['user']['page_user_registration']->content['block_tree_user'] = new \stdClass();
  cache_factory::$data['settings--pages']['user']['page_user_registration']->content['block_tree_user']->region = 'nav';
  cache_factory::$data['settings--pages']['user']['page_user_registration']->content['block_tree_user']->type = 'link';
  cache_factory::$data['settings--pages']['user']['page_user_registration']->content['block_tree_user']->npath = 'trees/user/user';
  cache_factory::$data['settings--pages']['user']['page_user_registration']->content['form_user_registration'] = new \stdClass();
  cache_factory::$data['settings--pages']['user']['page_user_registration']->content['form_user_registration']->region = 'content_1_1';
  cache_factory::$data['settings--pages']['user']['page_user_registration']->content['form_user_registration']->type = 'link';
  cache_factory::$data['settings--pages']['user']['page_user_registration']->content['form_user_registration']->npath = 'forms/user/registration';
  cache_factory::$data['settings--pages']['user']['page_user_registration']->https = true;
  cache_factory::$data['settings--pages']['user']['page_user_registration']->display = new \stdClass();
  cache_factory::$data['settings--pages']['user']['page_user_registration']->display->url = new \stdClass();
  cache_factory::$data['settings--pages']['user']['page_user_registration']->display->url->match = '%^/user/registration$%';

}