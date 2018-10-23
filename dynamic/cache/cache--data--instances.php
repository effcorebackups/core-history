<?php

namespace effcore { # cache for data--instances

  cache::$data['data--instances']['user']['user_admin'] = new \effcore\instance();
  cache::$data['data--instances']['user']['user_admin']->entity_name = 'user';
  cache::$data['data--instances']['user']['user_admin']->values['nick'] = 'admin';
  cache::$data['data--instances']['user']['user_admin']->values['is_embed'] = 1;
  cache::$data['data--instances']['user']['role_admins'] = new \effcore\instance();
  cache::$data['data--instances']['user']['role_admins']->entity_name = 'role';
  cache::$data['data--instances']['user']['role_admins']->values['id'] = 'admins';
  cache::$data['data--instances']['user']['role_admins']->values['title'] = 'Administrators';
  cache::$data['data--instances']['user']['role_admins']->values['is_embed'] = 1;
  cache::$data['data--instances']['user']['role_admins']->values['weight'] = 100;
  cache::$data['data--instances']['user']['role_managers'] = new \effcore\instance();
  cache::$data['data--instances']['user']['role_managers']->entity_name = 'role';
  cache::$data['data--instances']['user']['role_managers']->values['id'] = 'managers';
  cache::$data['data--instances']['user']['role_managers']->values['title'] = 'Managers';
  cache::$data['data--instances']['user']['role_managers']->values['is_embed'] = 1;
  cache::$data['data--instances']['user']['role_managers']->values['weight'] = 80;
  cache::$data['data--instances']['user']['role_owner'] = new \effcore\instance();
  cache::$data['data--instances']['user']['role_owner']->entity_name = 'role';
  cache::$data['data--instances']['user']['role_owner']->values['id'] = 'owner';
  cache::$data['data--instances']['user']['role_owner']->values['title'] = 'Owner';
  cache::$data['data--instances']['user']['role_owner']->values['is_embed'] = 1;
  cache::$data['data--instances']['user']['role_owner']->values['weight'] = 60;
  cache::$data['data--instances']['user']['role_registered'] = new \effcore\instance();
  cache::$data['data--instances']['user']['role_registered']->entity_name = 'role';
  cache::$data['data--instances']['user']['role_registered']->values['id'] = 'registered';
  cache::$data['data--instances']['user']['role_registered']->values['title'] = 'Registered';
  cache::$data['data--instances']['user']['role_registered']->values['is_embed'] = 1;
  cache::$data['data--instances']['user']['role_registered']->values['weight'] = 40;
  cache::$data['data--instances']['user']['role_anonymous'] = new \effcore\instance();
  cache::$data['data--instances']['user']['role_anonymous']->entity_name = 'role';
  cache::$data['data--instances']['user']['role_anonymous']->values['id'] = 'anonymous';
  cache::$data['data--instances']['user']['role_anonymous']->values['title'] = 'Anonymous';
  cache::$data['data--instances']['user']['role_anonymous']->values['is_embed'] = 1;
  cache::$data['data--instances']['user']['role_anonymous']->values['weight'] = 20;
  cache::$data['data--instances']['user']['permission_user_select'] = new \effcore\instance();
  cache::$data['data--instances']['user']['permission_user_select']->entity_name = 'permission';
  cache::$data['data--instances']['user']['permission_user_select']->values['id'] = 'user_select';
  cache::$data['data--instances']['user']['permission_user_select']->values['title'] = 'User: select';
  cache::$data['data--instances']['user']['permission_user_update'] = new \effcore\instance();
  cache::$data['data--instances']['user']['permission_user_update']->entity_name = 'permission';
  cache::$data['data--instances']['user']['permission_user_update']->values['id'] = 'user_update';
  cache::$data['data--instances']['user']['permission_user_update']->values['title'] = 'User: update';
  cache::$data['data--instances']['user']['permission_user_insert'] = new \effcore\instance();
  cache::$data['data--instances']['user']['permission_user_insert']->entity_name = 'permission';
  cache::$data['data--instances']['user']['permission_user_insert']->values['id'] = 'user_insert';
  cache::$data['data--instances']['user']['permission_user_insert']->values['title'] = 'User: insert';
  cache::$data['data--instances']['user']['permission_user_delete'] = new \effcore\instance();
  cache::$data['data--instances']['user']['permission_user_delete']->entity_name = 'permission';
  cache::$data['data--instances']['user']['permission_user_delete']->values['id'] = 'user_delete';
  cache::$data['data--instances']['user']['permission_user_delete']->values['title'] = 'User: delete';
  cache::$data['data--instances']['user']['relation_role_ws_user_admins_1'] = new \effcore\instance();
  cache::$data['data--instances']['user']['relation_role_ws_user_admins_1']->entity_name = 'relation_role_ws_user';
  cache::$data['data--instances']['user']['relation_role_ws_user_admins_1']->values['id_role'] = 'admins';
  cache::$data['data--instances']['user']['relation_role_ws_user_admins_1']->values['nick'] = 'admin';
  cache::$data['data--instances']['user']['relation_role_ws_permission_admins_user_select'] = new \effcore\instance();
  cache::$data['data--instances']['user']['relation_role_ws_permission_admins_user_select']->entity_name = 'relation_role_ws_permission';
  cache::$data['data--instances']['user']['relation_role_ws_permission_admins_user_select']->values['id_role'] = 'admins';
  cache::$data['data--instances']['user']['relation_role_ws_permission_admins_user_select']->values['id_permission'] = 'user_select';
  cache::$data['data--instances']['user']['relation_role_ws_permission_admins_user_update'] = new \effcore\instance();
  cache::$data['data--instances']['user']['relation_role_ws_permission_admins_user_update']->entity_name = 'relation_role_ws_permission';
  cache::$data['data--instances']['user']['relation_role_ws_permission_admins_user_update']->values['id_role'] = 'admins';
  cache::$data['data--instances']['user']['relation_role_ws_permission_admins_user_update']->values['id_permission'] = 'user_update';
  cache::$data['data--instances']['user']['relation_role_ws_permission_admins_user_insert'] = new \effcore\instance();
  cache::$data['data--instances']['user']['relation_role_ws_permission_admins_user_insert']->entity_name = 'relation_role_ws_permission';
  cache::$data['data--instances']['user']['relation_role_ws_permission_admins_user_insert']->values['id_role'] = 'admins';
  cache::$data['data--instances']['user']['relation_role_ws_permission_admins_user_insert']->values['id_permission'] = 'user_insert';
  cache::$data['data--instances']['user']['relation_role_ws_permission_admins_user_delete'] = new \effcore\instance();
  cache::$data['data--instances']['user']['relation_role_ws_permission_admins_user_delete']->entity_name = 'relation_role_ws_permission';
  cache::$data['data--instances']['user']['relation_role_ws_permission_admins_user_delete']->values['id_role'] = 'admins';
  cache::$data['data--instances']['user']['relation_role_ws_permission_admins_user_delete']->values['id_permission'] = 'user_delete';
  cache::$data['data--instances']['demo']['role_demo'] = new \effcore\instance();
  cache::$data['data--instances']['demo']['role_demo']->entity_name = 'role';
  cache::$data['data--instances']['demo']['role_demo']->values['id'] = 'demo';
  cache::$data['data--instances']['demo']['role_demo']->values['title'] = 'Demo';
  cache::$data['data--instances']['demo']['demo_types_example_1'] = new \effcore\instance();
  cache::$data['data--instances']['demo']['demo_types_example_1']->entity_name = 'demo_types';
  cache::$data['data--instances']['demo']['demo_types_example_1']->values['id'] = 1;
  cache::$data['data--instances']['demo']['demo_types_example_1']->values['description'] = 'use default values';
  cache::$data['data--instances']['demo']['demo_types_example_2'] = new \effcore\instance();
  cache::$data['data--instances']['demo']['demo_types_example_2']->entity_name = 'demo_types';
  cache::$data['data--instances']['demo']['demo_types_example_2']->values['id'] = 2;
  cache::$data['data--instances']['demo']['demo_types_example_2']->values['description'] = 'use own values';
  cache::$data['data--instances']['demo']['demo_types_example_2']->values['f_integer'] = 123;
  cache::$data['data--instances']['demo']['demo_types_example_2']->values['f_varchar'] = 'own text';
  cache::$data['data--instances']['demo']['demo_types_example_2']->values['f_time'] = '12:34:56';
  cache::$data['data--instances']['demo']['demo_types_example_2']->values['f_date'] = '2020-12-31';
  cache::$data['data--instances']['demo']['demo_types_example_2']->values['f_datetime'] = '2020-12-31 12:34:56';
  cache::$data['data--instances']['demo']['demo_types_example_2']->values['f_blob'] = 12345;
  cache::$data['data--instances']['demo']['demo_autoincrement_1'] = new \effcore\instance();
  cache::$data['data--instances']['demo']['demo_autoincrement_1']->entity_name = 'demo_autoincrement';
  cache::$data['data--instances']['demo']['demo_autoincrement_1']->values['f_integer_2'] = 100;
  cache::$data['data--instances']['demo']['demo_autoincrement_2'] = new \effcore\instance();
  cache::$data['data--instances']['demo']['demo_autoincrement_2']->entity_name = 'demo_autoincrement';
  cache::$data['data--instances']['demo']['demo_autoincrement_2']->values['f_integer_2'] = 200;
  cache::$data['data--instances']['demo']['demo_autoincrement_3'] = new \effcore\instance();
  cache::$data['data--instances']['demo']['demo_autoincrement_3']->entity_name = 'demo_autoincrement';
  cache::$data['data--instances']['demo']['demo_autoincrement_3']->values['f_integer_2'] = 300;
  cache::$data['data--instances']['demo']['demo_constraints_1'] = new \effcore\instance();
  cache::$data['data--instances']['demo']['demo_constraints_1']->entity_name = 'demo_constraints';
  cache::$data['data--instances']['demo']['demo_constraints_1']->values['f_integer_1'] = 1;
  cache::$data['data--instances']['demo']['demo_constraints_1']->values['f_integer_2'] = 100;
  cache::$data['data--instances']['demo']['demo_constraints_2'] = new \effcore\instance();
  cache::$data['data--instances']['demo']['demo_constraints_2']->entity_name = 'demo_constraints';
  cache::$data['data--instances']['demo']['demo_constraints_2']->values['f_integer_1'] = 2;
  cache::$data['data--instances']['demo']['demo_constraints_2']->values['f_integer_2'] = 200;
  cache::$data['data--instances']['demo']['demo_constraints_3'] = new \effcore\instance();
  cache::$data['data--instances']['demo']['demo_constraints_3']->entity_name = 'demo_constraints';
  cache::$data['data--instances']['demo']['demo_constraints_3']->values['f_integer_1'] = 3;
  cache::$data['data--instances']['demo']['demo_constraints_3']->values['f_integer_2'] = 300;
  cache::$data['data--instances']['demo']['demo_indexes_1'] = new \effcore\instance();
  cache::$data['data--instances']['demo']['demo_indexes_1']->entity_name = 'demo_indexes';
  cache::$data['data--instances']['demo']['demo_indexes_1']->values['f_integer_1'] = 1;
  cache::$data['data--instances']['demo']['demo_indexes_1']->values['f_integer_2'] = 100;
  cache::$data['data--instances']['demo']['demo_indexes_2'] = new \effcore\instance();
  cache::$data['data--instances']['demo']['demo_indexes_2']->entity_name = 'demo_indexes';
  cache::$data['data--instances']['demo']['demo_indexes_2']->values['f_integer_1'] = 2;
  cache::$data['data--instances']['demo']['demo_indexes_2']->values['f_integer_2'] = 200;
  cache::$data['data--instances']['demo']['demo_indexes_3'] = new \effcore\instance();
  cache::$data['data--instances']['demo']['demo_indexes_3']->entity_name = 'demo_indexes';
  cache::$data['data--instances']['demo']['demo_indexes_3']->values['f_integer_1'] = 3;
  cache::$data['data--instances']['demo']['demo_indexes_3']->values['f_integer_2'] = 300;

}