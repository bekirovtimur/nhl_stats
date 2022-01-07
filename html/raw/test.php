<?php
$data = json_decode( file_get_contents('http://ws.meteocontrol.de/api/sites/P9JWT/data/energygeneration?apiKey=xVQfZ7HaA9'), true, 5, JSON_BIGINT_AS_STRING ) ;
if ( !$data ) {
    die('something went wrong with the JSON data');
}
else if ( !isset($data['chartData']) || !isset($data['chartData']['date'], $data['chartData']['data']) || !is_array($data['chartData']['data']) ) {
    die('unexpected JSON format');
}
else {
    // connect to the database
    // see http://docs.php.net/pdo.construct
    // and http://docs.php.net/ref.pdo-mysql.connection
    $pdo = new PDO('mysql:host=mysql;dbname=test;charset=utf8', 'root', 'root', array(
        PDO::ATTR_EMULATE_PREPARES=>false,
        //PDO::MYSQL_ATTR_DIRECT_QUERY=>false,
        PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION
    ));
    // this will create a (temporary) table, that fits the INSERT statement for this example
    setup($pdo);

    // prepare a statement with two parameters
    // see http://docs.php.net/pdo.prepared-statements
    $stmt = $pdo->prepare('INSERT INTO so_tbl_power (`gmtdate`, `data`) VALUES ( :pit, :measurement )');
    $stmt->bindParam(':pit', $pit);
    $stmt->bindParam(':measurement', $measurement);
    // when the statement is executed the values that are "in" $pit and $measurement at that moment will be used where the placeholders :pit and :measurement were placed in the statement. 

    $date = $data['chartData']['date']; // won't be using this ....
    foreach( $data['chartData']['data'] as $mp ) {
        // ? mp[1] <-> measurement reading failed?
        // skip those entries that do not have a value in $mp[1]
        // you might want to insert those anyway ....but I don't ;-)
        if ( !is_null($mp[1]) ) { 
            $mp[0] = gmdate('Y-m-d H:i:s', substr($mp[0], 0, -3));
            // assign the values to the parameters bound to the statement
            list($pit, $measurement) = $mp;
            // execute the statement (with those parameters)
            $stmt->execute();
        }
    }


    // now let's see what is in the table
    foreach( $pdo->query('SELECT id,`gmtdate`, `data` FROM so_tbl_power ORDER BY id', PDO::FETCH_ASSOC) as $row ) {
        echo join(', ', $row), "\r\n";
    }
}


function setup($pdo) {
    $pdo->exec('
        CREATE TEMPORARY TABLE so_tbl_power (
            id int auto_increment,
            `gmtdate` DateTime NOT NULL, 
            `data` Decimal(8,4),
            primary key(id),
            unique key(`gmtdate`)
        )
    ');
}