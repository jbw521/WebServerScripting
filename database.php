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
        $query = 'insert into user (alias, password, fname, lname, email)'
                . ' values (:username_placeholder, :password_placeholder, :firstname_placeholder, :lastname_placeholder, :email_placeholder)';
                                          
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
               
                $statement->bindValue(':username_placeholder', $username);
                $statement->bindValue(':firstname_placeholder', $fname);
                $statement->bindValue(':lastname_placeholder', $lname);
                $statement->bindValue(':password_placeholder', $password);
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
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>