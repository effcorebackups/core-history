<?php

  ##################################################################
  ### Copyright © 2017—2018 Maxim Rysevets. All rights reserved. ###
  ##################################################################

namespace effcore {

# indicates that the cache for marked pattern should be separated by files
  interface has_external_cache {
    static function get_not_external_properties();
  }

}