
/*
 * Description:
 * This file is used to create all tables used by WebCalendar and
 * initialize some of those tables with the required data.
 *
 * The comments in the table definitions will be parsed to
 * generate a document (in HTML) that describes these tables.
 *
 * History:
 * 21-Oct-2002 Added this file header and additional comments
 *   below.
 */

/*
 * Defines a WebCalendar user.
 */
CREATE TABLE webcal_user (
  /* the unique user login */
  cal_login VARCHAR(25) NOT NULL,
  /* the user's password. (not used for http or ldap authentication) */
  cal_passwd VARCHAR(32),
  /* user's last name */
  cal_lastname VARCHAR(25),
  /* user's first name */
  cal_firstname VARCHAR(25),
  /* is the user an administrator ('Y' = yes, 'N' = no) */
  cal_is_meal_coordinator CHAR(1) DEFAULT 'N',
  /* bean counter is the only one who can add payment events */
  cal_is_beancounter CHAR(1) DEFAULT 'N',
  /* user's email address */
  cal_email VARCHAR(75) NULL,
  /* billing is by household */
  cal_billing_group VARCHAR(25) NOT NULL,
  /* user birthdate (for determining work/eat ratios and meal prices)
     If not entered, assume they are an adult. */
  cal_birthdate INT,
  /* Unit number at Coho, for example '241', '3xx' if not live in Coho. */
  cal_unit INT DEFAULT 0,
  PRIMARY KEY ( cal_login )
);


/*
 * Defines a calendar event.  Each event in the system has one entry
 * in this table.
 * The following tables contain additional information about each
 * event:<ul>
 * <li><a href="#webcal_meal_participant">webcal_meal_participant</a> -
 *  lists diners/crew
 * </ul>
 */
CREATE TABLE webcal_meal (
  /* cal_id is unique integer id for event */
  cal_id INT NOT NULL,
  /* club_id is the same for all meals in one set of club meals. 
     unused for other meal suits. */
  cal_club_id INT NULL,
  /* date of event (in YYYYMMDD format) */
  cal_date INT NOT NULL,
  /* event time (in HHMMSS format) */
  cal_time INT NULL,
  /* meal suit: heart, spade, diamond, club, wild */
  cal_suit VARCHAR(7) NOT NULL,
  /* walkins are: 
     'N' = no;
     'W' = welcome
     'Y' = needed
     'C' = check with lead chef asap  */
  cal_walkins CHAR(1) DEFAULT 'C',
  /* deadline for signing up. format: number of days before meal. 
     after this date, price increases to walkin/guest price and 
     only the admin (MC,BC) can add you to the meal */
  cal_signup_deadline INT NOT NULL DEFAULT 2,
  /* base price (child, walkin, guest prices based on this) */
  cal_base_price DECIMAL(5,2) NOT NULL DEFAULT 400,
  /* desired number of crew (not counting head chef) */
  cal_num_crew INT,
  /* max number of diners 0 = unlimited */
  cal_max_diners INT DEFAULT 0,
  /* menu. For now, is just a text box. Later we'll allow interaction with a
     recipe database. */
  cal_menu TEXT,
  /* notes, such as a description of duties of optional other crew members */
  cal_notes TEXT,
  /* if meal was cancelled, keep it in the database for reference */
  cal_cancelled CHAR(1) NOT NULL DEFAULT 0,
  PRIMARY KEY ( cal_id )
);

/* 
 * For regular meals each month
 */
