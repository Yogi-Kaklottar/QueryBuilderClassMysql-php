# QueryBulderClassMysql-php
1.Introduction:
	I devloped class file in php for build a query like insert,update,delete and select operation in query builder class generating the individual class for all table in database and provide getter setter method using a simple object to perform database operation and create complex select query.This class using a minimum script to perform crude operation to provide standardize way to perform database operation using single method to generate complex select,insert,update,delete query auto generating  getter setter method for all table. This class reduce code to perform db operation.
	This query builder consists a set of classes, each handling a specific part of the query building process. Generating the individual class for all table in database and provide getter setter method using a simple object to perform database operation.
  
  
2.Advantages:
  ->	Minimum script to perform crude operation.
  -> Provide standardize way to perform database operation.
  -> Generate automatic class  and getter setter method for all database table and this class using to perform db operation.
  ->Easy error detection and remove more than syntax error  because query auto generating.
  
3.Discription For Classes:
3.1 Connection Class:
	Connection class are base class for some method are following:

		openConnection();
		closeConnection();
		executeReader($query);
		executeScalar($query);
		getTotalRows();

  To be execute any operation before configure this value:

 
3.2 Field Class:
	This class are table column type are declared.This class tobe used for the column datatype check and assign. 

3.3.Common class:
	Common  class are declare operation for static variable to be define.
  
3.3.TableMaster class:
	TableMaster.class is derive class inherited for common class. TableMaster class data member are protected declare.
  Following is method are declare in TableMaster class:
  
	    preparedExecuteNoneQuery($intDMLStatement);
	    aggregateExecuteNoneQuery($intAggregateFunction,$fieldName);
	    setTblName($strTblName);
	  setWhere($strWhere);
	  setLimit($intSkip,$intRows);
	  setGroupBy($strFieldName);
	  setOrderBy($strFieldName);
	  setSortMethod($str);
	  setHaving($fieldName,$sign,$cnt);

4.Usage:

4.1.Configuration:
	1. QueryBuilderClass folder paste in your project or www folder.
	2.After open QueryBuilderClass /tablegen.php file adjust the basic configurations for your DB     	    connection like host,database name, username and password.
		
    Syntax:	 $db="test“;
  			$con = mysqli_connect("localhost","root","","");
	     	 Discription:
 			  $db=Enter Database Name
   			$con=Enter Database Confguration 

3. After to run QueryBuilderClass /tablegen.php and auto generate the individual class for all  table in database.
		following example of class.
		Example :-teacher.php 
    
 	4. Any  operation to perform to required some simple task to  following:
  
       To include  auto generating php class file.
     		Syntax:
         			include_once(class file);
		    Example:
    			include_once('student_master.php');
	       Creating Object
    		Example:
		      $obj = new StudentMaster();
          
	5.connection.php in  connection class variable for assign 
  
        private static $hostname = "localhost";
        private static $username = "root";
        private static $password = "";
        private static $select_db = "test";		
4.2 Insert
	First open for connection
			 Example:
    			$obj = new StudentMaster();
  		    $obj->openConnection();

	Set value for class call preparedExecuteNoneQuery() this function generate query and after call executeNoneQuery() this function execute query and return to the boolean value so  decide query are sucessfull run or not. 

   		Syntax:
			  query= preparedExecuteNoneQuery(Common::operation);
		  Description:
      	query= Return Query As String 
			  operation=$insert 
		  Syntax:
		    result=executeNoneQuery(Query);
		Discription:
		    result=Return Boolean True Or False
      		 Query=Argument As Query
	
  Example:

          $obj = new StudentMaster();
           $obj->openConnection();
          $obj->setName($_POST["name"]);
          $obj->setDateOfBirth($_POST["dob"]);
          $obj->setClass($_POST["clas"]);
          $obj->setPhoneNumber($_POST["phno"]);
          $obj->setScience($_POST["science"]);
          $obj->setSocialScience($_POST["sciences"]);
          $obj->setEnglish($_POST["english"]);
          $obj->setTId($_POST["tname"]);
          $obj->setMaths($_POST["maths"]);
          $obj->setTotal($_POST["science"]+$_POST["sciences"]+$_POST["english"]+$_POST["maths"]);
          $obj->setPersantage("".$obj->getTotal()/4);
          $query = $obj->preparedExecuteNoneQuery(Common::$insert);
          $obj->executeNoneQuery($query);

