/* 
 * a few users
 * 
 */
INSERT INTO webcal_user ( cal_login, cal_passwd, cal_firstname, cal_lastname, cal_is_meal_coordinator, cal_is_beancounter, cal_billing_group, cal_birthdate ) VALUES ( 'jkimdon', '7cc84b002339a323cb3673a9380a76be', 'Joey', 'Kimdon', 'Y', 'Y', 'Kimdons', '19770101' );
INSERT INTO webcal_user ( cal_login, cal_passwd, cal_firstname, cal_lastname, cal_is_meal_coordinator, cal_is_beancounter, cal_billing_group, cal_birthdate ) VALUES ( 'dkimdon', '6e94eaa1627b7d5ddfbbff8cc65d2f57', 'David', 'Kimdon', 'N', 'N', 'Kimdons', '19750101' );
INSERT INTO webcal_user ( cal_login, cal_passwd, cal_firstname, cal_lastname, cal_is_meal_coordinator, cal_is_beancounter, cal_billing_group, cal_birthdate ) VALUES ( 'akimdon', '26c204028871ea49ed25', 'Aria', 'Kimdon', 'N', 'N', 'Kimdons2', '20050101' );
INSERT INTO webcal_user ( cal_login, cal_passwd, cal_firstname, cal_lastname, cal_is_meal_coordinator, cal_is_beancounter, cal_billing_group, cal_birthdate ) VALUES ( 'userA', 'a6fcd06cf913ba61a22b62058e6508cf', 'Ima', 'User', 'N', 'N', 'coolKids', '19750101' );
INSERT INTO webcal_user ( cal_login, cal_passwd, cal_firstname, cal_lastname, cal_is_meal_coordinator, cal_is_beancounter, cal_billing_group, cal_birthdate ) VALUES ( 'userB', 'c776586bf146463bc87074f5ae8d1aec', 'Meow', 'Cat', 'N', 'N', 'pets', '19750101' );
INSERT INTO webcal_user ( cal_login, cal_passwd, cal_firstname, cal_lastname, cal_is_meal_coordinator, cal_is_beancounter, cal_billing_group, cal_birthdate ) VALUES ( 'userC', 'fb7a36af7be102d0a7eda2fd25d556b9', 'Bark', 'Dog', 'N', 'N', 'pets', '19750101' );
INSERT INTO webcal_user ( cal_login, cal_passwd, cal_firstname, cal_lastname, cal_is_meal_coordinator, cal_is_beancounter, cal_billing_group, cal_birthdate ) VALUES ( 'userD', '858bf7ad5beb8e22f127c136c4f6797b', 'Ura', 'User', 'N', 'N', 'coolKids', '19750101' );
INSERT INTO webcal_user ( cal_login, cal_passwd, cal_firstname, cal_lastname, cal_is_meal_coordinator, cal_is_beancounter, cal_billing_group, cal_birthdate ) VALUES ( 'userE', 'd200ffdec60228074a7f91bf92d17245', 'Weera', 'User', 'N', 'N', 'coolKids', '19750101' );
INSERT INTO webcal_user ( cal_login, cal_passwd, cal_firstname, cal_lastname, cal_is_meal_coordinator, cal_is_beancounter, cal_billing_group, cal_birthdate ) VALUES ( 'userF', 'd778482b84ce9c777b1fc1dbe235f971', 'Sheeza', 'User', 'N', 'N', 'coolKids', '19750101' );
INSERT INTO webcal_user ( cal_login, cal_passwd, cal_firstname, cal_lastname, cal_is_meal_coordinator, cal_is_beancounter, cal_billing_group, cal_birthdate ) VALUES ( 'userG', 'a662fed8832c01c2abfe7ee11b992423', 'Heeza', 'User', 'N', 'N', 'coolKids', '19750101' );
INSERT INTO webcal_user ( cal_login, cal_passwd, cal_firstname, cal_lastname, cal_is_meal_coordinator, cal_is_beancounter, cal_billing_group, cal_birthdate ) VALUES ( 'userH', '4f56c02c17005ab213b79cd3bd556603', 'Oink', 'Pig', 'N', 'N', 'pets', '19750101' );
INSERT INTO webcal_user ( cal_login, cal_passwd, cal_firstname, cal_lastname, cal_is_meal_coordinator, cal_is_beancounter, cal_billing_group, cal_birthdate ) VALUES 
( 'userI', '8ffff2b36653009deff53f2ee07b302a', 'Hiss', 'Snake', 'N', 'N', 'pets', '19750101' ), 
( 'userJ', '5e3d387fc55b2f1a95a1b923b1b91c23', 'Croak', 'Frog', 'N', 'N', 'pets', '19750101' );
/*
 * financial log entries
 */
