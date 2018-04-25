<?php

require	'../../vendor/autoload.php';
include	'config.php';
$app	=	new	Slim\App();

// Get container
$container = $app->getContainer();

// Register component on container
$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig('../../templates');

    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));

    return $view;
};

$app->get('/songs', function($request,$response){
				try
				{
					
					$con	=	getDB();
					$sql	=	"SELECT	* FROM songs";
					$result = array();
						foreach	($con->query($sql)	as	$data){
									$result[]	= array(
														'id' => $data['id'],
														'name' => $data['name'],
														'artist' => $data['artist'],
														'image' => $data['image'],
														'album_id' => $data['album_id']
													 );
													
								
						}
						if($result){
							return	$response->withJson(array('status'	=>	'success','message' => "",'songs'=>$result));
						}else{
							return	$response->withJson(array('status'	=>	'success', 'message' => 'Songs Not Found'));
								}
				}
				catch(\Exception	$ex){
					return	$response->withJson(array('error'	=>	$ex->getMessage()),422);
				}
});

$app->get('/songs/{limit}', function($request,$response){
				try
				{
					$limit		=	$request->getAttribute('limit');
					$con	=	getDB();
					$sql	=	"SELECT	* FROM songs LIMIT $limit"; 
					$result = array();
						foreach	($con->query($sql)	as	$data){
									$result[]	= array(
														'id' => $data['id'],
														'name' => $data['name'],
														'artist' => $data['artist'],
														'image' => $data['image'],
														'album_id' => $data['album_id']
													 );
													
								
						}
						if($result){
							return	$response->withJson(array('status'	=>	'success','message' => "",'songs'=>$result));
						}else{
							return	$response->withJson(array('status'	=>	'success', 'message' => 'Songs Not Found'));
								}
				}
				catch(\Exception	$ex){
					return	$response->withJson(array('error'	=>	$ex->getMessage()),422);
				}
});

$app->get('/songs/{limit}/{id}', function($request,$response){
				try
				{
					$limit		=	$request->getAttribute('limit');
					$id		=	$request->getAttribute('id');
					$con	=	getDB();
					$sql	=	"SELECT	* FROM songs WHERE id = '$id' LIMIT $limit"; 
					$result = array();
						foreach	($con->query($sql)	as	$data){
									$result[]	= array(
														'id' => $data['id'],
														'name' => $data['name'],
														'artist' => $data['artist'],
														'image' => $data['image'],
														'album_id' => $data['album_id']
													 );
													
								
						}
						if($result){
							return	$response->withJson(array('status'	=>	'success','message' => "",'songs'=>$result));
						}else{
							return	$response->withJson(array('status'	=>	'success', 'message' => 'Song Not Found'));
								}
				}
				catch(\Exception	$ex){
					return	$response->withJson(array('error'	=>	$ex->getMessage()),422);
				}
});

$app->get('/getprofile', function($request,$response){
				try
				{
					$con	=	getDB();
					$sql	=	"SELECT	* FROM profile ORDER BY name ASC"; 
					$result = array();
						foreach	($con->query($sql)	as	$data){
									$result[]	= array(
														'id' => $data['id'],
														'name' => $data['name'],
														'band' => $data['band'],
														'status' => $data['status']
													 );
													
								
						}
						if($result){
							return	$response->withJson(array('status'	=>	'success','message' => "",'profile'=>$result));
						}else{
							return	$response->withJson(array('status'	=>	'success', 'message' => 'Profiles Not Found'));
								}
				}
				catch(\Exception	$ex){
					return	$response->withJson(array('error'	=>	$ex->getMessage()),422);
				}
});

$app->get('/getprofile/{id}', function($request,$response){
				try
				{
					$id		=	$request->getAttribute('id');
					$con	=	getDB();
					$sql	=	"SELECT	* FROM profile WHERE id = '$id'"; 
					$result = array();
						foreach	($con->query($sql)	as	$data){
									$result[]	= array(
														'id' => $data['id'],
														'name' => $data['name'],
														'band' => $data['band'],
														'status' => $data['status']
													 );
													
								
						}
						if($result){
							return	$response->withJson(array('status'	=>	'success','message' => "",'profile'=>$result));
						}else{
							return	$response->withJson(array('status'	=>	'success', 'message' => 'Profile Not Found'));
								}
				}
				catch(\Exception	$ex){
					return	$response->withJson(array('error'	=>	$ex->getMessage()),422);
				}
});

