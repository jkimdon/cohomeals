<?php
require_once("classes/Units.class.php");
require_once("classes/DBUtils.class.php");
require_once("classes/ShoppingList.class.php");
/**
	This class is used to represent a Recipe.  It provides functions to manipulate and display a given Recipe.
*/
class Recipe {
	var $id = 0;
	var $name = NULL;
	var $ethnic = NULL;
	var $base = NULL;
	var $course = NULL;
	var $prep_time = NULL;
	var $difficulty = NULL;
	var $directions = NULL;
	var $comments = NULL;
	var $serving_size = NULL;
	var $source = NULL;
	var $source_desc = NULL;
	var $cost = 0;
	var $private = 'FALSE';
	var $picture = NULL;
	var $picture_type = NULL;
	var $picture_oid = NULL;
	var $modified = NULL;
	var $owner = NULL;
	var $unitSystem = NULL;
	
	/**
		Constructor to create/load a Recipe
	*/
	function Recipe($id=0, $name='', $ethnic='NULL', $base='NULL', $course='NULL', $time='NULL', $difficulty='NULL', $directions='', $comments='', 
		$serving=0, $source=0, $source_desc='', $cost=0, $owner=NULL, $private='FALSE', $picture='', $picture_type='', $picture_oid=NULL) {
		global $DB_LINK, $SMObj;
		// Initial a new Recipe Object
		$this->id = $id;
		$this->name = $name;
		$this->ethnic = $ethnic;
		$this->base = $base;
		$this->course = $course;
		$this->prep_time = $time;
		$this->difficulty = $difficulty;
		$this->directions = $directions;
		$this->comments = $comments;
		$this->serving_size = $serving;
		$this->source = $source;
		$this->source_desc = $source_desc;
		$this->cost = $cost;
		$this->picture = $picture;
		$this->picture_type = $picture_type;
		$this->picture_oid = $picture_oid;
		if ($owner == "" || $owner == NULL) {
			$this->owner = $SMObj->getUserLoginID();
		} else {
			$this->owner = $owner;
		}
		
		if ($this->source=='')
			$this->source = 'NULL';

		$this->modified = $DB_LINK->DBDate(time()); // set the current date
		$this->unitSystem = Units::getLocalSystem();
		
		if ($private == "TRUE") $this->private = $DB_LINK->true;
		else $this->private = $DB_LINK->false;
	}
	
	/**
		Returns the ID for this recipe, this is set when it is inserted into the DB
	*/
	function getID() {
		return $this->id;
	}
	
	/**
		Add or update the currently loaded recipe
	*/
	function addUpdate() {
		if ($this->id) $this->update();
		else $this->insert();
	}
	
	/**
		Insert a new Recipe into the database
	*/
	function insert() {
		global $db_table_recipes, $DB_LINK, $g_rb_recipe_id_seq, $LangUI;
		// do the Insert
		$sql = "INSERT INTO $db_table_recipes 
						(recipe_name,
						 recipe_ethnic,
						 recipe_base,
						 recipe_course,
						 recipe_prep_time,
						 recipe_difficulty,
						 recipe_directions,
						 recipe_comments,
						 recipe_serving_size,
						 recipe_source,
						 recipe_source_desc,
						 recipe_cost,
						 recipe_modified,
						 recipe_system,
						 recipe_private,
						 recipe_owner) 
					VALUES 
						('$this->name',
						 $this->ethnic,
						 $this->base,
						 $this->course,
						 $this->prep_time,
						 $this->difficulty,
						 '$this->directions',
						 '$this->comments',
						 $this->serving_size,
						 $this->source,
						 '$this->source_desc',
						 $this->cost,
						 $this->modified,
						 '$this->unitSystem',
						 '$this->private',
						 '$this->owner')";
		$rc = $DB_LINK->Execute($sql);
		DBUtils::checkResult($rc, $LangUI->_('Recipe Successfully created') . ": ".  $this->name, 
			$LangUI->_('There was an error inserting the recipe'), $sql);
		// retrieve incremented sequence value
		$this->id = DBUtils::getSequenceValue($g_rb_recipe_id_seq);
		return $this->id;
	}
	