CREATE TABLE webcal_standard_meals (
  /* day of the week, starting with 0=Sunday */
  cal_day_of_week INT NOT NULL,
  /* which week in the month, e.g. first, fifth */
  cal_which_week INT NOT NULL,
  /* if there are meals that rotate months, we note their rotation order here */
  cal_rotation_order INT DEFAULT 0,
  /* if there are meals that rotate months, we note if this is the next one to be assigned */
  cal_is_next CHAR(1) DEFAULT 1,
  /* if this is only for one month (i.e. not regular), indicate which month */
  cal_temp_change INT DEFAULT 0,
  /* standard time */
  cal_time INT NOT NULL,
  /* meal suit: heart, spade, diamond, club, wild */
  cal_suit VARCHAR(7) NOT NULL,
  /* base price (child, walkin, guest prices based on this) */
  cal_base_price DECIMAL(5,2) NOT NULL DEFAULT 400,
  /* menu if regular */
  cal_menu TEXT,
  /* regular head chef or "none" */
  cal_head_chef VARCHAR(25) NOT NULL,
  /* regular crew slots: job, login, job, login, ... */
  cal_regular_crew VARCHAR(1000),
  PRIMARY KEY ( cal_day_of_week, cal_which_week, cal_time, cal_temp_change, cal_rotation_order )
);


/*
 * This table associates one or more participants with a meal using the meal id.
 * One entry refers to one person and one meal, telling the role of the person.
 * Each person at a meal has their own entry, and each meal has its own set of
 * entries per person.
 * The meal can be found in webcal_meal.
 */
CREATE TABLE webcal_meal_participant (
  /* meal id */
  cal_id INT DEFAULT 0 NOT NULL,
  /* participant in the event */
  cal_login VARCHAR(25) NOT NULL,
  /* type of participation: 
     'H' = head chef (only one)
     'M' = in-house muncher
     'T' = take-home plate
     'C' = crew
     'B' = blocked (block auto-signup for this meal only)
  */
  cal_type CHAR(1) NOT NULL,
  /* notes, e.g. about availability or crew type preference */
  cal_notes VARCHAR(80) NULL,
  /* flag for walkin diner (higher price). 1 = walkin, 0 = pre-signup */
  cal_walkin CHAR(1) DEFAULT 0,
  /* timestamp when initially signed up */
  cal_timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY ( cal_id, cal_login, cal_type, cal_notes )
);


/* 
 * This table keeps track of subscriptions. If new heart meals are added, the 
 * subscribers are added to the meal. Also then removals or additions of 
 * subscribers to heart or club can be handled separately from subscriptions
 */
CREATE TABLE webcal_subscriptions (
  /* participant */
  cal_login VARCHAR(25) NOT NULL,
  /* meal suit (heart or club) */
  cal_suit VARCHAR(7) NOT NULL,
  /* identify which of the many club meals. Unused for heart meals. */
  cal_club_id INT NULL,
  /* day of the week subscribed for heart meals. 0 = Sun to 6 = Sat */
  cal_day INT NULL,
  /* start of current block */
  cal_start INT NULL,
  /* end of current block */
  cal_end INT NULL,
  /* for heart meals: does the subscription automatically renew: 0=no 1=yes */
  cal_ongoing INT NULL,
  PRIMARY KEY ( cal_login, cal_suit, cal_club_id, cal_day, cal_ongoing )
);


/* food preferences for people */
CREATE TABLE webcal_food_prefs (
  /* user login */
  cal_login VARCHAR(25) NOT NULL,
  /* food */
  cal_food VARCHAR(40) NOT NULL,
  /* level of complexity of request to meal crew
	1 = no or minimal request to meal crew
	2 = < 10% time/complexity request to meal crew
	3 = > 10% time/complexity request to meal crew
  */
  cal_level INT NOT NULL,
  /* reason why don't want to eat this food */
  cal_reason ENUM('fatal','physical','philosophical','finicky') NOT NULL,
  PRIMARY KEY ( cal_login, cal_food )
);



/*
 * This table associates one or more external users (people who do not
 * have a WebCalendar userid) with a meal by the meal id.
 * A meal must still have at least one WebCalendar user associated
 * with it. 
 * The event can be found in webcal_meal.
 * Assumes on-site dining.
 */
