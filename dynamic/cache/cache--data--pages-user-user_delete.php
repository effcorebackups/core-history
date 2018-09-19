<?php

namespace effcore { # cache for data--pages-user-user_delete

  cache::$data['data--pages-user-user_delete'] = new \effcore\page();
  cache::$data['data--pages-user-user_delete']->title = 'Delete user %%_nick_context{4}?';
  cache::$data['data--pages-user-user_delete']->https = true;
  cache::$data['data--pages-user-user_delete']->display = new \stdClass();
  cache::$data['data--pages-user-user_delete']->display->check = 'url';
  cache::$data['data--pages-user-user_delete']->display->where = 'path';
  cache::$data['data--pages-user-user_delete']->display->match = '%^/manage/users/delete/(?<id_user>[0-9]+)$%';
  cache::$data['data--pages-user-user_delete']->access = new \stdClass();
  cache::$data['data--pages-user-user_delete']->access->roles['admins'] = 'admins';
  cache::$data['data--pages-user-user_delete']->content['check_access_user_delete'] = new \stdClass();
  cache::$data['data--pages-user-user_delete']->content['check_access_user_delete']->region = 'head';
  cache::$data['data--pages-user-user_delete']->content['check_access_user_delete']->type = 'code';
  cache::$data['data--pages-user-user_delete']->content['check_access_user_delete']->handler = '\\effcore\\modules\\user\\events_access::on_check_access_user_delete';
  cache::$data['data--pages-user-user_delete']->content['menu_main'] = new \effcore\page_part();
  cache::$data['data--pages-user-user_delete']->content['menu_main']->region = 'main_menu';
  cache::$data['data--pages-user-user_delete']->content['menu_main']->type = 'link';
  cache::$data['data--pages-user-user_delete']->content['menu_main']->source = 'trees/core/main';
  cache::$data['data--pages-user-user_delete']->content['menu_user'] = new \effcore\page_part();
  cache::$data['data--pages-user-user_delete']->content['menu_user']->region = 'head';
  cache::$data['data--pages-user-user_delete']->content['menu_user']->type = 'code';
  cache::$data['data--pages-user-user_delete']->content['menu_user']->source = '\\effcore\\modules\\menu\\events_page::on_show_block_menu_user';
  cache::$data['data--pages-user-user_delete']->content['logo'] = new \effcore\page_part();
  cache::$data['data--pages-user-user_delete']->content['logo']->region = 'head';
  cache::$data['data--pages-user-user_delete']->content['logo']->type = 'link';
  cache::$data['data--pages-user-user_delete']->content['logo']->source = 'blocks/page/logo';
  cache::$data['data--pages-user-user_delete']->content['title'] = new \effcore\page_part();
  cache::$data['data--pages-user-user_delete']->content['title']->region = 'title';
  cache::$data['data--pages-user-user_delete']->content['title']->type = 'code';
  cache::$data['data--pages-user-user_delete']->content['title']->source = '\\effcore\\modules\\page\\events_page::on_show_title';
  cache::$data['data--pages-user-user_delete']->content['form_user_delete'] = new \stdClass();
  cache::$data['data--pages-user-user_delete']->content['form_user_delete']->region = 'content';
  cache::$data['data--pages-user-user_delete']->content['form_user_delete']->type = 'link';
  cache::$data['data--pages-user-user_delete']->content['form_user_delete']->dpath = 'forms/user/user_delete';

}