	/**
		Updates the currently existing recipe
	*/
	function update() {
		global $DB_LINK, $db_table_recipes, $LangUI;
		$sql = "
			UPDATE $db_table_recipes 
			SET recipe_name='$this->name',
				recipe_ethnic='$this->ethnic',
				recipe_base=$this->base,
				recipe_course=$this->course,
				recipe_prep_time=$this->prep_time,
				recipe_difficulty=$this->difficulty,
				recipe_directions='$this->directions',
				recipe_comments='$this->comments',
				recipe_serving_size=$this->serving_size,
				recipe_source_desc='$this->source_desc',
				recipe_source=$this->source,
				recipe_cost=$this->cost,
				recipe_private='$this->private',
				recipe_modified=$this->modified,
				recipe_owner='$this->owner'
				WHERE recipe_id=$this->id";
		$rc = $DB_LINK->Execute($sql);
		DBUtils::checkResult($rc, $LangUI->_('Recipe Successfully updated') . ": ".  $this->name, 
			$LangUI->_('There was an error updating the recipe'), $sql);
	}
	
	/**
		Updates/Adds a picture to the recipe, the 'id' must be set for this to work
	*/
	function updatePicture() {
		global $DB_LINK, $db_table_recipes, $g_rb_database_type, $LangUI;
		if (is_uploaded_file($this->picture['tmp_name'])) {
			// delete the old blob, otherwise we waste space (only needed for postgres)
			if (!$this->deletePicture()) return FALSE;
			
			$rc = $DB_LINK->UpdateBlobFile($db_table_recipes,'recipe_picture',$this->picture['tmp_name'],'recipe_id='.$this->id);
			DBUtils::checkResult($rc, NULL, $LangUI->_('There was an error adding the picture'), "");
			
			// Update the picture type
			$sql = "UPDATE $db_table_recipes SET recipe_picture_type='$this->picture_type' WHERE recipe_id=" . $this->id;
			$rc = $DB_LINK->Execute($sql);
			DBUtils::checkResult($rc, NULL, $LangUI->_('There was an error adding the picture'), $sql);
		}
		return TRUE;
	}
	
	/**
		Deletes this recipe from the database
	*/
	function delete() {
		global $DB_LINK, $db_table_recipes, $db_table_list_recipes, $db_table_related_recipes, $db_table_ingredientmaps, $db_table_reviews,
			$db_table_ratings, $db_table_mealplans, $db_table_favorites;
			
		$sql = "DELETE from $db_table_recipes WHERE recipe_id=" . $this->id;
		$rc = $DB_LINK->Execute($sql);
		DBUtils::checkResult($rc, NULL, NULL, $sql);
		
		$sql = "DELETE from $db_table_list_recipes WHERE list_rp_recipe=" . $this->id;
		$result = $DB_LINK->Execute($sql);
		DBUtils::checkResult($rc, NULL, NULL, $sql);
	
		$sql = "DELETE from $db_table_related_recipes WHERE related_parent=" . $this->id;
		$result = $DB_LINK->Execute($sql);
		DBUtils::checkResult($rc, NULL, NULL, $sql);
	
		$sql = "DELETE from $db_table_ingredientmaps WHERE map_recipe=" . $this->id;
		$result = $DB_LINK->Execute($sql);
		DBUtils::checkResult($rc, NULL, NULL, $sql);
	
		$sql = "DELETE from $db_table_reviews WHERE review_recipe=" . $this->id;
		$result = $DB_LINK->Execute($sql);
		DBUtils::checkResult($rc, NULL, NULL, $sql);
		
		$sql = "DELETE from $db_table_ratings WHERE rating_recipe=" . $this->id;
		$result = $DB_LINK->Execute($sql);
		DBUtils::checkResult($rc, NULL, NULL, $sql);
			
		$sql = "DELETE from $db_table_mealplans WHERE mplan_recipe=" . $this->id;
		$result = $DB_LINK->Execute($sql);
		DBUtils::checkResult($rc, NULL, NULL, $sql);
			
		$sql = "DELETE from $db_table_favorites WHERE favorite_recipe=" . $this->id;
		$result = $DB_LINK->Execute($sql);
		DBUtils::checkResult($rc, NULL, NULL, $sql);
	}
	
