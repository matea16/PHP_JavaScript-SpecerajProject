<?php

// Popunjavamo tablice u bazi "probnim" podacima.
require_once __DIR__ . '/db.class.php';

seed_table_users();
seed_table_products();
seed_table_trgovine();
seed_table_recenzije();

exit( 0 );

// ------------------------------------------
function seed_table_users()
{
	$db = DB::getConnection();

	// Ubaci neke korisnike unutra
	try
	{
		$st = $db->prepare( 'INSERT INTO projekt_users(username, password_hash, email, registration_sequence, has_registered) VALUES (:username, :password, \'a@b.com\', \'abc\', \'1\')' );

		$st->execute( array( 'username' => 'mirko', 'password' => password_hash( 'mirkovasifra', PASSWORD_DEFAULT ) ) );
		$st->execute( array( 'username' => 'slavko', 'password' => password_hash( 'slavkovasifra', PASSWORD_DEFAULT ) ) );
		$st->execute( array( 'username' => 'ana', 'password' => password_hash( 'aninasifra', PASSWORD_DEFAULT ) ) );
		$st->execute( array( 'username' => 'maja', 'password' => password_hash( 'majinasifra', PASSWORD_DEFAULT ) ) );
		$st->execute( array( 'username' => 'pero', 'password' => password_hash( 'perinasifra', PASSWORD_DEFAULT ) ) );
	}
	catch( PDOException $e ) { exit( "PDO error [insert projekt_users]: " . $e->getMessage() ); }

	echo "Ubacio u tablicu projekt_users.<br />";
}


// ------------------------------------------
function seed_table_products()
{
	$db = DB::getConnection();

	// Ubaci neke proizvode unutra (ovo nije bas pametno ovako raditi, preko hardcodiranih id-eva usera)
	try
	{
		$st = $db->prepare( 'INSERT INTO projekt_products(id_trgovina, name, akcija, price) VALUES (:id_trgovina, :name, :akcija, :price)' );

		$st->execute( array( 'id_trgovina' => 1, 'name' => 'Kruh sa sjemenkama', 'akcija' => NULL, 'price' => 8.99 ) );
		$st->execute( array( 'id_trgovina' => 1, 'name' => 'Bijeli kruh', 'akcija' => 20, 'price' => 5.99) ); 
		$st->execute( array( 'id_trgovina' => 1, 'name' => 'Ananas', 'akcija' => NULL, 'price' => 12.99 ) ); 
		$st->execute( array( 'id_trgovina' => 1, 'name' => 'Mlijeko', 'akcija' => NULL, 'price' => 6.99) ); 

		$st->execute( array( 'id_trgovina' => 2, 'name' => 'Kruh sa sjemenkama', 'akcija' => NULL, 'price' => 7.99 ) );
		$st->execute( array( 'id_trgovina' => 2, 'name' => 'Bijeli kruh', 'akcija' => NULL, 'price' => 6.99) ); 
		$st->execute( array( 'id_trgovina' => 2, 'name' => 'Ananas', 'akcija' => 30, 'price' => 12.99 ) ); 
		$st->execute( array( 'id_trgovina' => 2, 'name' => 'Mlijeko', 'akcija' => 15, 'price' => 6.99) ); 

		$st->execute( array( 'id_trgovina' => 3, 'name' => 'Kruh sa sjemenkama', 'akcija' => NULL, 'price' => 5.99 ) );
		$st->execute( array( 'id_trgovina' => 3, 'name' => 'Bijeli kruh', 'akcija' => NULL, 'price' => 5.99) ); 
		$st->execute( array( 'id_trgovina' => 3, 'name' => 'Ananas', 'akcija' => NULL, 'price' => 12.99 ) ); 
		$st->execute( array( 'id_trgovina' => 3, 'name' => 'Mlijeko', 'akcija' => NULL, 'price' => 4.99) ); 

		$st->execute( array( 'id_trgovina' => 4, 'name' => 'Kruh sa sjemenkama', 'akcija' => 10, 'price' => 7.99 ) );
		$st->execute( array( 'id_trgovina' => 4, 'name' => 'Bijeli kruh', 'akcija' => 25, 'price' => 5.99) ); 
		$st->execute( array( 'id_trgovina' => 4, 'name' => 'Ananas', 'akcija' => NULL, 'price' => 10.99 ) ); 
		$st->execute( array( 'id_trgovina' => 4, 'name' => 'Mlijeko', 'akcija' => NULL, 'price' => 7.99) ); 

		$st->execute( array( 'id_trgovina' => 5, 'name' => 'Kruh sa sjemenkama', 'akcija' => 10, 'price' => 8.99 ) );
		$st->execute( array( 'id_trgovina' => 5, 'name' => 'Bijeli kruh', 'akcija' => 20, 'price' => 5.99) ); 
		$st->execute( array( 'id_trgovina' => 5, 'name' => 'Ananas', 'akcija' => NULL, 'price' => 14.99 ) ); 
		$st->execute( array( 'id_trgovina' => 5, 'name' => 'Mlijeko', 'akcija' => 10, 'price' => 7.99) ); 
	}
	catch( PDOException $e ) { exit( "PDO error [projekt_products]: " . $e->getMessage() ); }

	echo "Ubacio u tablicu projekt_products.<br />";
}


