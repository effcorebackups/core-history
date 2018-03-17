<?php

namespace effcore { # cache for data--module

  cache::$data['data--module']['core'] = new \effcore\module();
  cache::$data['data--module']['core']->id = 'core';
  cache::$data['data--module']['core']->title = 'Core';
  cache::$data['data--module']['core']->description = 'Main system module.';
  cache::$data['data--module']['core']->version = 1;
  cache::$data['data--module']['core']->state = 'always_on';
  cache::$data['data--module']['core']->path = 'system/core/';
  cache::$data['data--module']['demo'] = new \effcore\module();
  cache::$data['data--module']['demo']->id = 'demo';
  cache::$data['data--module']['demo']->title = 'Demo';
  cache::$data['data--module']['demo']->description = 'Module for demonstrating capabilities.';
  cache::$data['data--module']['demo']->version = 1;
  cache::$data['data--module']['demo']->state = 'off';
  cache::$data['data--module']['demo']->path = 'system/develop/demo/';
  cache::$data['data--module']['develop'] = new \effcore\module();
  cache::$data['data--module']['develop']->id = 'develop';
  cache::$data['data--module']['develop']->title = 'Develop';
  cache::$data['data--module']['develop']->description = 'Module for development.';
  cache::$data['data--module']['develop']->version = 1;
  cache::$data['data--module']['develop']->state = 'on';
  cache::$data['data--module']['develop']->path = 'system/develop/';
  cache::$data['data--module']['locales'] = new \effcore\module();
  cache::$data['data--module']['locales']->id = 'locales';
  cache::$data['data--module']['locales']->title = 'Locales';
  cache::$data['data--module']['locales']->description = 'Module for internationalization.';
  cache::$data['data--module']['locales']->version = 1;
  cache::$data['data--module']['locales']->state = 'on';
  cache::$data['data--module']['locales']->path = 'system/locales/';
  cache::$data['data--module']['page'] = new \effcore\module();
  cache::$data['data--module']['page']->id = 'page';
  cache::$data['data--module']['page']->title = 'Page';
  cache::$data['data--module']['page']->description = 'Module for working with pages.';
  cache::$data['data--module']['page']->version = 1;
  cache::$data['data--module']['page']->state = 'always_on';
  cache::$data['data--module']['page']->path = 'system/page/';
  cache::$data['data--module']['storage'] = new \effcore\module();
  cache::$data['data--module']['storage']->id = 'storage';
  cache::$data['data--module']['storage']->title = 'Storage';
  cache::$data['data--module']['storage']->description = 'Module for storages support.';
  cache::$data['data--module']['storage']->version = 1;
  cache::$data['data--module']['storage']->state = 'always_on';
  cache::$data['data--module']['storage']->path = 'system/storage/';
  cache::$data['data--module']['tree'] = new \effcore\module();
  cache::$data['data--module']['tree']->id = 'tree';
  cache::$data['data--module']['tree']->title = 'Tree';
  cache::$data['data--module']['tree']->description = 'Module for working with hierarchical structures like trees.';
  cache::$data['data--module']['tree']->version = 1;
  cache::$data['data--module']['tree']->state = 'always_on';
  cache::$data['data--module']['tree']->path = 'system/tree/';
  cache::$data['data--module']['user'] = new \effcore\module();
  cache::$data['data--module']['user']->id = 'user';
  cache::$data['data--module']['user']->title = 'User';
  cache::$data['data--module']['user']->description = 'Module for working with user accounts and permissions.';
  cache::$data['data--module']['user']->version = 1;
  cache::$data['data--module']['user']->state = 'always_on';
  cache::$data['data--module']['user']->path = 'system/user/';

}