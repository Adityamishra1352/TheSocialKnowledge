-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2023 at 10:22 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thesocialknowledge`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminusers`
--

CREATE TABLE `adminusers` (
  `sno` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `enrollment` varchar(255) NOT NULL,
  `batch` varchar(255) NOT NULL,
  `year` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adminusers`
--

INSERT INTO `adminusers` (`sno`, `email`, `enrollment`, `batch`, `year`) VALUES
(266, '201b001@juetguna.in', '201b001', 'b1', '2020'),
(267, '201b002@juetguna.in', '201b002', 'b1', '2020'),
(268, '201b003@juetguna.in', '201b003', 'b1', '2020'),
(269, '201b004@juetguna.in', '201b004', 'b1', '2020'),
(270, '201b005@juetguna.in', '201b005', 'b1', '2020'),
(271, '201b006@juetguna.in', '201b006', 'b1', '2020'),
(272, '201b007@juetguna.in', '201b007', 'b1', '2020'),
(273, '201b008@juetguna.in', '201b008', 'b1', '2020'),
(274, '201b009@juetguna.in', '201b009', 'b1', '2020'),
(275, '201b010@juetguna.in', '201b010', 'b1', '2020'),
(276, '201b011@juetguna.in', '201b011', 'b1', '2020'),
(277, '201b012@juetguna.in', '201b012', 'b1', '2020'),
(278, '201b013@juetguna.in', '201b013', 'b1', '2020'),
(279, '201b014@juetguna.in', '201b014', 'b1', '2020'),
(280, '201b015@juetguna.in', '201b015', 'b1', '2020'),
(281, '201b016@juetguna.in', '201b016', 'b1', '2020'),
(282, '201b017@juetguna.in', '201b017', 'b1', '2020'),
(283, '201b018@juetguna.in', '201b018', 'b1', '2020'),
(284, '201b019@juetguna.in', '201b019', 'b1', '2020'),
(285, '201b020@juetguna.in', '201b020', 'b1', '2020'),
(286, '201b021@juetguna.in', '201b021', 'b1', '2020'),
(287, '201b022@juetguna.in', '201b022', 'b1', '2020'),
(288, '201b023@juetguna.in', '201b023', 'b1', '2020'),
(289, '201b024@juetguna.in', '201b024', 'b1', '2020'),
(290, '201b025@juetguna.in', '201b025', 'b1', '2020'),
(291, '201b026@juetguna.in', '201b026', 'b1', '2020'),
(292, '201b027@juetguna.in', '201b027', 'b1', '2020'),
(293, '201b028@juetguna.in', '201b028', 'b1', '2020'),
(294, '201b029@juetguna.in', '201b029', 'b1', '2020'),
(295, '201b030@juetguna.in', '201b030', 'b1', '2020'),
(296, '201b031@juetguna.in', '201b031', 'b1', '2020'),
(297, '201b032@juetguna.in', '201b032', 'b1', '2020'),
(298, 'mishra.aditya1352@gmail.com', '999999', 'b1', '2020');

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

CREATE TABLE `certificates` (
  `certificate_id` int(11) NOT NULL,
  `certificate_formating` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `certificates`
--

INSERT INTO `certificates` (`certificate_id`, `certificate_formating`, `user_id`, `test_id`, `score`, `time`) VALUES
(1, 'SK11001', 0, 0, 0, '2023-10-12 12:36:14'),
(30, 'SK11001', 0, 0, 0, '2023-10-12 12:36:35'),
(33, 'SK1231', 25, 12, 4, '2023-10-12 12:47:17'),
(34, 'SK1134', 25, 11, 11, '2023-10-12 15:27:25'),
(35, 'SK1335', 27, 13, 11, '2023-10-13 02:07:13'),
(36, 'SK1136', 28, 11, 13, '2023-10-13 21:25:50'),
(37, 'SK1237', 28, 12, 8, '2023-10-13 21:26:33'),
(38, 'SK1438', 28, 14, 9, '2023-10-13 21:28:25');

-- --------------------------------------------------------

--
-- Table structure for table `chatbot`
--

CREATE TABLE `chatbot` (
  `sno` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `codinganswers`
--

CREATE TABLE `codinganswers` (
  `answer_id` int(11) NOT NULL,
  `question_id` longtext NOT NULL,
  `user_id` int(11) NOT NULL,
  `filename` longtext NOT NULL,
  `correct` tinyint(1) NOT NULL,
  `test_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `codinganswers`
--

INSERT INTO `codinganswers` (`answer_id`, `question_id`, `user_id`, `filename`, `correct`, `test_id`, `date`) VALUES
(29, '[\"13\"]', 43, '[\"answers/13php6f93baa.php\"]', 1, 8, '2023-11-20 04:27:33');

-- --------------------------------------------------------

--
-- Table structure for table `codingquestions`
--

CREATE TABLE `codingquestions` (
  `code_id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `inputOutput` longtext NOT NULL,
  `test_id` int(11) NOT NULL,
  `organiser_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `codingquestions`
--

INSERT INTO `codingquestions` (`code_id`, `question`, `inputOutput`, `test_id`, `organiser_id`) VALUES
(1, ' Hii i am aditya mishra ', '[{\"input\":\"dsa\",\"expected_output\":\"ads\"},{\"input\":\"ads\",\"expected_output\":\"das\"},{\"input\":\"ads\",\"expected_output\":\"asd\"}]', 7, 44),
(4, 'Write a program to add two numbers', '[{\"input\":\"1,2\",\"expected_output\":\"3\"},{\"input\":\"3,5\",\"expected_output\":\"8\"}]', 6, 43),
(5, 'Write a program to subtract two numbers', '[{\"input\":\"5,2\",\"expected_output\":\"3\"},{\"input\":\"1,2\",\"expected_output\":\"-1\"},{\"input\":\"6,0\",\"expected_output\":\"6\"}]', 6, 43),
(7, 'Write a program to multiply two number', '[{\"input\":\"4,5\",\"expected_output\":\"20\"},{\"input\":\"3,2\",\"expected_output\":\"6\"}]', 6, 43),
(8, 'Write a program to add two numbers.', '[{\"input\":\"5,8\",\"expected_output\":\"13\"},{\"input\":\"5,6\",\"expected_output\":\"11\"},{\"input\":\"9,1\",\"expected_output\":\"10\"}]', 8, 43),
(9, 'Write a program to subtract two numbers.', '[{\"input\":\"5,1\",\"expected_output\":\"4\"},{\"input\":\"9,1\",\"expected_output\":\"8\"},{\"input\":\"7,6\",\"expected_output\":\"1\"}]', 8, 43),
(10, 'Write a program to multiply two numbers', '[{\"input\":\"5,6\",\"expected_output\":\"30\"},{\"input\":\"2,4\",\"expected_output\":\"8\"}]', 8, 43),
(11, 'Concatenate two strings together', '[{\"input\":\"aditya, mishra\",\"expected_output\":\"aditya mishra\"}]', 8, 43),
(13, 'Write a program to divide two numbers', '[{\"input\":\"2,2\",\"expected_output\":\"1\"},{\"input\":\"4,2\",\"expected_output\":\"2\"},{\"input\":\"9,3\",\"expected_output\":\"3\"}]', 8, 43);

-- --------------------------------------------------------

--
-- Table structure for table `codingtest`
--

CREATE TABLE `codingtest` (
  `test_id` int(11) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `timefortest` int(11) NOT NULL,
  `heldfrom` datetime NOT NULL,
  `heldtill` datetime NOT NULL,
  `usersfortest` longtext NOT NULL,
  `organiser_id` int(11) NOT NULL,
  `displayed` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `codingtest`
--

INSERT INTO `codingtest` (`test_id`, `heading`, `description`, `timefortest`, `heldfrom`, `heldtill`, `usersfortest`, `organiser_id`, `displayed`) VALUES
(6, 'C++ programming', 'Hii this is the first test', 10, '2023-11-01 09:43:00', '2023-11-30 09:43:00', '', 43, 0),
(7, 'JavaScript Programming', 'Hii this is the second test', 10, '2023-11-01 10:19:00', '2023-11-30 10:19:00', '', 44, 0),
(8, 'PHP programming', 'This is the third test', 40, '2023-11-15 08:54:00', '2023-11-30 08:54:00', '', 43, 0),
(9, 'PHP Programming', 'php test', 10, '2023-11-13 09:54:00', '2023-11-22 09:54:00', '', 43, 0);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp(),
  `displayed` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `heading`, `description`, `timestamp`, `displayed`) VALUES
(1, 'C++ Programming', 'C++ is a cross-platform language that can be used to create high-performance applications. ', '2023-09-30 14:15:49', 1),
(2, 'JavaScript', 'JavaScript, often abbreviated as JS, is a programming language that is one of the core technologies of the World Wide Web, alongside HTML and CSS.', '2023-10-08 14:04:31', 1);

-- --------------------------------------------------------

--
-- Table structure for table `course_content`
--

CREATE TABLE `course_content` (
  `page_id` int(11) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `course_id` int(11) NOT NULL,
  `page_no` int(11) NOT NULL,
  `nav_content` varchar(255) NOT NULL,
  `displayed` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_content`
--

INSERT INTO `course_content` (`page_id`, `heading`, `description`, `course_id`, `page_no`, `nav_content`, `displayed`) VALUES
(1, 'Introduction to C++', '<h2>Benefits of C++ over C language:</h2>\r\n                <p>The major difference being OOPS concept, C++ is an object oriented language whereas C is a procedural language. <br>\r\n                    Apart form this there are many other features of C++ which gives this language an upper hand on C laguage.</p>\r\n                <h2>Features which makes C++ stronger than C:</h2>\r\n                <ul>\r\n                    <li>There is Stronger Type Checking in C++.</li>\r\n                   <li> All the OOPS features in C++ like Abstraction, Encapsulation, Inheritance etc makes it more worthy and useful for programmers.</li>\r\n                    <li>C++ supports and allows user defined operators (i.e Operator Overloading) and function overloading is also supported in it.</li>\r\n                    <li>Exception Handling is there in C++.</li>\r\n                    <li>The Concept of Virtual functions and also Constructors and Destructors for Objects.</li>\r\n                    <li>Inline Functions in C++ instead of Macros in C language. Inline functions make complete function body act like Macro, safely</li>\r\n                    <li>Variables can be declared anywhere in the program in C++, but must be declared before they are used.</li>\r\n                </ul>', 1, 1, 'Introduction', 1),
(2, 'THE SYNTAX OF C++', '<section class=\"intro\">\r\n                <ul>PARTS OF BASIC CODE\r\n                    <br></br>\r\n                <li>The header file tells the complier to import all the functions associated with the title specified in the given line. </li>\r\n                 <li>The second line specifies that we can use names for variables and objects from the library.</li>   \r\n                <li>Then there is the main function which contains all the code details and the execution begins here.</li>\r\n                <li>The last line return 0 terminates the code.</li>\r\n                <li>Function name always ends with () and function befins with \'{\' and ends with \'}\'</li>\r\n                <li>:: in namespace std means the scope resolution operator.</li>\r\n                </ul>\r\n            </section>\r\n            <section>\r\n                \r\n            <br></br>\r\n                <h2>PARTS OF main():</h2>\r\n                <p>There are many parts of the main function which are as follows:</p>\r\n                \r\n                <ul>\r\n                    <li>Declaration of variables: The variables to be used are declared in the starting of the code for convinence but they can be declared anywhere within the program, the only condition being that before use it should be declared. </li>\r\n                    <br></br>\r\n                    <li>Input statements: Input is always taken from cin function which comes under iostream library. </li>\r\n                    <br></br>\r\n                    <li> Output statments: Output is always given from cout function which also comes under iostream library.</li>\r\n                    <br></br>\r\n                    <li>There are two parts of the main function: declaration part and the executable part.</li>\r\n                    <br></br>\r\n                    <li> Under the executable part comes the lines of code written to manipute and get the desired output.</li>\r\n                    <br></br>\r\n                    <li>There are 2 types of comments in the c++ i.e., single line and multiline comments.</li>\r\n                    <br></br>\r\n                    <li>return 0 is used at the end of the main function to terminate the function .</li>\r\n                </ul>', 1, 2, 'C++:Syntax', 1),
(3, 'C++ Output', '<span>\r\n                The cout object, together with the << operator, is used to output values/print text:\r\n            <br></span>', 1, 3, 'C++: Output', 1),
(4, 'Datatypes in C++', '<ul>\r\n                 Datatypes or variables are the named memory locations in the code.These are used to store any value that the user provides or the programmer wishes to enter when the code is created.Its values can be changes n number of times and can be reused.\r\n                    <br><br>\r\n                    <h3>Rules for defining a variable:</h3>\r\n                    <br>\r\n                    <li>A variable csn only contain an alphabet, number and underscore. No special characters can be included in variable name.</li>\r\n                    <br>\r\n                <li>A variable must start with an alphabet or an underscore.</li>\r\n                <br>\r\n                <li>It cannot start with a digit but it can be followed by one.</li>\r\n                <br>\r\n                <li>A variable cannot be a reserved word or a keyword.</li>\r\n                </ul><h3>Types of variables:</h3>\r\n                <p>There are seven types of variables in particular:</p>\r\n                \r\n                <ul>\r\n                    <li>int:  Used to store integer variables. Its has asize of 2 or 4 bytes.</li>\r\n                    <br>\r\n                    <li>bool: Used to store only two values i.e., trueor false. It has a size of 1 byte.</li>\r\n                    <br>\r\n                    <li>char: Used to store a single character. The character can be alrttrt, number, ASCII value. It has a size of 1 byte.</li>\r\n                    <br>\r\n                    <li>float:It stores fractional numbers with one or mare decimals.It can store a max of 7 decimal digits. It has a size of 4 bytes.</li>\r\n                    <br>\r\n                    <li>double:It is used to store values with decimal upto 14 decimal digits. It has a size of 8 bytes.</li>\r\n                    \r\n                </ul>\r\n                <br>\r\n                <h4>THERE ARE VARIOUS DERIVED VARIABLES TOO</h4>\r\n                <ul>\r\n                    <li>Array</li>\r\n                    <li>Strings</li>\r\n                    <li>Functions</li>\r\n                    <li>Pointers</li>\r\n                </ul>', 1, 4, 'C++: Variables', 1),
(5, 'C++ User Input', '<span>\r\n                cin is a predefined variable that reads data from the keyboard with the extraction operator (>>).\r\n                <br>\r\n                In the following example, the user can input a number, which is stored in the variable x. Then we print the value of x:\r\n            <br></span>', 1, 5, 'C++: User Input', 1),
(6, 'Operators in C++', '<ul>\r\n                    Operators are the symbols that perform operations on operands.\r\n                    <h2>Types of operators:</h2>\r\n                    <br>\r\n                <li>Airthematic operators: Operators that perform airthmatic operations.\r\n                    <br> There are three types of airthmatic operations:<ul>\r\n                        <br>\r\n                         <li>Unary operators: operators which require to work upon.There are two types of unary operators<ol>\r\n                            <br>\r\n                               <li>Postfix: Here firstly the value of a variable is used then changed(eg.- a++).</li>\r\n                               <li>Prefix: Here firstly the value of the variable is changed then used(eg.- ++a).</li>\r\n                        </ol></li>\r\n                        <br>\r\n                         <li>Binary operators: Here the operators require two operands to work on. <br>Eg.: +,_.*,/,>, etc\r\n                        <ul>\r\n                            <li>a + b  </li>\r\n                                <li> a - b \r\n                                    </li>\r\n                                <li>a * b\r\n                                    </li>\r\n                                <li>a / b \r\n                                    </li>\r\n                                <li>a % b</li>\r\n                        </ul></li> \r\n                        <br>\r\n                         <li>Ternary Operators: Here the operators require three operands to work upon. <br>Eg.: ?,:</li> </ul></li>\r\n                         <br>\r\n                <li>Assignment Operators: These are used to assign values to the operands.\r\n                    <br>Eg.:+=,-=, etc\r\n                <br>\r\n            <ul>\r\n                <li> a += b</li>\r\n            </ul></li>\r\n                    <br>\r\n                <li>Bitwise Operators: These operators works on bits.These are of three types:\r\n                    <ol>\r\n                        <li>BITWISE And(&)</li>\r\n                        <li>BITWISE Or(|)</li>\r\n                        <li>BITWISE XOR(^)</li>\r\n                    </ol>\r\n                </li>\r\n                <br>\r\n                <li>Shift Operator: These are used to shift he values of the operands.\r\n                    <br>There are three types of shift operators:<br>\r\n                    <ul>\r\n                        <li>Left Shift</li>\r\n                        <li>Right Shift</li>\r\n                        <li>Unsigned Shift</li>\r\n                    </ul>\r\n                </li>\r\n                </ul>', 1, 6, 'C++: Operators', 1),
(7, 'Datatypes in C++', '<span>In C++, data types are declarations for variables. This determines the type and size of data associated with variables.</span>\r\n                <br>\r\n                <section class=\"code\">\r\n                    <span>int x=90;</span>\r\n                </section>\r\n                <h3>Different Datatypes in C++:</h3>\r\n                <ol>\r\n            <li class=\"mains\"><span>C++:int:</span>\r\n                <ul>\r\n                    <li>The int keyword is used to indicate integers.</li>\r\n                    <li>Its size is usually 4 bytes(i.e.  it can store values from -2147483648 to 2147483647.).</li>\r\n                    <li>For Example:\r\n                        <section class=\"code\">\r\n                            int x=3409;\r\n                        </section>\r\n                    </li>\r\n                </ul>\r\n            </li>\r\n            <li class=\"mains\"><span>C++:Float and Double:</span>\r\n                <ul>\r\n                    <li>float and double are used to store floating-point numbers (decimals and exponentials).</li>                    \r\n                    <li>The size of float is 4 bytes and the size of double is 8 bytes. Hence, double has two times the precision of float. To learn more, visit C++ float and double.</li>\r\n                        <li>For example,</li>\r\n                        <section class=\"code\">\r\n                            float area = 64.74;\r\n                        double volume = 134.64534;\r\n                        </section>\r\n                </ul>\r\n            </li>  \r\n            <li class=\"mains\"><span>C++:char:</span>\r\n                <ul>\r\n                    <li>Keyword char is used for characters.</li>\r\n                        <li>Its size is 1 byte.\r\n                            Characters in C++ are enclosed inside single quotes \' \'.</li>\r\n                        <li>For example,</li>\r\n                        <section class=\"code\">char test = \'h\';</section>\r\n                </ul>\r\n            </li>\r\n            <li class=\"mains\"><span>C++:bool:</span>\r\n                <ul>\r\n                    <li>The bool data type has one of two possible values: true or false.</li>\r\n                        <li>Booleans are used in conditional statements and loops (which we will learn in later chapters).</li>\r\n                        <li>For example,</li>\r\n                        <section class=\"code\">bool cond = false;</section>\r\n                </ul>\r\n            </li>\r\n            <li class=\"mains\"><span>C++:void:</span>\r\n                <ul>\r\n                    <li>The void keyword indicates an absence of data. It means \"nothing\" or \"no value\".</li>\r\n                </ul>\r\n            </li>\r\n            <h1>C++:Modifiers:</h1>\r\n            <span>We can further modify int, char and double data types by using type modifiers. <br> There are 4 type modifiers in C++. <br> They are:\r\n                <ol>\r\n                <li>signed</li>\r\n                <li>unsigned</li>\r\n                <li>short</li>\r\n                <li>long</li>\r\n                </ol> \r\n                <h1>Derived Data Types:</h1>\r\n            <span>Data types that are derived from fundamental data types are derived types. <br> For example: arrays, pointers, function types, structures, etc.</span>', 1, 7, 'C++: Datatypes', 1),
(8, 'Strings in C++', '<section class=\"intro\">\r\n                <ul>\r\n                   <h4>Introduction to strings:</h4> \r\n                  <p>It refers to group of characters enclosed within double quotes.Strings are used to create immutable objects.\r\n                    Immutable means its value cannot be changes once initialized.\r\n                  </p>\r\n                  <h4>DECLARATION OF strings:</h4>\r\n                  <p>There are two types of declarations of strings in C++: C CHARACTER TYPE and the C++ String class </p>\r\n                <li>string s=\"ABC\";</li>\r\n                <br>\r\n                <li>char s[]={\'A\',\'B\',\'C\'};</li>\r\n                <br>\r\n                <li>char s[]=\"ABC\";</li>\r\n                </ul>\r\n            </section>\r\n            <section>\r\n                \r\n                <h2>Functions of strings:</h2>\r\n                \r\n                <ul>\r\n                    <li>strcpy(s1.s2): This function copies the content of string s2 into string s1.</li>\r\n                    <br>\r\n                    <li>strlen(s):     This function returns the length of string s.</li>\r\n                    <br>\r\n                    <li>strcat(s1,s2): This function concatenates the content of string s2 onto string s1.  </li>\r\n                    <br>\r\n                    <li>strstr(s1,s2): It returns the pointer to the first occurance of string s2 in string s1.</li>\r\n                    <br>\r\n                    <li>getline():     Here the characters are entered by the user.</li>\r\n                    <br>\r\n                    <li>resize():      This function changes the size of the string as per desired.</li>\r\n                    <br>\r\n                    <li>swap():        This function swaps the contents of two strings.</li>\r\n                    <br>\r\n                    <li>push_back():   This adds a character at the end of the string.</li>\r\n                    <br>\r\n                    <li>pop_back():    This deletes a character from the end of the string. This was introduced from C++11.</li>\r\n                </ul>', 1, 8, 'C++: Strings', 1),
(9, 'C++:Math', '<section class=\"intro\">\r\n                    <span>C++ offers some basic math functions and the required header file to use these functions is <<x>math.h>.</span>\r\n                    <br>\r\n                    <h3>Max and min</h3>\r\n                    <span>The <i>max(x,y)</i> function can be used to find the highest value of x and y:</span>\r\n                    <section class=\"code\">\r\n                        cout << max(5, 10);\r\n                    </section>\r\n                    <span>And the <i>min(x,y)</i> function can be used to find the lowest value of x and y:</span>\r\n                    <section class=\"code\">\r\n                        cout << min(5, 10);\r\n                    </section>\r\n                    <h3>C++ <<x>cmath> Header</h3>\r\n                    <ol>\r\n                <li class=\"mains\">\r\n                    <span>abs(x)</span>\r\n                    <ul>\r\n                        <li>Returns the absolute value of x</li>\r\n                    </ul>\r\n                </li>\r\n                <br>\r\n                <li class=\"mains\">\r\n                    <span>acos(x)</span>\r\n                    <ul>\r\n                        <li>Returns the arccosine of x</li>                    \r\n                    </ul>\r\n                </li>\r\n                <br>  \r\n                <li class=\"mains\">\r\n                    <span>asin(x)</span>\r\n                    <ul>\r\n                        <li>Returns the arcsine of x</li>\r\n                    </ul>\r\n                </li>\r\n                <br>\r\n                <li class=\"mains\">\r\n                    <span>atan(x)</span>\r\n                    <ul>\r\n                        <li>Returns the arctangent of x</li>\r\n                    </ul>\r\n                </li>\r\n                <br>\r\n                <li class=\"mains\">\r\n                    <span>cbrt(x)</span>\r\n                    <ul>\r\n                        <li>Returns the cube root of x</li>\r\n                    </ul>\r\n                </li>\r\n                <br>\r\n                <li class=\"mains\">\r\n                    <span>ceil(x)</span>\r\n                    <ul>\r\n                        <li>Returns the value of x rounded up to its nearest integer</li>\r\n                    </ul>\r\n                </li>\r\n                <br>\r\n                <li class=\"mains\">\r\n                    <span>cos(x)</span>\r\n                    <ul>\r\n                        <li>Returns the cosine of x</li>\r\n                    </ul>\r\n                </li>\r\n                <br>\r\n                <li class=\"mains\">\r\n                    <span>cosh(x)</span>\r\n                    <ul>\r\n                        <li>Returns the hyperbolic cosine of x</li>\r\n                    </ul>\r\n                </li>\r\n                <br>\r\n                <li class=\"mains\">\r\n                    <span>exp(x)</span>\r\n                    <ul>\r\n                        <li>Returns the value of E*</li>\r\n                    </ul>\r\n                </li>\r\n                <br>\r\n                <li class=\"mains\">\r\n                    <span>expm1(x)</span>\r\n                    <ul>\r\n                        <li>Return e*-1</li>\r\n                    </ul>\r\n                </li>\r\n                <br>\r\n                <li class=\"mains\">\r\n                    <span>fabs(x)</span>\r\n                    <ul>\r\n                        <li>Returns the absolute value of a floating x</li>\r\n                    </ul>\r\n                </li>\r\n                <br>\r\n                <li class=\"mains\">\r\n                    <span>fdim(x,y)</span>\r\n                    <ul>\r\n                        <li>Returns the positive difference between x and y</li>\r\n                    </ul>\r\n                </li>\r\n                <br>\r\n                <li class=\"mains\">\r\n                    <span>floor(x)</span>\r\n                    <ul>\r\n                        <li>Returns the value of x rounded down to its nearest integer</li>\r\n                    </ul>\r\n                </li>\r\n                <br>\r\n                <li class=\"mains\">\r\n                    <span>hypot(x,y)</span>\r\n                    <ul>\r\n                        <li>Return the sqrt(x*x+y*y) without intermediate overflow or underflow</li>\r\n                    </ul>\r\n                </li>\r\n                <br>\r\n                <li class=\"mains\">\r\n                    <span>fma(x,y,z)</span>\r\n                    <ul>\r\n                        <li>Returns x*y+z with losing precision</li>\r\n                    </ul>\r\n                </li>\r\n                <br>\r\n                <li class=\"mains\">\r\n                    <span>fmax(x,y)</span>\r\n                    <ul>\r\n                        <li>Returns the highest value of a floating x and y</li>\r\n                    </ul>\r\n                </li>\r\n                <br>\r\n                <li class=\"mains\">\r\n                    <span>fmin(x,y)</span>\r\n                    <ul>\r\n                        <li>Returns the lowest value of a floating x and y</li>\r\n                    </ul>\r\n                </li>\r\n                <br>\r\n                <li class=\"mains\">\r\n                    <span>fmod(x,y)</span>\r\n                    <ul>\r\n                        <li>Returns the floating point remainder of x/y</li>\r\n                    </ul>\r\n                </li>\r\n                <br>\r\n                <li class=\"mains\">\r\n                    <span>pow(x,y)</span>\r\n                    <ul>\r\n                        <li>Returns the value x to the power of y</li>\r\n                    </ul>\r\n                </li>\r\n                <br>\r\n                <li class=\"mains\">\r\n                    <span>sin(x)</span>\r\n                    <ul>\r\n                        <li>Returns the sine of x</li>\r\n                    </ul>\r\n                </li>\r\n                <br>\r\n                <li class=\"mains\">\r\n                    <span>sinh(x)</span>\r\n                    <ul>\r\n                        <li>Returns the hyperbolic sine of a doubke value</li>\r\n                    </ul>\r\n                </li>\r\n                <br>\r\n            </ol></section>', 1, 9, 'C++: Math', 1),
(10, 'Booleans in C++', '<section class=\"intro\">\r\n                <ul>\r\n                     C++ booleans refers to only two values true/false. When we want an answer in only yes/no or right/wrong then we use bools.\r\n                    <br><br><br>\r\n                    <h2>Booleans values</h2>\r\n                    <p>There are only two booleans values:</p>\r\n                <li>true:  This means when the answer is in favour of the condition mentioned.</li>\r\n                <li>false: This refers to when the answer is not in the favour of the mentioned condition.</li>\r\n                <br><br>\r\n                <section class=\"code\">\r\n                    <p>#include <<x>iostream>\r\n                        <br>\r\n                        using namespace std;\r\n                        <br>\r\n                        int main() <br>\r\n                        {\r\n                        <br>\r\n                        bool b1 = true; <br>\r\n                        bool b2 = false; <br>\r\n                        <br>\r\n                        cout << b1 <<\" , \"<< b2;\r\n                        <br>\r\n                        return 0; <br>\r\n                        }</p>\r\n                </section>\r\n                <h2>Type conversions:</h2>\r\n                <p>We can convert a non-boolean type to boolean by two types:</p>\r\n                <li>Implicit type conversion: Here the complier automatically converts the non bool type to boolean.</li>\r\n                <li>Explicit type conversion: Here the programmer converts the non bool type to bool by using predefined data types.</li>\r\n                </ul>\r\n                <br><br>\r\n            </section>\r\n            <h3>Examples:</h3>\r\n            <ul><br>\r\n                <li>!false == true</li>\r\n                <br>\r\n                   <li> !true == false</li>\r\n            </ul>', 1, 10, 'C++: Booleans', 1),
(11, 'Conditions in C++', '<section class=\"intro\">\r\n                <ul>\r\n                    Conditions are the selective constructs in C++ which are used when we want output based on certain statement being true or false.\r\n                    <br><br>\r\n                    <h2>Types of conditions:</h2>\r\n                <li>ONLY IF:  One way construct.Here only if condition occurs.<br>Syntax:<br>if(expression){}</li>\r\n                <br>\r\n                 <li>ELSE-IF: Two way construct.Here there is one if and one else . If condition is true then if gets executed else else gets executed.<br>Syntax:<br>if(expression){}<br>else{}<br></li>\r\n                 <br>\r\n                <li>Multiple if-else : Multi way construct use to evaluate more than one condition at a time.It is a ladder of if-else if-else if-else. When there are multiple conditions here.<br>Syntax:<br>if(expression){}<br>else if(expression){}<br>else if(expression){}<br>else{}</li>\r\n                <li>Nested if-else: Here there are multiple if\'s inside if and muktiple else inside elae and vice versa.<br>Syntax:<br>if(expression){<br>if(expression){}<br>else{}<br>}<br>else{<br>if(expression){}<br>else{}<br>}</li>\r\n                <li>Switch case: It is an alternative of multiple if-else.Here the conditions are reduced and performance gets higher.<br>Syntax:<br>switch(n):<br>{<br>case 1:condition;break;<br>case 2:condition;break;<br>case 3:condition;break;<br>default:condition;<br>}</li>\r\n                </ul>\r\n            </section>', 1, 11, 'C++: Conditions', 1),
(12, 'Switch-case in C++', '<section class=\"intro\">\r\n                <ul>\r\n                   It is a selective construct. Switch-case statements are the alternatives of multiple if-else in order to ease the learning and return the number of lines of code in the program.It comes with break statement in order to move to the next statement.<br></br>\r\n                <h4>ADVANTAGES OF USING switch-case:</h4> \r\n                    \r\n                <li>Length reduction: The length of the code is reduced drastically as all the conditions becomes on liners.</li>\r\n                <li>Complexity reduction: The complexity too reduces as the code length is reduced so it becomes less complex than any other form of selective construct.</li>\r\n                <li>High performance: The performance is also increased because of the jump tables at the time of complication of the code. </li>\r\n                </ul>\r\n            </section>\r\n            <section>\r\n                <br><br><br><br><br>\r\n                <h2>FALL THROUGH:</h2>\r\n                <p> This is a condition in switch cases where the break statement is missing after any case. In such situation the statment next in case will get executed.</h2>\r\n                    <p><br>Syntax:<br>switch(n):<br>{<br>case 1:condition;break;<br>case 2:condition;break;<br>case 3:condition;break;<br>default:condition;<br>}</p>\r\n                    </p>\r\n                    <h4>DISADVANTAGES OF switch-case:</h4>\r\n                <ul>\r\n                    <li>We cannot use variable expressions.</li>\r\n                    <li>It checks only for equality.</li>\r\n                    <li>We cannot use relational operators.</li>\r\n                    <li>We cannot use the same variable for teo cases.</li>\r\n                    </ul>\r\n                    <h4>SIMILARITIES BETWEEN if-else and switch-case:</h4>\r\n                    <ul>\r\n                    <li> Both are selective constructs.</li>\r\n                    <li> Both are used to evalute more than one conditions.</li>\r\n                    </ul>\r\n                    <h4>DIFFERENCES BETWEEN multiple if-else and switch-case:</h4>\r\n                    <ul>\r\n                        <li>switch case only test for equality but multiple if-else can work with relational operators.</li>\r\n                        <li>switch cases cannot work with expressions but multiple if-else can.</li>\r\n                        <li>In switch case the case must be a constant but in multiple if-else it can be a variable.</li>\r\n                </ul></section>', 1, 12, 'C++: Switch Case', 1),
(13, 'ITERATIVE STATEMENTS IN C++', '<section class=\"intro\">\r\n                <ul>\r\n                 These are used to repeat a set of statments repeatedly for given or n number of times as specified.\r\n                    <br>\r\n                    <h3>Content of loops</h3>\r\n                <li>Initialization</li>\r\n                <li>Condition Test Expression</li>  \r\n                <li>Iteration</li>\r\n                <li>Loop Body</li>\r\n                <h5>LOOPS which donot contain any body: NULL BODY LOOP, EMPTY LOOP, TIME DELAY LOOP.</h5>\r\n                <h3>Types of loops:</h3>\r\n                    <ul>\r\n                        <li>for loop:      An iterative construct used to executes set of statements repeatedly for finite number of times.Here initialization,condition,iteration statements are placed together.</li>\r\n                        <li>while loop:    It is an iterative construct used to executes set of statements repeatedly when the number of iterations are not fixed. Here all the three components of iterations are placed separately.</li>\r\n                        <li>do-while loop: It is an iterative construct that executes a set of instructions which guarantees that the loop will get executed atleast once.Here all the three components of loop are places separtely.</li>\r\n                    </ul>\r\n                </ul>\r\n            </section>\r\n            <section>\r\n                <h3>Similarities in while and do while loop:</h3>\r\n                <ul>\r\n                    <li>Both are iterative constructs.</li>\r\n                    <li>In both the loops all the three iterative conditions are scattered.</li>\r\n                    <li>Both are used when number of iterations are not known.</li></ul>\r\n                    <h3>Differences between for/while and do-while loop:</h3>\r\n                    <ul>\r\n                    <li>for/whike is an pre tested loop and entry control loop and do while is post tested loopand exit control loop. </li>\r\n                    <li>for/while doesnot guarantee the number of times the loop will get executed but do-while loop guarantes that the loop will get executed atleast once.</li>\r\n                </ul></section>', 1, 13, 'C++: Loops', 1),
(14, 'C++ Break and Continue', '<section class=\"intro\">\r\n            <span>\r\n                The break statement can be used to jump out of a loop.\r\n                <br>\r\n                This example jumps out of the loop when i is equal to 4:\r\n            <br></span>\r\n            <section class=\"code\">for (int i = 0; i < 10; i++) { <br>\r\n                if (i == 4) { <br>\r\n                  break;<br>\r\n                }<br>\r\n                cout << i << \"\\n\";<br>\r\n              }</section>\r\n            <br>\r\n            <h2>C++ Continue</h2>\r\n            <span>The continue statement breaks one iteration (in the loop), if a specified condition occurs, and continues with the next iteration in the loop. <br>\r\n\r\n                This example skips the value of 4:</span>\r\n            <section class=\"code\">\r\n                <span>for (int i = 0; i < 10; i++) { <br>\r\n                    if (i == 4) {<br>\r\n                      continue;<br>\r\n                    }<br>\r\n                    cout << i << \"\\n\";<br>\r\n                  }></span>\r\n                  <br>\r\n            </section>', 1, 14, 'C++: Break/Continue', 1),
(15, 'Arrays in C++', '<section class=\"intro\">\r\n                <ul>\r\n                    It is a homogeneous collection of data.Here the data is placed in contiguous memory location that can be individually called out as and when needed with the help of loops and various our features.\r\n                    <br><br>\r\n                    <section class=\"code\">\r\n                        #include <<x>iostream> <br>\r\n                            using namespace std;\r\n                            <br>\r\n                             //main() is where program execution begins.\r\n                            <br>\r\n                            int main() { <br>\r\n                               cout << \"Hello World\"; \r\n                               // prints Hello World\r\n                               <br>\r\n                               return 0;\r\n                               <br>\r\n                            }</code>\r\n                    </section>\r\n                    <h2>Advantages of Arrays:</h2>\r\n                <li>Easy to specify.</li>\r\n                <li>Less coding is required because all the data is grouped.</li>\r\n                <li>High performance</li>\r\n                <li>Random accessing of data is possible.</li>\r\n                <li>Free from runtime overhead.</li>\r\n                <h2>Disadvantages of Arrays:</h2>\r\n                <li>It can store only same type of data.</li>\r\n                <li>We need to know its size.</li>\r\n                <li>Careful designing is required.</li>\r\n                <br>\r\n                <h2>Types of Arrays:</h2>\r\n                    <li>Single Dimentional arrays</li>\r\n                    <li>2-Dimentionalarrays</li>\r\n                    <li>Multi Dimentional arrays</li>\r\n                <h2>Operations that can be performed on arrays:</h2>\r\n                    <li>Searching</li>\r\n                    <li>Sorting</li>\r\n                    <li>Merging of 2 arrays</li>\r\n                    <li>Insertion in an array</li>\r\n                    <li>Delation from an array</li>\r\n                </ul>\r\n                <button class=\"next\"><a href=\"#\">Next</a></button>\r\n            </section>  ', 1, 15, 'C++: Arrays', 1),
(16, 'C++ Structures', '<section class=\"intro\">\r\n            <span>Structures (also called structs) are a way to group several related variables into one place. <br>\r\n                Each variable in the structure is known as a member of the structure.</span>\r\n            <br>\r\n            <h2>Creating a C++ Structure</h2>\r\n            <span>To create a structure, use the <i>struct</i> keyword and declare each of its members inside curly\r\n                braces.</span>\r\n            <section class=\"code\">\r\n                <span>struct { // Structure declaration <br>\r\n                    int myNum; // Member (int variable) <br>\r\n                    string myString; // Member (string variable)<br>\r\n                    } myStructure; // Structure variable<br></span>\r\n            </section>\r\n            <h3>Accessing the Structure Members</h3>\r\n            <section class=\"code\">\r\n                // Create a structure variable called myStructure<br>\r\n                struct {<br>\r\n                int myNum;<br>\r\n                string myString;<br>\r\n                } myStructure;<br>\r\n\r\n                // Assign values to members of myStructure<br>\r\n                myStructure.myNum = 1;<br>\r\n                myStructure.myString = \"Hello World!\";<br>\r\n\r\n                // Print members of myStructure<br>\r\n                cout << myStructure.myNum << \"\\n\" ;<br>\r\n                    cout << myStructure.myString << \"\\n\" ;<br>\r\n            </section>\r\n            <h2>Named Structures</h2>\r\n            <span>By giving a name to the structure, you can treat it as a data type. This means that you can create variables with this structure anywhere in the program at any time. <br>\r\n                To create a named structure, put the name of the structure right after the struct keyword:</span>\r\n                <section class=\"code\">\r\n                    struct myDataType { // This structure is named \"myDataType\" <br>\r\n  int myNum;<br>\r\n  string myString;<br>\r\n};<br>\r\n                </section>', 1, 16, 'C++: Structures', 1),
(17, 'C++ Pointers', '<section class=\"intro\">\r\n                <span>\r\n                    A pointer however, is a variable that stores the memory address as its value. <br>\r\n                    A pointer variable points to a data type (like int or string) of the same type, and is created with\r\n                    the * operator. The address of the variable you\'re working with is assigned to the pointer:\r\n                    <br></span>\r\n                <section class=\"code\">string food = \"Pizza\";  // A food variable of type string <br>\r\n                    string* ptr = &food;    // A pointer variable, with the name ptr, that stores the address of food\r\n                    <br>\r\n                    // Output the value of food (Pizza)\r\n                    cout << food << \"\\n\";\r\n                    <br>\r\n                    // Output the memory address of food (0x6dfed4)\r\n                    cout << &food << \"\\n\";\r\n                    <br>\r\n                    // Output the memory address of food with the pointer (0x6dfed4)\r\n                    cout << ptr << \"\\n\";\r\n                    <br>\r\n                </section>', 1, 17, 'C++: Pointers', 1),
(18, 'Function Parameters in C++', '<section class=\"intro\">\r\n                <ul>\r\n                <span style=\"font-size: 18px;\"> A function parameter is a variable used in a function.They are always initialized with a value provided by the caller of the function.</span>\r\n                    <br><br>\r\n                    <h2>Basic syntax:</h2>\r\n                    <section class=\"code\">return_type function_name( parameter list ) <br>\r\n                        {<br>\r\n                            body of the function<br>\r\n                         }</section>\r\n                         <br><br>\r\n                <li>Return Type − A function may return a value. </li>\r\n\r\n                        <li>Function Name − This is the actual name of the function. The function name and the parameter list together constitute the function signature.</li>\r\n                        \r\n                        <li>Parameters − A parameter is like a placeholder. </li>\r\n                        \r\n                        <li>Function Body − The function body contains a collection of statements that define what the function does.</li>\r\n                <br><br>\r\n                <h2>Types of function parameters:</h2>\r\n                <br>\r\n                <li>Default Parameters: These values are used by = symbol.</li>\r\n                <li>Multiple Parameters: Here inside a function we can use as many parameters as required.</li>\r\n                </ul>\r\n            </section>\r\n            <section>\r\n                <br><br>\r\n                <h2></h2>\r\n                <p></p>\r\n                <section class=\"code\">\r\n                        #include <<x>iostream><br>\r\n                            int getValueFromUser()<br>\r\n                                {<br>\r\n                                     std::cout << \"Enter an integer: \";<br>\r\n                                    int i{};<br>\r\n                                    std::cin >> i;<br>\r\n                                    return i;<br>\r\n                                }<br>\r\n                                int main()<br>\r\n                                {<br>\r\n                                    int num { getValueFromUser() \r\n                                    };<br>\r\n                                std::cout << n << \" doubled is: \" << n* 2 << \'\\n\';<br>\r\n                                 return 0;<br>\r\n                                }<br>\r\n                </section>\r\n\r\n                <ul>\r\n                    <h3>How are parameters passed : </h3>\r\n                    <li>Pass by value: Here the parameters are passed by giving value either from the user or directly by the programmer. </li>.\r\n                    <li>Pass by reference: Here the parameters are passed with reference with\'&\' symbol in front of the parameter. Here the value can be changed any number of times.</li>\r\n                    \r\n                    \r\n                </ul>', 1, 18, 'C++: Function Parameters', 1),
(19, 'Function Overloading in C++', '<section class=\"intro\">\r\n                <ul>\r\n                <span style=\"font-size: 18px;\">A function overloading occurs when 2 or more functions have the same name but different signatures. But they have the different set of parameters.Functions with different return types and identical parameters can not be overloaded. It improves code readability and reusability.</span>\r\n                    <br><br>\r\n                    <h2>Function overloading must have:</h2>\r\n                <li>The same name as that of the other functions.</li>\r\n                <li>They have the different parameters.</li>\r\n                <br><br>\r\n                <h2>Rules for overloading:</h2>\r\n                <br>\r\n                <li> Functions must have different parameter types.</li>\r\n                <li>Functions must have different number of parameters.</li>\r\n                <li> Functions must have different combinations of arguments.</li>\r\n                </ul>\r\n            </section>\r\n            <section>\r\n                <section class=\"code\" style=\"width: 550px\">1. return_type funcion_name (data_type_1 variable1, data_type_2 variable2) {}<br>\r\n\r\n                       2. return_type_1 funcion_name (data_type_2 variable1) {}<br>\r\n                        \r\n                       3. return_type funcion_name (data_type_1 variable1, data_type_3 variable2) {}</section>\r\n\r\n                <ul>\r\n                    <li>The first overloaded function has different data types but the same function name as other functions.</li>.\r\n                    <li>The second overloaded function has 1 variable as above function and datatype of another variable which makes it overloaded.</li> <br>\r\n                    <li>The third and the last overloaded funtion has the same return type as the first but different data types and variables.</li>\r\n                </ul></section>', 1, 19, 'C++: Function Overloading', 1),
(20, 'Recursion in C++', '<section class=\"intro\">\r\n                <span style=\"font-size:18px;\">When function is called within the same function, it is known as recursion in C++. The function which calls the same function, is known as recursive function.</span>\r\n                    <br><br>\r\n                <ul>\r\n                  <li>A function that calls itself, and doesn\'t perform any task after function call, is known as tail recursion. In tail recursion, we generally call the same function with return statement</li>\r\n                </ul>\r\n            </section>\r\n            <section class=\"code\">\r\n                recursionfunction(){   <br> \r\n                  recursionfunction(); //calling self function <br>    \r\n                  }    <br>\r\n            </section>', 1, 20, 'C++: Recursion', 1),
(21, 'Classes and Objects in C++', '<section class=\"intro\">\r\n                <ul>\r\n                  <h2>C++ Class:</h2>\r\n                  <span style=\"font-size:18px;\">A Class is a blueprint of an object.</span> \r\n                    <br><br>\r\n                    <h2>Creating a Class:</h2>\r\n                <li>A class is defined in C++ using keyword class followed by the name of the class.</li>\r\n                <li>The body of the class is defined inside the curly brackets and terminated by a semicolon at the end. </li>\r\n                <section class=\"code\">\r\n                    class className {<br>\r\n                      // some data <br>\r\n                      // some functions<br>\r\n                   };<br>\r\n                </section>\r\n                <li>The variables declared inside the class are known as data members. And, the functions are known as member functions of a class.</li>\r\n                <br><br>\r\n                <h2>C++ Objects:</h2>\r\n                <br>\r\n                <li>To use the data and access functions defined in the class, we create objects.</li>\r\n                <li>Objects are created in such a way:</li>\r\n                <section class=\"code\">\r\n                    className objectVariableName; <br>\r\n                </section>\r\n                <li>We can create objects of a class in any function of the program.</li>\r\n                <li> We can also create objects of a class within the class itself, or in other classes.</li>\r\n                <li>We can create as many objects as we want from a single class.</li>\r\n                <br><br>\r\n                <h2>C++ Access Data Members and Member Functions:</h2>\r\n                  <li>To access the data members and member functions of a class we use a <b>.</b> (dot) operator.</li>\r\n                  <section class=\"code\">\r\n                      object.function(); <br>\r\n                      object.variable=value; <br>\r\n                  </section>\r\n                </ul></section>', 1, 21, 'C++: Classes/Objects', 1),
(22, 'Class Methods in C++', '<section class=\"intro\">\r\n                <ul>\r\n                        <span style=\"font-size:18px;\">C++ class methods are user-defined functions that are used inside an instance of the class. A dot notation . is used before method names to distinguish them from the regular functions.</span>\r\n                    <br><br>\r\n                    <h2>A class method can be defined in two ways:</h2>\r\n                <li class=\"mains\"><span>Inside the class definition:</span></li>\r\n                       <section class=\"code\">class Person<br>\r\n                            {<br>\r\n                              string name;<br>\r\n                            public:<br>\r\n                              // Defines the method<br>\r\n                              void get_name()<br>\r\n                              {<br>\r\n                                return name;<br>\r\n                              }<br>\r\n                            }<br>\r\n                             int main()<br>\r\n                            {<br>\r\n                              Person robert;<br>\r\n                            // Calls the method<br>\r\n                              robert.get_name();<br>\r\n                            return 0;<br>\r\n                            }</section>\r\n                <li class=\"mains\"><span>Outside the class definition</span></li>\r\n                <section class=\"code\">class Person<br>\r\n                        {<br>\r\n                          string name;<br>\r\n                         public:<br>\r\n                          void get_name();<br>\r\n                        }<br>\r\n                         // Defines the method<br>\r\n                        void Person::get_name()<br>\r\n                        {<br>\r\n                          return name;<br>\r\n                        }<br>\r\n                         int main()<br>\r\n                        {<br>\r\n                          Person robert;<br>\r\n                         // Calls the method<br>\r\n                          robert.get_name();<br>\r\n                        return 0;<br>\r\n                        }<br></section>\r\n                </ul>\r\n            </section>', 1, 22, 'C++: Class Methods', 1),
(23, 'Constructors in C++', '<section class=\"intro\">\r\n                <ul>\r\n                Constructor is amember function used to create and initialize the objects with legal set of values. \r\n                    <br><br>\r\n                    <h2>Properties:</h2>\r\n                <li>They have the same name as that of the class.</li>\r\n                <li>They are automatically called at the time of object creation.</li>\r\n                <li>They have parameters therefore can be overloaded.</li>\r\n                <li>Generally they are made public.</li>\r\n                <li>These are not inherited bur can be called through child class constructors.</li>\r\n                <br><br>\r\n                <h2>Types of values in constructors:</h2>\r\n                <br>\r\n                <li>Dumy/Garbage value: The values which are automatically assigned by the complier are called dumy/garbage values.</li>\r\n                <li>Legal values:The values which are assigned by the user/programmer are called legal values.</li>\r\n                </ul>\r\n            </section>\r\n            <section>\r\n                <br><br>\r\n                <h2>Types of constructors in C++</h2>\r\n                <p>There are three types of constructors in C++:</p>\r\n                \r\n                <ul>\r\n                    <li>Default constructor:It is an non-parameterized constructor which is automatically provided by the complier.It is used to create and initialize objects with dumy values.</li>\r\n                    <li>Parameterized constructors:A constructo which accepts some value through parameters is called parameterized constructor.</li>\r\n                    <li>Copy constructor:It is a member function which initialize the objects which the help of other objects of the same class.</li>\r\n                </ul>\r\n                <h3>This keyword:</h3>\r\n                <p>It is used to point to the current object of the class.It is used to differentiate between global and local variables when both of them have the same name.</p></section>', 1, 23, 'C++: Class Methods', 1),
(24, 'aa', 'aa', 2, 1, 'aa', 0),
(25, 'bb', 'bb', 2, 2, 'bb', 1),
(26, 'qq', 'qq', 2, 1, 'qq', 0),
(27, 'ww', 'ww', 2, 2, 'ww', 0),
(28, 'rr', 'rr', 2, 1, 'rr', 0),
(29, 'tt', 'tt', 2, 2, 'tt', 0);

-- --------------------------------------------------------

--
-- Table structure for table `details`
--

CREATE TABLE `details` (
  `sno` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phonenumber` varchar(255) NOT NULL,
  `jobtitle` varchar(255) NOT NULL,
  `worktitle` varchar(255) NOT NULL,
  `employer` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `degree` varchar(255) NOT NULL,
  `university` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `sno` int(11) NOT NULL,
  `likewebsite` varchar(255) NOT NULL,
  `recommendations` varchar(255) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`sno`, `likewebsite`, `recommendations`, `timestamp`) VALUES
(1, 'Yes', 'Nope', '2023-09-18 13:49:28'),
(2, 'Partially', 'fdsaasfsd', '2023-09-18 13:51:22'),
(3, 'Yes', '', '2023-09-18 14:18:35'),
(4, 'Yes', '', '2023-09-26 02:33:33');

-- --------------------------------------------------------

--
-- Table structure for table `forgotpass`
--

CREATE TABLE `forgotpass` (
  `sno` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `question_id` int(11) NOT NULL,
  `question` longtext DEFAULT NULL,
  `answer` varchar(255) NOT NULL,
  `test_id` int(11) NOT NULL,
  `options` longtext NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `ismultiplechoice` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`question_id`, `question`, `answer`, `test_id`, `options`, `image`, `ismultiplechoice`) VALUES
(274, 'C++ language is a ___.', 'Object Oriented Language', 19, '[\"Object Oriented Language\",\"Procedural Oriented Language\",\"Structural Oriented Language\"]', NULL, 0),
(277, 'Which of the following is not a valid keyword in C++ language?', 'do-while', 19, '[\"while\",\"do-while\",\"switch\"]', NULL, 0),
(304, 'hii', 'adityamishra', 20, '[\"aditya\",\"adityam\",\"adityamishra\",\"adii\"]', NULL, 0),
(306, 'What is the output of the following code?', 'Error', 19, '[\"Error\",\"Hello World\"]', 'Screenshot 2023-10-28 234328.png', 0),
(331, 'How you doing', '[\"das\",\"dsa\"]', 19, '[\"das\",\"dsa\",\"ds\",\"das\"]', NULL, 1),
(332, 'Hello sir', '[\"sad\",\"das\",\"sad\"]', 19, '[\"sad\",\"das\",\"asd\",\"sad\"]', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `test_id` int(11) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `time` datetime NOT NULL,
  `organiser_id` int(11) NOT NULL,
  `displayed` int(11) NOT NULL DEFAULT 1,
  `course_id` int(11) NOT NULL DEFAULT 0,
  `timeforeach` int(11) NOT NULL DEFAULT 15,
  `questionsforeach` int(11) NOT NULL DEFAULT 3,
  `heldtill` datetime NOT NULL,
  `startString` varchar(255) DEFAULT NULL,
  `scoreRelease` int(11) NOT NULL DEFAULT 0,
  `userfortest` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`test_id`, `heading`, `description`, `time`, `organiser_id`, `displayed`, `course_id`, `timeforeach`, `questionsforeach`, `heldtill`, `startString`, `scoreRelease`, `userfortest`) VALUES
(19, 'C++', 'Test1', '2023-11-02 10:11:00', 43, 1, 0, 15, 5, '2023-11-23 01:46:00', 'firsttest', 1, '[\"266\",\"267\",\"268\",\"269\",\"270\",\"271\",\"272\",\"273\",\"274\",\"275\",\"276\",\"277\",\"278\",\"279\",\"280\",\"281\",\"282\",\"283\",\"284\",\"285\",\"286\",\"287\",\"288\",\"289\",\"290\",\"291\",\"292\",\"293\",\"294\",\"295\",\"296\",\"297\"]'),
(20, 'JavaScript', 'hey', '2023-11-02 15:06:00', 43, 0, 0, 10, 15, '2023-11-05 15:06:00', NULL, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `testblock`
--

CREATE TABLE `testblock` (
  `test_id` int(11) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `timefortest` int(11) NOT NULL,
  `heldfrom` datetime NOT NULL,
  `heldtill` datetime NOT NULL,
  `usersfortest` longtext NOT NULL,
  `organiser_id` int(11) NOT NULL,
  `displayed` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `testblock`
--

INSERT INTO `testblock` (`test_id`, `heading`, `description`, `timefortest`, `heldfrom`, `heldtill`, `usersfortest`, `organiser_id`, `displayed`) VALUES
(1, 'Survey', 'c++', 30, '2023-11-01 13:25:00', '2023-12-10 13:25:00', '', 43, 0);

-- --------------------------------------------------------

--
-- Table structure for table `testquestions`
--

CREATE TABLE `testquestions` (
  `question_id` int(11) NOT NULL,
  `questionText` varchar(255) NOT NULL,
  `test_id` int(11) NOT NULL,
  `options` longtext NOT NULL DEFAULT '[]',
  `answer` longtext NOT NULL,
  `questionType` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `testscores`
--

CREATE TABLE `testscores` (
  `sno` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `answers` longtext NOT NULL,
  `user_id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `enrollment` varchar(255) NOT NULL,
  `errors` int(11) NOT NULL DEFAULT 0,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `testscores`
--

INSERT INTO `testscores` (`sno`, `score`, `answers`, `user_id`, `test_id`, `enrollment`, `errors`, `date`) VALUES
(112, 4, '[{\"question_id\":\"331\",\"question\":\"How you doing\",\"image\":null,\"answer\":\"[\"das\",\"dsa\"]\",\"correctAnswer\":\"[\"das\",\"dsa\"]\"},{\"question_id\":\"274\",\"question\":\"C++ language is a ___.\",\"image\":null,\"answer\":\"Object Oriented Language\",\"correctAnswer\":\"Object Oriented Language\"},{\"question_id\":\"306\",\"question\":\"What is the output of the following code?\",\"image\":\"Screenshot 2023-10-28 234328.png\",\"answer\":\"Error\",\"correctAnswer\":\"Error\"},{\"question_id\":\"277\",\"question\":\"Which of the following is not a valid keyword in C++ language?\",\"image\":null,\"answer\":\"do-while\",\"correctAnswer\":\"do-while\"}]', 45, 19, '201b001', 0, '2023-11-15 13:37:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` int(11) NOT NULL DEFAULT 0,
  `organiser` int(11) NOT NULL DEFAULT 0,
  `description` longtext DEFAULT '',
  `profileImage` varchar(255) DEFAULT NULL,
  `location` varchar(255) NOT NULL,
  `courses_array` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `test_array` longtext DEFAULT NULL,
  `verified` int(11) NOT NULL DEFAULT 0,
  `enrollment` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fname`, `lname`, `email`, `password`, `admin`, `organiser`, `description`, `profileImage`, `location`, `courses_array`, `test_array`, `verified`, `enrollment`) VALUES
(3, 'Aditya ', 'Mishra', '201b016@juetguna.in', '$2y$10$qoHKVMU/9Fd9JAHF7jDQDuRDZrkMZlDC7/rZmWksB7al047wpgOGq', 1, 0, 'When a man learns to feel love, he must also bear the risk of feeling hate.', '65242af5b6a3a3_IMG_20220525_132135_405.jpg', 'Guna, Madhya Pradesh', '0', '[]', 1, '201b016'),
(43, 'Aditi', 'Mishra', '201b014@juetguna.in', '$2y$10$ctqNbkZfuWAHTaAYvyGtReOqyJtklqpZGBRB9CwogzRQrecD/EsOG', 0, 1, '', NULL, '', '[]', '[]', 0, '201b014'),
(44, 'Aditya', 'Rana', '201b018@juetguna.in', '$2y$10$uTGMiu7IfZksuyha0PtXqu7L3JwME40g8bqUM0Tvo2ILQq4bfrZbC', 0, 1, '', NULL, '', '[]', '[]', 0, '201b018'),
(45, 'Ayush', 'Kumar', '201b001@juetguna.in', '$2y$10$HaYlmAR5LH/IcrkwuiXvaeqruJvA.5eZotM6W7q9qMZoIE56KWDze', 0, 0, '', NULL, '', '[]', '[\"19\"]', 0, '201b001'),
(46, 'Abhijeet ', 'Verma', '201b005@juetguna.in', '$2y$10$aE84ypGxzDhd0JBGKj.sReEuKGJiaKRaTtapgC.Xi5syaehfL7i6.', 0, 0, '', NULL, '', '[]', '[]', 0, '201b005'),
(48, 'Aditya ', 'Patel', '201b017@juetguna.in', '$2y$10$fOI.BewFBtjjGk1Ic2jKMeHGPDy94FoKKAENNvye.dv3qzdWtM4TS', 0, 0, '', NULL, '', '[]', '[]', 0, '201b017'),
(49, 'Aditya', 'Suhane', '201b023@juetguna.in', '$2y$10$zoj4Q8nlahzeYhNRktztxeQ.m0CDJaVNf2iX1DhvN9GuDcHfenz5m', 0, 0, '', NULL, '', '[]', '[]', 0, '201b023'),
(50, 'Aditya', 'Mishra', 'mishra.aditya1352@gmail.com', '$2y$10$01sJSq9nqzNdBYiBb7Krwuqvi4fto6fNsHQs9o8hlMXlgPaUYnxce', 0, 0, '', NULL, '', '[]', '[]', 0, '999999'),
(51, 'Aditya', 'Agarwal', '201b015@juetguna.in', '$2y$10$XI96sry/beUZ6D.Fp6.C1OSpW.EnE27LWTKgAMP21T26pvACyPny6', 0, 0, '', NULL, '', NULL, '[]', 0, '201b015'),
(52, 'Aditya', 'Yadav', '201b029@juetguna.in', '$2y$10$0RdY3r54wMlXFZX49jKaueGtEjCM.Q4tJKxTXj8hZqNwEx.CsTIMW', 0, 0, '', NULL, '', NULL, '[]', 0, '201b029');

-- --------------------------------------------------------

--
-- Table structure for table `verification`
--

CREATE TABLE `verification` (
  `sno` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminusers`
--
ALTER TABLE `adminusers`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`certificate_id`);

--
-- Indexes for table `chatbot`
--
ALTER TABLE `chatbot`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `codinganswers`
--
ALTER TABLE `codinganswers`
  ADD PRIMARY KEY (`answer_id`);

--
-- Indexes for table `codingquestions`
--
ALTER TABLE `codingquestions`
  ADD PRIMARY KEY (`code_id`);

--
-- Indexes for table `codingtest`
--
ALTER TABLE `codingtest`
  ADD PRIMARY KEY (`test_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `course_content`
--
ALTER TABLE `course_content`
  ADD PRIMARY KEY (`page_id`);

--
-- Indexes for table `details`
--
ALTER TABLE `details`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `forgotpass`
--
ALTER TABLE `forgotpass`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`test_id`);

--
-- Indexes for table `testblock`
--
ALTER TABLE `testblock`
  ADD PRIMARY KEY (`test_id`);

--
-- Indexes for table `testquestions`
--
ALTER TABLE `testquestions`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `testscores`
--
ALTER TABLE `testscores`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `verification`
--
ALTER TABLE `verification`
  ADD PRIMARY KEY (`sno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminusers`
--
ALTER TABLE `adminusers`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=299;

--
-- AUTO_INCREMENT for table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `certificate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `chatbot`
--
ALTER TABLE `chatbot`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `codinganswers`
--
ALTER TABLE `codinganswers`
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `codingquestions`
--
ALTER TABLE `codingquestions`
  MODIFY `code_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `codingtest`
--
ALTER TABLE `codingtest`
  MODIFY `test_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `course_content`
--
ALTER TABLE `course_content`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `details`
--
ALTER TABLE `details`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `forgotpass`
--
ALTER TABLE `forgotpass`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=333;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `test_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `testblock`
--
ALTER TABLE `testblock`
  MODIFY `test_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `testquestions`
--
ALTER TABLE `testquestions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `testscores`
--
ALTER TABLE `testscores`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `verification`
--
ALTER TABLE `verification`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