CREATE TABLE webcal_meal_guest (
  /* event id */
  cal_meal_id INT DEFAULT 0 NOT NULL,
  /* external user full name */
  cal_fullname VARCHAR(50) NOT NULL,
  /* which user is the host */
  cal_host VARCHAR(25) NOT NULL,
  /* fee category: 'A' = adult, 'C' = child, 'F' = free */
  cal_fee CHAR(1) NOT NULL,
  /* type of participation:
	'M' = on-site diner
	'T' = take-home plate
  */
  cal_type CHAR(1) NOT NULL,
  /* flag for walkin diner (higher price). 1 = walkin, 0 = pre-signup */
  cal_walkin CHAR(1) DEFAULT 0,
  PRIMARY KEY ( cal_meal_id, cal_fullname )
);



/*
 * Specify preferences for a user.
 * Most preferences are set via pref.php.
 * Values in this table are loaded after system settings
 * found in <a href="#webcal_config">webcal_config</a>.
 */
CREATE TABLE webcal_user_pref (
  /* user login */
  cal_login VARCHAR(25) NOT NULL,
  /* setting name */
  cal_setting VARCHAR(25) NOT NULL,
  /* setting value */
  cal_value VARCHAR(100) NULL,
  PRIMARY KEY ( cal_login, cal_setting )
);


/*
 * This table holds data for site extra fields
 * (customized in site_extra.php).
 */
CREATE TABLE webcal_site_extras (
  /* event id */
  cal_id INT DEFAULT 0 NOT NULL,
  /* the brief name of this type (first field in $site_extra array) */
  cal_name VARCHAR(25) NOT NULL,
  /* $EXTRA_URL, $EXTRA_DATE, etc. */
  cal_type INT NOT NULL,
  /* only used for $EXTRA_DATE type fields (in YYYYMMDD format) */
  cal_date INT DEFAULT 0,
  /* how many minutes before event should a reminder be sent */
  cal_remind INT DEFAULT 0,
  /* used to store text data */
  cal_data TEXT,
  PRIMARY KEY ( cal_id, cal_name, cal_type )
);

/*
 * This table keeps a history of when reminders get sent.
 */
CREATE TABLE webcal_reminder_log (
  /* event id */
  cal_id INT DEFAULT 0 NOT NULL,
  /* extra type (see site_extras.php) */
  cal_name VARCHAR(25) NOT NULL,
  /* the event date we are sending reminder for (in YYYYMMDD format) */
  cal_event_date INT NOT NULL DEFAULT 0,
  /* the date/time we last sent a reminder (in UNIX time format) */
  cal_last_sent INT NOT NULL DEFAULT 0,
  PRIMARY KEY ( cal_id, cal_name, cal_event_date )
);

/*
 * Define buddies who can sign up others for meals and shifts 
 */
CREATE TABLE webcal_buddy (
  /* the login of the person who can do the signing */
  cal_signer VARCHAR(25) NOT NULL,
  /* the login of the person who can be signed up */
  cal_signee VARCHAR(25) NOT NULL,
  PRIMARY KEY ( cal_signer, cal_signee )
);


/*
 * System settings (set by the admin interface in admin.php)
 */
CREATE TABLE webcal_config (
  /* setting name */
  cal_setting VARCHAR(50) NOT NULL,
  /* setting value */
  cal_value VARCHAR(100) NULL,
  PRIMARY KEY ( cal_setting )
);

