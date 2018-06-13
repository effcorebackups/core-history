<?php

namespace effcore { # cache for data--forms-demo-demo

  cache::$data['data--forms-demo-demo'] = new \effcore\form();
  cache::$data['data--forms-demo-demo']->children['form_elements'] = new \effcore\container();
  cache::$data['data--forms-demo-demo']->children['form_elements']->tag_name = 'fieldset';
  cache::$data['data--forms-demo-demo']->children['form_elements']->title = 'Form elements';
  cache::$data['data--forms-demo-demo']->children['form_elements']->title_tag_name = 'legend';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['file'] = new \effcore\field_file();
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['file']->title = 'File (field_file)';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['file']->max_file_size = '10K';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['file']->allowed_types['gif'] = 'gif';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['file']->allowed_types['jpeg'] = 'jpeg';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['file']->allowed_types['jpg'] = 'jpg';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['file']->allowed_types['png'] = 'png';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['file']->upload_dir = 'demo/';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['file']->element_attributes['name'] = 'file[]';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['file']->element_attributes['multiple'] = 'multiple';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['file']->description = new \effcore\text();
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['file']->description->args['info'] = '&lt;input type="file"&gt;';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['file']->description->text = 'Element %%_info.';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['text'] = new \effcore\field_text();
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['text']->title = 'Text (field_text)';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['text']->element_attributes['name'] = 'text';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['text']->element_attributes['value'] = 'text in input';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['text']->element_attributes['minlength'] = 5;
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['text']->element_attributes['pattern'] = '%^[a-zA-Z0-9 ]+$%';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['text']->description = new \effcore\text();
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['text']->description->args['info'] = '&lt;input type="text"&gt;';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['text']->description->text = 'Element %%_info.';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['password'] = new \effcore\field_password();
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['password']->title = 'Password (field_password)';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['password']->element_attributes['name'] = 'password';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['password']->element_attributes['value'] = 'text in password';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['password']->description = new \effcore\text();
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['password']->description->args['info'] = '&lt;input type="password"&gt;';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['password']->description->text = 'Element %%_info.';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['search'] = new \effcore\field_search();
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['search']->title = 'Search (field_search)';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['search']->element_attributes['name'] = 'search';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['search']->element_attributes['value'] = 'text in search';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['search']->description = new \effcore\text();
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['search']->description->args['info'] = '&lt;input type="search"&gt;';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['search']->description->text = 'Element %%_info.';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['url'] = new \effcore\field_url();
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['url']->title = 'URL (field_url)';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['url']->element_attributes['name'] = 'url';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['url']->element_attributes['value'] = 'http://example.com';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['url']->description = new \effcore\text();
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['url']->description->args['info'] = '&lt;input type="url"&gt;';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['url']->description->text = 'Element %%_info.';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['phone'] = new \effcore\field_phone();
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['phone']->title = 'Phone (field_phone)';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['phone']->element_attributes['name'] = 'phone';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['phone']->element_attributes['value'] = '&#43;000112334455';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['phone']->description = new \effcore\text();
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['phone']->description->text = 'Use international format of mobile phone numbers.';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['email'] = new \effcore\field_email();
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['email']->title = 'EMail (field_email)';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['email']->element_attributes['name'] = 'email';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['email']->element_attributes['value'] = 'test1@example.com,test2@example.com';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['email']->element_attributes['multiple'] = 'multiple';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['email']->description = new \effcore\text();
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['email']->description->args['info'] = '&lt;input type="email"&gt;';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['email']->description->text = 'Element %%_info.';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['number'] = new \effcore\field_number();
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['number']->title = 'Number (field_number)';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['number']->element_attributes['name'] = 'number';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['number']->element_attributes['min'] = -1000;
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['number']->element_attributes['max'] = 1000;
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['number']->element_attributes['step'] = 0.2;
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['number']->description = new \effcore\text();
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['number']->description->args['info'] = '&lt;input type="number"&gt;';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['number']->description->text = 'Element %%_info.';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['range'] = new \effcore\field_range();
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['range']->title = 'Range (field_range)';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['range']->element_attributes['name'] = 'range';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['range']->element_attributes['min'] = -1;
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['range']->element_attributes['max'] = 1;
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['range']->element_attributes['step'] = 0.2;
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['range']->description = new \effcore\text();
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['range']->description->args['info'] = '&lt;input type="range"&gt;';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['range']->description->text = 'Element %%_info.';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['date'] = new \effcore\field_date();
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['date']->title = 'Date (field_date)';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['date']->element_attributes['name'] = 'date';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['date']->element_attributes['value'] = '2020-01-01';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['date']->description = new \effcore\text();
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['date']->description->args['info'] = '&lt;input type="date"&gt;';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['date']->description->text = 'Element %%_info.';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['time'] = new \effcore\field_time();
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['time']->title = 'Time (field_time)';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['time']->element_attributes['name'] = 'time';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['time']->element_attributes['value'] = '01:23:45';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['time']->description = new \effcore\text();
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['time']->description->args['info'] = '&lt;input type="time"&gt;';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['time']->description->text = 'Element %%_info.';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['select_timezone'] = new \effcore\field_timezone();
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['select_timezone']->selected[424] = 424;
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['select_timezone']->element_attributes['name'] = 'select_timezone';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['select_timezone']->element_attributes['required'] = 'required';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['select_timezone']->title = 'Timezone (field_timezone)';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['color'] = new \effcore\field_color();
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['color']->title = 'Color (field_color)';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['color']->element_attributes['name'] = 'color';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['color']->element_attributes['value'] = '#ffffff';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['textarea'] = new \effcore\field_textarea();
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['textarea']->title = 'Textarea (field_textarea)';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['textarea']->element_attributes['name'] = 'textarea_macro';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['textarea']->element_attributes['value'] = 'text in textarea';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['textarea']->description = new \effcore\text();
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['textarea']->description->args['info'] = '&lt;textarea&gt;&lt;/textarea&gt;';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['textarea']->description->text = 'Element %%_info.';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['select'] = new \effcore\field_select();
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['select']->values['not_selected'] = '- select -';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['select']->values['option_1'] = 'Option 1 (selected)';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['select']->values['option_2'] = 'Option 2 (disabled)';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['select']->values['option_3'] = 'Option 3';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['select']->values['group_1'] = new \stdClass();
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['select']->values['group_1']->title = 'Group 1';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['select']->values['group_1']->values['option_4'] = 'Option 4';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['select']->selected['option_1'] = 'option_1';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['select']->disabled['option_2'] = 'option_2';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['select']->element_attributes['name'] = 'select';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['select']->title = 'Selection list (field_select)';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['select']->description = new \effcore\text();
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['select']->description->args['info'] = '&lt;select&gt;';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['select']->description->text = 'Element %%_info.';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['checkboxes_all'] = new \effcore\container();
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['checkboxes_all']->tag_name = 'fieldset';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['checkboxes_all']->title = 'Checkboxes';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['checkboxes_all']->title_tag_name = 'legend';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['checkboxes_all']->children['checkbox'] = new \effcore\field_checkbox();
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['checkboxes_all']->children['checkbox']->title = 'Checkbox (field_checkbox)';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['checkboxes_all']->children['checkbox']->element_attributes['name'] = 'checkbox';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['checkboxes_all']->children['checkbox']->element_attributes['value'] = 'checkbox';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['checkboxes_all']->children['checkbox']->element_attributes['checked'] = 'checked';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['checkboxes_all']->children['checkbox']->description = new \effcore\text();
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['checkboxes_all']->children['checkbox']->description->args['info'] = '&lt;checkbox&gt;';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['checkboxes_all']->children['checkbox']->description->text = 'Element %%_info.';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['checkboxes_all']->children['checkboxes'] = new \effcore\group_checkboxes();
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['checkboxes_all']->children['checkboxes']->element_attributes['name'] = 'checkboxes[]';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['checkboxes_all']->children['checkboxes']->values['checkboxes_1'] = 'Checkbox 1';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['checkboxes_all']->children['checkboxes']->values['checkboxes_2'] = 'Checkbox 2 (checked)';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['checkboxes_all']->children['checkboxes']->values['checkboxes_3'] = 'Checkbox 3 (disabled)';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['checkboxes_all']->children['checkboxes']->values['checkboxes_4'] = 'Checkbox 4 (disabled + checked)';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['checkboxes_all']->children['checkboxes']->disabled['checkboxes_3'] = 'checkboxes_3';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['checkboxes_all']->children['checkboxes']->disabled['checkboxes_4'] = 'checkboxes_4';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['checkboxes_all']->children['checkboxes']->checked['checkboxes_2'] = 'checkboxes_2';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['checkboxes_all']->children['checkboxes']->checked['checkboxes_4'] = 'checkboxes_4';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['checkboxes_all']->children['checkboxes']->title = 'Checkboxes (group_checkboxes)';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['checkboxes_all']->children['checkboxes']->description = new \effcore\text();
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['checkboxes_all']->children['checkboxes']->description->args['info'] = '&lt;input type="checkbox"&gt;';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['checkboxes_all']->children['checkboxes']->description->text = 'Elements %%_info.';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['radiobuttons_all'] = new \effcore\container();
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['radiobuttons_all']->tag_name = 'fieldset';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['radiobuttons_all']->title = 'Radiobuttons';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['radiobuttons_all']->title_tag_name = 'legend';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['radiobuttons_all']->children['radiobutton'] = new \effcore\field_radiobutton();
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['radiobuttons_all']->children['radiobutton']->title = 'Radiobutton (field_radiobutton)';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['radiobuttons_all']->children['radiobutton']->element_attributes['name'] = 'radiobutton';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['radiobuttons_all']->children['radiobutton']->element_attributes['value'] = 'radiobutton';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['radiobuttons_all']->children['radiobutton']->description = new \effcore\text();
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['radiobuttons_all']->children['radiobutton']->description->args['info'] = '&lt;input type="radio"&gt;';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['radiobuttons_all']->children['radiobutton']->description->text = 'Element %%_info.';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['radiobuttons_all']->children['radiobuttons'] = new \effcore\group_radiobuttons();
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['radiobuttons_all']->children['radiobuttons']->element_attributes['name'] = 'radiobuttons';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['radiobuttons_all']->children['radiobuttons']->values['radiobuttons_1'] = 'Radiobutton 1';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['radiobuttons_all']->children['radiobuttons']->values['radiobuttons_2'] = 'Radiobutton 2 (checked)';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['radiobuttons_all']->children['radiobuttons']->values['radiobuttons_3'] = 'Radiobutton 3 (disabled)';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['radiobuttons_all']->children['radiobuttons']->disabled['radiobuttons_3'] = 'radiobuttons_3';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['radiobuttons_all']->children['radiobuttons']->checked['radiobuttons_2'] = 'radiobuttons_2';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['radiobuttons_all']->children['radiobuttons']->title = 'Radiobuttons (group_radiobuttons)';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['radiobuttons_all']->children['radiobuttons']->description = new \effcore\text();
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['radiobuttons_all']->children['radiobuttons']->description->args['info'] = '&lt;input type="radio"&gt;';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['radiobuttons_all']->children['radiobuttons']->description->text = 'Elements %%_info.';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['radiobuttons_all']->children['palette'] = new \effcore\group_palette();
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['radiobuttons_all']->children['palette']->element_attributes['name'] = 'palette_color';
  cache::$data['data--forms-demo-demo']->children['form_elements']->children['radiobuttons_all']->children['palette']->title = 'Color (group_palette)';
  cache::$data['data--forms-demo-demo']->children['button_submit'] = new \effcore\markup();
  cache::$data['data--forms-demo-demo']->children['button_submit']->tag_name = 'button';
  cache::$data['data--forms-demo-demo']->children['button_submit']->children['label'] = new \effcore\text();
  cache::$data['data--forms-demo-demo']->children['button_submit']->children['label']->text = 'submit';
  cache::$data['data--forms-demo-demo']->children['button_submit']->attributes['type'] = 'submit';
  cache::$data['data--forms-demo-demo']->children['button_submit']->attributes['name'] = 'button';
  cache::$data['data--forms-demo-demo']->children['button_submit']->attributes['value'] = 'submit';
  cache::$data['data--forms-demo-demo']->children['button_button'] = new \effcore\markup();
  cache::$data['data--forms-demo-demo']->children['button_button']->tag_name = 'button';
  cache::$data['data--forms-demo-demo']->children['button_button']->children['label'] = new \effcore\text();
  cache::$data['data--forms-demo-demo']->children['button_button']->children['label']->text = 'button';
  cache::$data['data--forms-demo-demo']->children['button_button']->attributes['type'] = 'button';
  cache::$data['data--forms-demo-demo']->children['button_button']->attributes['name'] = 'button';
  cache::$data['data--forms-demo-demo']->children['button_button']->attributes['value'] = 'button';
  cache::$data['data--forms-demo-demo']->children['button_reset'] = new \effcore\markup();
  cache::$data['data--forms-demo-demo']->children['button_reset']->tag_name = 'button';
  cache::$data['data--forms-demo-demo']->children['button_reset']->children['label'] = new \effcore\text();
  cache::$data['data--forms-demo-demo']->children['button_reset']->children['label']->text = 'reset';
  cache::$data['data--forms-demo-demo']->children['button_reset']->attributes['type'] = 'reset';
  cache::$data['data--forms-demo-demo']->children['button_reset']->attributes['name'] = 'button';
  cache::$data['data--forms-demo-demo']->children['button_reset']->attributes['value'] = 'reset';
  cache::$data['data--forms-demo-demo']->attributes['id'] = 'demo';
  cache::$data['data--forms-demo-demo']->attributes['novalidate'] = 'novalidate';
  cache::$data['data--forms-demo-demo']->attributes['enctype'] = 'multipart/form-data';
  cache::$data['data--forms-demo-demo']->attributes['method'] = 'post';

}