<?php
  function lang( $phrase ) {
    static $lang = array(
      // Admin Head title
      'ADMIN_DEFAULT_PAGE_TITLE'     => 'Default',
    );

    echo $lang[$phrase];
  }
