<?php
include_once 'includes/init.php';

$id = mysql_safe( getPostValue( 'id' ), false );


/// block for each checked signee

$signees = get_signees( $login, true );

for ( $i=0; $i<count( $signees ); $i++ ) {

  $user = $signees[$i]['cal_login'];
  $user_status = getPostValue( $user );

  if ( $user_status == true ) {
    $sql = "INSERT INTO webcal_meal_participant " .
      "( cal_id, cal_login, cal_type, cal_walkin ) " . 
      "VALUES ( $id, '$user', 'B', 0 )";
    dbi_query( $sql );
  }
}



$nexturl = "view_entry.php?id=$id";
do_redirect( $nexturl );

?>