$app->get('/getplaylist/{id}', function($request,$response){
				try
				{
					$id		=	$request->getAttribute('id');
					$con	=	getDB();
					$sql	=	"SELECT	* FROM playlist WHERE user_id = '$id'"; 
					$result = array();
						foreach	($con->query($sql)	as	$data){
									$result[]	= array(
														'id' => $data['id'],
														'name' => $data['name']
													 );
													
								
						}
						if($result){
							return	$response->withJson(array('status'	=>	'success','data'=>$result));
							return	$response->withJson($result);
						}else{
							return	$response->withJson(array('status'	=>	'success', 'message' => 'Profile Not Found'));
								}
				}
				catch(\Exception	$ex){
					return	$response->withJson(array('error'	=>	$ex->getMessage()),422);
				}
});

$app->get('/getplaylist/{id}/{playlist_id}', function($request,$response){
				try
				{
					$id		=	$request->getAttribute('id');
					$playlist_id		=	$request->getAttribute('playlist_id');
					$con	=	getDB();
					$playlistNew = array();
					       $sql	=	"SELECT	* FROM playlist WHERE id = '$playlist_id'"; 
							$pre	=	$con->prepare($sql,	array(PDO::ATTR_CURSOR	=>	PDO::CURSOR_FWDONLY));
								$values	=	array(
												':id'	=>	$playlist_id
								);
								$pre->execute($values);
								$playlist	=	$pre->fetch();	

							$sql	=	"SELECT	* FROM songs WHERE playlist_id = '$playlist_id'"; 
							$playlistNew['id'] = $playlist['id'];
	       					$playlistNew['name'] = $playlist['name'];
	        				$playlistNew['user_id'] = $playlist['user_id'];

							$songslist = array();
							foreach	($con->query($sql)	as	$data){
										$songslist[]	= array(
															'id' => $data['id'],
															'name' => $data['name'],
															'songUrl' => $data['songUrl'],
															'artist' => $data['artist'],
															'album_id' => $data['album_id'],
															'image' => $data['image'],
															'profile_id' => $data['profile_id'],
															'playlist_id' => $data['playlist_id'],
															
														 );
														
									
							}

							$playlistNew['songs'] = $songslist;
							
							$responses = array();
							$responses['playlists'] = $playlistNew;
						if(count($responses) > 0){
							return	$response->withJson(array('status'	=>	'success','data'=>$responses));
						}else{
							return	$response->withJson(array('status'	=>	'success', 'message' => 'Playlist Not Found'));
								}
				}
				catch(\Exception	$ex){
					return	$response->withJson(array('error'	=>	$ex->getMessage()),422);
				}
});

$app->get('/deleteplaylist/{id}', function($request,$response){
				try
				{
					$id		=	$request->getAttribute('id');
					$con	=	getDB();
					$sql	=	"SELECT	* FROM playlist WHERE id = '$id'"; 
					$pre	=	$con->prepare($sql,	array(PDO::ATTR_CURSOR	=>	PDO::CURSOR_FWDONLY));
								$values	=	array(
												':id'	=>	$id
								);
								$pre->execute($values);
								$result	=	$pre->fetch();
					
					if(count($result) > 0){
						$sql				=	"DELETE	FROM playlist WHERE	id = '$id'";
						$pre =	$con->prepare($sql,	array(PDO::ATTR_CURSOR	=>	PDO::CURSOR_FWDONLY));
						$values	=	array(
						':id'	=>	$id
						);
						$result	=	$pre->execute($values);
						if($result){
							return	$response->withJson(array('status'	=> 'success','message'=> 'Play list deleted successfully'));
						}else{
							return	$response->withJson(array('status'	=> 'success','message'=> 'Error occurs while deleting playlist'));
						}
					}else{
						return	$response->withJson(array('status'	=> 'success','message'=> 'Invalid playlist id'));
					}
					
				}
				catch(\Exception	$ex){
					return	$response->withJson(array('error'	=>	$ex->getMessage()),422);
				}
});

