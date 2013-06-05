-- User table:
CREATE TABLE wa_users
(
  user_id serial NOT NULL,
  username character varying(60),
  email character varying(60),
  pass character(40) NOT NULL,
  reg_date timestamp without time zone NOT NULL DEFAULT now(),
  user_role character(1) DEFAULT 0,
  CONSTRAINT wa_users_pkey PRIMARY KEY (user_id)
)

-- Table of the a storyboard:
CREATE TABLE wa_storyboards 
(
	id serial not null,
	name character varying(30),
	description character varying(160),
	private boolean DEFAULT false,	
	creation_date timestamp without time zone NOT NULL DEFAULT now(),
	
)

-- Ownership of storyboards:

CREATE TABLE wa_ownership
(
	uid integer NOT NULL default '0',
	bid integer NOT NULL default '0',
	PRIMARY KEY (uid, bid)
)

-- Storypages: contined inside a storyboard:
CREATE TABLE wa_storypage
(
	parrent_id integer NOT NULL,
	page_number integer NOT NULL,
	link varchar(150),
	PRIMARY KEY (parrent_id, page_number)
)
