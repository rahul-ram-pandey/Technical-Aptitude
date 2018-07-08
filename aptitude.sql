-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2016 at 04:31 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `aptitude`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminlogin`
--

CREATE TABLE IF NOT EXISTS `adminlogin` (
  `admname` varchar(32) NOT NULL,
  `admpassword` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`admname`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`admname`, `admpassword`) VALUES
('root', 'root');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `feedback` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `username`, `feedback`) VALUES
(1, 'rahul', 'abcd'),
(2, '', ''),
(3, '', 'tytry'),
(4, '', 'tryry'),
(5, '', 'trytry'),
(6, '', 'trytry');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `subid` int(20) NOT NULL,
  `testid` bigint(20) NOT NULL DEFAULT '0',
  `qnid` int(11) NOT NULL DEFAULT '0',
  `question` varchar(500) DEFAULT NULL,
  `optiona` varchar(100) DEFAULT NULL,
  `optionb` varchar(100) DEFAULT NULL,
  `optionc` varchar(100) DEFAULT NULL,
  `optiond` varchar(100) DEFAULT NULL,
  `correctanswer` enum('optiona','optionb','optionc','optiond') DEFAULT NULL,
  `marks` int(11) DEFAULT NULL,
  PRIMARY KEY (`testid`,`qnid`),
  UNIQUE KEY `question` (`question`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`subid`, `testid`, `qnid`, `question`, `optiona`, `optionb`, `optionc`, `optiond`, `correctanswer`, `marks`) VALUES
(1, 1, 1, 'Which of the following type of class allows only one object of it to be created?', 'Virtual class', 'Abstract class', 'Singleton class', 'Friend class', 'optionc', 1),
(1, 1, 2, 'Which of the following is not a type of constructor?', 'Copy constructor 	', 'Friend constructor', 'Default constructor', 'Parameterized constructor', 'optionb', 1),
(1, 1, 3, 'Which of the following is not the member of class?\r\n	', 'Static function', 'Friend function', 'Const function', 'Virtual function', 'optionb', 1),
(1, 1, 4, 'Which of the following statements is correct?	', 'Base class pointer cannot point to derived class.', 'Derived class pointer cannot point to base class. ', 'Pointer to derived class cannot be created.', 'Pointer to base class cannot be created.', 'optionb', 1),
(1, 1, 5, 'Which of the following concepts means determining at runtime what method to invoke?\r\n', 'Data hiding', 'Dynamic Typing ', 'Dynamic binding', 'Dynamic loading', 'optionc', 1),
(4, 2, 1, 'You have 10 users plugged into a hub running 10Mbps half-duplex. There is a server connected to the switch running 10Mbps half-duplex as well. How much bandwidth does each host have to the server?\r\n', '100 kbps', '1 Mbps', '2 Mbps', '10 Mbps', 'optiond', 1),
(4, 2, 2, 'What command is used to create a backup configuration?\r\n\r\n', 'copy running backup', 'copy running-config startup-config', 'config mem', 'wr mem', 'optionb', 1),
(4, 2, 3, 'What are the two main types of access control lists (ACLs)?\r\nStandard\r\nIEEE\r\nExtended\r\nSpecialized\r\nAnswer: Option A', '1 and 3', '2 and 4', '3 and 4', '1 and 2', 'optiona', 1),
(4, 2, 4, 'What flavor of Network Address Translation can be used to have one IP address allow many users to connect to the global Internet?\r\n', 'NAT', 'Static', 'Dynamic', 'PAT', 'optiond', 1),
(4, 2, 5, 'How long is an IPv6 address?\r\n', '32 bits', '128 bytes', '64 bits', '128 bits', 'optiond', 1),
(1, 3, 1, 'Which of the following function prototype is perfectly acceptable?\r\n', 'int Function(int Tmp = Show());', 'float Function(int Tmp = Show(int, float));', 'Both A and B.', 'float = Show(int, float) Function(Tmp);', 'optiona', 1),
(1, 3, 2, 'Which of the following statement is correct?\r\n', 'C++ enables to define functions that take constants as an argument.', 'We cannot change the argument of the function that that are declared as constant.', 'Both A and B.', 'We cannot use the constant while defining the function.', 'optionc', 1),
(1, 3, 3, 'Which of the following statement will be correct if the function has three arguments passed to it?\r\n', 'The trailing argument will be the default argument.', 'The first argument will be the default argument.', 'The middle argument will be the default argument.', 'All the argument will be the default argument.', 'optiona', 1),
(1, 3, 4, 'Which of the following function / type of function cannot be overloaded?\r\n', 'Member function', 'Static function', 'Virtual function', 'Both B and C', 'optionc', 1),
(1, 3, 5, 'Which of the following function declaration is/are incorrect?\r\n', 'int Sum(int a, int b = 2, int c = 3);', 'int Sum(int a = 5, int b);', 'int Sum(int a = 0, int b, int c = 3);', 'Both B and C are incorrect.', 'optiond', 1),
(4, 4, 1, 'A receiving host has failed to receive all of the segments that it should acknowledge. What can the host do to improve the reliability of this communication session?\r\n', 'Send a different source port number.', 'Restart the virtual circuit.', 'Decrease the sequence number.', 'Decrease the window size.', 'optiond', 1),
(4, 4, 2, 'Why does the data communication industry use the layered OSI reference model?\r\nIt divides the network communication process into smaller and simpler components, thus aiding component development, design, and troubleshooting.\r\nIt enables equipment from different vendors to use the same electronic components, thus saving research and development funds.\r\nIt supports the evolution of multiple competing standards and thus provides business opportunities for equipment manufacturers.\r\nIt encourages ind', '1 only', '1 and 4', '2 and 3', '3 only', 'optionb', 1),
(4, 4, 3, 'Which of the following describe router functions?\r\n', 'Path selection', 'Packet switching', 'Internetwork communication', 'All of the above', 'optiond', 1),
(4, 4, 4, 'Routers operate at layer _____. LAN switches operate at layer _____. Ethernet hubs operate at layer _____. Word processing operates at layer _____.\r\n', '3, 3, 1, 7', '3, 2, 1, none', '3, 2, 1, 7', '3, 3, 2, none', 'optionb', 1),
(4, 4, 5, 'Which layer 1 devices can be used to enlarge the area covered by a single LAN segment?\r\nSwitch\r\nNIC\r\nHub\r\nRepeater\r\nRJ45 transceiver\r\n', '1 and 3', '1 only', '3 and 4', '5 only', 'optionc', 1),
(6, 5, 1, 'Which display devices allows us to walk around an object and view it from different sides.\r\n', ' Direct view storage tubes', 'Three-dimensional devices', 'Flat panel display devices', ' Plasma panel display devices', 'optionb', 1),
(6, 5, 2, ' The process of digitizing a given picture definition into a set of pixel-intensity for storage in the frame buffer is called\r\n', ' Rasterization', ' Encoding', ' Scan conversion', ' True color system', 'optionc', 1),
(6, 5, 3, 'In which system, the Shadow mask methods are commonly used\r\n', ' Raster-scan system', 'Random-scan system', 'Only b', ' Both a and b', 'optiona', 1),
(6, 6, 1, 'The devices which converts the electrical energy into light is called\r\n', ' Liquid-crystal displays', ' Non-emitters', ' Plasma panels', 'Emitters', 'optiond', 1),
(6, 6, 2, '________ stores the picture information as a charge distribution behind the phosphor-coated screen.\r\n', ' Cathode ray tube', 'Direct-view storage tube', ' Flat panel displays', ' 3D viewing device.', 'optionb', 1),
(6, 6, 3, ' The maximum number of points that can be displayed without overlap on a CRT is referred as\r\n', 'Picture', 'Resolution', 'Persistence', ' Neither b nor c', 'optionb', 1),
(5, 7, 1, 'An empty list is the one which has no\r\n\r\n', 'nodes', 'data', 'both a and b', 'address', 'optionc', 1),
(5, 7, 2, 'A ___________ tree is a tree where for each parent node, there is only one associated child node', 'balanced binary tree', 'rooted complete binary tree', 'complete binary tree', 'degenerate tree', 'optiond', 1),
(5, 7, 3, 'A binary tree of depth â€œdâ€ is an almost complete binary tree if', 'Each leaf in the tree is either at level â€œdâ€ or at level â€œdâ€“1â€', 'For any node â€œnâ€ in the tree with a right descendent at level â€œdâ€ all the left descendants o', 'Both a and b', 'None of the above', 'optionc', 1),
(5, 8, 1, ' The worst case of quick sort has order', 'O(n2)', 'O(n)', 'O (n log2 n)', 'O (log2 n)', 'optiona', 1),
(5, 8, 2, 'Which of the following sorting methods would be most suitable for sorting a list which is almost sorted?\r\n', 'Bubble Sort', 'Insertion Sort', 'Selection Sort', 'Quick Sort ', 'optiona', 1),
(5, 8, 3, 'You have to sort a list L consisting of a sorted list followed by a few â€œrandomâ€ elements. Which of the following sorting methods would be especially suitable for such a task?', 'Bubble sort', 'Selection sort', 'Quick sort', 'Insertion sort', 'optiond', 1),
(3, 9, 1, 'You can add a row using SQL in a database with which of the following?', 'ADD', 'CREATE', 'INSERT', 'MAKE', 'optionc', 1),
(3, 9, 2, '	\r\nThe SQL WHERE clause:\r\n', 'limits the column data that are returned.', 'limits the row data are returned.', 'Both A and B are correct.', 'Neither A nor B are correct.', 'optionb', 1),
(3, 9, 3, 'Which of the following is the original purpose of SQL?\r\n', 'To specify the syntax and semantics of SQL data definition language', 'To specify the syntax and semantics of SQL manipulation language', 'To define the data structures', 'All of the above.', 'optiond', 1),
(2, 10, 1, 'Which one of these lists contains only Java programming language keywords?\r\n', 'class, if, void, long, Int, continue', 'goto, instanceof, native, finally, default, throws', 'try, virtual, throw, final, volatile, transient', 'strictfp, constant, super, implements, do', 'optionb', 1),
(2, 10, 2, 'Which is a reserved word in the Java programming language?\r\n', 'method', 'native', 'subclasses', 'reference', 'optionb', 1),
(2, 10, 3, 'Which is a valid keyword in java?\r\n', 'interface', 'string', 'Float', 'unsigned', 'optiona', 1),
(2, 11, 1, '	\r\nWhat will be the output of the program?\r\npublic class Foo \r\n{  \r\n    public static void main(String[] args) \r\n    {\r\n        try \r\n        { \r\n            return; \r\n        } \r\n        finally \r\n        {\r\n            System.out.println( "Finally" ); \r\n        } \r\n    } \r\n}\r\n', 'Finally', 'Compilation fails.', 'The code runs with no output.', 'An exception is thrown at runtime.', 'optiona', 1),
(2, 11, 2, 'What will be the output of the program?\r\ntry \r\n{ \r\n    int x = 0; \r\n    int y = 5 / x; \r\n} \r\ncatch (Exception e) \r\n{\r\n    System.out.println("Exception"); \r\n} \r\ncatch (ArithmeticException ae) \r\n{\r\n    System.out.println(" Arithmetic Exception"); \r\n} \r\nSystem.out.println("finished");\r\n', 'finished', 'Exception', 'Compilation fails.', 'Arithmetic Exception', 'optionc', 1),
(2, 11, 3, '	\r\nWhat will be the output of the program?\r\npublic class X \r\n{  \r\n    public static void main(String [] args) \r\n    {\r\n        try \r\n        {\r\n            badMethod();  \r\n            System.out.print("A"); \r\n        }  \r\n        catch (Exception ex) \r\n        {\r\n            System.out.print("B");  \r\n        } \r\n        finally \r\n        {\r\n            System.out.print("C"); \r\n        } \r\n        System.out.print("D"); \r\n    }  \r\n    public static void badMethod() \r\n    {\r\n        throw new Erro', 'ABCD', 'Compilation fails.', 'C is printed before exiting with an error message.', 'BC is printed before exiting with an error message.', 'optionc', 1),
(7, 12, 1, ' From the following which quality deals with maintaining the quality of the software product?', 'Quality assurance', 'Quality control ', 'Quality efficiency', 'None of the above', 'optionb', 1),
(7, 12, 2, 'Software project manager is engaged with software management activities. He is responsible for ______ .', 'Project planning.', 'Monitoring the progress', 'Communication among stakeholders', 'All mentioned above ', 'optiond', 1),
(7, 12, 3, 'Classes communicate with one another via ______ .', 'Read sensors', 'Dial phones', 'Messages ', 'None of the above', 'optionc', 1);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `stdid` bigint(20) NOT NULL,
  `stdname` varchar(40) DEFAULT NULL,
  `stdpassword` varchar(40) DEFAULT NULL,
  `emailid` varchar(40) DEFAULT NULL,
  `contactno` varchar(20) DEFAULT NULL,
  `address` varchar(40) DEFAULT NULL,
  `city` varchar(40) DEFAULT NULL,
  `pincode` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`stdid`),
  UNIQUE KEY `stdname` (`stdname`),
  UNIQUE KEY `emailid` (`emailid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`stdid`, `stdname`, `stdpassword`, `emailid`, `contactno`, `address`, `city`, `pincode`) VALUES