$app->post('/registeruser',	function($request,	$response){
			try{
				if(isset($_POST['data'])){
					$scheme = $request->getUri()->getScheme();
					$host = $request->getUri()->getHost();
					$basePath = $request->getUri()->getBasePath();
					$base_url = $scheme.'://'.$host.$basePath; 

					$allData = json_decode($_POST['data']);
					$username = $allData->username;
					$email = $allData->email;
					$password = $allData->password;

					$con	=	getDB();
					$sql	=	"SELECT	* FROM users WHERE username = '$username'"; 
					$pre	=	$con->prepare($sql,	array(PDO::ATTR_CURSOR	=>	PDO::CURSOR_FWDONLY));
								$values	=	array(
												':username'	=>	$username
								);
								$pre->execute($values);
								$result	=	$pre->fetch();
							
					if(count($result) > 1){
						$response = array('status' => 'error', 'message' => 'Username already exists');
	        			return json_encode($response);
					}

					$sql	=	"SELECT	* FROM users WHERE email = '$email'"; 
					$pre	=	$con->prepare($sql,	array(PDO::ATTR_CURSOR	=>	PDO::CURSOR_FWDONLY));
								$values	=	array(
												':email'	=>	$email
								);
								$pre->execute($values);
								$result	=	$pre->fetch();

					if(count($result) > 1){
						$response = array('status' => 'error', 'message' => 'Email already exists');
	        			return json_encode($response);
					}

					$creationdate = date('Y-m-d H:i:s');

					
					$sql	=	"INSERT	INTO users(username,email,password,creationdate,status)	VALUES	(:username,:email,:password,:creationdate,:status)";
					$pre	=	$con->prepare($sql,	array(PDO::ATTR_CURSOR	=>	PDO::CURSOR_FWDONLY));
								
								$values	=	array(
												':username' => $username,
												':email' => $email,
												':password' => $password,
												':creationdate' => $creationdate,
												':status' => 0
								);

								$result	=	$pre->execute($values);
								$last_inserted_id = $con->lastInsertId();
								if($result){
									
									sendEmail($base_url,$email,$last_inserted_id,$creationdate);
									$response = array('status' => 'success', 'message' => 'User created succesffully');
								}else{
									$response = array('status' => 'error', 'message' => 'User cannot be created succesffully');
								}
			}else{
				$response = array('status' => 'error', 'message' => 'Bad request.');
			} 
			echo json_encode($response);
			}
			catch(\Exception	$ex){
					return	$response->withJson(array('error'	=>	$ex->getMessage()),422);
			}
});
// $app->get('/sendEmail/:email/:userid/:creationdate', ($list=function($email,$userid,$creationdate){
// 	print_r($email);
// 	print_r($userid);
// 	print_r($creationdate);

// }));

function sendEmail($base_url,$email,$userid,$creationdate){
	
	$link = base64_encode($creationdate.'_'.$userid);
	$param = "secret-password-reset-code";

   $to = $email;
$subject = "Email Confirmation";
$messageToSend = 'Thank you for registering with us.';
        $messageToSend .= '<br>';
        $messageToSend .= 'Please copy the following link into new window and press enter to activate your account :';
        $messageToSend .= '<br>';
        $messageToSend .= $base_url.'/confirmEmail/'.$link;
        $headers .= "MIME-Version: 1.0\r\n";
    	$headers .= "Content-Type: text/html; charset=iso-8859-1\n";
		$headers .= "From: hamstereq@testingserver.net" . "\r\n";

mail($to,$subject,$messageToSend,$headers);



}

