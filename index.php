<?php

namespace Aventura\Diary;

use \Aventura\Diary\Bookable\Availability;
use \Aventura\Diary\Bookable\Availability\Timetable;
use \Aventura\Diary\Bookable\Availability\Timetable\Rule\DotwRangeRule;
use \Aventura\Diary\DateTime\Duration;
use \Aventura\Diary\DateTime\Period;

require '.\\vendor\\autoload.php';
require '.\\src\\autoload.php';

$service = new Bookable();
$availability = new Availability();
$timetable = new Timetable();
$availability->setTimetable($timetable);
$service->setAvailability($availability);

// date_default_timezone_set('UTC');

?>
<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        <h1>Testing page</h1>
        <?php $period = new Period(DateTime::now(), Duration::hours(1)); ?>
        <p>Today is: <?php var_dump(gmdate('N')); ?></p>
        <p>Period: <?php echo $period->format('(%s) | (%e)'); ?></p>
        <p>Right now: <code><?php echo DateTime::nowTimestamp(); ?></code></p>
        <p>Time: <code><?php echo DateTime::now()->getTime()->getTimestamp(); ?></code></p>
        <p>Date: <code><?php echo DateTime::now()->getDate()->getTimestamp(); ?></code></p>
        <p><?php echo DateTime::now(); ?></p>
    </body>
</html>