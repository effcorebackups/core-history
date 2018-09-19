<?php

namespace effcore { # cache for data--pages-page-decoration

  cache::$data['data--pages-page-decoration'] = new \effcore\page();
  cache::$data['data--pages-page-decoration']->title = 'Decoration';
  cache::$data['data--pages-page-decoration']->https = true;
  cache::$data['data--pages-page-decoration']->display = new \stdClass();
  cache::$data['data--pages-page-decoration']->display->check = 'url';
  cache::$data['data--pages-page-decoration']->display->where = 'path';
  cache::$data['data--pages-page-decoration']->display->match = '%^/manage/decoration$%';
  cache::$data['data--pages-page-decoration']->access = new \stdClass();
  cache::$data['data--pages-page-decoration']->access->roles['admins'] = 'admins';
  cache::$data['data--pages-page-decoration']->content['menu_main'] = new \effcore\page_part();
  cache::$data['data--pages-page-decoration']->content['menu_main']->region = 'main_menu';
  cache::$data['data--pages-page-decoration']->content['menu_main']->type = 'link';
  cache::$data['data--pages-page-decoration']->content['menu_main']->source = 'trees/core/main';
  cache::$data['data--pages-page-decoration']->content['menu_user'] = new \effcore\page_part();
  cache::$data['data--pages-page-decoration']->content['menu_user']->region = 'head';
  cache::$data['data--pages-page-decoration']->content['menu_user']->type = 'code';
  cache::$data['data--pages-page-decoration']->content['menu_user']->source = '\\effcore\\modules\\menu\\events_page::on_show_block_menu_user';
  cache::$data['data--pages-page-decoration']->content['block_logo'] = new \stdClass();
  cache::$data['data--pages-page-decoration']->content['block_logo']->region = 'head';
  cache::$data['data--pages-page-decoration']->content['block_logo']->type = 'link';
  cache::$data['data--pages-page-decoration']->content['block_logo']->dpath = 'blocks/page/logo';
  cache::$data['data--pages-page-decoration']->content['block_title'] = new \stdClass();
  cache::$data['data--pages-page-decoration']->content['block_title']->region = 'title';
  cache::$data['data--pages-page-decoration']->content['block_title']->type = 'code';
  cache::$data['data--pages-page-decoration']->content['block_title']->handler = '\\effcore\\modules\\page\\events_page::on_show_block_title';
  cache::$data['data--pages-page-decoration']->content['form_decoration'] = new \stdClass();
  cache::$data['data--pages-page-decoration']->content['form_decoration']->region = 'content';
  cache::$data['data--pages-page-decoration']->content['form_decoration']->type = 'link';
  cache::$data['data--pages-page-decoration']->content['form_decoration']->dpath = 'forms/page/decoration';

}