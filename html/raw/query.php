SELECT `fullName`,`jerseyNumber`,SUM(`goals`) FROM `scores` WHERE `nationality`="RUS" GROUP BY `fullName`,`jerseyNumber` ORDER BY SUM(`goals`) DESC LIMIT 10;