INSERT INTO webcal_financial_log ( cal_log_id, cal_login, cal_billing_group, cal_description, cal_meal_id, cal_amount, cal_running_balance, cal_text ) VALUES ( 1, 'jkimdon', 'Kimdons', 'payment', 0, 10050, 10050, 'The first payment: check sent to bean counter' );
/* 
 * a heart subscription
 */
INSERT INTO webcal_subscriptions ( cal_login, cal_suit, cal_off_day, cal_start, cal_end, cal_ongoing ) VALUES ( 'jkimdon', 'heart', 4, 20071114, 20071130, 1 );
INSERT INTO webcal_meal_participant ( cal_id, cal_login, cal_type, cal_notes ) VALUES ( 35, 'jkimdon', 'M', '' );
INSERT INTO webcal_meal_participant ( cal_id, cal_login, cal_type, cal_notes ) VALUES ( 36, 'jkimdon', 'M', '' );
INSERT INTO webcal_meal_participant ( cal_id, cal_login, cal_type, cal_notes ) VALUES ( 37, 'jkimdon', 'M', '' );
INSERT INTO webcal_meal_participant ( cal_id, cal_login, cal_type, cal_notes ) VALUES ( 38, 'jkimdon', 'M', '' );
INSERT INTO webcal_meal_participant ( cal_id, cal_login, cal_type, cal_notes ) VALUES ( 39, 'jkimdon', 'M', '' );
INSERT INTO webcal_meal_participant ( cal_id, cal_login, cal_type, cal_notes ) VALUES ( 40, 'jkimdon', 'M', '' );
INSERT INTO webcal_meal_participant ( cal_id, cal_login, cal_type, cal_notes ) VALUES ( 41, 'jkimdon', 'M', '' );
INSERT INTO webcal_meal_participant ( cal_id, cal_login, cal_type, cal_notes ) VALUES ( 42, 'jkimdon', 'M', '' );
INSERT INTO webcal_meal_participant ( cal_id, cal_login, cal_type, cal_notes ) VALUES ( 43, 'jkimdon', 'M', '' );
/*
 * food prefs
 */
INSERT INTO webcal_food_prefs ( cal_login, cal_food, cal_level, cal_reason ) VALUES ( 'jkimdon', 'dairy', 2, 'physical' );
INSERT INTO webcal_food_prefs ( cal_login, cal_food, cal_level, cal_reason ) VALUES ( 'jkimdon', 'wheat', 2, 'physical' );
INSERT INTO webcal_food_prefs ( cal_login, cal_food, cal_level, cal_reason ) VALUES ( 'jkimdon', 'cashews', 2, 'physical' );
INSERT INTO webcal_food_prefs ( cal_login, cal_food, cal_level, cal_reason ) VALUES ( 'akimdon', 'dairy', 2, 'physical' );
/* 
 * a few buddies
 * 
 */
INSERT INTO webcal_buddy ( cal_signer, cal_signee ) VALUES ( 'jkimdon', 'akimdon' );
INSERT INTO webcal_buddy ( cal_signer, cal_signee ) VALUES ( 'dkimdon', 'akimdon' );
INSERT INTO webcal_buddy ( cal_signer, cal_signee ) VALUES ( 'akimdon', 'dkimdon' );
/* 
 * one club
 * 
 */