$app->get('/confirmEmail/{id}', function($request,$response){
				try
				{
					$id		=	$request->getAttribute('id');
					$link = base64_decode($id);

			        $data = explode('_',$link);
			        $date = $data[0];
			        $userid = $data[1];
					$con	=	getDB();
					$sql	=	"SELECT	* FROM users WHERE id = :id"; 
					$pre	=	$con->prepare($sql,	array(PDO::ATTR_CURSOR	=>	PDO::CURSOR_FWDONLY));
								$values	=	array(
												':id'	=>	$userid
								);
								$pre->execute($values);
								$result	=	$pre->fetch();

					$currentdate = date('Y-m-d H:i:s');
        
			        $diff = strtotime($currentdate) - strtotime($date);
			        $diff_in_hrs = $diff/3600;
			        $response = '';
					
					if(count($result) > 0)
			        {
			            if(floor($diff_in_hrs) > 24)
			            {
			                $response = array('status' => 'error', 'message' => 'This link has been expired');
			    			return json_encode($response);
			            }
			            else
			            {
			                 $sql	=	"UPDATE users SET status = :status WHERE id = :id";
						$pre	=	$con->prepare($sql,	array(PDO::ATTR_CURSOR	=>	PDO::CURSOR_FWDONLY));
								
								$values	=	array(
												':status' => 1,
												'id' => $userid
								);

								$result	=	$pre->execute($values);
								if($result){
									echo "Account activated Successfully";
								}
			            }
			        }
					
				}
				catch(\Exception	$ex){
					return	$response->withJson(array('error'	=>	$ex->getMessage()),422);
				}
});

$app->post('/loginuser', function($request,$response){
				try
				{
					if(isset($_POST['data'])){
						$allData = json_decode($_POST['data']);
						$email = $allData->email;
						$password = $allData->password;

					$con	=	getDB();
					$sql	=	"SELECT	id,username,email,status FROM users WHERE email = '$email' AND password = '$password' AND status = 1"; 
					$result = array();
						foreach	($con->query($sql)	as	$data){
									$result[]	= array(
														'id' => $data['id'],
														'username' => $data['username'],
														'email' => $data['email']
													 );
													
								
						}
						if($result){
							return	$response->withJson(array('status' => 'success','message' => 'User login successfully','data'=>$result));
						
						}else{
							return	$response->withJson(array('status' => 'error', 'message' => 'Invalid crednetials'));
						}
					}else{
							return	$response->withJson(array('status' => 'error', 'message' => 'Bad Request'));
					}
				}
				catch(\Exception	$ex){
					return	$response->withJson(array('error'	=>	$ex->getMessage()),422);
				}
});

$app->post('/addprofile',	function($request,	$response){
			try{
				if(isset($_POST['data'])){
					
					$allData = json_decode($_POST['data']);
					$name = $allData->name;
					$band = $allData->band;
					$status = $allData->status;

					if($name == ""){
						$response = array('status' => 'error', 'message' => 'Profile name is required');
    					return json_encode($response);
					}
					if($band == ""){
						$response = array('status' => 'error', 'message' => 'Band value is required');
    					return json_encode($response);
					}
					if($status == ""){
						$response = array('status' => 'error', 'message' => 'Status value is required');
    					return json_encode($response);
					}

						$con	=	getDB();
						$string ="";
		                if(is_object($band)){
		                    foreach($band as $key => $value) {
		                        $string  .= $key.":".$value.",";
		                    }     
                    	trim($string,",");
                    	$sql	=	"INSERT	INTO profile(name,band,status)	VALUES	(:name,:band,:status)";
						$pre	=	$con->prepare($sql,	array(PDO::ATTR_CURSOR	=>	PDO::CURSOR_FWDONLY));
								
								$values	=	array(
												':name' => $name,
												':band' => $string,
												':status' => $status
								);

								$result	=	$pre->execute($values);
								$last_inserted_id = $con->lastInsertId();
                		}else{
                			$sql	=	"INSERT	INTO profile(name,band,status)	VALUES	(:name,:band,:status)";
							$pre	=	$con->prepare($sql,	array(PDO::ATTR_CURSOR	=>	PDO::CURSOR_FWDONLY));
								
								$values	=	array(
												':name' => $name,
												':band' => $band,
												':status' => $status
								);

								$result	=	$pre->execute($values);
								$last_inserted_id = $con->lastInsertId();
                		}

					
				
								if($result){
									$response = array('status' => 'success', 'message' => 'Profile inserted succesffully', 'profile Id' => $last_inserted_id);
								}else{
									$response = array('status' => 'error', 'message' => 'Profile cannot be created succesffully');
								}
			}else{
				$response = array('status' => 'error', 'message' => 'Bad request.');
			} 
			echo json_encode($response);
			}
			catch(\Exception	$ex){
					return	$response->withJson(array('error'	=>	$ex->getMessage()),422);
			}
});