# default settings
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ( 'application_name', 'Coho Ecovillage Meals' );
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ( 'LANGUAGE', 'Browser-defined' );
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ( 'demo_mode', 'N' );
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ( 'require_approvals', 'Y' );
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ( 'allow_conflicts', 'N' );
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ( 'conflict_repeat_months', '6' );
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ( 'disable_priority_field', 'N' );
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ( 'disable_access_field', 'N' );
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ( 'disable_participants_field', 'N' );
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ( 'allow_view_other', 'Y' );
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ( 'email_fallback_from', 'youremailhere' );
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ( 'remember_last_login', 'Y' );
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ( 'allow_color_customization', 'Y' );
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ('BGCOLOR','#FFFFFF');
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ('TEXTCOLOR','#000000');
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ('H2COLOR','#000000');
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ('CELLBG','#C0C0C0');
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ('WEEKENDBG','#D0D0D0');
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ('TABLEBG','#000000');
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ('THBG','#FFFFFF');
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ('THFG','#000000');
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ('POPUP_FG','#000000');
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ('POPUP_BG','#FFFFFF');
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ('TODAYCELLBG','#FFFF33');
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ( 'STARTVIEW', 'month.php' );
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ( 'WEEK_START', '0' );
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ( 'TIME_FORMAT', '12' );
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ( 'DISPLAY_UNAPPROVED', 'Y' );
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ( 'DISPLAY_WEEKNUMBER', 'Y' );
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ( 'WORK_DAY_START_HOUR', '8' );
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ( 'WORK_DAY_END_HOUR', '17' );
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ( 'send_email', 'N' );
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ( 'EMAIL_REMINDER', 'Y' );
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ( 'EMAIL_EVENT_ADDED', 'Y' );
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ( 'EMAIL_EVENT_UPDATED', 'Y' );
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ( 'EMAIL_EVENT_DELETED', 'Y' );
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ( 'EMAIL_EVENT_REJECTED', 'Y' );
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ('auto_refresh', 'N');
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ('nonuser_enabled', 'N');
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ('allow_html_description', 'N');
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ('DISPLAY_WEEKENDS', 'Y');
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ('DISPLAY_DESC_PRINT_DAY', 'N');
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ('DATE_FORMAT', '__month__ __dd__, __yyyy__');
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ('TIME_SLOTS', '12');
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ('TIMED_EVT_LEN', 'D');
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ('PUBLISH_ENABLED', 'N');
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ('DATE_FORMAT_MY', '__month__ __yyyy__');
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ('DATE_FORMAT_MD', '__month__ __dd__');
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ('CUSTOM_SCRIPT', 'N');
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ('CUSTOM_HEADER', 'N');
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ('CUSTOM_TRAILER', 'N');
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ('bold_days_in_year', 'Y');
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ('site_extras_in_popup', 'N');
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ('add_link_in_views', 'Y');
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ('allow_conflict_override', 'Y');
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ('limit_appts', 'N');
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ('limit_appts_number', '6');
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ('public_access', 'N');
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ('public_access_default_visible', 'N');
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ('public_access_default_selected', 'N');
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ('public_access_others', 'N');
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ('public_access_can_add', 'N');
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ('public_access_add_needs_approval', 'Y');
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ('public_access_view_part', 'N');
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ('nonuser_at_top', 'Y');
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ('allow_external_users', 'N');
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ('external_notifications', 'N');
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ('external_reminders', 'N');
INSERT INTO webcal_config ( cal_setting, cal_value )
  VALUES ('enable_gradients', 'N');


/*
 * Activity log for an event.
 */
CREATE TABLE webcal_entry_log (
  /* unique id of this log entry */
  cal_log_id INT NOT NULL,
  /* event id */
  cal_entry_id INT NOT NULL,
  /* user who performed this action */
  cal_login VARCHAR(25) NOT NULL,
  /* log types:  <ul> */
  /* <li>C: Created</li>  */
  /* <li>D: Deleted</li>  */
  /* <li>U: Updated by user</li>  */
  cal_type CHAR(1) NOT NULL,
  /* date in YYYYMMDD format */
  cal_timestamp TIMESTAMP NOT NULL,
  /* optional text */
  cal_text TEXT,
  PRIMARY KEY ( cal_log_id )
);


/*
 * log of financial activity
 *
 * bean counter can add events in here, such as payments. Each event should have a description,
 * which is shown in the user's financial history report
 * 
 * when a meal occurs, a debit event is created. this allows households
 * to change over time.
 */
