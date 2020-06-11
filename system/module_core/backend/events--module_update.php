<?php

  ##################################################################
  ### Copyright © 2017—2020 Maxim Rysevets. All rights reserved. ###
  ##################################################################

namespace effcore\modules\core {
          use const \effcore\dir_dynamic;
          use const \effcore\dir_root;
          use \effcore\cache;
          use \effcore\entity;
          use \effcore\message;
          use \effcore\module;
          use \effcore\text;
          abstract class events_module_update {

  static function on_update_files($event, $bundle_id) {
    $bundle = module::bundle_get($bundle_id);
    if ($bundle) {
      $stderr_to_stdout = '2>&1';
      $repo_path = realpath(dir_root.$bundle->path.$bundle->repo_directory);
      if ($repo_path !== false) {
        $result = [];
        $commands = [
          'whoami '                            .$stderr_to_stdout,
          'git --version '                     .$stderr_to_stdout,
          'git -C '.$repo_path.' clean  -f -d '.$stderr_to_stdout,
          'git -C '.$repo_path.' reset --hard '.$stderr_to_stdout,
          'git -C '.$repo_path.' pull '        .$stderr_to_stdout];
        foreach ($commands as $c_num => $c_command) {
          $return_var = null;
          $result['command-'.$c_num] = '$ '.$c_command;
          exec($c_command, $result, $return_var);
          if ($return_var !== 0) break;
        }
        cache::update_global();
        message::insert('All caches was reset.');
        return $result;
      }
    }
  }

  static function on_restore_repo($event, $bundle_id) {
    $bundle = module::bundle_get($bundle_id);
    if ($bundle) {
      $stderr_to_stdout = '2>&1';
      $repo_path_cur = realpath(dir_root.$bundle->path.$bundle->repo_directory);
      $repo_path_tmp = dir_dynamic.'tmp/repo_'.$bundle_id;
      if ($repo_path_cur !== false) {
        $result = [];
        $commands = [
          'whoami '                                                                              .$stderr_to_stdout,
          'git --version '                                                                       .$stderr_to_stdout,
          'rm -rf '.$repo_path_cur.'/.git '                                                      .$stderr_to_stdout,
          'rm -rf '.$repo_path_tmp.' '                                                           .$stderr_to_stdout,
          'git clone --branch='.$bundle->repo_branch.' '.$bundle->repo_url.' '.$repo_path_tmp.' '.$stderr_to_stdout,
          'mv '    .$repo_path_tmp.'/.git '.$repo_path_cur.                                   ' '.$stderr_to_stdout,
          'rm -rf '.$repo_path_tmp.                                                           ' '.$stderr_to_stdout];
        foreach ($commands as $c_num => $c_command) {
          $return_var = null;
          $result['command-'.$c_num] = '$ '.$c_command;
          exec($c_command, $result, $return_var);
          if ($return_var !== 0) break;
        }
        return $result;
      }
    }
  }

  static function on_update_data_1000($update) {
    $entity = entity::get('message');
    if ($entity->install())
         {message::insert(new text('Entity "%%_entity" was installed.',     ['entity' => $entity->name])         ); return true; }
    else {message::insert(new text('Entity "%%_entity" was not installed!', ['entity' => $entity->name]), 'error'); return false;}
  }

}}