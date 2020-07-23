<?php

  ##################################################################
  ### Copyright © 2017—2020 Maxim Rysevets. All rights reserved. ###
  ##################################################################

namespace effcore {
          class step_check {

  public $where;
  public $which;
  public $match;
  public $on_success;
  public $on_failure;

  function run(&$test, $dpath, &$c_results) {
    $last_response = end(step_request::$history);
    if ($this->where === 'http_code'   ) $result = $last_response && isset($last_response['info'   ]) && array_key_exists('http_code',                  $last_response['info'   ]) && (int)$last_response['info'   ]['http_code']                  === $this->match;
    if ($this->where === 'submit_error') $result = $last_response && isset($last_response['headers']) && array_key_exists('X-Form-Submit-Errors-Count', $last_response['headers']) && (int)$last_response['headers']['X-Form-Submit-Errors-Count'] === $this->match;
    if ($this->where === 'token'       ) $result = (string)token::apply($this->which) === (string)$this->match;
    if ($result === true) $c_results['reports'][$dpath.'/on_success_title'] = new text_multiline(['checking on "%%_name" = "%%_value"', 'result of checking is = "%%_result"'], ['name' => $this->where.($this->which ? ': '.$this->which : ''), 'value' => $this->match, 'result' => (new text('success'))->render() ]);
    if ($result !== true) $c_results['reports'][$dpath.'/on_failure_title'] = new text_multiline(['checking on "%%_name" = "%%_value"', 'result of checking is = "%%_result"'], ['name' => $this->where.($this->which ? ': '.$this->which : ''), 'value' => $this->match, 'result' => (new text('failure'))->render() ]);
    if ($result === true && isset($this->on_success)) foreach ($this->on_success as $c_step) { $c_step->run($test, $dpath.'/on_success', $c_results); if (array_key_exists('return', $c_results)) return; }
    if ($result !== true && isset($this->on_failure)) foreach ($this->on_failure as $c_step) { $c_step->run($test, $dpath.'/on_failure', $c_results); if (array_key_exists('return', $c_results)) return; }
  }

}}