(1, 'rahul', '12345678', 'rahul.f444@gmail.com', '1234567890', 'qwerty', 'mumbai', '400001'),
(2, 'rahul1', '12345678', 'rahu.f444@gmail.com', '9821061078', 'perin nariman street\r\n190 ambani niwas 4', 'mumbai', '400001'),
(3, 'rah', '12345678', 'rahul.f444@ghgj.fdg', '0982106107', 'perin nariman street\r\n190 ambani niwas 4', 'mumbai', '400001'),
(4, 'asdf', 'asdfasdf', 'asdf@asdf.asdf', '1234576890', 'dasf', 'adsf', '123456'),
(5, 'abc', 'f3b824b12593b0f51672e306ae05e7fa', 'jsayed80@gmail.com', '9188334499', 'vashi', 'navimumbai', '400709');

-- --------------------------------------------------------

--
-- Table structure for table `studentquestion`
--

CREATE TABLE IF NOT EXISTS `studentquestion` (
  `stdid` bigint(20) NOT NULL DEFAULT '0',
  `testid` bigint(20) NOT NULL DEFAULT '0',
  `qnid` int(11) NOT NULL DEFAULT '0',
  `answered` enum('answered','unanswered','review') DEFAULT NULL,
  `stdanswer` enum('optiona','optionb','optionc','optiond') DEFAULT NULL,
  PRIMARY KEY (`stdid`,`testid`,`qnid`),
  KEY `testid` (`testid`,`qnid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `studenttest`
--

CREATE TABLE IF NOT EXISTS `studenttest` (
  `stdid` bigint(20) NOT NULL DEFAULT '0',
  `testid` bigint(20) NOT NULL DEFAULT '0',
  `starttime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `endtime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `correctlyanswered` int(11) DEFAULT NULL,
  `status` enum('over','inprogress') DEFAULT NULL,
  PRIMARY KEY (`stdid`,`testid`),
  KEY `testid` (`testid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `subid` int(10) NOT NULL,
  `name` varchar(30) NOT NULL,
  `sdesc` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  PRIMARY KEY (`subid`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subid`, `name`, `sdesc`, `image`) VALUES
(1, 'C++', 'Basic OOPS concept', 'c++.png'),
(2, 'Java', 'Language Fundamentals', 'java.png'),
(3, 'DBMS', 'SQL', 'dbms.jpg'),
(4, 'Computer Networks', 'Networking & Internetworking', 'cn.jpg'),
(5, 'Data Structures', 'Sorting', 'ds.jpg'),
(6, 'Computer Graphics', 'Basics', 'cg.png'),
(7, 'Software Engineering', 'Basics', 'se.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE IF NOT EXISTS `test` (
  `testid` bigint(20) NOT NULL,
  `subid` int(20) DEFAULT NULL,
  `testname` varchar(30) NOT NULL,
  `testdesc` varchar(100) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `totalquestions` int(11) DEFAULT NULL,
  `attemptedstudents` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`testid`),
  UNIQUE KEY `testname` (`testname`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`testid`, `subid`, `testname`, `testdesc`, `duration`, `totalquestions`, `attemptedstudents`) VALUES
(1, 1, 'OOPS Concept', 'Basics', 25, 5, 0),
(2, 4, 'Networking Basics', 'Basics', 2, 5, 0),
(3, 1, 'Functions', 'Basics', 2, 5, 0),
(4, 4, 'Internetworking', 'Basics', 2, 5, 0),
(5, 6, 'Set 1', 'Basics', 2, 3, 0),
(6, 6, 'Set 2', 'Basics', 2, 3, 0),
(7, 5, 'Tree', 'Basics', 2, 3, 0),
(8, 5, 'Sorting', 'Basics', 2, 3, 0),
(9, 3, 'SQL', 'Basics', 2, 3, 0),
(10, 2, 'Language Fundamentals', 'Basics', 2, 3, 0),
(11, 2, 'Exception', 'Basics', 2, 3, 0),
(12, 7, 'Basics', 'Basics', 2, 3, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