Genarating Query:

	INSERT INTO student_master ( name, date_of_birth, class, phone_number, science, social_science, english, t_id, maths, total, persantage ) VALUES('jenish', '1978-05-05', 'mca1', '8765546', '97', '70', '90', '2', '87', '344', '86' );

4.3.Update
	First open for connection

		 Example:
   		 $obj = new StudentMaster();
    	 $obj->openConnection();

	Set value for class call preparedExecuteNoneQuery() and after call executeNoneQuery();
    	Syntax:
	    	query= preparedExecuteNoneQuery(Common::operation);
	 Description:
     		query= Return Query As String
	  	  operation=$update
	Example:
 
            $obj = new StudentMaster();
            $obj->openConnection();
            $obj->setName($_POST["name"]);
            $obj->setDateOfBirth($_POST["dob"]);
            $obj->setClass($_POST["clas"]);
            $obj->setPhoneNumber($_POST["phno"]);
            $obj->setScience($_POST["science"]);
            $obj->setSocialScience($_POST["sciences"]);
            $obj->setEnglish($_POST["english"]);
            $obj->setMaths($_POST["maths"]);
            $obj->setTId($_POST["tname"]);
            $obj->setTotal($_POST["science"]+$_POST["sciences"]+$_POST["english"]+$_POST["maths"]);
            $obj->setPersantage("".$obj->getTotal()/4);	
            $obj->setWhere("id=".$_POST['id']);
            $query = $obj->preparedExecuteNoneQuery(Common::$update);
            $check = $obj->executeNoneQuery($query); 

Genarating Query:

	update student_master set name = 'ranil', date_of_birth = '2020-04-01', class = 'mmmmk', 	phone_number = '987497558', science = '34', social_science = '34', english = '45', maths = 	'23', t_id = '1', total = '136', persantage = '34' WHERE id=4; 

