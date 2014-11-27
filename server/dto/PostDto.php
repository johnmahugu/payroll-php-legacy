<?php

class PostDto extends AbstractDto{

	static function refactorNames($posts){
	
		foreach($posts as $post)
			$postNamesArrResponse[] = array('id'=>$post->id,'name'=>$post->name);
		
		return self::encode($postNamesArrResponse);
	}
	
	static function refactorMany($posts){
		
		$postsArrResponse['page'] = 1;
		$postsArrResponse['total'] = $posts->count();
		
		$i = 1;
		foreach($posts as $post)
			$postsArrResponse['rows'][] = array('id'=>$post->id,'cell'=>array($i++,$post->name,$post->Department->name));
		
		return self::encode($postsArrResponse);
	}
	
	static function refactorOne($post,$departments){

		foreach($departments as $department)
			$departmentArrResponse[] = array('id'=>$department->id,'name'=>$department->name);
			
		$postArrResponse = array('id'=>$post->id,'name'=>$post->name,'descr'=>$post->descr,'department'=>$post->Department->name,'departments'=>$departmentArrResponse);
		
		return self::encode($postArrResponse);
	}
}
?>