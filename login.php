<?php

require_once('book_sc_fns.php');
do_html_header('Administration');

display_login_form();
echo sha1('test');
do_html_footer();