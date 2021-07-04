<?php


require_once __DIR__ . '/db.class.php';

create_table_users();
create_table_products();
create_table_trgovine();
create_table_recenzije();

exit( 0 );

// --------------------------
function has_table( $tblname )
{
	$db = DB::getConnection();
	
	try
	{
		$st = $db->query( 'SELECT DATABASE()' );
		$dbname = $st->fetch()[0];

		$st = $db->prepare( 
			'SELECT * FROM information_schema.tables WHERE table_schema = :dbname AND table_name = :tblname LIMIT 1' );
		$st->execute( ['dbname' => $dbname, 'tblname' => $tblname] );
		if( $st->rowCount() > 0 )
			return true;
	}
	catch( PDOException $e ) { exit( "PDO error [show tables]: " . $e->getMessage() ); }

	return false;
}


function create_table_users()
{
	$db = DB::getConnection();

	if( has_table( 'projekt_users' ) )
		exit( 'Tablica projekt_users vec postoji. Obrisite ju pa probajte ponovno.' );

	try
	{
		$st = $db->prepare( 
			'CREATE TABLE IF NOT EXISTS projekt_users (' .
			'id int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
			'username varchar(50) NOT NULL,' .
			'password_hash varchar(255) NOT NULL,'.
			'email varchar(50) NOT NULL,' .
			'registration_sequence varchar(20) NOT NULL,' .
			'has_registered int)'
		);

		$st->execute();
	}
	catch( PDOException $e ) { exit( "PDO error [create projekt_users]: " . $e->getMessage() ); }

	echo "Napravio tablicu projekt_users.<br />";
}


function create_table_products()
{
	$db = DB::getConnection();

	if( has_table( 'projekt_products' ) )
		exit( 'Tablica projekt_products vec postoji. Obrisite ju pa probajte ponovno.' );

	try
	{
		$st = $db->prepare( 
			'CREATE TABLE IF NOT EXISTS projekt_products (' .
			'id int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
			'id_trgovina int NOT NULL,' .
            'name varchar(100) NOT NULL,' .
			'akcija INT,' .
            'price decimal(15,2) NOT NULL)'
		);

		$st->execute();
	}
	catch( PDOException $e ) { exit( "PDO error [create projekt_products]: " . $e->getMessage() ); }

	echo "Napravio tablicu projekt_products.<br />";
}


function create_table_trgovine()
{
	$db = DB::getConnection();

	if( has_table( 'projekt_trgovine' ) )
		exit( 'Tablica projekt_trgovine vec postoji. Obrisite ju pa probajte ponovno.' );

	try
	{
		$st = $db->prepare( 
			'CREATE TABLE IF NOT EXISTS projekt_trgovine (' .
			'id int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
			'name varchar(100) NOT NULL)' 
		);

		$st->execute();
	}
	catch( PDOException $e ) { exit( "PDO error [create projekt_trgovine]: " . $e->getMessage() ); }

	echo "Napravio tablicu projekt_trgovine.<br />";
}

function create_table_recenzije()
{
	$db = DB::getConnection();

	if( has_table( 'projekt_recenzije' ) )
		exit( 'Tablica projekt_recenzije vec postoji. Obrisite ju pa probajte ponovno.' );

	try
	{
		$st = $db->prepare( 
			'CREATE TABLE IF NOT EXISTS projekt_recenzije (' .
			'id int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
			'id_trgovina int NOT NULL,' .
			'id_user int NOT NULL,' .
			'ocjena INT,' .
			'komentar varchar(1000))' 
		);

		$st->execute();
	}
	catch( PDOException $e ) { exit( "PDO error [create projekt_recenzije]: " . $e->getMessage() ); }

	echo "Napravio tablicu projekt_recenzije.<br />";
}
?> 