$app->post('/upateprofile',	function($request,	$response){
			try{
				if(isset($_POST['data'])){
					
					$allData = json_decode($_POST['data']);
					$id = $allData->id;
					$name = $allData->name;
					$band = $allData->band;
					$status = $allData->status;

					if($id == ""){
						$response = array('status' => 'error', 'message' => 'Invalid profile id');
	             return json_encode($response);
					}
					if($name == ""){
						$response = array('status' => 'error', 'message' => 'Please provide profile name');
    					return json_encode($response);
					}
					if($band == ""){
						$response = array('status' => 'error', 'message' => 'Please provide band value');
    					return json_encode($response);
					}
					if($status == ""){
						$response = array('status' => 'error', 'message' => 'Please provide status value');
    					return json_encode($response);
					}

						$con	=	getDB();
						$string ="";
		                if(is_object($band)){
		                    foreach($band as $key => $value) {
		                        $string  .= $key.":".$value.",";
		                    }     
                    	trim($string,",");
                    	$sql	=	"UPDATE profile SET name = :name, band = :band, status = :status WHERE id = :id";
						$pre	=	$con->prepare($sql,	array(PDO::ATTR_CURSOR	=>	PDO::CURSOR_FWDONLY));
								
								$values	=	array(
												':name' => $name,
												':band' => $string,
												':status' => $status,
												'id' => $id
								);

								$result	=	$pre->execute($values);
                		}else{
                			$sql	=	"UPDATE profile SET name = :name, band = :band, status = :status WHERE id = :id"; 
						$pre	=	$con->prepare($sql,	array(PDO::ATTR_CURSOR	=>	PDO::CURSOR_FWDONLY));
								
								$values	=	array(
												':name' => $name,
												':band' => $band,
												':status' => $status,
												'id' => $id
								);

								$result	=	$pre->execute($values);
                		}

					
				
								if($result){
									$response = array('status' => 'success', 'message' => 'Profile updated successfully');
								}else{
									$response = array('status' => 'error', 'message' => 'Profile cannot be updated succesffully');
								}
			}else{ 
				$response = array('status' => 'error', 'message' => 'Bad request.');
			} 
			echo json_encode($response);
			}
			catch(\Exception	$ex){
					return	$response->withJson(array('error'	=>	$ex->getMessage()),422);
			}
});