INSERT INTO webcal_meal ( cal_id, cal_club_id, cal_date, cal_time, cal_suit, cal_walkins, cal_num_crew, cal_menu, cal_notes ) VALUES ( '1', '1', '20070910', '173000', 'club', 'C', '2', 'green beans and corn', 'This is the From-The-CoHo-Garden Club' );
INSERT INTO webcal_meal ( cal_id, cal_club_id, cal_date, cal_time, cal_suit, cal_walkins, cal_num_crew, cal_menu, cal_notes ) VALUES ( '2', '1', '20070917', '173000', 'club', 'C', '2', '', 'This is the From-The-CoHo-Garden Club' );
INSERT INTO webcal_meal ( cal_id, cal_club_id, cal_date, cal_time, cal_suit, cal_walkins, cal_num_crew, cal_menu, cal_notes ) VALUES ( '3', '1', '20070924', '173000', 'club', 'C', '2', '', 'This is the From-The-CoHo-Garden Club' );
INSERT INTO webcal_meal ( cal_id, cal_club_id, cal_date, cal_time, cal_suit, cal_walkins, cal_num_crew, cal_menu, cal_notes ) VALUES ( '4', '1', '20071001', '173000', 'club', 'C', '2', '', 'This is the From-The-CoHo-Garden Club' );
INSERT INTO webcal_meal ( cal_id, cal_club_id, cal_date, cal_time, cal_suit, cal_walkins, cal_num_crew, cal_menu, cal_notes ) VALUES ( '5', '1', '20071008', '173000', 'club', 'C', '2', '', 'This is the From-The-CoHo-Garden Club' );
/* 
 * another club 
 * 
 */
INSERT INTO webcal_meal ( cal_id, cal_club_id, cal_date, cal_time, cal_suit, cal_walkins, cal_num_crew, cal_menu, cal_notes ) VALUES ( '6', '2', '20070904', '180000', 'club', 'C', '2', 'berries and sauce', 'This is the Leftovers Club' );
INSERT INTO webcal_meal ( cal_id, cal_club_id, cal_date, cal_time, cal_suit, cal_walkins, cal_num_crew, cal_menu, cal_notes ) VALUES ( '7', '2', '20070911', '180000', 'club', 'C', '2', 'berries and sauce', 'This is the Leftovers Club' );
INSERT INTO webcal_meal ( cal_id, cal_club_id, cal_date, cal_time, cal_suit, cal_walkins, cal_num_crew, cal_menu, cal_notes ) VALUES ( '8', '2', '20070918', '180000', 'club', 'C', '2', 'berries and sauce', 'This is the Leftovers Club' );
/*
 * wild with a participant and a billing
 *
 */
INSERT INTO webcal_meal ( cal_id, cal_club_id, cal_date, cal_time, cal_suit, cal_walkins, cal_num_crew, cal_menu, cal_notes ) VALUES ( '9', '0', '20071213', '183000', 'wild', 'C', '3', 'baby food', 'babies only' );
INSERT INTO webcal_meal_participant ( cal_id, cal_login, cal_type, cal_notes ) VALUES ( 9, 'jkimdon', 'M', '' );
INSERT INTO webcal_financial_log ( cal_log_id, cal_login, cal_billing_group, cal_description, cal_meal_id, cal_amount, cal_running_balance, cal_text ) VALUES ( 2, 'jkimdon', 'Kimdons', 'Joey Kimdon dining', 9, -400, 9650, '' );
INSERT INTO webcal_meal_participant ( cal_id, cal_login, cal_type, cal_notes ) VALUES ( 9, 'dkimdon', 'M', '' );
INSERT INTO webcal_financial_log ( cal_log_id, cal_login, cal_billing_group, cal_description, cal_meal_id, cal_amount, cal_running_balance, cal_text ) VALUES ( 3, 'dkimdon', 'Kimdons', 'David Kimdon dining', 9, -400, 9650, '' );
INSERT INTO webcal_meal_participant ( cal_id, cal_login, cal_type, cal_notes ) VALUES ( 9, 'akimdon', 'M', '' );
INSERT INTO webcal_financial_log ( cal_log_id, cal_login, cal_billing_group, cal_description, cal_meal_id, cal_amount, cal_running_balance, cal_text ) VALUES ( 4, 'akimdon', 'Kimdons', 'Aria Kimdon dining', 9, -400, 9650, '' );
INSERT INTO webcal_meal_participant ( cal_id, cal_login, cal_type, cal_notes ) VALUES ( 9, 'userA', 'T', '' );
INSERT INTO webcal_financial_log ( cal_log_id, cal_login, cal_billing_group, cal_description, cal_meal_id, cal_amount, cal_running_balance, cal_text ) VALUES ( 5, 'userA', 'coolKids', 'Ima User dining', 9, -400, 9650, '' );
INSERT INTO webcal_meal_participant ( cal_id, cal_login, cal_type, cal_notes ) VALUES ( 9, 'userB', 'T', '' );
INSERT INTO webcal_financial_log ( cal_log_id, cal_login, cal_billing_group, cal_description, cal_meal_id, cal_amount, cal_running_balance, cal_text ) VALUES ( 6, 'userB', 'pets', 'Meow Cat dining', 9, -400, 9650, '' );
INSERT INTO webcal_meal_participant ( cal_id, cal_login, cal_type, cal_notes ) VALUES ( 9, 'userC', 'M', '' );
INSERT INTO webcal_financial_log ( cal_log_id, cal_login, cal_billing_group, cal_description, cal_meal_id, cal_amount, cal_running_balance, cal_text ) VALUES ( 7, 'userC', 'pets', 'Bark Dog dining', 9, -400, 9650, '' );
INSERT INTO webcal_meal_participant ( cal_id, cal_login, cal_type, cal_notes ) VALUES ( 9, 'userC', 'C', '' );
INSERT INTO webcal_meal_participant ( cal_id, cal_login, cal_type, cal_notes ) VALUES ( 9, 'jkimdon', 'H', '' );

