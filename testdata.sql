--test data User
INSERT INTO User (lastName, firstName, username, password)
VALUES('Abbass', 'Cai', 'pinkurinal', 'hungry07');

INSERT INTO User (lastName, firstName, username, password)
VALUES('Edrosa', 'Raine', 'raineaway', 'hungry07');

--test data Calendar
INSERT INTO Calendar (calenName, calenColor, uID)
VALUES('Work', 'e4ad38', 1);

INSERT INTO Calendar (calenName, calenColor, uID)
VALUES('Personal', '611a2e', 1);

INSERT INTO Calendar (calenName, calenColor, uID)
VALUES('Startup', '270aa7', 1);

INSERT INTO Calendar (calenName, calenColor, uID)
VALUES('Work', 'e4ad38', 2);

INSERT INTO Calendar (calenName, calenColor, uID)
VALUES('Personal', '611a2e', 2);

--test data Events
INSERT INTO Event (eventName, allDay, dateStart, dateEnd, calenID)
VALUES('Client Meeting', 0, , '2015-04-20 13:30:00', 1);

INSERT INTO Event (eventName, allDay, dateStart, dateEnd, calenID)
VALUES('Process Monitoring', 0, '2015-04-20 13:30:00', '2015-04-19 15:00:00', 1);

INSERT INTO Event (eventName, allDay, dateStart, dateEnd, calenID)
VALUES('Weekly scrum meeting', 0, '2015-04-15 17:00:00', '2015-04-15 21:00:00', 1);

INSERT INTO Event (eventName, allDay, dateStart, dateEnd, calenID)
VALUES('Visit Dentist', 0, '2015-04-25 10:00:00', '2015-04-25 12:00:00', 2);

INSERT INTO Event (eventName, allDay, dateStart, dateEnd, calenID)
VALUES('Mom\'s Birthday', 1, '2015-04-05', '2015-04-05', 2);

INSERT INTO Event (eventName, allDay, dateStart, dateEnd, calenID)
VALUES('Techtalks on Product Management', 0, '2015-04-18 09:00:00', '2015-04-18 17:00:00', 3);

INSERT INTO Event (eventName, allDay, dateStart, dateEnd, calenID)
VALUES('Startup Bootcamp', 1, '2015-04-06', '2015-04-08', 3);

INSERT INTO Event (eventName, allDay, dateStart, dateEnd, calenID)
VALUES('Data Migration', 1, '2015-04-09', '2015-04-09', 4);

INSERT INTO Event (eventName, allDay, dateStart, dateEnd, calenID)
VALUES('Meeting with Developers', 0, '2015-04-13 09:00:00', '2015-04-13 10:00:00', 4);

INSERT INTO Event (eventName, allDay, dateStart, dateEnd, calenID)
VALUES('Monthly System Performance Evaluation', 0, '2015-04-06 14:00:00', '2015-04-06 18:00:00', 4);

INSERT INTO Event (eventName, allDay, dateStart, dateEnd, calenID)
VALUES('Dinner at Sally\'s', 0, '2015-04-25 20:00:00', '2015-04-25 23:00:00', 5);

INSERT INTO Event (eventName, allDay, dateStart, dateEnd, calenID)
VALUES('Salsa Night', 0, '2015-04-23 21:00:00', '2015-04-23 23:00:00', 5);
