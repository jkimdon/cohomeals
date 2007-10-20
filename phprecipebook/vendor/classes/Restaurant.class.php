<?php
require_once("classes/DBUtils.class.php");
/**
	This class is used to represent a restaurant.  Functionality to add, update, and delete restaurants
	is provided through this class.
*/
class Restaurant {
	// Define the data this object will hold
	var $id = 0;
	var $name = NULL;
	var $website = NULL;
	var $address = NULL;
	var $city = NULL;
	var $state = NULL;
	var $country = NULL;
	var $zip = NULL;
	var $phone = NULL;
	var $hours = NULL;
	var $menu_text = NULL;
	var $picture = NULL;
	var $picture_type = NULL;
	var $picture_oid = NULL;
	var $comments = NULL;
	var $price = 0;
	var $delivery = NULL;
	var $carry_out = NULL;
	var $dine_in = NULL;
	var $credit = NULL;
	/*
		The constructor for a new restaurant, or loading an existing restaurant
	*/
	function Restaurant($id=0, $name='', $website='', $address='', $city='', $state='', $zip='', $country='',
		$phone='', $hours='', $menu_text='', $picture='', $picture_type='',
		$picture_oid=NULL, $comments='', $price='', $delivery='', $carry_out='', $dine_in='',
		$credit='', $owner='') {
			$this->id = $id;
			$this->name = $name;
			$this->website = $website;
			$this->address = $address;
			$this->city = $city;
			$this->state = $state;
			$this->zip = $zip;
			$this->country = $country;
			$this->phone = $phone;
			$this->hours = $hours;
			$this->menu_text = $menu_text;
			$this->picture = $picture;
			$this->picture_type = $picture_type;
			$this->picture_oid = $picture_oid;
			$this->comments = $comments;
			$this->price = $price;
			$this->delivery = $delivery;
			$this->carry_out = $carry_out;
			$this->dine_in = $dine_in;
			$this->credit = $credit;
	}
	
	/**
		Returns the ID for this restaurant
	*/
	function getID() {
		return $this->id;
	}
	
	/**
		Add or update the currently loaded restaurant
	*/
	function addUpdate() {
		if ($this->id) $this->update();
		else $this->insert();
	}
	
	/*
		Inserts a restaurant into the database
	*/
	function insert() {
		global $DB_LINK, $LangUI, $db_table_restaurants, $g_rb_restaurant_id_seq;
		$sql = "INSERT INTO $db_table_restaurants (
				restaurant_name,
				restaurant_website,
				restaurant_address,
				restaurant_city,
				restaurant_state,
				restaurant_zip,
				restaurant_country,
				restaurant_phone,
				restaurant_hours,
				restaurant_menu_text,
				restaurant_comments,
				restaurant_price,
				restaurant_delivery,
				restaurant_carry_out,
				restaurant_dine_in,
				restaurant_credit) VALUES (
				'$this->name',
				'$this->website',
				'$this->address',
				'$this->city',
				'$this->state',
				'$this->zip',
				'$this->country',
				'$this->phone',
				'$this->hours',
				'$this->menu_text',
				'$this->comments',
				$this->price,
				'$this->delivery',
				'$this->carry_out',
				'$this->dine_in',
				'$this->credit')";
		$rc = $DB_LINK->Execute($sql);
		DBUtils::checkResult($rc,NULL,$LangUI->_('There was an error inserting the restaurant'),$sql);
		$this->id = DBUtils::getSequenceValue($g_rb_restaurant_id_seq);
		return $this->id;
	}
	
	/*
		Updates a restaurant
	*/
	function update() {
		global $DB_LINK, $LangUI, $db_table_restaurants;
		$sql = "UPDATE $db_table_restaurants SET 
				restaurant_name='$this->name',
				restaurant_website='$this->website',
				restaurant_address='$this->address',
				restaurant_city='$this->city',
				restaurant_state='$this->state',
				restaurant_zip='$this->zip',
				restaurant_country='$this->country',
				restaurant_phone='$this->phone',
				restaurant_hours='$this->hours',
				restaurant_menu_text='$this->menu_text',
				restaurant_comments='$this->comments',
				restaurant_price=$this->price,
				restaurant_delivery='$this->delivery',
				restaurant_carry_out='$this->carry_out',
				restaurant_dine_in='$this->dine_in',
				restaurant_credit='$this->credit' 
				WHERE restaurant_id=$this->id";
		$rc = $DB_LINK->Execute($sql);
		DBUtils::checkResult($rc,NULL,$LangUI->_('There was an error inserting the restaurant'),$sql);
	}	
	
	/**
		Deletes this restaurant from the database
	*/
	function delete() {
		global $DB_LINK, $db_table_restaurants;
		$sql = "DELETE from $db_table_restaurants WHERE restaurant_id=" . $_GET['restaurant_id'];
		$rc = $DB_LINK->Execute($sql);
		DBUtils::checkResult($rc, NULL, NULL, $sql);
	}
	
	/**
		Updates/Adds a picture to the recipe, the 'id' must be set for this to work
	*/
	function updatePicture() {
		global $DB_LINK, $db_table_restaurants, $LangUI;
		if (is_uploaded_file($this->picture['tmp_name'])) {
			// delete the old blob, otherwise we waste space (only needed for postgres)
			if (!$this->deletePicture()) return FALSE;
			
			$rc = $DB_LINK->UpdateBlobFile($db_table_restaurants,'restaurant_picture',$this->picture['tmp_name'],'restaurant_id='.$this->id);
			DBUtils::checkResult($rc, NULL, $LangUI->_('There was an error adding the restaurant'), $sql);
			
			// Update the picture type
			$sql = "UPDATE $db_table_restaurants SET restaurant_picture_type='$this->picture_type' WHERE restaurant_id=".$this->id;
			$rc = $DB_LINK->Execute($sql);
			DBUtils::checkResult($rc, NULL, $LangUI->_('There was an error adding the picture'), $sql);
		}
		return TRUE;
	}
	
	/**
		Removes the currently set picture from the restaurant
	*/
	function deletePicture() {
		global $DB_LINK, $db_table_restaurants, $g_rb_database_type, $LangUI;
		$sql = "UPDATE $db_table_restaurants SET restaurant_picture='', restaurant_picture_type='' WHERE restaurant_id=$this->id";
		$rc = $DB_LINK->Execute($sql);
		DBUtils::checkResult($rc, NULL, $LangUI->_('There was an error removing the picture'), $sql);
		
		// Do the postgres cleanup
		if ($this->picture_oid && $g_rb_database_type=="postgres") {
			$rc = $DB_LINK->BlobDelete($this->picture_oid);
			$this->picture_oid=NULL;
			DBUtils::checkResult($rc, NULL, $LangUI->_('There was an error removing the picture'), $sql);
		}
		return TRUE;
	}
}
