<?php

namespace effectivecore { # cache for data--file_types

  cache::$data['data--file_types']['core']['code_php'] = new \stdClass();
  cache::$data['data--file_types']['core']['code_php']->type = 'php';
  cache::$data['data--file_types']['core']['code_php']->protected = 1;
  cache::$data['data--file_types']['core']['code_php']->headers['Content-type'] = 'text/html';
  cache::$data['data--file_types']['core']['styles'] = new \stdClass();
  cache::$data['data--file_types']['core']['styles']->type = 'css';
  cache::$data['data--file_types']['core']['styles']->use_tokens = 1;
  cache::$data['data--file_types']['core']['styles']->headers['Content-type'] = 'text/css';
  cache::$data['data--file_types']['core']['javascript'] = new \stdClass();
  cache::$data['data--file_types']['core']['javascript']->type = 'js';
  cache::$data['data--file_types']['core']['javascript']->use_tokens = 1;
  cache::$data['data--file_types']['core']['javascript']->headers['Content-type'] = 'text/javascript';
  cache::$data['data--file_types']['core']['markup_html'] = new \stdClass();
  cache::$data['data--file_types']['core']['markup_html']->type = 'html';
  cache::$data['data--file_types']['core']['markup_html']->use_tokens = 1;
  cache::$data['data--file_types']['core']['markup_html']->headers['Content-type'] = 'text/html';
  cache::$data['data--file_types']['core']['markup_xml'] = new \stdClass();
  cache::$data['data--file_types']['core']['markup_xml']->type = 'xml';
  cache::$data['data--file_types']['core']['markup_xml']->use_tokens = 1;
  cache::$data['data--file_types']['core']['markup_xml']->headers['Content-type'] = 'text/xml';
  cache::$data['data--file_types']['core']['text'] = new \stdClass();
  cache::$data['data--file_types']['core']['text']->type = 'txt';
  cache::$data['data--file_types']['core']['text']->headers['Content-type'] = 'text/plain';
  cache::$data['data--file_types']['core']['image_generic'] = new \stdClass();
  cache::$data['data--file_types']['core']['image_generic']->type = 'image';
  cache::$data['data--file_types']['core']['image_generic']->headers['Content-type'] = 'image/*';
  cache::$data['data--file_types']['core']['image_svg'] = new \stdClass();
  cache::$data['data--file_types']['core']['image_svg']->type = 'svg';
  cache::$data['data--file_types']['core']['image_svg']->use_tokens = 1;
  cache::$data['data--file_types']['core']['image_svg']->headers['Content-type'] = 'image/svg+xml';
  cache::$data['data--file_types']['core']['image_ico'] = new \stdClass();
  cache::$data['data--file_types']['core']['image_ico']->type = 'ico';
  cache::$data['data--file_types']['core']['image_ico']->headers['Content-type'] = 'image/x-icon';
  cache::$data['data--file_types']['core']['image_gif'] = new \stdClass();
  cache::$data['data--file_types']['core']['image_gif']->type = 'gif';
  cache::$data['data--file_types']['core']['image_gif']->headers['Content-type'] = 'image/gif';
  cache::$data['data--file_types']['core']['image_jpg'] = new \stdClass();
  cache::$data['data--file_types']['core']['image_jpg']->type = 'jpg';
  cache::$data['data--file_types']['core']['image_jpg']->headers['Content-type'] = 'image/jpeg';
  cache::$data['data--file_types']['core']['image_png'] = new \stdClass();
  cache::$data['data--file_types']['core']['image_png']->type = 'png';
  cache::$data['data--file_types']['core']['image_png']->headers['Content-type'] = 'image/png';
  cache::$data['data--file_types']['storage']['db_files'] = new \stdClass();
  cache::$data['data--file_types']['storage']['db_files']->type = '_d';
  cache::$data['data--file_types']['storage']['db_files']->protected = 1;
  cache::$data['data--file_types']['storage']['db_files']->headers['Content-type'] = 'text/data';
  cache::$data['data--file_types']['storage']['db_sqlite'] = new \stdClass();
  cache::$data['data--file_types']['storage']['db_sqlite']->type = 'sqlite';
  cache::$data['data--file_types']['storage']['db_sqlite']->protected = 1;

}