<?php

namespace effectivecore { # cache for data--pages-user-login

  cache::$data['data--pages-user-login'] = new \effectivecore\page();
  cache::$data['data--pages-user-login']->title = 'Login';
  cache::$data['data--pages-user-login']->https = true;
  cache::$data['data--pages-user-login']->display = new \stdClass();
  cache::$data['data--pages-user-login']->display->check = 'url';
  cache::$data['data--pages-user-login']->display->match = '%^/user/login$%';
  cache::$data['data--pages-user-login']->access = new \stdClass();
  cache::$data['data--pages-user-login']->access->roles['anonymous'] = 'anonymous';
  cache::$data['data--pages-user-login']->content['block_menu_main'] = new \stdClass();
  cache::$data['data--pages-user-login']->content['block_menu_main']->region = 'main_menu';
  cache::$data['data--pages-user-login']->content['block_menu_main']->type = 'link';
  cache::$data['data--pages-user-login']->content['block_menu_main']->dpath = 'trees/core/main';
  cache::$data['data--pages-user-login']->content['block_menu_user'] = new \stdClass();
  cache::$data['data--pages-user-login']->content['block_menu_user']->region = 'head_2';
  cache::$data['data--pages-user-login']->content['block_menu_user']->type = 'code';
  cache::$data['data--pages-user-login']->content['block_menu_user']->handler = '\\effectivecore\\modules\\core\\events_page::on_show_block_menu_user';
  cache::$data['data--pages-user-login']->content['block_logo'] = new \stdClass();
  cache::$data['data--pages-user-login']->content['block_logo']->region = 'head_3';
  cache::$data['data--pages-user-login']->content['block_logo']->type = 'code';
  cache::$data['data--pages-user-login']->content['block_logo']->handler = '\\effectivecore\\modules\\core\\events_page::on_show_block_logo';
  cache::$data['data--pages-user-login']->content['block_title'] = new \stdClass();
  cache::$data['data--pages-user-login']->content['block_title']->region = 'main_1';
  cache::$data['data--pages-user-login']->content['block_title']->type = 'code';
  cache::$data['data--pages-user-login']->content['block_title']->handler = '\\effectivecore\\modules\\core\\events_page::on_show_block_title';
  cache::$data['data--pages-user-login']->content['form_login'] = new \stdClass();
  cache::$data['data--pages-user-login']->content['form_login']->region = 'main_1';
  cache::$data['data--pages-user-login']->content['form_login']->type = 'link';
  cache::$data['data--pages-user-login']->content['form_login']->dpath = 'forms/user/login';
  cache::$data['data--pages-user-login']->content['block_copyright'] = new \stdClass();
  cache::$data['data--pages-user-login']->content['block_copyright']->region = 'copyright';
  cache::$data['data--pages-user-login']->content['block_copyright']->type = 'code';
  cache::$data['data--pages-user-login']->content['block_copyright']->handler = '\\effectivecore\\modules\\core\\events_page::on_show_block_copyright';

}