$app->post('/addplaylist',	function($request,	$response){
			try{
				if(isset($_POST['data'])){
					
					$allData = json_decode($_POST['data']);
					
					$name = $allData->playlists[0]->name;
					$user_id = $allData->playlists[0]->user_id;

					 if($name == '') 
				      {
				         $response = array('status' => 'error', 'message' => 'Please provide play list name');
				         return json_encode($response); 
				      }
				       if($user_id == '') 
				      {
				         $response = array('status' => 'error', 'message' => 'Please provide user id');
				         return json_encode($response); 
				      }

						$con	=	getDB();
						$sql	=	"SELECT	* FROM playlist WHERE name = '$name' AND user_id = '$user_id'"; 
						$is_playlist_exists = array();
						foreach	($con->query($sql)	as	$data){
									$is_playlist_exists[]	= array(
														'id' => $data['id'],
														'name' => $data['name'],
														'user_id' => $data['user_id']
													 );
													
								
						}
						if(count($is_playlist_exists) > 0){
							$playlist_name = $is_playlist_exists[0]['name'];
							$playlist_user_id = $is_playlist_exists[0]['user_id'];
							$playlist_id = $is_playlist_exists[0]['id'];
							$sql				=	"DELETE	FROM playlist WHERE	name = :name AND user_id = :user_id"; 
							$pre =	$con->prepare($sql,	array(PDO::ATTR_CURSOR	=>	PDO::CURSOR_FWDONLY));
							$values	=	array(
							':name'	=>	$playlist_name,
							':user_id' => $playlist_user_id
							);
							$result	=	$pre->execute($values);

							$sql				=	"DELETE	FROM songs WHERE playlist_id = :playlist_id";
							$pre =	$con->prepare($sql,	array(PDO::ATTR_CURSOR	=>	PDO::CURSOR_FWDONLY));
							$values	=	array(
							':playlist_id'	=>	$playlist_id
							);
							$result	=	$pre->execute($values);
						}
						
						$sql	=	"INSERT	INTO playlist(name,user_id)	VALUES (:name,:user_id)";
							$pre	=	$con->prepare($sql,	array(PDO::ATTR_CURSOR	=>	PDO::CURSOR_FWDONLY));
								
								$values	=	array(
												':name' => $name,
												':user_id' => $user_id
								);

								$result	=	$pre->execute($values);
								$last_inserted_id = $con->lastInsertId();
						
						foreach( $allData as $playlist)
					       {
					          foreach($playlist[0]->songs as $songs)
					            {
					                $sql	=	"INSERT	INTO songs(name,artist,image,songUrl,album_id,playlist_id,profile_id)	VALUES (:name,:artist,:image,:songUrl,:album_id,:playlist_id,:profile_id)";
									$pre	=	$con->prepare($sql,	array(PDO::ATTR_CURSOR	=>	PDO::CURSOR_FWDONLY));
										
										$values	=	array(
														':name' => $songs->name,
														':artist' => $songs->artist,
														':image' => $songs->image,
														':songUrl' => $songs->songUrl,
														':album_id' => $songs->album_id,
														':playlist_id' => $last_inserted_id,
														':profile_id' => $songs->profile_id,
										);

										$result	=	$pre->execute($values);
							            }
					       }
					       $playlistNew = array();
					       $sql	=	"SELECT	* FROM playlist WHERE id = '$last_inserted_id'"; 
							$pre	=	$con->prepare($sql,	array(PDO::ATTR_CURSOR	=>	PDO::CURSOR_FWDONLY));
								$values	=	array(
												':id'	=>	$last_inserted_id
								);
								$pre->execute($values);
								$playlist	=	$pre->fetch();	

							$sql	=	"SELECT	* FROM songs WHERE playlist_id = '$last_inserted_id'"; 
							$playlistNew['id'] = $playlist['id'];
	       					$playlistNew['name'] = $playlist['name'];
	        				$playlistNew['user_id'] = $playlist['user_id'];

							$songslist = array();
							foreach	($con->query($sql)	as	$data){
										$songslist[]	= array(
															'id' => $data['id'],
															'name' => $data['name'],
															'artist' => $data['artist'],
															'image' => $data['image'],
															'songUrl' => $data['songUrl'],
															'album_id' => $data['album_id'],
															'playlist_id' => $data['playlist_id'],
															'profile_id' => $data['profile_id'],
														 );
														
									
							}

							$playlistNew['songs'] = $songslist;
							
							$responses = array();
							$responses['playlists'] = $playlistNew;
							return	$response->withJson(array('status' => 'success','data'=>$responses));
			
			}else{
				$response = array('status' => 'error', 'message' => 'Bad request.');
			} 
			echo json_encode($response);
			}
			catch(\Exception	$ex){
					return	$response->withJson(array('error'	=>	$ex->getMessage()),422);
			}
});

$app->post('/updateplaylist',	function($request,	$response){
			try{
				if(isset($_POST['data'])){
					
					$allData = json_decode($_POST['data']);
					
					$id = $allData->playlists[0]->id;

					 if($id == '') 
				      {
				         $response = array('status' => 'error', 'message' => 'Please provide play list id');
    	         		return json_encode($response); 
				      }
				     

						$con	=	getDB();
						$sql	=	"SELECT	* FROM playlist WHERE id = '$id'"; 
							$pre	=	$con->prepare($sql,	array(PDO::ATTR_CURSOR	=>	PDO::CURSOR_FWDONLY));
								$values	=	array(
												':id'	=>	$id
								);
								$pre->execute($values);
								$playlistss	=	$pre->fetch();

						if(count($playlistss) > 0){
							foreach( $allData as $playlist)
		        	       	{
		        	           
		        	          
		        	            foreach($playlist[0]->songs as $songs)
		        	            {
		        	               
					
									$sql	=	"INSERT	INTO songs(name,artist,image,songUrl,album_id,playlist_id,profile_id)	VALUES (:name,:artist,:image,:songUrl,:album_id,:playlist_id,:profile_id)";
												$pre	=	$con->prepare($sql,	array(PDO::ATTR_CURSOR	=>	PDO::CURSOR_FWDONLY));
													
													$values	=	array(
																	':name' => $songs->name,
																	':artist' => $songs->artist,
																	':image' => $songs->image,
																	':songUrl' => $songs->songUrl,
																	':album_id' => $songs->album_id,
																	':playlist_id' => $id,
																	':profile_id' => $songs->profile_id,
													);

													$result	=	$pre->execute($values);
		        	            }
		        	       }
						}
				
						
					
					 
							return	$response->withJson(array('status' => 'success','message'=>'Play list updated successfully'));
			
			}else{
				$response = array('status' => 'error', 'message' => 'Invalid play list id.');
			} 
			echo json_encode($response);
			}
			catch(\Exception	$ex){
					return	$response->withJson(array('error'	=>	$ex->getMessage()),422);
			}
});

