
class TC_SelectList < Test::Unit::TestCase
    include FireWatir
    
    def setup
        $ff.goto($htmlRoot + "login.php")
	#$ff.text_field(:id, "user").set("admin")
	#$ff.text_field(:id, "password").set("admin")
	$ff.button(:value, "Login").click
	assert( $ff.contains_text(/Default Administrator/) )
    end

    def test_addmeal
	$ff.link(:text, "Add New Meal").click
	$ff.text_field(:id, "entry_brief").set("Heart")
	$ff.text_field(:id, "entry_full").set("Meal")
        $ff.select_list(:name, "day").option(:value, "10").select
	$ff.text_field(:name, "hour").set("4")
	$ff.text_field(:name, "minute").set("30")
        $ff.select_list(:name, "walkins").option(:value, "E").select
	$ff.button(:value, "Save").click
	assert( $ff.contains_text(/Heart/) )
  
        # check the day view
        $ff.link(:title, "dayofmonth10").click
	assert( $ff.contains_text(/Heart/) )
	assert( $ff.contains_text(/4:30am/) )

	# check the event view
	$ff.link(:title, "View this entry").click
	assert( $ff.contains_text(/Heart/) )
	assert( $ff.contains_text(/Meal/) )
	assert( $ff.contains_text(/4:30am-6:30am/) )
	assert( $ff.contains_text(/10/) )
	assert( $ff.contains_text(/Encouraged/) )
   end

end