/* 
 * some hearts
 * 
 */
INSERT INTO webcal_meal ( cal_id, cal_club_id, cal_date, cal_time, cal_suit, cal_walkins, cal_num_crew, cal_menu, cal_notes, cal_signup_deadline ) VALUES ( '10', '0', '20070912', '180000', 'heart', 'C', '3', '', '', 14 );
INSERT INTO webcal_meal ( cal_id, cal_club_id, cal_date, cal_time, cal_suit, cal_walkins, cal_num_crew, cal_menu, cal_notes, cal_signup_deadline ) VALUES ( '11', '0', '20070913', '180000', 'heart', 'C', '3', '', '', 14 );
INSERT INTO webcal_meal ( cal_id, cal_club_id, cal_date, cal_time, cal_suit, cal_walkins, cal_num_crew, cal_menu, cal_notes, cal_signup_deadline ) VALUES ( '12', '0', '20070914', '180000', 'heart', 'C', '3', '', '', 14 );
INSERT INTO webcal_meal ( cal_id, cal_club_id, cal_date, cal_time, cal_suit, cal_walkins, cal_num_crew, cal_menu, cal_notes, cal_signup_deadline ) VALUES ( '13', '0', '20070919', '180000', 'heart', 'C', '3', '', '', 14 );
INSERT INTO webcal_meal ( cal_id, cal_club_id, cal_date, cal_time, cal_suit, cal_walkins, cal_num_crew, cal_menu, cal_notes, cal_signup_deadline ) VALUES ( '14', '0', '20070920', '180000', 'heart', 'C', '3', '', '', 14 );
INSERT INTO webcal_meal ( cal_id, cal_club_id, cal_date, cal_time, cal_suit, cal_walkins, cal_num_crew, cal_menu, cal_notes, cal_signup_deadline ) VALUES ( '15', '0', '20070921', '180000', 'heart', 'C', '3', '', '', 14 );
INSERT INTO webcal_meal ( cal_id, cal_club_id, cal_date, cal_time, cal_suit, cal_walkins, cal_num_crew, cal_menu, cal_notes, cal_signup_deadline ) VALUES ( '16', '0', '20070926', '180000', 'heart', 'C', '3', '', '', 14 );
INSERT INTO webcal_meal ( cal_id, cal_club_id, cal_date, cal_time, cal_suit, cal_walkins, cal_num_crew, cal_menu, cal_notes, cal_signup_deadline ) VALUES ( '17', '0', '20070927', '180000', 'heart', 'C', '3', '', '', 14 );
INSERT INTO webcal_meal ( cal_id, cal_club_id, cal_date, cal_time, cal_suit, cal_walkins, cal_num_crew, cal_menu, cal_notes, cal_signup_deadline ) VALUES ( '18', '0', '20070928', '180000', 'heart', 'C', '3', '', '', 14 );
/* oct */
INSERT INTO webcal_meal ( cal_id, cal_club_id, cal_date, cal_time, cal_suit, cal_walkins, cal_num_crew, cal_menu, cal_notes, cal_signup_deadline ) VALUES ( '19', '0', '20071003', '180000', 'heart', 'C', '3', '', '', 14 );
INSERT INTO webcal_meal ( cal_id, cal_club_id, cal_date, cal_time, cal_suit, cal_walkins, cal_num_crew, cal_menu, cal_notes, cal_signup_deadline ) VALUES ( '20', '0', '20071004', '180000', 'heart', 'C', '3', '', '', 14 );
INSERT INTO webcal_meal ( cal_id, cal_club_id, cal_date, cal_time, cal_suit, cal_walkins, cal_num_crew, cal_menu, cal_notes, cal_signup_deadline ) VALUES ( '21', '0', '20071005', '180000', 'heart', 'C', '3', '', '', 14 );
INSERT INTO webcal_meal ( cal_id, cal_club_id, cal_date, cal_time, cal_suit, cal_walkins, cal_num_crew, cal_menu, cal_notes, cal_signup_deadline ) VALUES ( '22', '0', '20071010', '180000', 'heart', 'C', '3', '', '', 14 );
INSERT INTO webcal_meal ( cal_id, cal_club_id, cal_date, cal_time, cal_suit, cal_walkins, cal_num_crew, cal_menu, cal_notes, cal_signup_deadline ) VALUES ( '23', '0', '20071011', '180000', 'heart', 'C', '3', '', '', 14 );
INSERT INTO webcal_meal ( cal_id, cal_club_id, cal_date, cal_time, cal_suit, cal_walkins, cal_num_crew, cal_menu, cal_notes, cal_signup_deadline ) VALUES ( '24', '0', '20071012', '180000', 'heart', 'C', '3', '', '', 14 );
INSERT INTO webcal_meal ( cal_id, cal_club_id, cal_date, cal_time, cal_suit, cal_walkins, cal_num_crew, cal_menu, cal_notes, cal_signup_deadline ) VALUES ( '25', '0', '20071017', '180000', 'heart', 'C', '3', '', '', 14 );
INSERT INTO webcal_meal ( cal_id, cal_club_id, cal_date, cal_time, cal_suit, cal_walkins, cal_num_crew, cal_menu, cal_notes, cal_signup_deadline ) VALUES ( '26', '0', '20071018', '180000', 'heart', 'C', '3', '', '', 14 );
INSERT INTO webcal_meal ( cal_id, cal_club_id, cal_date, cal_time, cal_suit, cal_walkins, cal_num_crew, cal_menu, cal_notes, cal_signup_deadline ) VALUES ( '27', '0', '20071019', '180000', 'heart', 'C', '3', '', '', 14 );
INSERT INTO webcal_meal ( cal_id, cal_club_id, cal_date, cal_time, cal_suit, cal_walkins, cal_num_crew, cal_menu, cal_notes, cal_signup_deadline ) VALUES ( '28', '0', '20071024', '180000', 'heart', 'C', '3', '', '', 14 );
INSERT INTO webcal_meal ( cal_id, cal_club_id, cal_date, cal_time, cal_suit, cal_walkins, cal_num_crew, cal_menu, cal_notes, cal_signup_deadline ) VALUES ( '29', '0', '20071025', '180000', 'heart', 'C', '3', '', '', 14 );
INSERT INTO webcal_meal ( cal_id, cal_club_id, cal_date, cal_time, cal_suit, cal_walkins, cal_num_crew, cal_menu, cal_notes, cal_signup_deadline ) VALUES ( '30', '0', '20071026', '180000', 'heart', 'C', '3', '', '', 14 );
INSERT INTO webcal_meal ( cal_id, cal_club_id, cal_date, cal_time, cal_suit, cal_walkins, cal_num_crew, cal_menu, cal_notes, cal_signup_deadline ) VALUES ( '31', '0', '20071031', '180000', 'heart', 'C', '3', '', '', 14 );
/* nov */
INSERT INTO webcal_meal ( cal_id, cal_club_id, cal_date, cal_time, cal_suit, cal_walkins, cal_num_crew, cal_menu, cal_notes, cal_signup_deadline ) VALUES ( '55', '0', '20071101', '180000', 'heart', 'C', '3', '', '', 14 );
INSERT INTO webcal_meal ( cal_id, cal_club_id, cal_date, cal_time, cal_suit, cal_walkins, cal_num_crew, cal_menu, cal_notes, cal_signup_deadline ) VALUES ( '56', '0', '20071102', '180000', 'heart', 'C', '3', '', '', 14 );
INSERT INTO webcal_meal ( cal_id, cal_club_id, cal_date, cal_time, cal_suit, cal_walkins, cal_num_crew, cal_menu, cal_notes, cal_signup_deadline ) VALUES ( '32', '0', '20071107', '180000', 'heart', 'C', '3', '', '', 14 );
INSERT INTO webcal_meal ( cal_id, cal_club_id, cal_date, cal_time, cal_suit, cal_walkins, cal_num_crew, cal_menu, cal_notes, cal_signup_deadline ) VALUES ( '33', '0', '20071108', '180000', 'heart', 'C', '3', '', '', 14 );
INSERT INTO webcal_meal ( cal_id, cal_club_id, cal_date, cal_time, cal_suit, cal_walkins, cal_num_crew, cal_menu, cal_notes, cal_signup_deadline ) VALUES ( '34', '0', '20071109', '180000', 'heart', 'C', '3', '', '', 14 );
INSERT INTO webcal_meal ( cal_id, cal_club_id, cal_date, cal_time, cal_suit, cal_walkins, cal_num_crew, cal_menu, cal_notes, cal_signup_deadline ) VALUES ( '35', '0', '20071114', '180000', 'heart', 'C', '3', '', '', 14 );
INSERT INTO webcal_meal ( cal_id, cal_club_id, cal_date, cal_time, cal_suit, cal_walkins, cal_num_crew, cal_menu, cal_notes, cal_signup_deadline ) VALUES ( '36', '0', '20071115', '180000', 'heart', 'C', '3', '', '', 14 );
INSERT INTO webcal_meal ( cal_id, cal_club_id, cal_date, cal_time, cal_suit, cal_walkins, cal_num_crew, cal_menu, cal_notes, cal_signup_deadline ) VALUES ( '37', '0', '20071116', '180000', 'heart', 'C', '3', '', '', 14 );
INSERT INTO webcal_meal ( cal_id, cal_club_id, cal_date, cal_time, cal_suit, cal_walkins, cal_num_crew, cal_menu, cal_notes, cal_signup_deadline ) VALUES ( '38', '0', '20071121', '180000', 'heart', 'C', '3', '', '', 14 );
INSERT INTO webcal_meal ( cal_id, cal_club_id, cal_date, cal_time, cal_suit, cal_walkins, cal_num_crew, cal_menu, cal_notes, cal_signup_deadline ) VALUES ( '39', '0', '20071122', '180000', 'heart', 'C', '3', '', '', 14 );
INSERT INTO webcal_meal ( cal_id, cal_club_id, cal_date, cal_time, cal_suit, cal_walkins, cal_num_crew, cal_menu, cal_notes, cal_signup_deadline ) VALUES ( '40', '0', '20071123', '180000', 'heart', 'C', '3', '', '', 14 );
INSERT INTO webcal_meal ( cal_id, cal_club_id, cal_date, cal_time, cal_suit, cal_walkins, cal_num_crew, cal_menu, cal_notes, cal_signup_deadline ) VALUES ( '41', '0', '20071128', '180000', 'heart', 'C', '3', '', '', 14 );
INSERT INTO webcal_meal ( cal_id, cal_club_id, cal_date, cal_time, cal_suit, cal_walkins, cal_num_crew, cal_menu, cal_notes, cal_signup_deadline ) VALUES ( '42', '0', '20071129', '180000', 'heart', 'C', '3', '', '', 14 );
INSERT INTO webcal_meal ( cal_id, cal_club_id, cal_date, cal_time, cal_suit, cal_walkins, cal_num_crew, cal_menu, cal_notes, cal_signup_deadline ) VALUES ( '43', '0', '20071130', '180000', 'heart', 'C', '3', '', '', 14 );
/* dec */
INSERT INTO webcal_meal ( cal_id, cal_club_id, cal_date, cal_time, cal_suit, cal_walkins, cal_num_crew, cal_menu, cal_notes, cal_signup_deadline ) VALUES ( '44', '0', '20071205', '180000', 'heart', 'C', '3', '', '', 14 );
INSERT INTO webcal_meal ( cal_id, cal_club_id, cal_date, cal_time, cal_suit, cal_walkins, cal_num_crew, cal_menu, cal_notes, cal_signup_deadline ) VALUES ( '45', '0', '20071206', '180000', 'heart', 'C', '3', '', '', 14 );
INSERT INTO webcal_meal ( cal_id, cal_club_id, cal_date, cal_time, cal_suit, cal_walkins, cal_num_crew, cal_menu, cal_notes, cal_signup_deadline ) VALUES ( '46', '0', '20071207', '180000', 'heart', 'C', '3', '', '', 14 );
INSERT INTO webcal_meal ( cal_id, cal_club_id, cal_date, cal_time, cal_suit, cal_walkins, cal_num_crew, cal_menu, cal_notes, cal_signup_deadline ) VALUES ( '47', '0', '20071212', '180000', 'heart', 'C', '3', '', '', 14 );
INSERT INTO webcal_meal ( cal_id, cal_club_id, cal_date, cal_time, cal_suit, cal_walkins, cal_num_crew, cal_menu, cal_notes, cal_signup_deadline ) VALUES ( '48', '0', '20071213', '180000', 'heart', 'C', '3', '', '', 14 );
INSERT INTO webcal_meal ( cal_id, cal_club_id, cal_date, cal_time, cal_suit, cal_walkins, cal_num_crew, cal_menu, cal_notes, cal_signup_deadline ) VALUES ( '49', '0', '20071214', '180000', 'heart', 'C', '3', '', '', 14 );
INSERT INTO webcal_meal ( cal_id, cal_club_id, cal_date, cal_time, cal_suit, cal_walkins, cal_num_crew, cal_menu, cal_notes, cal_signup_deadline ) VALUES ( '50', '0', '20071219', '180000', 'heart', 'C', '3', '', '', 14 );
INSERT INTO webcal_meal ( cal_id, cal_club_id, cal_date, cal_time, cal_suit, cal_walkins, cal_num_crew, cal_menu, cal_notes, cal_signup_deadline ) VALUES ( '51', '0', '20071220', '180000', 'heart', 'C', '3', '', '', 14 );
INSERT INTO webcal_meal ( cal_id, cal_club_id, cal_date, cal_time, cal_suit, cal_walkins, cal_num_crew, cal_menu, cal_notes, cal_signup_deadline ) VALUES ( '52', '0', '20071221', '180000', 'heart', 'C', '3', '', '', 14 );
INSERT INTO webcal_meal ( cal_id, cal_club_id, cal_date, cal_time, cal_suit, cal_walkins, cal_num_crew, cal_menu, cal_notes, cal_signup_deadline ) VALUES ( '53', '0', '20071226', '180000', 'heart', 'C', '3', '', '', 14 );
INSERT INTO webcal_meal ( cal_id, cal_club_id, cal_date, cal_time, cal_suit, cal_walkins, cal_num_crew, cal_menu, cal_notes, cal_signup_deadline ) VALUES ( '54', '0', '20071227', '180000', 'heart', 'C', '3', '', '', 14 );
INSERT INTO webcal_meal ( cal_id, cal_club_id, cal_date, cal_time, cal_suit, cal_walkins, cal_num_crew, cal_menu, cal_notes, cal_signup_deadline ) VALUES ( '57', '0', '20071228', '180000', 'heart', 'C', '3', '', '', 14 );