$app->post('/forgetpassword', function($request,$response){
				try
				{
					$scheme = $request->getUri()->getScheme();
					$host = $request->getUri()->getHost();
					$basePath = $request->getUri()->getBasePath();
					$base_url = $scheme.'://'.$host.$basePath;

					$con	=	getDB();
					if(isset($_POST['data']))
				     {
			    	         $allData = json_decode($_POST['data']);
			    	        	$email = $allData->email;
			    	      if($email == '') 
			    	      {
			    	         $response = array('status' => 'error', 'message' => 'Please provide email address');
			    	         return json_encode($response); 
			    	      }
			    	      
				         $sql	=	"SELECT	* FROM users WHERE email = :email"; 
							$pre	=	$con->prepare($sql,	array(PDO::ATTR_CURSOR	=>	PDO::CURSOR_FWDONLY));
								$values	=	array(
												':email'	=>	$email
								);
								$pre->execute($values);
								$user	=	$pre->fetch();	
				       
				        if(count($user) > 0)
			    	    {	
							sendForgetPasswordEmail($base_url,$allData->email,$user['id']);
							$response = array('status' => 'success', 'message' => 'A reset password email has been sent.');
						}
						else
						{
							$response = array('status' => 'error', 'message' => 'User does not exists');
			    	        return json_encode($response); 
						}
			    	       
				     }
	     else
		{
			 $response = array('status' => 'error', 'message' => 'Please provide email address');
		}   
	    echo json_encode($response);
				}
				catch(\Exception	$ex){
					return	$response->withJson(array('error'	=>	$ex->getMessage()),422);
				}
});

function sendForgetPasswordEmail($base_url,$email,$userid){
	$link = base64_encode($email.'_'.$userid);
	$param = "secret-password-reset-code";

   		$to = $email;
		$subject = "Forget Password";
		
		$messageToSend = 'Hi,';
        $messageToSend .= '<br>';
        $messageToSend .= 'A forget password request has been sent by you. Please click on the following link to reset your password. ';
        $messageToSend .= '<br>';
        $messageToSend .= $base_url.'/resetPassword/'.$link;
        $headers .= "MIME-Version: 1.0\r\n";
    	$headers .= "Content-Type: text/html; charset=iso-8859-1\n";
		$headers .= "From: hamstereq@testingserver.net" . "\r\n";

mail($to,$subject,$messageToSend,$headers);

}



$app->get('/resetPassword/{id}', function ($request, $response) {
	$app	=	new	Slim\App();
	$container = $app->getContainer();
	$id		=	$request->getAttribute('id');
		$link = base64_decode($id);
		$data = explode('_' ,$link);
		$email = $data[0];
		$viewData = [
        'email' => $email
    ];
    return $this->get('view')->render($response, 'resetPassword.twig', $viewData);
});

$app->post('/changePassword', function($request,$response){
				try
				{
					if(isset($_POST)){
						$allData = json_decode($_POST['data']);
						$email = $_POST['email'];
						$password = $_POST['password'];

						

					$con	=	getDB();
					$sql	=	"UPDATE users SET password = :password WHERE email = :email"; 
						$pre	=	$con->prepare($sql,	array(PDO::ATTR_CURSOR	=>	PDO::CURSOR_FWDONLY));
								
								$values	=	array(
												':email' => $email,
												':password' => $password
								);

								$result	=	$pre->execute($values);
						if($result){
							echo "success";
						
						}else{
							echo "error";
						}
					}else{
							echo 'Bad Request';
					}
				}
				catch(\Exception	$ex){
					return	$response->withJson(array('error'	=>	$ex->getMessage()),422);
				}
});
$app->run();
?>