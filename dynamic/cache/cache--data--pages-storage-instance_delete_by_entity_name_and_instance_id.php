<?php

namespace effcore { # cache for data--pages-storage-instance_delete_by_entity_name_and_instance_id

  cache::$data['data--pages-storage-instance_delete_by_entity_name_and_instance_id'] = new \effcore\page();
  cache::$data['data--pages-storage-instance_delete_by_entity_name_and_instance_id']->title = 'Delete instance';
  cache::$data['data--pages-storage-instance_delete_by_entity_name_and_instance_id']->https = true;
  cache::$data['data--pages-storage-instance_delete_by_entity_name_and_instance_id']->display = new \stdClass();
  cache::$data['data--pages-storage-instance_delete_by_entity_name_and_instance_id']->display->check = 'url';
  cache::$data['data--pages-storage-instance_delete_by_entity_name_and_instance_id']->display->where = 'path';
  cache::$data['data--pages-storage-instance_delete_by_entity_name_and_instance_id']->display->match = '%^(?<base>/manage/instances)/(?<action>delete)/(?<entity_name>[a-z0-9_]+)/(?<instance_id>[a-zA-Z0-9-_+]+)$%';
  cache::$data['data--pages-storage-instance_delete_by_entity_name_and_instance_id']->access = new \stdClass();
  cache::$data['data--pages-storage-instance_delete_by_entity_name_and_instance_id']->access->roles['admins'] = 'admins';
  cache::$data['data--pages-storage-instance_delete_by_entity_name_and_instance_id']->children['check_access_instance_delete'] = new \effcore\page_part();
  cache::$data['data--pages-storage-instance_delete_by_entity_name_and_instance_id']->children['check_access_instance_delete']->region = 'head';
  cache::$data['data--pages-storage-instance_delete_by_entity_name_and_instance_id']->children['check_access_instance_delete']->type = 'code';
  cache::$data['data--pages-storage-instance_delete_by_entity_name_and_instance_id']->children['check_access_instance_delete']->source = '\\effcore\\modules\\storage\\events_access::on_check_access_instance_delete';
  cache::$data['data--pages-storage-instance_delete_by_entity_name_and_instance_id']->children['menu_main'] = new \effcore\page_part();
  cache::$data['data--pages-storage-instance_delete_by_entity_name_and_instance_id']->children['menu_main']->region = 'main_menu';
  cache::$data['data--pages-storage-instance_delete_by_entity_name_and_instance_id']->children['menu_main']->type = 'link';
  cache::$data['data--pages-storage-instance_delete_by_entity_name_and_instance_id']->children['menu_main']->source = 'trees/core/main';
  cache::$data['data--pages-storage-instance_delete_by_entity_name_and_instance_id']->children['menu_user'] = new \effcore\page_part();
  cache::$data['data--pages-storage-instance_delete_by_entity_name_and_instance_id']->children['menu_user']->region = 'head';
  cache::$data['data--pages-storage-instance_delete_by_entity_name_and_instance_id']->children['menu_user']->type = 'code';
  cache::$data['data--pages-storage-instance_delete_by_entity_name_and_instance_id']->children['menu_user']->source = '\\effcore\\modules\\user\\events_page::on_show_block_menu_user';
  cache::$data['data--pages-storage-instance_delete_by_entity_name_and_instance_id']->children['logo'] = new \effcore\page_part();
  cache::$data['data--pages-storage-instance_delete_by_entity_name_and_instance_id']->children['logo']->region = 'head';
  cache::$data['data--pages-storage-instance_delete_by_entity_name_and_instance_id']->children['logo']->type = 'link';
  cache::$data['data--pages-storage-instance_delete_by_entity_name_and_instance_id']->children['logo']->source = 'blocks/page/logo';
  cache::$data['data--pages-storage-instance_delete_by_entity_name_and_instance_id']->children['title'] = new \effcore\page_part();
  cache::$data['data--pages-storage-instance_delete_by_entity_name_and_instance_id']->children['title']->region = 'title';
  cache::$data['data--pages-storage-instance_delete_by_entity_name_and_instance_id']->children['title']->type = 'code';
  cache::$data['data--pages-storage-instance_delete_by_entity_name_and_instance_id']->children['title']->source = '\\effcore\\modules\\page\\events_page::on_show_title';
  cache::$data['data--pages-storage-instance_delete_by_entity_name_and_instance_id']->children['form_instance_delete'] = new \effcore\page_part();
  cache::$data['data--pages-storage-instance_delete_by_entity_name_and_instance_id']->children['form_instance_delete']->type = 'link';
  cache::$data['data--pages-storage-instance_delete_by_entity_name_and_instance_id']->children['form_instance_delete']->source = 'forms/storage/instance_delete';
  cache::$data['data--pages-storage-instance_delete_by_entity_name_and_instance_id']->children['form_access'] = new \effcore\page_part();
  cache::$data['data--pages-storage-instance_delete_by_entity_name_and_instance_id']->children['form_access']->display = new \stdClass();
  cache::$data['data--pages-storage-instance_delete_by_entity_name_and_instance_id']->children['form_access']->display->check = 'user';
  cache::$data['data--pages-storage-instance_delete_by_entity_name_and_instance_id']->children['form_access']->display->where = 'role';
  cache::$data['data--pages-storage-instance_delete_by_entity_name_and_instance_id']->children['form_access']->display->match = '%^admins$%';
  cache::$data['data--pages-storage-instance_delete_by_entity_name_and_instance_id']->children['form_access']->type = 'link';
  cache::$data['data--pages-storage-instance_delete_by_entity_name_and_instance_id']->children['form_access']->source = 'forms/user/access';
  cache::$data['data--pages-storage-instance_delete_by_entity_name_and_instance_id']->children['form_access']->source_args['entity_name'] = 'page';

}