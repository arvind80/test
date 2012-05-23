SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for records
-- ----------------------------
CREATE TABLE `records` (
  `recordID` int(11) NOT NULL auto_increment,
  `recordText` varchar(255) default NULL,
  `recordListingID` int(11) default NULL,
  PRIMARY KEY  (`recordID`)
);

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `records` VALUES ('1', 'Once dropped, an Ajax query is activated', '3');
INSERT INTO `records` VALUES ('2', 'Dragging changes the opacity of the item', '2');
INSERT INTO `records` VALUES ('3', 'Returned array can be found at the right', '1');
INSERT INTO `records` VALUES ('4', 'It is very very easy', '4');
