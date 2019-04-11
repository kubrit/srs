<?php

// Error
DEFINE('ERR_UNKNOWN_URL','Unknown page url address!');
DEFINE('ERR_FAILED_TO_SAVE','Failed to save, try again.');
//DEFINE('ERR_RECORD_NOT_DELETED','Record was not deleted, please try again.');
DEFINE('ERR_CHOOSE_FILE','Please choose a file.');
DEFINE('ERR_INVALID_TYPE','Invalid file type. Allowed:');
//DEFINE('ERR_USER_NOT_EXIST','Sorry, the user does not exist!');
DEFINE('ERR_YOU_MUST_LOG_IN','You must be logged in to do this! Please log in <a href=\'index.php\' onclick=\'window.location.href=\"index.php\"\'>here</a>.');
DEFINE('ERR_ALREADY_REGISTERED_AND_LOGGED_IN','You are already registered and logged in.');
DEFINE('ERR_FIELDS_WITH_ASTERISK_ARE_REQUIRED','Fields marked with an asterisk are required!');
DEFINE('ERR_PASSWORD_DONT_MATCH','Entered passwords do not match! Repeat...');
DEFINE('ERR_PASSWORD_CHAR_MINIMUM','Password must consist of min. 4 characters!');
DEFINE('ERR_INCORRECT_PASSWORD','You have incorrectly entered your current password!');
DEFINE('ERR_IS_ALREADY_TAKEN','is already taken.');
DEFINE('ERR_SPACES_IN_LOGIN_NOT_ALLOWED','Your login can not contain spaces.');
DEFINE('ERR_VALID_EMAIL_REQUIRED','A valid e-mail address is required!');
DEFINE('ERR_NO_RECIPIENT_SELECTED','Please select the recipient of the message.');
DEFINE('ERR_USERNAME_AND_PASSWORD_EMPTY','You must enter your username and password!');
DEFINE('ERR_USERNAME_NOT_EXIST','This user does not exist. You have not registered yet?');
DEFINE('ERR_ACCOUNT_INACTIVE','Account Inactive. Contact the Administrator.');
DEFINE('ERR_PASSWORD_TO_LONG','Password too long! Max. 32 characters.');
DEFINE('ERR_CREATE_USER_PASSWORD_COMBINATION_INVALID','This User/Password combination is invalid!');
DEFINE('ERR_NO_RECORD_DELETED','No record deleted. Try again.');
DEFINE('ERR_ERROR','Error!');
DEFINE('ERR_FAILED','Failed!');
DEFINE('ERR_INVALID_CONVERSATION_ID','Invalid conversation ID! <a href="messages.php?messages=list">Back</a>');
DEFINE('ERR_DOES_NOT_EXIST','does not exist!');
DEFINE('ERR_INVALID_LOGIN','Entered login is invalid.');
DEFINE('ERR_USERS_NOT_FOUND','These users can\'t be found: ');
DEFINE('ERR_SUBJECT_IS_EMPTY','Subject can\'t be empty.');
DEFINE('ERR_BODY_IS_EMPTY','Body can\'t be empty.');
DEFINE('ERR_SELECT_AT_LEAST_ONE','At least [ 1 ] checkbox must be selected!');
DEFINE('ERR_CANT_ADD_SHIPMENTS_ALL','You can\'t add shipment in `shipments=all`!');

// Success
DEFINE('SUC_SUCCESS','Success!');
DEFINE('SUC_RECORDS_CREATED','records created.');
DEFINE('SUC_RECORDS_DELETED','records deleted.');
DEFINE('SUC_PHOTO_UPLOADED','Photo uploaded, refresh the page.');
DEFINE('SUC_PASSWORD_CHANGED','Password changed successfully.');
DEFINE('SUC_DATA_UPDATED','Your data updated successfully.');
DEFINE('SUC_REGISTERED','Successfully registered.');
DEFINE('SUC_MESSAGE_SENT','Message sent.');

// Info
// DEFINE('INFO_TEST','Info testing.');

// Texts
DEFINE('TXT_CHOOSE','Choose...');
DEFINE('TXT_SEND_ANOTHER_PHOTO','Send another photo...');
DEFINE('TXT_PERSONAL_INFORMATION','Personal information');
DEFINE('TXT_LOGIN','Login');
DEFINE('TXT_FIRST_NAME','First name');
DEFINE('TXT_LAST_NAME','Last name');
DEFINE('TXT_EMAIL','E-mail');
DEFINE('TXT_LANDLINE_PHONE','Landline Phone');
DEFINE('TXT_CELLPHONE','Cellphone');
DEFINE('TXT_COMPANY','Company');
DEFINE('TXT_PROFILE','Profile');
DEFINE('TXT_SETTINGS','Settings');
DEFINE('TXT_LANGUAGE','Language');
DEFINE('TXT_CHANGE_PASSWORD','Change password');
DEFINE('TXT_CURRENT_PASSWORD','Current password');
DEFINE('TXT_NEW_PASSWORD','New password');
DEFINE('TXT_REPEAT_PASSWORD','Repeat password');
DEFINE('TXT_CHANGE_PHOTO','To change the photo go');
DEFINE('TXT_HERE','here');
DEFINE('TXT_RECEIVE_IMPORTANT_INFORMATION','I want to receive important information on email.');
DEFINE('TXT_SIGN_UP','Sign Up');
DEFINE('TXT_WELCOME','Welcome in Shipping Registration System');
DEFINE('TXT_ABOUT','The application was created to register the mail flow between the sender and the recipient. Particularly useful in a large territorial dispersion of the company.');
DEFINE('TXT_CONTACT','Contact');
DEFINE('TXT_APP_DEVELOPER','Application Developer');
DEFINE('TXT_ARE_YOU_SURE','Are you sure you wish to delete this record?');
DEFINE('TXT_SELECT','Select');
DEFINE('TXT_DESELECT','Deselct All');
DEFINE('TXT_SELECTED','With selected');
DEFINE('TXT_SHIPMENTS','Shipments');
DEFINE('TXT_YOUR_MESSAGES','Your Messages');
DEFINE('TXT_NEW_MESSAGE','New message');
DEFINE('TXT_FIND_USER','Find a user!');
DEFINE('TXT_CONVERSATION_WITH','Conversation with: ');
DEFINE('TXT_NEW','New');
DEFINE('TXT_ME','Me');
DEFINE('TXT_CONFIRM_DELETE','Do you really want to delete the records?');
DEFINE('TXT_ADD_NEW_SHIPMENTS','Add new shipments');