CREATE TABLE webcal_financial_log (
  /* unique id of this log entry */
  cal_log_id INT NOT NULL,
  /* which person is affected */
  cal_login VARCHAR(50) NOT NULL,
  /* which household is affected */
  cal_billing_group VARCHAR(25) NOT NULL,
  /* describe event */
  cal_description VARCHAR(80) NOT NULL,
  /* timestamp of posting of event in this log */
  cal_timestamp TIMESTAMP NOT NULL,
  /* if a meal debit, link to meal event */
  cal_meal_id INT NULL,
  /* amount, in cents. positive = payment, negative = debit */
  cal_amount INT SIGNED NOT NULL,
  /* running total for a billing group 
     (is rechecked with each new event) */
  cal_running_balance INT SIGNED NOT NULL,
  /* optional text */
  cal_text TEXT,
  PRIMARY KEY ( cal_log_id ) 
);


/* 
 * log of food expenditures
 *
 */
CREATE TABLE webcal_food_expenditures (
  /* unique id of this log entry */
  cal_log_id INT NOT NULL,
  /* User login of who spent the money */
  cal_purchaser VARCHAR(25) NOT NULL,
  /* amount spent in cents */
  cal_amount INT SIGNED NOT NULL,
  /* meal id for food purchased for a specific meal. 0 if for general pantry */
  cal_meal_id INT NULL,
  /* timestamp of posting of event in this log */
  cal_timestamp TIMESTAMP NOT NULL default CURRENT_TIMESTAMP,
  /* where the money went to, e.g. co-op */
  cal_source VARCHAR(80) NULL,
  /* notes. including purpose of purchase if not directly for a meal (e.g. pantry, farmer's market) */
  cal_notes VARCHAR(80) NULL,
  PRIMARY KEY ( cal_log_id )
);


/*
 * types and prices of food in the pantry
 */
CREATE TABLE webcal_pantry_food (
  /* unique food id */
  cal_food_id INT NOT NULL,
  /* description of food */
  cal_description VARCHAR(80) NOT NULL,
  /* food category (for organizing the display) */
  cal_category VARCHAR(80) NULL,
  /* unit (e.g. cup, can) */
  cal_unit VARCHAR(25) NOT NULL,
  /* price per unit in cents (will be updated) */
  cal_unit_price INT SIGNED NOT NULL,
  /* timestamp of most recent update (most recent price change) */
  cal_timestamp TIMESTAMP NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  /* flag if the item is currently available in the pantry for meals */
  cal_available_meals INT NULL,
  /* flag if the item is currently available for individual purchase */
  cal_available_individuals INT NULL,
  /* Special flags: currently O=organic, L=local, S=spray-free, D=grower direct */
  cal_flags VARCHAR(4) NULL,
  /* optional notes */
  cal_notes VARCHAR(80) NULL,
  PRIMARY KEY ( cal_food_id )
);


/*
 * logs pantry purchases and uses. for data mining 
 */
CREATE TABLE webcal_pantry_purchases (
  /* unique log id */
  cal_log_id INT NOT NULL,
  /* food id from pantry_food table */
  cal_food_id INT NOT NULL,
  /* number of units in this transaction */
  cal_number_units DECIMAL(10,2) NOT NULL,
  /* purchase price (cents) based on number of units and current price */
  cal_total_price INT NOT NULL,
  /* type of transaction: 0 = supply, 1 = used */
  cal_type INT NOT NULL,
  /* timestamp of log entry */
  cal_timestamp	TIMESTAMP NOT NULL default CURRENT_TIMESTAMP,
  /* purchase date if type = supply */
  cal_purchase_date TIMESTAMP NULL,
  /* meal id if type = used */
  cal_meal_id INT NULL,
  PRIMARY KEY ( cal_log_id )
);