// ------------------------------------------
function seed_table_trgovine()
{
	$db = DB::getConnection();

	// Ubaci neke prodaje unutra (ovo nije bas pametno ovako raditi, preko hardcodiranih id-eva usera i proizvoda)
	try
	{
		$st = $db->prepare( 'INSERT INTO projekt_trgovine(name) VALUES (:name)' );

		$st->execute( array( 'name' => 'Konzum') );
		$st->execute( array( 'name' => 'Interspar') );
		$st->execute( array( 'name' => 'Plodine') );
		$st->execute( array( 'name' => 'Tommy') );
		$st->execute( array( 'name' => 'Lonia') );
		
	}
	catch( PDOException $e ) { exit( "PDO error [projekt_trgovine]: " . $e->getMessage() ); }

	echo "Ubacio u tablicu projekt_trgovine.<br />";
}

function seed_table_recenzije()
{
	$db = DB::getConnection();

	// Ubaci neke prodaje unutra (ovo nije bas pametno ovako raditi, preko hardcodiranih id-eva usera i proizvoda)
	try
	{
		$st = $db->prepare( 'INSERT INTO projekt_recenzije(id_trgovina, id_user, ocjena, komentar) VALUES (:id_trgovina, :id_user, :ocjena, :komentar)' );

		$st->execute( array( 'id_trgovina' => 1, 'id_user' => 4, 'ocjena' => 5, 'komentar' => 'Odlicna usluga.' ) );
		$st->execute( array( 'id_trgovina' => 1, 'id_user' => 5, 'ocjena' => 3, 'komentar' => 'Kvaliteta moze biti i bolja' ) );

		$st->execute( array( 'id_trgovina' => 2, 'id_user' => 4, 'ocjena' => 1, 'komentar' => 'Uzas. Nikad vise ne narucuje odavdje' ) );

		$st->execute( array( 'id_trgovina' => 3, 'id_user' => 5, 'ocjena' => 5, 'komentar' => 'Jako dobre cijene.' ) );
		$st->execute( array( 'id_trgovina' => 3, 'id_user' => 3, 'ocjena' => 4, 'komentar' => 'Odlicna dostava!' ) );

		$st->execute( array( 'id_trgovina' => 4, 'id_user' => 1, 'ocjena' => 5, 'komentar' => 'Brza dostava, dobre cijene, pristupacni zaposlenici' ) );
	}
	catch( PDOException $e ) { exit( "PDO error [projekt_recenzije]: " . $e->getMessage() ); }

	echo "Ubacio u tablicu projekt_recenzije.<br />";
}

?> 
 
 