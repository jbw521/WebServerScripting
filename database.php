<?php
$dsn = 'mysql:host=localhost;dbname=stickman3db';
    //$username = 'root';
    //$password = '';  // be sure to change this info based on where you're running the website
    $username = 'stickman3';
    $password = 'limenewprocessingbigharmfuloctave';
	try {
        $db= new PDO($dsn, $username, $password);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('database_error.php');
        exit();
    }
    
    function get_username($username){
        global $db;
        $query = 'Select alias,password,fname,lname,profilepic,email from user where alias=:username_placeholder';
                                          
            //prepare the query, bind the values, then you execute
                $statement = $db->prepare($query);
               
                $statement->bindValue(':username_placeholder', $username);
                               
                $didit = $statement->execute();
                $results = $statement->fetch();
                
                if (!$didit){ // if the username doesn't appear in the database, this will happen
                   return $didit; 
                }
                else
                {
                    return $results;
                }
    }
    
    function get_password($username){
        global $db;
        $query = 'Select password from user where alias=:username_placeholder';
                                          
            //prepare the query, bind the values, then you execute
                $statement = $db->prepare($query);
               
                $statement->bindValue(':username_placeholder', $username);
                               
                $didit = $statement->execute();
                $results = $statement->fetch();
                
                if (!$didit){
                   return $didit;
                }
                else
                {
                    return $results;
                }
    }
    
    function add_user($username, $password, $fname, $lname, $email){
        global $db;
        $query = 'insert into user (alias, password, fname, lname, email, registerDate)'
                . ' values (:username_placeholder, :password_placeholder, :firstname_placeholder, :lastname_placeholder, :email_placeholder, NOW())';
                                          
            //prepare the query, bind the values, then you execute
                $statement = $db->prepare($query);
				
				$options = [ 'cost' => 13 ];
				$password_hashed = password_hash($password, PASSWORD_DEFAULT, $options);
               
                $statement->bindValue(':username_placeholder', $username);
                $statement->bindValue(':password_placeholder', $password_hashed);
                $statement->bindValue(':firstname_placeholder', $fname);
                $statement->bindValue(':lastname_placeholder', $lname);
                $statement->bindValue(':email_placeholder', $email);
                               
                $didit = $statement->execute();
                
                return $didit;
    }
    
    function update_user($username, $password, $fname, $lname, $email, $profilepic){
        global $db;
        $query = 'update user'
                . ' set password=:password_placeholder, fname=:firstname_placeholder, lname=:lastname_placeholder, email=:email_placeholder, profilepic=:profilepic_placeholder'
                . ' where alias=:username_placeholder;';
                                          
            //prepare the query, bind the values, then you execute
                $statement = $db->prepare($query);
               
			    $options = [ 'cost' => 13 ];
				$password_hashed = password_hash($password, PASSWORD_DEFAULT, $options);
				
                $statement->bindValue(':username_placeholder', $username);
                $statement->bindValue(':firstname_placeholder', $fname);
                $statement->bindValue(':lastname_placeholder', $lname);
                $statement->bindValue(':password_placeholder', $password_hashed);
                $statement->bindValue(':email_placeholder', $email);
                $statement->bindValue(':profilepic_placeholder', $profilepic);
                               
                $didit = $statement->execute();
                
                return $didit;
    }
    
    function add_post($username, $imgpath, $caption){
        global $db;
        $query = 'insert into post (alias, imagepath, caption)'
                . ' values (:username_placeholder, :imagepath_placeholder, :caption_placeholder)';
                                          
            //prepare the query, bind the values, then you execute
                $statement = $db->prepare($query);
               
                $statement->bindValue(':username_placeholder', $username);
                $statement->bindValue(':imagepath_placeholder', $imgpath);
                $statement->bindValue(':caption_placeholder', $caption);
                               
                $didit = $statement->execute();
                
                return $didit;
    }
	
	function get_all_users_sidebar()
	{
		global $db;
		$query = 'SELECT alias, fname, lname FROM user';
		
		$statement = $db->prepare($query);
		$statement->execute();
		$users = $statement->fetchAll();
		$statement->closeCursor();
		
		return $users;		
	}
	
	function get_newest_users()
	{
		global $db;
		$query = 'SELECT alias, fname, lname
					FROM user
					ORDER BY registerDate DESC 
					LIMIT 2;';
					
		$statement = $db->prepare($query);
		$statement->execute();
		$users = $statement->fetchAll();
		$statement->closeCursor();
		
		return $users;	
	}
	
	function get_users_most_comments()
	{
		global $db;
		$query = 'SELECT u.alias, fname, lname, COUNT(*) as \'numComments\'
					FROM user as u 
					JOIN comment as c ON u.alias = c.alias
					GROUP BY u.alias
					LIMIT 5;';
					
		$statement = $db->prepare($query);
		$statement->execute();
		$users = $statement->fetchAll();
		$statement->closeCursor();
		
		return $users;	
	}
        
        function add_comment($alias, $comment){
        global $db;
        $query = 'insert into comment (alias, postid, comment)'
                . ' values (:username_placeholder, null, :caption_placeholder)';
                                          
            //prepare the query, bind the values, then you execute
                $statement = $db->prepare($query);
               
                $statement->bindValue(':username_placeholder', $alias);
                $statement->bindValue(':comment_placeholder', $comment);
                               
                $didit = $statement->execute();
                
                return $didit;
        }
        
        function get_post($username){
        global $db;
        $query = 'Select postid, imagepath, caption from post where alias=:username_placeholder';
                                          
            //prepare the query, bind the values, then you execute
                $statement = $db->prepare($query);
               
                $statement->bindValue(':username_placeholder', $username);
                               
                $didit = $statement->execute();
                $results = $statement->fetch();
                
                if (!$didit){
                   return $didit;
                }
                else
                {
                    return $results;
                }
        }
        
        function get_comment($username){
        global $db;
        $query = 'Select comment from comment where alias=:username_placeholder';
                                          
            //prepare the query, bind the values, then you execute
                $statement = $db->prepare($query);
               
                $statement->bindValue(':username_placeholder', $username);
                               
                $didit = $statement->execute();
                $results = $statement->fetch();
                
                if (!$didit){
                   return $didit;
                }
                else
                {
                    return $results;
                }
        }
	
	
	
	?>
