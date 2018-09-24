<?php

namespace effcore { # cache for data--tree_items

  cache::$data['data--tree_items']['user']['login'] = new \effcore\tree_item();
  cache::$data['data--tree_items']['user']['login']->id = 'login';
  cache::$data['data--tree_items']['user']['login']->id_parent = 'M:user_anonymous';
  cache::$data['data--tree_items']['user']['login']->href = '/user/login';
  cache::$data['data--tree_items']['user']['login']->title = 'login';
  cache::$data['data--tree_items']['user']['login']->attributes['class']['login'] = 'login';
  cache::$data['data--tree_items']['user']['login']->weight = 100;
  cache::$data['data--tree_items']['user']['login']->access = new \stdClass();
  cache::$data['data--tree_items']['user']['login']->access->roles['anonymous'] = 'anonymous';
  cache::$data['data--tree_items']['user']['registration'] = new \effcore\tree_item();
  cache::$data['data--tree_items']['user']['registration']->id = 'registration';
  cache::$data['data--tree_items']['user']['registration']->id_parent = 'M:user_anonymous';
  cache::$data['data--tree_items']['user']['registration']->href = '/user/registration';
  cache::$data['data--tree_items']['user']['registration']->title = 'registration';
  cache::$data['data--tree_items']['user']['registration']->attributes['class']['registration'] = 'registration';
  cache::$data['data--tree_items']['user']['registration']->access = new \stdClass();
  cache::$data['data--tree_items']['user']['registration']->access->roles['anonymous'] = 'anonymous';
  cache::$data['data--tree_items']['user']['user_edit'] = new \effcore\tree_item();
  cache::$data['data--tree_items']['user']['user_edit']->id = 'user_edit';
  cache::$data['data--tree_items']['user']['user_edit']->id_parent = 'M:user_logged_in';
  cache::$data['data--tree_items']['user']['user_edit']->href = '/user/%%_id_user/edit';
  cache::$data['data--tree_items']['user']['user_edit']->title = 'edit';
  cache::$data['data--tree_items']['user']['user_edit']->attributes['class']['user-edit'] = 'user-edit';
  cache::$data['data--tree_items']['user']['user_edit']->access = new \stdClass();
  cache::$data['data--tree_items']['user']['user_edit']->access->roles['admins'] = 'admins';
  cache::$data['data--tree_items']['user']['user_edit']->access->roles['registered'] = 'registered';
  cache::$data['data--tree_items']['user']['logout'] = new \effcore\tree_item();
  cache::$data['data--tree_items']['user']['logout']->id = 'logout';
  cache::$data['data--tree_items']['user']['logout']->id_parent = 'M:user_logged_in';
  cache::$data['data--tree_items']['user']['logout']->href = '/user/logout';
  cache::$data['data--tree_items']['user']['logout']->title = 'logout';
  cache::$data['data--tree_items']['user']['logout']->attributes['class']['logout'] = 'logout';
  cache::$data['data--tree_items']['user']['logout']->weight = -100;
  cache::$data['data--tree_items']['user']['logout']->access = new \stdClass();
  cache::$data['data--tree_items']['user']['logout']->access->roles['registered'] = 'registered';
  cache::$data['data--tree_items']['storage']['manage_instances'] = new \effcore\tree_item();
  cache::$data['data--tree_items']['storage']['manage_instances']->id = 'manage_instances';
  cache::$data['data--tree_items']['storage']['manage_instances']->id_parent = 'manage';
  cache::$data['data--tree_items']['storage']['manage_instances']->href = '/manage/instances/select';
  cache::$data['data--tree_items']['storage']['manage_instances']->title = 'Instances';
  cache::$data['data--tree_items']['storage']['manage_instances']->attributes['class']['manage-instances'] = 'manage-instances';
  cache::$data['data--tree_items']['storage']['manage_instances']->access = new \stdClass();
  cache::$data['data--tree_items']['storage']['manage_instances']->access->roles['admins'] = 'admins';
  cache::$data['data--tree_items']['page']['decoration'] = new \effcore\tree_item();
  cache::$data['data--tree_items']['page']['decoration']->id = 'decoration';
  cache::$data['data--tree_items']['page']['decoration']->id_parent = 'manage';
  cache::$data['data--tree_items']['page']['decoration']->href = '/manage/decoration';
  cache::$data['data--tree_items']['page']['decoration']->title = 'Decoration';
  cache::$data['data--tree_items']['page']['decoration']->attributes['class']['decoration'] = 'decoration';
  cache::$data['data--tree_items']['page']['decoration']->access = new \stdClass();
  cache::$data['data--tree_items']['page']['decoration']->access->roles['admins'] = 'admins';
  cache::$data['data--tree_items']['menu']['manage_trees'] = new \effcore\tree_item();
  cache::$data['data--tree_items']['menu']['manage_trees']->id = 'manage_trees';
  cache::$data['data--tree_items']['menu']['manage_trees']->id_parent = 'manage';
  cache::$data['data--tree_items']['menu']['manage_trees']->href = '/manage/trees/select';
  cache::$data['data--tree_items']['menu']['manage_trees']->title = 'Trees';
  cache::$data['data--tree_items']['menu']['manage_trees']->attributes['class']['manage-trees'] = 'manage-trees';
  cache::$data['data--tree_items']['menu']['manage_trees']->access = new \stdClass();
  cache::$data['data--tree_items']['menu']['manage_trees']->access->roles['admins'] = 'admins';
  cache::$data['data--tree_items']['test']['tests'] = new \effcore\tree_item();
  cache::$data['data--tree_items']['test']['tests']->id = 'tests';
  cache::$data['data--tree_items']['test']['tests']->id_parent = 'develop';
  cache::$data['data--tree_items']['test']['tests']->href = '/develop/tests';
  cache::$data['data--tree_items']['test']['tests']->title = 'Tests';
  cache::$data['data--tree_items']['test']['tests']->attributes['class']['tests'] = 'tests';
  cache::$data['data--tree_items']['test']['tests']->access = new \stdClass();
  cache::$data['data--tree_items']['test']['tests']->access->roles['admins'] = 'admins';
  cache::$data['data--tree_items']['demo']['demo'] = new \effcore\tree_item();
  cache::$data['data--tree_items']['demo']['demo']->id = 'demo';
  cache::$data['data--tree_items']['demo']['demo']->id_parent = 'develop';
  cache::$data['data--tree_items']['demo']['demo']->href = '/develop/demo';
  cache::$data['data--tree_items']['demo']['demo']->title = 'Demo';
  cache::$data['data--tree_items']['demo']['demo']->attributes['class']['demo'] = 'demo';
  cache::$data['data--tree_items']['demo']['demo']->weight = 100;
  cache::$data['data--tree_items']['demo']['demo']->access = new \stdClass();
  cache::$data['data--tree_items']['demo']['demo']->access->roles['admins'] = 'admins';
  cache::$data['data--tree_items']['demo']['demo_item_1'] = new \effcore\tree_item();
  cache::$data['data--tree_items']['demo']['demo_item_1']->id = 'demo_item_1';
  cache::$data['data--tree_items']['demo']['demo_item_1']->id_parent = 'M:demo';
  cache::$data['data--tree_items']['demo']['demo_item_1']->href = '/develop/demo/item_1';
  cache::$data['data--tree_items']['demo']['demo_item_1']->title = 'item #1';
  cache::$data['data--tree_items']['demo']['demo_item_1']->attributes['class']['demo-item-1'] = 'demo-item-1';
  cache::$data['data--tree_items']['demo']['demo_item_1']->access = new \stdClass();
  cache::$data['data--tree_items']['demo']['demo_item_1']->access->roles['admins'] = 'admins';
  cache::$data['data--tree_items']['demo']['demo_item_1_1'] = new \effcore\tree_item();
  cache::$data['data--tree_items']['demo']['demo_item_1_1']->id = 'demo_item_1_1';
  cache::$data['data--tree_items']['demo']['demo_item_1_1']->id_parent = 'demo_item_1';
  cache::$data['data--tree_items']['demo']['demo_item_1_1']->href = '/develop/demo/item_1/item_1_1';
  cache::$data['data--tree_items']['demo']['demo_item_1_1']->title = 'item #1.1';
  cache::$data['data--tree_items']['demo']['demo_item_1_1']->attributes['class']['demo-item-1-1'] = 'demo-item-1-1';
  cache::$data['data--tree_items']['demo']['demo_item_1_1']->access = new \stdClass();
  cache::$data['data--tree_items']['demo']['demo_item_1_1']->access->roles['admins'] = 'admins';
  cache::$data['data--tree_items']['demo']['demo_item_1_2'] = new \effcore\tree_item();
  cache::$data['data--tree_items']['demo']['demo_item_1_2']->id = 'demo_item_1_2';
  cache::$data['data--tree_items']['demo']['demo_item_1_2']->id_parent = 'demo_item_1';
  cache::$data['data--tree_items']['demo']['demo_item_1_2']->href = '/develop/demo/item_1/item_1_2';
  cache::$data['data--tree_items']['demo']['demo_item_1_2']->title = 'item #1.2';
  cache::$data['data--tree_items']['demo']['demo_item_1_2']->attributes['class']['demo-item-1-2'] = 'demo-item-1-2';
  cache::$data['data--tree_items']['demo']['demo_item_1_2']->access = new \stdClass();
  cache::$data['data--tree_items']['demo']['demo_item_1_2']->access->roles['admins'] = 'admins';
  cache::$data['data--tree_items']['demo']['demo_item_1_2_1'] = new \effcore\tree_item();
  cache::$data['data--tree_items']['demo']['demo_item_1_2_1']->id = 'demo_item_1_2_1';
  cache::$data['data--tree_items']['demo']['demo_item_1_2_1']->id_parent = 'demo_item_1_2';
  cache::$data['data--tree_items']['demo']['demo_item_1_2_1']->href = '/develop/demo/item_1/item_1_2/item_1_2_1';
  cache::$data['data--tree_items']['demo']['demo_item_1_2_1']->title = 'item #1.2.1';
  cache::$data['data--tree_items']['demo']['demo_item_1_2_1']->attributes['class']['demo-item-1-2-1'] = 'demo-item-1-2-1';
  cache::$data['data--tree_items']['demo']['demo_item_1_2_1']->access = new \stdClass();
  cache::$data['data--tree_items']['demo']['demo_item_1_2_1']->access->roles['admins'] = 'admins';
  cache::$data['data--tree_items']['demo']['demo_item_1_2_2'] = new \effcore\tree_item();
  cache::$data['data--tree_items']['demo']['demo_item_1_2_2']->id = 'demo_item_1_2_2';
  cache::$data['data--tree_items']['demo']['demo_item_1_2_2']->id_parent = 'demo_item_1_2';
  cache::$data['data--tree_items']['demo']['demo_item_1_2_2']->href = '/develop/demo/item_1/item_1_2/item_1_2_2';
  cache::$data['data--tree_items']['demo']['demo_item_1_2_2']->title = 'item #1.2.2';
  cache::$data['data--tree_items']['demo']['demo_item_1_2_2']->attributes['class']['demo-item-1-2-2'] = 'demo-item-1-2-2';
  cache::$data['data--tree_items']['demo']['demo_item_1_2_2']->access = new \stdClass();
  cache::$data['data--tree_items']['demo']['demo_item_1_2_2']->access->roles['admins'] = 'admins';
  cache::$data['data--tree_items']['demo']['demo_item_1_3'] = new \effcore\tree_item();
  cache::$data['data--tree_items']['demo']['demo_item_1_3']->id = 'demo_item_1_3';
  cache::$data['data--tree_items']['demo']['demo_item_1_3']->id_parent = 'demo_item_1';
  cache::$data['data--tree_items']['demo']['demo_item_1_3']->href = '/develop/demo/item_1/item_1_3';
  cache::$data['data--tree_items']['demo']['demo_item_1_3']->title = 'item #1.3';
  cache::$data['data--tree_items']['demo']['demo_item_1_3']->attributes['class']['demo-item-1-3'] = 'demo-item-1-3';
  cache::$data['data--tree_items']['demo']['demo_item_1_3']->access = new \stdClass();
  cache::$data['data--tree_items']['demo']['demo_item_1_3']->access->roles['admins'] = 'admins';
  cache::$data['data--tree_items']['demo']['demo_item_2'] = new \effcore\tree_item();
  cache::$data['data--tree_items']['demo']['demo_item_2']->id = 'demo_item_2';
  cache::$data['data--tree_items']['demo']['demo_item_2']->id_parent = 'M:demo';
  cache::$data['data--tree_items']['demo']['demo_item_2']->href = '/develop/demo/item_2';
  cache::$data['data--tree_items']['demo']['demo_item_2']->title = 'item #2';
  cache::$data['data--tree_items']['demo']['demo_item_2']->attributes['class']['demo-item-2'] = 'demo-item-2';
  cache::$data['data--tree_items']['demo']['demo_item_2']->access = new \stdClass();
  cache::$data['data--tree_items']['demo']['demo_item_2']->access->roles['admins'] = 'admins';
  cache::$data['data--tree_items']['develop']['develop'] = new \effcore\tree_item();
  cache::$data['data--tree_items']['develop']['develop']->id = 'develop';
  cache::$data['data--tree_items']['develop']['develop']->id_parent = 'M:main';
  cache::$data['data--tree_items']['develop']['develop']->title = 'Develop';
  cache::$data['data--tree_items']['develop']['develop']->attributes['class']['develop'] = 'develop';
  cache::$data['data--tree_items']['develop']['develop']->weight = -100;
  cache::$data['data--tree_items']['develop']['develop']->access = new \stdClass();
  cache::$data['data--tree_items']['develop']['develop']->access->roles['admins'] = 'admins';
  cache::$data['data--tree_items']['develop']['structures'] = new \effcore\tree_item();
  cache::$data['data--tree_items']['develop']['structures']->id = 'structures';
  cache::$data['data--tree_items']['develop']['structures']->id_parent = 'develop';
  cache::$data['data--tree_items']['develop']['structures']->href = '/develop/structures/class/list';
  cache::$data['data--tree_items']['develop']['structures']->title = 'Structures';
  cache::$data['data--tree_items']['develop']['structures']->attributes['class']['structures'] = 'structures';
  cache::$data['data--tree_items']['develop']['structures']->access = new \stdClass();
  cache::$data['data--tree_items']['develop']['structures']->access->roles['admins'] = 'admins';
  cache::$data['data--tree_items']['develop']['php_mod_usage'] = new \effcore\tree_item();
  cache::$data['data--tree_items']['develop']['php_mod_usage']->id = 'php_mod_usage';
  cache::$data['data--tree_items']['develop']['php_mod_usage']->id_parent = 'develop';
  cache::$data['data--tree_items']['develop']['php_mod_usage']->href = '/develop/php_mod_usage';
  cache::$data['data--tree_items']['develop']['php_mod_usage']->title = 'PHP modules';
  cache::$data['data--tree_items']['develop']['php_mod_usage']->attributes['class']['php_mod_usage'] = 'php_mod_usage';
  cache::$data['data--tree_items']['develop']['php_mod_usage']->access = new \stdClass();
  cache::$data['data--tree_items']['develop']['php_mod_usage']->access->roles['admins'] = 'admins';
  cache::$data['data--tree_items']['core']['manage'] = new \effcore\tree_item();
  cache::$data['data--tree_items']['core']['manage']->id = 'manage';
  cache::$data['data--tree_items']['core']['manage']->id_parent = 'M:main';
  cache::$data['data--tree_items']['core']['manage']->title = 'Management';
  cache::$data['data--tree_items']['core']['manage']->attributes['class']['manage'] = 'manage';
  cache::$data['data--tree_items']['core']['manage']->access = new \stdClass();
  cache::$data['data--tree_items']['core']['manage']->access->roles['admins'] = 'admins';
  cache::$data['data--tree_items']['core']['modules'] = new \effcore\tree_item();
  cache::$data['data--tree_items']['core']['modules']->id = 'modules';
  cache::$data['data--tree_items']['core']['modules']->id_parent = 'manage';
  cache::$data['data--tree_items']['core']['modules']->href = '/manage/modules';
  cache::$data['data--tree_items']['core']['modules']->title = 'Modules';
  cache::$data['data--tree_items']['core']['modules']->attributes['class']['modules'] = 'modules';
  cache::$data['data--tree_items']['core']['modules']->access = new \stdClass();
  cache::$data['data--tree_items']['core']['modules']->access->roles['admins'] = 'admins';
  cache::$data['data--tree_items']['core']['info'] = new \effcore\tree_item();
  cache::$data['data--tree_items']['core']['info']->id = 'info';
  cache::$data['data--tree_items']['core']['info']->id_parent = 'manage';
  cache::$data['data--tree_items']['core']['info']->href = '/manage/info';
  cache::$data['data--tree_items']['core']['info']->title = 'Information';
  cache::$data['data--tree_items']['core']['info']->attributes['class']['info'] = 'info';
  cache::$data['data--tree_items']['core']['info']->weight = -100;
  cache::$data['data--tree_items']['core']['info']->access = new \stdClass();
  cache::$data['data--tree_items']['core']['info']->access->roles['admins'] = 'admins';

}