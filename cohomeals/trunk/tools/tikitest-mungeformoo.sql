update users_users set hash=md5('joeyjodw') where login='admin';
update users_users set hash=md5('joeyjodw') where login='jkimdon';
update tiki_preferences set value='disabled' where name='https_login';
update tiki_preferences set value='' where name='https_port';