	/**
		Removes the currently set picture from the recipe
	*/
	function deletePicture() {
		global $DB_LINK, $db_table_recipes, $g_rb_database_type, $LangUI;
		$sql = "UPDATE $db_table_recipes SET recipe_picture='', recipe_picture_type='' WHERE recipe_id=$this->id";
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
	
	/**
		Loads the values of a recipe if just the ID is set
	*/
	function loadRecipe() {
		global $DB_LINK, $db_table_recipes, $LangUI;
		$sql = "SELECT * FROM $db_table_recipes WHERE recipe_id=$this->id";
		$rc = $DB_LINK->Execute($sql);
		DBUtils::checkResult($rc, NULL, $LangUI->_('There was an error loading the ingredient'), $sql);
		$this->name = $rc->fields['recipe_name'];
		$this->ethnic = $rc->fields['recipe_ethnic'];
		$this->base = $rc->fields['recipe_base'];
		$this->course = $rc->fields['recipe_course'];
		$this->prep_time = $rc->fields['recipe_prep_time'];
		$this->difficulty = $rc->fields['recipe_difficulty'];
		$this->serving_size = $rc->fields['recipe_serving_size'];
		$this->directions = $rc->fields['recipe_directions'];
		$this->comments = $rc->fields['recipe_comments'];
		$this->source = $rc->fields['recipe_source'];
		$this->cost = $rc->fields['recipe_cost'];
		$this->modified = $rc->fields['recipe_modified'];
		$this->private = $rc->fields['recipe_private'];
		$this->unitSystem = $rc->fields['recipe_system'];
		$this->owner = $rc->fields['recipe_owner'];
	}
	
	/**
		Gets the child/related recipes for this recipe
		@param $req set to true then only the required recipes are returned, false all are returned
		@return array of recipe objects
	*/
	function getRelated($req) {
		global $DB_LINK, $db_table_related_recipes;
		$children = array();
		$sql = "SELECT related_child,related_required FROM $db_table_related_recipes WHERE related_parent=".$this->id;
		$rc = $DB_LINK->Execute($sql);
		DBUtils::checkResult($rc, NULL, NULL, $sql);
		while (!$rc->EOF) {
			if ($req) {
				// get all the required recipes
				if ($rc->fields['related_required'] == $DB_LINK->true) {
					$tmpObj = new Recipe($rc->fields['related_child']);
					$tmpObj->loadRecipe();
					$children[] = $tmpObj;
				}
			} else {
				// get all the children
				$tmpObj = new Recipe($rc->fields['related_child']);
				$tmpObj->loadRecipe();
				$children[] = $tmpObj;
			}
			$rc->MoveNext();
		}
		return $children;
	}
	
	/**
		Returns an array with all the current ingredients in it for this recipe
		@param $servings the number of servings to scale the ingredients to
		@param $optional if true then the optional ingredients are returned as well
	*/
	function getIngredients($servings=NULL,$optional=FALSE) {
		global $DB_LINK, $db_table_ingredientmaps;
		$ingredients = array();
		
		// compute the scaling
		if ($this->serving_size != 0 && $this->serving_size != "") 
		{
			$scaling = $servings / $this->serving_size;
		}
		
		if ($scaling == NULL || $servings == 0) 
		{
			$scaling=1;
		}
		$sql = "SELECT * FROM $db_table_ingredientmaps WHERE map_recipe=" . $this->id;
		$rc = $DB_LINK->Execute($sql);
		DBUtils::checkResult($rc, NULL, NULL, $sql);
		while (!$rc->EOF) {
			// Only add the ingredient if we are suppose to
			if (($optional && $rc->fields['map_optional']==$DB_LINK->true) || 
					$rc->fields['map_optional']!=$DB_LINK->true) 
			{
				$ingObj = new Ingredient();
				$ingObj->setIngredientMap($rc->fields['map_ingredient'], 
									$rc->fields['map_recipe'],
									$rc->fields['map_qualifier'],
									$rc->fields['map_quantity'],
									$rc->fields['map_unit'],
									$rc->fields['map_order']);
				$ingObj->loadIngredient();
				$ingObj->convertToBaseUnits($scaling);
				$ingredients = ShoppingList::combineIngredients($ingredients, $ingObj);
			}
			$rc->MoveNext();
		}
		return $ingredients;
	}
}
?>
