<?php

namespace effcore { # cache for data--forms-core-install

  cache::$data['data--forms-core-install'] = new \effcore\form();
  cache::$data['data--forms-core-install']->children['storage'] = new \effcore\fieldset();
  cache::$data['data--forms-core-install']->children['storage']->title = 'Storage params';
  cache::$data['data--forms-core-install']->children['storage']->children['is_mysql'] = new \effcore\field_radiobutton();
  cache::$data['data--forms-core-install']->children['storage']->children['is_mysql']->title = 'MySQL';
  cache::$data['data--forms-core-install']->children['storage']->children['is_mysql']->attributes['data-type'] = 'radiobutton';
  cache::$data['data--forms-core-install']->children['storage']->children['is_mysql']->attributes['class']['before-container'] = 'before-container';
  cache::$data['data--forms-core-install']->children['storage']->children['is_mysql']->element_attributes['name'] = 'driver';
  cache::$data['data--forms-core-install']->children['storage']->children['is_mysql']->element_attributes['value'] = 'mysql';
  cache::$data['data--forms-core-install']->children['storage']->children['mysql'] = new \effcore\fieldset();
  cache::$data['data--forms-core-install']->children['storage']->children['mysql']->children['storage_id'] = new \effcore\field_text();
  cache::$data['data--forms-core-install']->children['storage']->children['mysql']->children['storage_id']->title = 'Storage ID';
  cache::$data['data--forms-core-install']->children['storage']->children['mysql']->children['storage_id']->element_attributes['name'] = 'storage_id';
  cache::$data['data--forms-core-install']->children['storage']->children['mysql']->children['storage_id']->element_attributes['value'] = 'main';
  cache::$data['data--forms-core-install']->children['storage']->children['mysql']->children['storage_id']->element_attributes['minlength'] = 1;
  cache::$data['data--forms-core-install']->children['storage']->children['mysql']->children['storage_id']->element_attributes['maxlength'] = 128;
  cache::$data['data--forms-core-install']->children['storage']->children['mysql']->children['storage_id']->element_attributes['pattern'] = '%^[a-zA-Z0-9-_]+$%';
  cache::$data['data--forms-core-install']->children['storage']->children['mysql']->children['host_name'] = new \effcore\field_text();
  cache::$data['data--forms-core-install']->children['storage']->children['mysql']->children['host_name']->title = 'Hostname';
  cache::$data['data--forms-core-install']->children['storage']->children['mysql']->children['host_name']->element_attributes['name'] = 'host_name';
  cache::$data['data--forms-core-install']->children['storage']->children['mysql']->children['host_name']->element_attributes['value'] = '127.0.0.1';
  cache::$data['data--forms-core-install']->children['storage']->children['mysql']->children['host_name']->element_attributes['minlength'] = 1;
  cache::$data['data--forms-core-install']->children['storage']->children['mysql']->children['host_name']->element_attributes['maxlength'] = 253;
  cache::$data['data--forms-core-install']->children['storage']->children['mysql']->children['host_name']->element_attributes['pattern'] = '%^[a-zA-Z0-9-_:/.]+$%';
  cache::$data['data--forms-core-install']->children['storage']->children['mysql']->children['port'] = new \effcore\field_number();
  cache::$data['data--forms-core-install']->children['storage']->children['mysql']->children['port']->title = 'Port';
  cache::$data['data--forms-core-install']->children['storage']->children['mysql']->children['port']->element_attributes['name'] = 'port';
  cache::$data['data--forms-core-install']->children['storage']->children['mysql']->children['port']->element_attributes['value'] = 3306;
  cache::$data['data--forms-core-install']->children['storage']->children['mysql']->children['port']->element_attributes['min'] = 1024;
  cache::$data['data--forms-core-install']->children['storage']->children['mysql']->children['port']->element_attributes['max'] = 49150;
  cache::$data['data--forms-core-install']->children['storage']->children['mysql']->children['user_name'] = new \effcore\field_text();
  cache::$data['data--forms-core-install']->children['storage']->children['mysql']->children['user_name']->title = 'User name';
  cache::$data['data--forms-core-install']->children['storage']->children['mysql']->children['user_name']->element_attributes['name'] = 'user_name';
  cache::$data['data--forms-core-install']->children['storage']->children['mysql']->children['user_name']->element_attributes['value'] = 'root';
  cache::$data['data--forms-core-install']->children['storage']->children['mysql']->children['user_name']->element_attributes['minlength'] = 1;
  cache::$data['data--forms-core-install']->children['storage']->children['mysql']->children['user_name']->element_attributes['maxlength'] = 64;
  cache::$data['data--forms-core-install']->children['storage']->children['mysql']->children['user_name']->element_attributes['pattern'] = '%^[a-zA-Z0-9-_]+$%';
  cache::$data['data--forms-core-install']->children['storage']->children['mysql']->children['password'] = new \effcore\field_password();
  cache::$data['data--forms-core-install']->children['storage']->children['mysql']->children['password']->element_attributes['minlength'] = null;
  cache::$data['data--forms-core-install']->children['storage']->children['mysql']->children['password']->element_attributes['required'] = null;
  cache::$data['data--forms-core-install']->children['storage']->children['is_sqlite'] = new \effcore\field_radiobutton();
  cache::$data['data--forms-core-install']->children['storage']->children['is_sqlite']->title = 'SQLite';
  cache::$data['data--forms-core-install']->children['storage']->children['is_sqlite']->attributes['data-type'] = 'radiobutton';
  cache::$data['data--forms-core-install']->children['storage']->children['is_sqlite']->attributes['class']['before-container'] = 'before-container';
  cache::$data['data--forms-core-install']->children['storage']->children['is_sqlite']->element_attributes['name'] = 'driver';
  cache::$data['data--forms-core-install']->children['storage']->children['is_sqlite']->element_attributes['value'] = 'sqlite';
  cache::$data['data--forms-core-install']->children['storage']->children['sqlite'] = new \effcore\fieldset();
  cache::$data['data--forms-core-install']->children['storage']->children['sqlite']->children['file_name'] = new \effcore\field_text();
  cache::$data['data--forms-core-install']->children['storage']->children['sqlite']->children['file_name']->title = 'File name';
  cache::$data['data--forms-core-install']->children['storage']->children['sqlite']->children['file_name']->element_attributes['name'] = 'file_name';
  cache::$data['data--forms-core-install']->children['storage']->children['sqlite']->children['file_name']->element_attributes['value'] = 'data.sqlite';
  cache::$data['data--forms-core-install']->children['storage']->children['sqlite']->children['file_name']->element_attributes['minlength'] = 1;
  cache::$data['data--forms-core-install']->children['storage']->children['sqlite']->children['file_name']->element_attributes['maxlength'] = 255;
  cache::$data['data--forms-core-install']->children['storage']->children['sqlite']->children['file_name']->element_attributes['pattern'] = '%^[a-zA-Z0-9-_./]+$%';
  cache::$data['data--forms-core-install']->children['storage']->children['sqlite']->children['file_name']->element_attributes['readonly'] = 'readonly';
  cache::$data['data--forms-core-install']->children['storage']->children['params'] = new \effcore\fieldset();
  cache::$data['data--forms-core-install']->children['storage']->children['params']->title = 'Shared params';
  cache::$data['data--forms-core-install']->children['storage']->children['params']->children['table_prefix'] = new \effcore\field_text();
  cache::$data['data--forms-core-install']->children['storage']->children['params']->children['table_prefix']->title = 'Table prefix';
  cache::$data['data--forms-core-install']->children['storage']->children['params']->children['table_prefix']->element_attributes['name'] = 'table_prefix';
  cache::$data['data--forms-core-install']->children['storage']->children['params']->children['table_prefix']->element_attributes['maxlength'] = 10;
  cache::$data['data--forms-core-install']->children['storage']->children['params']->children['table_prefix']->element_attributes['pattern'] = '%^[a-zA-Z0-9-_]+$%';
  cache::$data['data--forms-core-install']->children['storage']->children['params']->children['table_prefix']->element_attributes['required'] = null;
  cache::$data['data--forms-core-install']->children['license_agreement'] = new \effcore\group_license_agreement();
  cache::$data['data--forms-core-install']->children['button_install'] = new \effcore\button();
  cache::$data['data--forms-core-install']->children['button_install']->attributes['type'] = 'submit';
  cache::$data['data--forms-core-install']->children['button_install']->attributes['name'] = 'button';
  cache::$data['data--forms-core-install']->children['button_install']->attributes['value'] = 'install';
  cache::$data['data--forms-core-install']->children['button_install']->title = 'install';
  cache::$data['data--forms-core-install']->children['button_to_front'] = new \effcore\button();
  cache::$data['data--forms-core-install']->children['button_to_front']->attributes['type'] = 'submit';
  cache::$data['data--forms-core-install']->children['button_to_front']->attributes['name'] = 'button';
  cache::$data['data--forms-core-install']->children['button_to_front']->attributes['value'] = 'to_front';
  cache::$data['data--forms-core-install']->children['button_to_front']->title = 'to front page';
  cache::$data['data--forms-core-install']->children['button_to_front']->novalidate = true;
  cache::$data['data--forms-core-install']->attributes['id'] = 'install';
  cache::$data['data--forms-core-install']->attributes['method'] = 'post';
  cache::$data['data--forms-core-install']->attributes['novalidate'] = 'novalidate';

}