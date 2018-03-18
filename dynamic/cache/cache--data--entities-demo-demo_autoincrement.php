<?php

namespace effcore { # cache for data--entities-demo-demo_autoincrement

  cache::$data['data--entities-demo-demo_autoincrement'] = new \effcore\entity();
  cache::$data['data--entities-demo-demo_autoincrement']->name = 'demo_autoincrement';
  cache::$data['data--entities-demo-demo_autoincrement']->storage_id = 'main';
  cache::$data['data--entities-demo-demo_autoincrement']->catalog_id = 'demo_autoincrement';
  cache::$data['data--entities-demo-demo_autoincrement']->title = 'Demo: autoincrement';
  cache::$data['data--entities-demo-demo_autoincrement']->fields = new \stdClass();
  cache::$data['data--entities-demo-demo_autoincrement']->fields->f_integer_1 = new \stdClass();
  cache::$data['data--entities-demo-demo_autoincrement']->fields->f_integer_1->type = 'autoincrement';
  cache::$data['data--entities-demo-demo_autoincrement']->fields->f_integer_1->not_null = true;
  cache::$data['data--entities-demo-demo_autoincrement']->constraints['key_f_integer_1'] = new \stdClass();
  cache::$data['data--entities-demo-demo_autoincrement']->constraints['key_f_integer_1']->type = 'primary key';
  cache::$data['data--entities-demo-demo_autoincrement']->constraints['key_f_integer_1']->fields['f_integer_1'] = 'f_integer_1';
  cache::$data['data--entities-demo-demo_autoincrement']->__post_init();

}