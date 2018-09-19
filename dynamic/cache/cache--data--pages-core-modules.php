<?php

namespace effcore { # cache for data--pages-core-modules

  cache::$data['data--pages-core-modules'] = new \effcore\page();
  cache::$data['data--pages-core-modules']->title = 'Modules';
  cache::$data['data--pages-core-modules']->https = true;
  cache::$data['data--pages-core-modules']->display = new \stdClass();
  cache::$data['data--pages-core-modules']->display->check = 'url';
  cache::$data['data--pages-core-modules']->display->where = 'path';
  cache::$data['data--pages-core-modules']->display->match = '%^/manage/modules$%';
  cache::$data['data--pages-core-modules']->access = new \stdClass();
  cache::$data['data--pages-core-modules']->access->roles['admins'] = 'admins';
  cache::$data['data--pages-core-modules']->content['menu_main'] = new \effcore\page_part();
  cache::$data['data--pages-core-modules']->content['menu_main']->region = 'main_menu';
  cache::$data['data--pages-core-modules']->content['menu_main']->type = 'link';
  cache::$data['data--pages-core-modules']->content['menu_main']->source = 'trees/core/main';
  cache::$data['data--pages-core-modules']->content['menu_user'] = new \effcore\page_part();
  cache::$data['data--pages-core-modules']->content['menu_user']->region = 'head';
  cache::$data['data--pages-core-modules']->content['menu_user']->type = 'code';
  cache::$data['data--pages-core-modules']->content['menu_user']->source = '\\effcore\\modules\\menu\\events_page::on_show_block_menu_user';
  cache::$data['data--pages-core-modules']->content['logo'] = new \effcore\page_part();
  cache::$data['data--pages-core-modules']->content['logo']->region = 'head';
  cache::$data['data--pages-core-modules']->content['logo']->type = 'link';
  cache::$data['data--pages-core-modules']->content['logo']->source = 'blocks/page/logo';
  cache::$data['data--pages-core-modules']->content['title'] = new \effcore\page_part();
  cache::$data['data--pages-core-modules']->content['title']->region = 'title';
  cache::$data['data--pages-core-modules']->content['title']->type = 'code';
  cache::$data['data--pages-core-modules']->content['title']->source = '\\effcore\\modules\\page\\events_page::on_show_title';
  cache::$data['data--pages-core-modules']->content['block_modules'] = new \stdClass();
  cache::$data['data--pages-core-modules']->content['block_modules']->region = 'content';
  cache::$data['data--pages-core-modules']->content['block_modules']->type = 'code';
  cache::$data['data--pages-core-modules']->content['block_modules']->handler = '\\effcore\\modules\\core\\events_page::on_show_block_modules';

}