<?php
	if ( isset( $_GET['month'] ) ) {
		$month = $_GET['month'];
	} else {
		$month = date ( "n" );
	}

	if ( isset ( $_GET['year'] ) ) {
		$year = $_GET['year'];
	} else {
		$year = date ( "Y" );
	}

	$current_month = date ( "n", mktime( 0, 0, 0, $month ) );
	$current_month_long = date ( "F", mktime( 0, 0, 0, $month ) );
	$current_year = date ( "Y", mktime( 0, 0, 0, $month, 1, $year ) );
	
	$prev_month = date ( "n", mktime ( 0, 0, 0, $current_month - 1) );
	$prev_year = ( $prev_month != 12 ? $current_year : $current_year - 1);

	$next_month = date ( "n", mktime ( 0, 0, 0, $current_month + 1) );
	$next_year = ( $next_month != 1 ? $current_year : $current_year + 1);

	$first_day = date ( "w", mktime ( 0, 0, 0, $current_month, 1, $current_year ) );
	$number_days = date ( "t", mktime ( 0, 0, 0, $current_month, 1, $current_year ) );
	$prev_number_days = date ( "t", mktime ( 0, 0, 0, $prev_month, 1, $current_year ) );
	$last_day = date ( "w", mktime ( 0,0,0, $current_month, $number_days, $current_year ) );
?>


<!DOCTYPE html>
<html>
<head>
	<title>Calendar App 0.2</title>
	<link rel="stylesheet" type="text/css" href="style.css" />
	<meta name="author" content="Evan Grill" />
	<meta name="description" content="Basic calendar application" />
	<meta name="version" content="0.2" />
</head>
<body>
	<div id="monthHeader">
		<span class="button">
			<a href=
			<?php
				echo "\"?month=";
				echo $prev_month;
				echo "&year=";
				echo $prev_year;
				echo "\""
			?>
			class="navigationLink">&lt;</a>
		</span>
		<span class="monthYear">
			<?php
				echo $current_month_long;
				echo " ";
				echo $current_year;
			?>
		</span>
		<span class="button">
			<a href=
			<?php
				echo "\"?month=";
				echo $next_month;
				echo "&year=";
				echo $next_year;
				echo "\""
			?>
			class="navigationLink">&gt;</a>
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
				for ( $i = 0; $i < $first_day; $i++ )
				{
					echo "<span class=\"calendarDayPrevNext\">";
					echo $prev_number_days - $first_day + $i + 1;
					echo "</span>\n";
				}
				for ( $i = 0; $i < $number_days; $i++ )
				{
					if ( ($i + $first_day) % 7 == 0  && $i != $first_day )
					{
						echo "</div>";
						echo "<div class=\"calendarRow\">";
					}
					echo "<span class=\"calendarDay\">";
					echo $i + 1;
					echo "</span>\n";
				}
				for ( $i = 0 ; $i < 6 - $last_day; $i++ )
				{
					echo "<span class=\"calendarDayPrevNext\">";
					echo $i + 1;
					echo "</span>\n";
				} 
			?>
		</div>
	</div>
</body>
</html>