// Menu
DEFINE('MENU_HOME','Home');
DEFINE('MENU_SHIPMENTS','Shipments');
DEFINE('MENU_CONTACT','Contact');
DEFINE('MENU_MESSAGES','Messages');
DEFINE('MENU_PROFILE','Profile');
DEFINE('MENU_SETTINGS','Settings');
DEFINE('MENU_CHANGE_PASSWORD','Change password');
DEFINE('MENU_SUPPORT','Support');
DEFINE('MENU_LOGOUT','Logout');

// Buttons
DEFINE('BTN_SAVE','Save');
DEFINE('BTN_DELETE','Delete');
DEFINE('BTN_CANCEL','Cancel');
DEFINE('BTN_BACK','Back');
DEFINE('BTN_SEND','Send');
DEFINE('BTN_CREATE','Create');
DEFINE('BTN_CREATE_ACCOUNT','Create account');
DEFINE('BTN_LOG_IN','Log in');
DEFINE('BTN_LOG_IN_PAGE','Login page');
DEFINE('BTN_EDIT','Edit');
DEFINE('BTN_CHANGE_SHIPMENTS_COUNT','Change shipping quantity');
DEFINE('BTN_ALL','All');
DEFINE('BTN_RECEIVED','Received');
DEFINE('BTN_SENT','Sent');
DEFINE('BTN_SEARCH','Search');
DEFINE('BTN_ADD','Add');
DEFINE('BTN_EXPORT','Export');
DEFINE('BTN_CSV','CSV');
DEFINE('BTN_PDF','PDF');
DEFINE('BTN_PREVIEW_ALL','Preview All');
DEFINE('BTN_NEXT','Next');
DEFINE('BTN_UPDATE_ALL','Update all');

// Tables
DEFINE('TBL_NUMERO','No.');
DEFINE('TBL_SENT_DATE','Sent date');
DEFINE('TBL_RECIPIENT','Recipient');
DEFINE('TBL_RECIPIENT_ADDRESS','Recipient address');
DEFINE('TBL_BODY','Body');
DEFINE('TBL_SHIPMENT_TYPE','Shipment type');
DEFINE('TBL_REGISTERED_BY','Registered by');
DEFINE('TBL_UPDATED_BY','Updated by');
DEFINE('TBL_ACTION','Action');
DEFINE('TBL_NO_RESULTS','No results...');
DEFINE('TBL_HOW_MANY_TO_ADD','Enter how many items you want to add');
DEFINE('TBL_SENDER','Sender');
DEFINE('TBL_SUBJECT','Subject');
DEFINE('TBL_LAST_UPDATE','Last update');
DEFINE('TBL_STATUS','Status');
DEFINE('TBL_ME','Me');
DEFINE('TBL_NEW','New');
DEFINE('TBL_NO_NEW_MESSAGES','You have no messages');
DEFINE('TBL_MESSAGE','Message');
DEFINE('TBL_LOGIN','Login');
DEFINE('TBL_FIRST_NAME','First Name');
DEFINE('TBL_LAST_NAME','Last Name');

// Placeholders
DEFINE('PLH_CONTENT_OF_SENT_CORRESPONDENCE','The content of sent correspondence');
DEFINE('PLH_SEARCH','Search...');
DEFINE('PLH_HOW_MANY_ITEMS_TO_ADD','How many items you want to add? e.g.: 1 , 2 , 3 , 5... max. 99');
DEFINE('PLH_SENT_TO_FEW','Enter eg: sadmin, admin, jdoe to send to a few');
DEFINE('PLH_SEARCH_FOR_USER','Search for a user...');
DEFINE('PLH_ANSWER_HERE','You can answer on message here...');
DEFINE('PLH_SENT_DATE','Sent date');
DEFINE('PLH_RECIPIENT','Recipient');
DEFINE('PLH_RECIPIENT_ADDRESS','Recipient address');
DEFINE('PLH_LOGIN','Login');
DEFINE('PLH_FIRST_NAME','First name');
DEFINE('PLH_LAST_NAME','Last name');
DEFINE('PLH_EMAIL','E-mail');
DEFINE('PLH_PASSWORD','Password');
DEFINE('PLH_REPEAT_PASSWORD','Repeat password');
DEFINE('PLH_ENTER_LOGIN','Enter your login');
DEFINE('PLH_ENTER_PASSWORD','Enter your password');

// Alts
DEFINE('ALT_PROFILE_PHOTO','Profile photo');
DEFINE('ALT_AVATAR','Avatar');

?>
