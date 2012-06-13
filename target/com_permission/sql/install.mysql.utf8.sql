/**
 * @package		Permission!
 *  
 * Discuss! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */


CREATE TABLE IF NOT EXISTS tcl_permission(
id INT PRIMARY KEY AUTO_INCREMENT ,
name VARCHAR( 255 ) NOT NULL ,
isActive BOOLEAN DEFAULT 0 NOT NULL ,
created_at DATETIME NOT NULL ,
update_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE =  'innodb'


CREATE TABLE IF NOT EXISTS tcl_group(
id INT PRIMARY KEY AUTO_INCREMENT ,
name VARCHAR( 255 ) NOT NULL ,
isActive BOOLEAN DEFAULT 0 NOT NULL ,
created_at DATETIME NOT NULL ,
update_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE =  'innodb'

create table tlc_user_permission_Links(id int primary key auto_increment,
      user_id int ,constraint fk_user_id foreign key(user_id) references wlycz_users(id),permission_id int,
      constraint fk_permission_id foreign key(permission_id) references tcl_permission(id),
      group_id int,foreign key(group_id) references tcl_group(id),isActive BOOLEAN DEFAULT 0 NOT NULL ,
created_at DATETIME NOT NULL ,
update_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE =  'innodb'


create table tlc_group_permission_links(id int primary key auto_increment,
     permission_id int,
      constraint fk_permission_id_links foreign key(permission_id) references tcl_permission(id),
      group_id int,constraint  fk_group_id_links foreign key(group_id) references tcl_group(id),
      isActive BOOLEAN DEFAULT 0 NOT NULL ,
created_at DATETIME NOT NULL ,
update_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE =  'innodb'
