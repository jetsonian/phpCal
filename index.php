<?php
	// if month is set by the URL set the month variable else set it to current year
	if ( isset( $_GET['month'] ) ) {
		$month = $_GET['month'];
	} else {
		$month = date ( "n" );
	}
	
	// if year is set by the URL set the year variable else set it to current year
	if ( isset ( $_GET['year'] ) ) {
		$year = $_GET['year'];
	} else {
		$year = date ( "Y" );
	}
	
	//convert month and year variables into format we like
	$current_month = date ( "n", mktime( 0, 0, 0, $month ) );
	$current_month_long = date ( "F", mktime( 0, 0, 0, $month ) );
	$current_year = date ( "Y", mktime( 0, 0, 0, $month, 1, $year ) );
	
	//determine the previous month
	$prev_month = date ( "n", mktime ( 0, 0, 0, $current_month - 1) );
	$prev_year = ( $prev_month != 12 ? $current_year : $current_year - 1);

	// determine the next month
	$next_month = date ( "n", mktime ( 0, 0, 0, $current_month + 1) );
	$next_year = ( $next_month != 1 ? $current_year : $current_year + 1);
	
	// determine what day the 1st falls on, how many days in the month, the number of
	// days in the previous month, and what day the last day of the month falls on.
	$first_day = date ( "w", mktime ( 0, 0, 0, $current_month, 1, $current_year ) );
	$number_days = date ( "t", mktime ( 0, 0, 0, $current_month, 1, $current_year ) );
	$prev_number_days = date ( "t", mktime ( 0, 0, 0, $prev_month, 1, $current_year ) );
	$last_day = date ( "w", mktime ( 0,0,0, $current_month, $number_days, $current_year ) );
?>


<!DOCTYPE html>
<html>
<head>
	<title>Calendar App 0.2.1</title>
	<link rel="stylesheet" type="text/css" href="style.css" />
	<meta name="author" content="Evan Grill" />
	<meta name="description" content="Basic calendar application" />
	<meta name="version" content="0.2.1" />
</head>
<body>
	<div id="monthHeader">
		<span class="button">
<?php
				// output a link to the previous month
				echo "\t\t\t<a href=\"?month=";
				echo $prev_month;
				echo "&year=";
				echo $prev_year;
				echo "\" class=\"navigationLink\">&lt;</a>\n";
?>
		</span>
		<span class="monthYear">
<?php
				// output the month and year to be displayed
				echo "\t\t\t";
				echo $current_month_long;
				echo " ";
				echo $current_year;
				echo "\n";
?>
		</span>
		<span class="button">
<?php
				// output a link to the next month
				echo "\t\t\t<a href=\"?month=";
				echo $next_month;
				echo "&year=";
				echo $next_year;
				echo "\" class=\"navigationLink\">&gt;</a>\n";
?>
		</span>
	<div id="calendarBox">
		<div id="headerRow">
			<span class="dayHeader">Sunday</span>
			<span class="dayHeader">Monday</span>
			<span class="dayHeader">Tuesday</span>
			<span class="dayHeader">Wednesday</span>
			<span class="dayHeader">Thursday</span>
			<span class="dayHeader">Friday</span>
			<span class="dayHeader">Saturday</span>
		</div>
		<div class="calendarRow">
<?php
				// loop until you get to the first day and output a day from the
				// previous month each iteration
				for ( $i = 0; $i < $first_day; $i++ )
				{
					echo "\t\t\t<span class=\"calendarDayPrevNext\">";
					echo $prev_number_days - $first_day + $i + 1;
					echo "</span>\n";
				}
				// loop the number of days of the month and output a day each iteration
				for ( $i = 0; $i < $number_days; $i++ )
				{
					if ( ($i + $first_day) % 7 == 0  && $i != $first_day )
					{
						echo "\t\t</div>\n";
						echo "\t\t<div class=\"calendarRow\">\n";
					}
					echo "\t\t\t<span class=\"calendarDay\">";
					echo $i + 1;
					echo "</span>\n";
				}
				// loop the number of spaces remaining on the last line of the
				// calendar and ouptut a day from the next month each iteration
				for ( $i = 0 ; $i < 6 - $last_day; $i++ )
				{
					echo "\t\t\t<span class=\"calendarDayPrevNext\">";
					echo $i + 1;
					echo "</span>\n";
				} 
?>
		</div>
	</div>
	<a href="./ChangeLog.txt" class="changesLink">View Changes</a>
</body>
</html>