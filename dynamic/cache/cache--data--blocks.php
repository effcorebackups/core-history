<?php

namespace effcore { # cache for data--blocks

  cache::$data['data--blocks']['page']['logo'] = new \effcore\block();
  cache::$data['data--blocks']['page']['logo']->content_tag_name = null;
  cache::$data['data--blocks']['page']['logo']->children['link'] = new \effcore\markup();
  cache::$data['data--blocks']['page']['logo']->children['link']->tag_name = 'a';
  cache::$data['data--blocks']['page']['logo']->children['link']->attributes['class']['to_front'] = 'to_front';
  cache::$data['data--blocks']['page']['logo']->children['link']->attributes['href'] = '/';
  cache::$data['data--blocks']['page']['logo']->children['link']->attributes['title'] = new \effcore\text();
  cache::$data['data--blocks']['page']['logo']->children['link']->attributes['title']->text = 'to front page';
  cache::$data['data--blocks']['page']['logo']->attributes['class']['logo'] = 'logo';
  cache::$data['data--blocks']['demo']['demo'] = new \effcore\block();
  cache::$data['data--blocks']['demo']['demo']->title = 'Static block';
  cache::$data['data--blocks']['demo']['demo']->children['demo_paragraph_title'] = new \effcore\markup();
  cache::$data['data--blocks']['demo']['demo']->children['demo_paragraph_title']->tag_name = 'h3';
  cache::$data['data--blocks']['demo']['demo']->children['demo_paragraph_title']->children['content'] = new \effcore\text();
  cache::$data['data--blocks']['demo']['demo']->children['demo_paragraph_title']->children['content']->text = 'Paragraph';
  cache::$data['data--blocks']['demo']['demo']->children['demo_paragraph'] = new \effcore\markup();
  cache::$data['data--blocks']['demo']['demo']->children['demo_paragraph']->tag_name = 'p';
  cache::$data['data--blocks']['demo']['demo']->children['demo_paragraph']->children['content'] = new \effcore\text();
  cache::$data['data--blocks']['demo']['demo']->children['demo_paragraph']->children['content']->text = ' Paragraph content. Paragraph content. Paragraph content. Paragraph content. Paragraph content. Paragraph content. Paragraph content. Paragraph content. Paragraph content. Paragraph content. Paragraph content. Paragraph content. Paragraph content. Paragraph content. Paragraph content. Paragraph content.&#10;';
  cache::$data['data--blocks']['demo']['demo']->children['demo_paragraph']->children['link_view_more'] = new \effcore\markup();
  cache::$data['data--blocks']['demo']['demo']->children['demo_paragraph']->children['link_view_more']->tag_name = 'a';
  cache::$data['data--blocks']['demo']['demo']->children['demo_paragraph']->children['link_view_more']->children['content'] = new \effcore\text();
  cache::$data['data--blocks']['demo']['demo']->children['demo_paragraph']->children['link_view_more']->children['content']->text = 'View more';
  cache::$data['data--blocks']['demo']['demo']->children['demo_paragraph']->children['link_view_more']->attributes['href'] = '/';
  cache::$data['data--blocks']['demo']['demo']->children['demo_unordered_list_title'] = new \effcore\markup();
  cache::$data['data--blocks']['demo']['demo']->children['demo_unordered_list_title']->tag_name = 'h3';
  cache::$data['data--blocks']['demo']['demo']->children['demo_unordered_list_title']->children['content'] = new \effcore\text();
  cache::$data['data--blocks']['demo']['demo']->children['demo_unordered_list_title']->children['content']->text = 'Unordered list';
  cache::$data['data--blocks']['demo']['demo']->children['demo_unordered_list'] = new \effcore\markup();
  cache::$data['data--blocks']['demo']['demo']->children['demo_unordered_list']->tag_name = 'ul';
  cache::$data['data--blocks']['demo']['demo']->children['demo_unordered_list']->children['li_1'] = new \effcore\markup();
  cache::$data['data--blocks']['demo']['demo']->children['demo_unordered_list']->children['li_1']->tag_name = 'li';
  cache::$data['data--blocks']['demo']['demo']->children['demo_unordered_list']->children['li_1']->children['content'] = new \effcore\text();
  cache::$data['data--blocks']['demo']['demo']->children['demo_unordered_list']->children['li_1']->children['content']->args['number'] = 1;
  cache::$data['data--blocks']['demo']['demo']->children['demo_unordered_list']->children['li_1']->children['content']->text = 'item #%%_number';
  cache::$data['data--blocks']['demo']['demo']->children['demo_unordered_list']->children['li_2'] = new \effcore\markup();
  cache::$data['data--blocks']['demo']['demo']->children['demo_unordered_list']->children['li_2']->tag_name = 'li';
  cache::$data['data--blocks']['demo']['demo']->children['demo_unordered_list']->children['li_2']->children['content'] = new \effcore\text();
  cache::$data['data--blocks']['demo']['demo']->children['demo_unordered_list']->children['li_2']->children['content']->args['number'] = 2;
  cache::$data['data--blocks']['demo']['demo']->children['demo_unordered_list']->children['li_2']->children['content']->text = 'item #%%_number';
  cache::$data['data--blocks']['demo']['demo']->children['demo_unordered_list']->children['li_2']->children['li_2_ul'] = new \effcore\markup();
  cache::$data['data--blocks']['demo']['demo']->children['demo_unordered_list']->children['li_2']->children['li_2_ul']->tag_name = 'ul';
  cache::$data['data--blocks']['demo']['demo']->children['demo_unordered_list']->children['li_2']->children['li_2_ul']->children['li_2_1'] = new \effcore\markup();
  cache::$data['data--blocks']['demo']['demo']->children['demo_unordered_list']->children['li_2']->children['li_2_ul']->children['li_2_1']->tag_name = 'li';
  cache::$data['data--blocks']['demo']['demo']->children['demo_unordered_list']->children['li_2']->children['li_2_ul']->children['li_2_1']->children['content'] = new \effcore\text();
  cache::$data['data--blocks']['demo']['demo']->children['demo_unordered_list']->children['li_2']->children['li_2_ul']->children['li_2_1']->children['content']->args['number'] = 2.1;
  cache::$data['data--blocks']['demo']['demo']->children['demo_unordered_list']->children['li_2']->children['li_2_ul']->children['li_2_1']->children['content']->text = 'item #%%_number';
  cache::$data['data--blocks']['demo']['demo']->children['demo_unordered_list']->children['li_2']->children['li_2_ul']->children['li_2_2'] = new \effcore\markup();
  cache::$data['data--blocks']['demo']['demo']->children['demo_unordered_list']->children['li_2']->children['li_2_ul']->children['li_2_2']->tag_name = 'li';
  cache::$data['data--blocks']['demo']['demo']->children['demo_unordered_list']->children['li_2']->children['li_2_ul']->children['li_2_2']->children['content'] = new \effcore\text();
  cache::$data['data--blocks']['demo']['demo']->children['demo_unordered_list']->children['li_2']->children['li_2_ul']->children['li_2_2']->children['content']->args['number'] = 2.2;
  cache::$data['data--blocks']['demo']['demo']->children['demo_unordered_list']->children['li_2']->children['li_2_ul']->children['li_2_2']->children['content']->text = 'item #%%_number';
  cache::$data['data--blocks']['demo']['demo']->children['demo_unordered_list']->children['li_2']->children['li_2_ul']->children['li_2_3'] = new \effcore\markup();
  cache::$data['data--blocks']['demo']['demo']->children['demo_unordered_list']->children['li_2']->children['li_2_ul']->children['li_2_3']->tag_name = 'li';
  cache::$data['data--blocks']['demo']['demo']->children['demo_unordered_list']->children['li_2']->children['li_2_ul']->children['li_2_3']->children['content'] = new \effcore\text();
  cache::$data['data--blocks']['demo']['demo']->children['demo_unordered_list']->children['li_2']->children['li_2_ul']->children['li_2_3']->children['content']->args['number'] = 2.3;
  cache::$data['data--blocks']['demo']['demo']->children['demo_unordered_list']->children['li_2']->children['li_2_ul']->children['li_2_3']->children['content']->text = 'item #%%_number';
  cache::$data['data--blocks']['demo']['demo']->children['demo_unordered_list']->children['li_3'] = new \effcore\markup();
  cache::$data['data--blocks']['demo']['demo']->children['demo_unordered_list']->children['li_3']->tag_name = 'li';
  cache::$data['data--blocks']['demo']['demo']->children['demo_unordered_list']->children['li_3']->children['content'] = new \effcore\text();
  cache::$data['data--blocks']['demo']['demo']->children['demo_unordered_list']->children['li_3']->children['content']->args['number'] = 3;
  cache::$data['data--blocks']['demo']['demo']->children['demo_unordered_list']->children['li_3']->children['content']->text = 'item #%%_number';
  cache::$data['data--blocks']['demo']['demo']->children['demo_ordered_list_title'] = new \effcore\markup();
  cache::$data['data--blocks']['demo']['demo']->children['demo_ordered_list_title']->tag_name = 'h3';
  cache::$data['data--blocks']['demo']['demo']->children['demo_ordered_list_title']->children['content'] = new \effcore\text();
  cache::$data['data--blocks']['demo']['demo']->children['demo_ordered_list_title']->children['content']->text = 'Ordered list';
  cache::$data['data--blocks']['demo']['demo']->children['demo_ordered_list'] = new \effcore\markup();
  cache::$data['data--blocks']['demo']['demo']->children['demo_ordered_list']->tag_name = 'ol';
  cache::$data['data--blocks']['demo']['demo']->children['demo_ordered_list']->children['li_1'] = new \effcore\markup();
  cache::$data['data--blocks']['demo']['demo']->children['demo_ordered_list']->children['li_1']->tag_name = 'li';
  cache::$data['data--blocks']['demo']['demo']->children['demo_ordered_list']->children['li_1']->children['content'] = new \effcore\text();
  cache::$data['data--blocks']['demo']['demo']->children['demo_ordered_list']->children['li_1']->children['content']->args['number'] = 1;
  cache::$data['data--blocks']['demo']['demo']->children['demo_ordered_list']->children['li_1']->children['content']->text = 'item #%%_number';
  cache::$data['data--blocks']['demo']['demo']->children['demo_ordered_list']->children['li_2'] = new \effcore\markup();
  cache::$data['data--blocks']['demo']['demo']->children['demo_ordered_list']->children['li_2']->tag_name = 'li';
  cache::$data['data--blocks']['demo']['demo']->children['demo_ordered_list']->children['li_2']->children['content'] = new \effcore\text();
  cache::$data['data--blocks']['demo']['demo']->children['demo_ordered_list']->children['li_2']->children['content']->args['number'] = 2;
  cache::$data['data--blocks']['demo']['demo']->children['demo_ordered_list']->children['li_2']->children['content']->text = 'item #%%_number';
  cache::$data['data--blocks']['demo']['demo']->children['demo_ordered_list']->children['li_2']->children['li_2_ol'] = new \effcore\markup();
  cache::$data['data--blocks']['demo']['demo']->children['demo_ordered_list']->children['li_2']->children['li_2_ol']->tag_name = 'ol';
  cache::$data['data--blocks']['demo']['demo']->children['demo_ordered_list']->children['li_2']->children['li_2_ol']->children['li_2_1'] = new \effcore\markup();
  cache::$data['data--blocks']['demo']['demo']->children['demo_ordered_list']->children['li_2']->children['li_2_ol']->children['li_2_1']->tag_name = 'li';
  cache::$data['data--blocks']['demo']['demo']->children['demo_ordered_list']->children['li_2']->children['li_2_ol']->children['li_2_1']->children['content'] = new \effcore\text();
  cache::$data['data--blocks']['demo']['demo']->children['demo_ordered_list']->children['li_2']->children['li_2_ol']->children['li_2_1']->children['content']->args['number'] = 2.1;
  cache::$data['data--blocks']['demo']['demo']->children['demo_ordered_list']->children['li_2']->children['li_2_ol']->children['li_2_1']->children['content']->text = 'item #%%_number';
  cache::$data['data--blocks']['demo']['demo']->children['demo_ordered_list']->children['li_2']->children['li_2_ol']->children['li_2_2'] = new \effcore\markup();
  cache::$data['data--blocks']['demo']['demo']->children['demo_ordered_list']->children['li_2']->children['li_2_ol']->children['li_2_2']->tag_name = 'li';
  cache::$data['data--blocks']['demo']['demo']->children['demo_ordered_list']->children['li_2']->children['li_2_ol']->children['li_2_2']->children['content'] = new \effcore\text();
  cache::$data['data--blocks']['demo']['demo']->children['demo_ordered_list']->children['li_2']->children['li_2_ol']->children['li_2_2']->children['content']->args['number'] = 2.2;
  cache::$data['data--blocks']['demo']['demo']->children['demo_ordered_list']->children['li_2']->children['li_2_ol']->children['li_2_2']->children['content']->text = 'item #%%_number';
  cache::$data['data--blocks']['demo']['demo']->children['demo_ordered_list']->children['li_2']->children['li_2_ol']->children['li_2_3'] = new \effcore\markup();
  cache::$data['data--blocks']['demo']['demo']->children['demo_ordered_list']->children['li_2']->children['li_2_ol']->children['li_2_3']->tag_name = 'li';
  cache::$data['data--blocks']['demo']['demo']->children['demo_ordered_list']->children['li_2']->children['li_2_ol']->children['li_2_3']->children['content'] = new \effcore\text();
  cache::$data['data--blocks']['demo']['demo']->children['demo_ordered_list']->children['li_2']->children['li_2_ol']->children['li_2_3']->children['content']->args['number'] = 2.3;
  cache::$data['data--blocks']['demo']['demo']->children['demo_ordered_list']->children['li_2']->children['li_2_ol']->children['li_2_3']->children['content']->text = 'item #%%_number';
  cache::$data['data--blocks']['demo']['demo']->children['demo_ordered_list']->children['li_3'] = new \effcore\markup();
  cache::$data['data--blocks']['demo']['demo']->children['demo_ordered_list']->children['li_3']->tag_name = 'li';
  cache::$data['data--blocks']['demo']['demo']->children['demo_ordered_list']->children['li_3']->children['content'] = new \effcore\text();
  cache::$data['data--blocks']['demo']['demo']->children['demo_ordered_list']->children['li_3']->children['content']->args['number'] = 3;
  cache::$data['data--blocks']['demo']['demo']->children['demo_ordered_list']->children['li_3']->children['content']->text = 'item #%%_number';
  cache::$data['data--blocks']['demo']['demo']->children['demo_table_title'] = new \effcore\markup();
  cache::$data['data--blocks']['demo']['demo']->children['demo_table_title']->tag_name = 'h3';
  cache::$data['data--blocks']['demo']['demo']->children['demo_table_title']->children['content'] = new \effcore\text();
  cache::$data['data--blocks']['demo']['demo']->children['demo_table_title']->children['content']->text = 'Table';
  cache::$data['data--blocks']['demo']['demo']->children['demo_table'] = new \effcore\table();
  cache::$data['data--blocks']['demo']['demo']->children['demo_table']->children['head'] = new \effcore\table_head();
  cache::$data['data--blocks']['demo']['demo']->children['demo_table']->children['head']->children['tr'] = new \effcore\table_head_row();
  cache::$data['data--blocks']['demo']['demo']->children['demo_table']->children['head']->children['tr']->children['th_1'] = new \effcore\table_head_row_cell();
  cache::$data['data--blocks']['demo']['demo']->children['demo_table']->children['head']->children['tr']->children['th_1']->children['content'] = new \effcore\text();
  cache::$data['data--blocks']['demo']['demo']->children['demo_table']->children['head']->children['tr']->children['th_1']->children['content']->args['number'] = 1;
  cache::$data['data--blocks']['demo']['demo']->children['demo_table']->children['head']->children['tr']->children['th_1']->children['content']->text = 'head cell #%%_number';
  cache::$data['data--blocks']['demo']['demo']->children['demo_table']->children['head']->children['tr']->children['th_2'] = new \effcore\table_head_row_cell();
  cache::$data['data--blocks']['demo']['demo']->children['demo_table']->children['head']->children['tr']->children['th_2']->children['content'] = new \effcore\text();
  cache::$data['data--blocks']['demo']['demo']->children['demo_table']->children['head']->children['tr']->children['th_2']->children['content']->args['number'] = 2;
  cache::$data['data--blocks']['demo']['demo']->children['demo_table']->children['head']->children['tr']->children['th_2']->children['content']->text = 'head cell #%%_number';
  cache::$data['data--blocks']['demo']['demo']->children['demo_table']->children['head']->children['tr']->children['th_3'] = new \effcore\table_head_row_cell();
  cache::$data['data--blocks']['demo']['demo']->children['demo_table']->children['head']->children['tr']->children['th_3']->children['content'] = new \effcore\text();
  cache::$data['data--blocks']['demo']['demo']->children['demo_table']->children['head']->children['tr']->children['th_3']->children['content']->args['number'] = 3;
  cache::$data['data--blocks']['demo']['demo']->children['demo_table']->children['head']->children['tr']->children['th_3']->children['content']->text = 'head cell #%%_number';
  cache::$data['data--blocks']['demo']['demo']->children['demo_table']->children['body'] = new \effcore\table_body();
  cache::$data['data--blocks']['demo']['demo']->children['demo_table']->children['body']->children['tr_1'] = new \effcore\table_body_row();
  cache::$data['data--blocks']['demo']['demo']->children['demo_table']->children['body']->children['tr_1']->children['td_1'] = new \effcore\table_body_row_cell();
  cache::$data['data--blocks']['demo']['demo']->children['demo_table']->children['body']->children['tr_1']->children['td_1']->children['content'] = new \effcore\text();
  cache::$data['data--blocks']['demo']['demo']->children['demo_table']->children['body']->children['tr_1']->children['td_1']->children['content']->args['number'] = 1.1;
  cache::$data['data--blocks']['demo']['demo']->children['demo_table']->children['body']->children['tr_1']->children['td_1']->children['content']->text = 'cell #%%_number';
  cache::$data['data--blocks']['demo']['demo']->children['demo_table']->children['body']->children['tr_1']->children['td_2'] = new \effcore\table_body_row_cell();
  cache::$data['data--blocks']['demo']['demo']->children['demo_table']->children['body']->children['tr_1']->children['td_2']->children['content'] = new \effcore\text();
  cache::$data['data--blocks']['demo']['demo']->children['demo_table']->children['body']->children['tr_1']->children['td_2']->children['content']->args['number'] = 1.2;
  cache::$data['data--blocks']['demo']['demo']->children['demo_table']->children['body']->children['tr_1']->children['td_2']->children['content']->text = 'cell #%%_number';
  cache::$data['data--blocks']['demo']['demo']->children['demo_table']->children['body']->children['tr_1']->children['td_3'] = new \effcore\table_body_row_cell();
  cache::$data['data--blocks']['demo']['demo']->children['demo_table']->children['body']->children['tr_1']->children['td_3']->children['content'] = new \effcore\text();
  cache::$data['data--blocks']['demo']['demo']->children['demo_table']->children['body']->children['tr_1']->children['td_3']->children['content']->args['number'] = 1.3;
  cache::$data['data--blocks']['demo']['demo']->children['demo_table']->children['body']->children['tr_1']->children['td_3']->children['content']->text = 'cell #%%_number';
  cache::$data['data--blocks']['demo']['demo']->children['demo_table']->children['body']->children['tr_2'] = new \effcore\table_body_row();
  cache::$data['data--blocks']['demo']['demo']->children['demo_table']->children['body']->children['tr_2']->children['td_1'] = new \effcore\table_body_row_cell();
  cache::$data['data--blocks']['demo']['demo']->children['demo_table']->children['body']->children['tr_2']->children['td_1']->children['content'] = new \effcore\text();
  cache::$data['data--blocks']['demo']['demo']->children['demo_table']->children['body']->children['tr_2']->children['td_1']->children['content']->args['number'] = 2.1;
  cache::$data['data--blocks']['demo']['demo']->children['demo_table']->children['body']->children['tr_2']->children['td_1']->children['content']->text = 'cell #%%_number';
  cache::$data['data--blocks']['demo']['demo']->children['demo_table']->children['body']->children['tr_2']->children['td_2'] = new \effcore\table_body_row_cell();
  cache::$data['data--blocks']['demo']['demo']->children['demo_table']->children['body']->children['tr_2']->children['td_2']->children['content'] = new \effcore\text();
  cache::$data['data--blocks']['demo']['demo']->children['demo_table']->children['body']->children['tr_2']->children['td_2']->children['content']->args['number'] = 2.2;
  cache::$data['data--blocks']['demo']['demo']->children['demo_table']->children['body']->children['tr_2']->children['td_2']->children['content']->text = 'cell #%%_number';
  cache::$data['data--blocks']['demo']['demo']->children['demo_table']->children['body']->children['tr_2']->children['td_3'] = new \effcore\table_body_row_cell();
  cache::$data['data--blocks']['demo']['demo']->children['demo_table']->children['body']->children['tr_2']->children['td_3']->children['content'] = new \effcore\text();
  cache::$data['data--blocks']['demo']['demo']->children['demo_table']->children['body']->children['tr_2']->children['td_3']->children['content']->args['number'] = 2.3;
  cache::$data['data--blocks']['demo']['demo']->children['demo_table']->children['body']->children['tr_2']->children['td_3']->children['content']->text = 'cell #%%_number';
  cache::$data['data--blocks']['demo']['demo']->children['demo_table']->children['body']->children['tr_3'] = new \effcore\table_body_row();
  cache::$data['data--blocks']['demo']['demo']->children['demo_table']->children['body']->children['tr_3']->children['td_1'] = new \effcore\table_body_row_cell();
  cache::$data['data--blocks']['demo']['demo']->children['demo_table']->children['body']->children['tr_3']->children['td_1']->children['content'] = new \effcore\text();
  cache::$data['data--blocks']['demo']['demo']->children['demo_table']->children['body']->children['tr_3']->children['td_1']->children['content']->args['number'] = 3.1;
  cache::$data['data--blocks']['demo']['demo']->children['demo_table']->children['body']->children['tr_3']->children['td_1']->children['content']->text = 'cell #%%_number';
  cache::$data['data--blocks']['demo']['demo']->children['demo_table']->children['body']->children['tr_3']->children['td_2'] = new \effcore\table_body_row_cell();
  cache::$data['data--blocks']['demo']['demo']->children['demo_table']->children['body']->children['tr_3']->children['td_2']->children['content'] = new \effcore\text();
  cache::$data['data--blocks']['demo']['demo']->children['demo_table']->children['body']->children['tr_3']->children['td_2']->children['content']->args['number'] = 3.2;
  cache::$data['data--blocks']['demo']['demo']->children['demo_table']->children['body']->children['tr_3']->children['td_2']->children['content']->text = 'cell #%%_number';
  cache::$data['data--blocks']['demo']['demo']->children['demo_table']->children['body']->children['tr_3']->children['td_3'] = new \effcore\table_body_row_cell();
  cache::$data['data--blocks']['demo']['demo']->children['demo_table']->children['body']->children['tr_3']->children['td_3']->children['content'] = new \effcore\text();
  cache::$data['data--blocks']['demo']['demo']->children['demo_table']->children['body']->children['tr_3']->children['td_3']->children['content']->args['number'] = 3.3;
  cache::$data['data--blocks']['demo']['demo']->children['demo_table']->children['body']->children['tr_3']->children['td_3']->children['content']->text = 'cell #%%_number';
  cache::$data['data--blocks']['demo']['demo']->children['demo_table']->children['body']->children['tr_4'] = new \effcore\table_body_row();
  cache::$data['data--blocks']['demo']['demo']->children['demo_table']->children['body']->children['tr_4']->children['td_1'] = new \effcore\table_body_row_cell();
  cache::$data['data--blocks']['demo']['demo']->children['demo_table']->children['body']->children['tr_4']->children['td_1']->children['content'] = new \effcore\text();
  cache::$data['data--blocks']['demo']['demo']->children['demo_table']->children['body']->children['tr_4']->children['td_1']->attributes['colspan'] = 3;
  cache::$data['data--blocks']['demo']['demo']->children['demo_pager_2'] = new \effcore\pager();
  cache::$data['data--blocks']['demo']['demo']->children['demo_pager_2']->id = 'pager';
  cache::$data['data--blocks']['demo']['demo']->children['demo_pager_2']->prefix = 'my';
  cache::$data['data--blocks']['demo']['demo']->children['demo_pager_2']->max = 10000;
  cache::$data['data--blocks']['demo']['demo']->children['controls_title'] = new \effcore\markup();
  cache::$data['data--blocks']['demo']['demo']->children['controls_title']->tag_name = 'h3';
  cache::$data['data--blocks']['demo']['demo']->children['controls_title']->children['content'] = new \effcore\text();
  cache::$data['data--blocks']['demo']['demo']->children['controls_title']->children['content']->text = 'Control elements';
  cache::$data['data--blocks']['demo']['demo']->children['demo_actions_list'] = new \effcore\control_actions_list();
  cache::$data['data--blocks']['demo']['demo']->children['demo_actions_list']->actions['edit'] = 'edit';
  cache::$data['data--blocks']['demo']['demo']->children['demo_actions_list']->actions['delete'] = 'delete';
  cache::$data['data--blocks']['demo']['demo']->children['demo_actions_list']->active['edit'] = 'edit';
  cache::$data['data--blocks']['demo']['demo']->children['demo_actions_list']->attributes['class']['demo-actions-list'] = 'demo-actions-list';
  cache::$data['data--blocks']['demo']['demo']->attributes['class']['demo'] = 'demo';

}