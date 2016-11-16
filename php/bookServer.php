<?php
	$option = $_GET["option"] ;
	if($option == "select"){
		$json_string = file_get_contents("../json/books.json");
		echo $json_string ;
		// echo "{\"name\":\"lili\"}" ;
	}

	if($option == "addItem"){
		$isInsert = 0;
		$book = $_GET["addData"];
		$book = json_decode($book,true);
		$id = $book["id"];
		$name =$book["name"];
		$price = $book["price"];
		$author = $book["author"];
		$json_string = file_get_contents("../json/books.json");
		$data = json_decode($json_string,true);
		if($id && $name && $price && $author){
			for($i = 0; $i<count($data); $i++){
				if($data[$i]["id"]==$id){
					$isInsert = 1;
				}else{
					$item = array('id' => $id,'name' =>$name,'price'=>$price,'author'=>$author);
					array_push($data,$item);
					$data = json_encode($data);
					file_put_contents("../json/books.json",$data);
				}
			}
		}else{
			$isInsert = 2;
		}
		
		echo $isInsert ;
	}
	if($option == "delete"){
		$id = $_GET["id"];
		$res = 1;
		$json = file_get_contents("../json/books.json");
		$json_arr = json_decode($json,true);
		for($i = 0 ;$i<count($json_arr);$i++){
			$del_id = $json_arr[$i]["id"];
			if($del_id==$id){
				array_splice($json_arr,$i,$i+1);
				$json_string = json_encode($json_arr);
				file_put_contents("../json/books.json",$json_string);
				$res = 0;
			}
		}
		echo $res;
	}
	if($option == "update"){
		$book = $_GET["book"];
		$book = json_decode($book,true);
		$id = $book["id"];
		$name =$book["name"];
		$price = $book["price"];
		$author = $book["author"];
		$isOk = 1;
		$json = file_get_contents("../json/books.json");
		$json_arr = json_decode($json,true);
		for($i = 0 ;$i<count($json_arr);$i++){
			$del_id = $json_arr[$i]["id"];
			if($del_id==$id){
				$json_arr[$i]["name"] = $name ;
				$json_arr[$i]["price"] = $price ;
				$json_arr[$i]["author"] = $author ;
				// array_splice($json_arr,$i,$i+1);
				$json_string = json_encode($json_arr);
				file_put_contents("../json/books.json",$json_string);
				$isOk = 0;
			}
		}
		echo $isOk;
	}
?>