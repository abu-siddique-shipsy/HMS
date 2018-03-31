<?php

require __DIR__.'/../config.php';


class nursingStation
{
	function addTask($task)	
	{
		$query = "insert into ward_task (reg_id,ward_id,task_description,task_type,time,total_days,at_date) values ('$task[reg_id]','$task[ward]','$task[desc]','$task[type]','$task[time]','$task[days]','$task[date]')";
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$con->query($query);
		$id = $con->insert_id;
		$con->close();
		return $id;
	}
	function getAllTasks($ward_id)
	{
		$query = "SELECT task_desc,concat(on_date, ' ', on_time) as scheduled_at , status,parent_type as task_type FROM ward_task_log where ward_id = '$ward_id' and status != 1";
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$con->query($query);
		$result = $con->query($query);
		while ($exe = $result->fetch_object()) 
		{
			$exe->status = ($exe->status == 0 ? 'Open' : 'Closed');
			$response[] = $exe; 
		}
		$con->close();
		return $response;
	}
	function createSchedule($tasks)
	{

		foreach ($tasks as $key => $value) 
		{
			if ($value->task_type == 1) 
			{
				$task = new stdClass();
				$task->id = $value->task_id;
				$task->parent = "wardTask";
				// print_r($value);

				$task->hr = self::cut_string_using_last(':',$value->time,'left',false);	 	
				$task->min = explode(" ",self::cut_string_using_last(':',$value->time,'right',false))[0];	 	
				$task->oncePerDay = (strpos($value->time, 'AM') || strpos($value->time, 'PM'));
				if (strpos($value->time, 'PM')) {
					$task->hr += 12; 
				}
				$task->total_days = $value->total_days;
				$task->desc = $value->task_description;
				$task->taskId = $value->task_id;
				$task->wardId = $value->ward_id;
				self::scheduleEveryTask($task);
				// print_r($task);
			}	 
			if ($value->task_type == 2) 
			{
				$task = new stdClass();
				$task->id = $value->task_id;
				$task->parent = "wardTask";
				$task->hr = self::cut_string_using_last(':',$value->time,'left',false);	 	
				$task->min = explode(" ",self::cut_string_using_last(':',$value->time,'right',false))[0];	 	
				if (strpos($value->time, 'PM')) {
					$task->hr += 12; 
				}
				$task->DateTime = $value->at_date." ".$task->hr.":".$task->min;
				$task->desc = $value->task_description;
				$task->taskId = $value->task_id;
				$task->wardId = $value->ward_id;
				
				if (self::addToLog($task,$task->DateTime))
				{
					self::markCreated($task->id);
				}
			}
		}
	}
	function scheduleEveryTask($task)
	{
		// print_r($task);
		$currDateAndTime = date('Y-m-d H:i:s',strtotime(date('Y-m-d H:i:s')));
		$currDate = date('Y-m-d',strtotime($task->hr.':'.$task->min));
		$endDate = date('Y-m-d H:i:s', strtotime($currDateAndTime. '+'.$task->total_days.' days'));
		$taskIds = [];
		
		if (!$task->oncePerDay) 
		{
			while ($endDate > date('Y-m-d H:i:s', strtotime($currDateAndTime))) 
			{
				$currDateAndTime = date('Y-m-d H:i:s', strtotime($currDateAndTime. '+'.$task->hr.' hour'));
				$currDateAndTime = date('Y-m-d H:i:s', strtotime($currDateAndTime. '+'.$task->min.' minutes'));
				$taskIds[] = self::addToLog($task,$currDateAndTime);
			}
		}
		else
		{
			if ($currDate < date('Y-m-d H:i:s')) 
			{
				$currDate = date('Y-m-d', strtotime($currDate. '+1 days'));
			}
			while ($task->total_days--) 
			{
				$currDate = $currDate." ".$task->hr.":".$task->min;
				$taskIds[] = self::addToLog($task,$currDate);
				$currDate = date('Y-m-d', strtotime($currDate. '+1 days'));
			}
		}
		if (count($taskIds)) 
		{
			self::markCreated($task->id);
		}
	}
	function markCreated($taskId)
	{
		$sql = "UPDATE ward_task set status = 1 where task_id = '$taskId'";
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$con->query($sql);	
		$con->close();
	}
	function addToLog($task,$currDateAndTime)
	{
		$on_date = date('Y-m-d',strtotime($currDateAndTime));
		$on_time = date('H:i:s',strtotime($currDateAndTime));
		$query = "INSERT into ward_task_log (ward_id,task_desc,on_date,on_time,parent_id,parent_type,status) values
				('$task->wardId','$task->desc','$on_date','$on_time','$task->id','$task->parent',0)";
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$con->query($query);
		$id = $con->insert_id;
		$con->close();
		return $id;
	}
	function scheduleOneTimeTask($task)
	{

		$time = $task->time;
		// if(date('H:i') < $time)
		// {
			$now = date('Y-m-d H:i:s');
			$schedule = date('Y-m-d H:i:s',strtotime($time));
			$alarm_warn = date('Y-m-d H:i:s',strtotime('-20 minutes',strtotime($schedule)));
			$alarm_danger = date('Y-m-d H:i:s',strtotime('-10 minutes',strtotime($schedule)));
			// print_r($alarm_warn);echo "\r\n";
			// print_r($alarm_danger);echo "\r\n";
			if($now > $alarm_danger)
			{
				$task->background = "red";
			}	
			else if($now > $alarm_warn && $now < $schedule)
			{
				$task->background = "yellow";
			}
			else
			{
				$task->background = "white";	
			}
			$result = self::updateSchedule($task->task_id,$schedule);
			$task->scheduled_at = $schedule;
			
		// }
		return $task;
	}
	function updateSchedule($task_id,$schedule)
	{
		$query = "UPDATE ward_task set scheduled_at = '$schedule' where task_id = '$task_id'";
		// print_r($query);
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$con->query($query);
		$result = $con->query($query);
		return $result;
	}
	function cut_string_using_last($character, $string, $side, $keep_character=true) 
	{
		$offset = ($keep_character ? 1 : 0);
		$whole_length = strlen($string);
		$right_length = (strlen(strrchr($string, $character)) - 1);
		$left_length = ($whole_length - $right_length - 1);
		switch($side) {
		    case 'left':
		        $piece = substr($string, 0, ($left_length + $offset));
		        break;
		    case 'right':
		        $start = (0 - ($right_length + $offset));
		        $piece = substr($string, $start);
		        break;
		    default:
		        $piece = false;
		        break;
		}
		return($piece);
	} 
}
// if($value->done_days != $value->total_days){
			// 	$add_days = $value->done_days; 
			// 	$on_date = date('Y-m-d' , strtotime('+'.$add_days.' day',strtotime($value->scheduled_at))); 
			// }
			// $on_time = date('H:i' , strtotime($value->time));
			// $created_date = date('Y-m-d H:i' , strtotime($value->scheduled_at)); 
			// $today = date('Y-m-d H:i',strtotime($on_date . " " . $on_time));
			// // print_r($today);
			// if($value->done_days !=  $value->total_days)
			// {
			// 	$query = "INSERT INTO ward_task_log (ward_id,parent_id,parent_type,on_date,on_time,task_desc) values ($value->ward_id,$value->task_id,'Added Task','$on_date','$on_time','$value->task_description') ";
			// 	print_r($query);
			// 	$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
			// 	if($con->query($query)) 
			// 	{
			// 		$value->done_days++;
			// 		$query = "UPDATE ward_task set done_days = $value->done_days where task_id = '$value->task_id'";
			// 		if($value->done_days == $value->total_days)
			// 			$query = "UPDATE ward_task set done_days = $value->done_days , status = 1 where task_id = '$value->task_id'";
			// 		print_r($query);
			// 		$con->query($query);
			// 	}

			// 	$con->close();
			// }
?>