4.4.Delete
	First open for connection

		 Example:
			 $obj = new StudentMaster();
  			$obj->openConnection();
	Set value for class call preparedExecuteNoneQuery() and after call executeNoneQuery();

        Example:
           $obj = new StudentMaster();
           $obj->openConnection();
           $obj->setWhere("id=".$_GET[‘id']);
           $query = $obj->preparedExecuteNoneQuery(Common::$delete);
           $check = $obj->executeNoneQuery($query);
        if(isset($check))
          {
                  echo 'student data delete';
          }
          else
          {
             echo 'Student Data not updated';
          }
          
      	Genarating Query:
          DELETE FROM student_master WHERE id=46; 
          
4.5.Multiple Record Fetch:

	First open for connection

		 Example:
    			$obj = new StudentMaster();
   			 $obj->openConnection();
	Set value for class call preparedExecuteNoneQuery() and after call executeReader() this function return to array of Rows and You get number of rows  use to getTotalRows() function to return number of rows are select.

    Syntax:
			query= preparedExecuteNoneQuery(Common::operation);
		Description:
   			 query= Return Query As String
	  		operation=$select
    Example:
        include_once('student_master.php');
        $obj=new StudentMaster();
        $obj->openConnection();
        $query = $obj->preparedExecuteNoneQuery(Common::$select);
        $run = $obj->executeReader($query);
        $cnt=$obj->getTotalRows();
        
	Generated Query:-

		select * from student_master;
  
4.6.Select One Record:-

	First open for connection

 		 Example:
		    $obj = new StudentMaster();
		    $obj->openConnection();
	Set value for class call preparedExecuteNoneQuery() and after call executeScalar() this function use to onle one record to select.

		  Syntax:
	                        query= preparedExecuteNoneQuery(Common::operation);
		  Description:
		          query= Return Query As String
              peration=$select
      	Syntax:
            $result=executeScalar(Query);
      	Discription:
            result=Return table of Row
                    Query=Argument As Query
      	Example:
            include_once('student_master.php');
            $obj=new StudentMaster();
            $obj->openConnection();
            $obj->setId($_GET['name']);
            $obj->setWhere('id='.$_GET['name']);
            $query = $obj->preparedExecuteNoneQuery(Common::$select);
            $run = $obj->executeScalar($query);
	
	Generated Query:-

		select * from student_master where id=35; 
	Another way to directly  to get object using id and use fetchId() method directy to access all variable.

		Example:
			include_once('student_master.php');
			$obj=new StudentMaster();
			$obj->openConnection();
			$obj->fetchId($id); 	
4.7.Limit

	Limit the number of rows you would like returned by the query.

     Synatx:
        setLimit($intSkip,$intRows);
        $IntSkip=No.Of  Skip Rows
        $IntRows=No.Of. Rows Return
     Exmaple:	 			
        $stud = new StudentMaster();
        $stud->openConnection();
        $stud->setLimit(3,4);
        $query = $stud->preparedExecuteNoneQuery(Common::$select);
        $run = $stud->executeReader($query);
    	Generating Query:  
      SELECT * FROM student_master LIMIT 3,4

4.8.Like
	Syntax:
	   setLike(field_name,Pattern);
   	   field_name=Coulmn Name
     	   Pattern= set Pattern
	Example:
 

	include_once('student_master.php');			
	$stud = new StudentMaster();
	$stud->openConnection();
	$stud->setLike(“name”,”m%”);
	$query = $stud->preparedExecuteNoneQuery(Common::$select);
	$run = $stud->executeReader($query);

	Generating Query:
  	 SELECT * FROM student_master WHERE name LIKE 'm%';

4.9.Aggregate Function

	Syntax:
               aggregateExecuteNoneQuery(Common::$operation,Field_name)
	$operation= Define Operation Following
			$count
			$sum
			$min
			$max
			$avg 
   	Field_name=Define Field Name
	Example:
 
 	Sum:
		aggregateExecuteNoneQuery(Common::$sum,”persantage”);
  	Query:
   	  	SELECT  sum(persantage) FROM student_master;
 	Avg:
		aggregateExecuteNoneQuery(Common::$avg,”persantage”);
     	Query:
          		SELECT  avg(persantage) FROM student_master;
 	Count:
		aggregateExecuteNoneQuery(Common::$sum,”*”);
     	Query:
          		SELECT  count(*) FROM student_master;
 	Min:
		aggregateExecuteNoneQuery(Common::$min,”persantage”);
	 Query:
		SELECT  min(persantage) FROM student_master;
 	Max:
		aggregateExecuteNoneQuery(Common::$max,”persantage”);
	Query:
          		SELECT  max(persantage) FROM student_master;

4.10.Group By

    	Syntax:
        setGroupBy(Field_Name);          
        Field_Name=Group field Name
    	Example:

        $stud->setGroupBy(“t_id”);
        echo $query=$stud->aggregateExecuteNoneQuery (Common::$sum,”persantage”);
        $run = $stud->executeReader($query);
	Generating Query:

		SELECT t_id,avg(persantage) FROM student_master GROUP BY t_id;

4.11.Order By

    	Syntax:
        setOrderBy(FieldName);
        setSortMethod($str);

        FieldName=Order Filed
        Str=Method For Order
        ASC=Ascending Order By Default
        DESC=D	escending Order
	Example:
 
		$stud->setOrderBy(“avg(persantage)”);
		$stud->setSortMethod(“DESC”);
	 Generating Query:

		SELECT t_id,avg(persantage) FROM student_master GROUP BY t_id ORDER BY 			avg(persantage) DESC;
4.12.Having Clause

      	Syntax:
        setHaving($fieldName,$sign,$cnt)
          $fieldName=Field Name
          $sign=	<,>,=,<=,>=, And !=
                     $cnt=	 number Comparision 
      	Example:

          $stud->setHaving(“avg(persantage)”,”<=”,50);
      	Generating Query:
        SELECT t_id,avg(persantage) FROM student_master 	GROUP BY t_id HAVING 	avg(persantage)<=50 ORDER BY  avg(persantage) DESC;

4.13. Multiple Data Assign Object
	Multiple data  assign to object using this function. But condition is to table column number are sequence to be manage.

    	Syntax:
        setMultipledata($row);
        $row =array of data
      Example:
        $row= Array ( [0] => jiya [1] => 2020-04-20 [2] => mca1 [3] => 84584584 [4] => 67 [5] 		=> 67 [6] => 67 [7] => 67 [8] => 268 [9] => 67 [10] => 1 );
        $obj = new StudentMaster();
        $obj->openConnection();
