<?php
$page_security = 'SA_TRACKING'; $path_to_root = "../../..";
include_once($path_to_root . "/includes/session.inc");
include_once($path_to_root . "/includes/ui.inc");
include_once($path_to_root . "/modules/FA_Tracking/includes/tracking_db.inc");
page(_("Visitor Tracking"), false, false, "", "");
$stats = get_tracking_stats();
echo "<b>Visitors:</b> " . ($stats['visitors']??0) . "<br>";
echo "<b>Events:</b> " . ($stats['events']??0) . "<br>";
end_page(true);