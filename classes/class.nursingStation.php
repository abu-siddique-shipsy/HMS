<?php

require __DIR__.'/../config.php';


class nursingStation
{
	function addTask($task)	
	{
		$query = "insert into ward_task (ward_id,task_description,task_type,time) values ('$task[ward]','$task[desc]','$task[type]','$task[time]')";
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$con->query($query);
		$con->close();
	}
	function getAllTasks($ward_id)
	{
		$query = "SELECT * FROM ward_task where ward_id = '$ward_id'";
		$con = new MySQLi(DBHOST,DBUSER,DBPASS,DBNAME);
		$con->query($query);
		$result = $con->query($query);
		while ($exe = $result->fetch_object()) 
		{
			$response[] = $exe; 
		}
		$con->close();
		return $response;
	}
	function createSchedule($tasks)
	{
		foreach ($tasks as &$task) {
			if($task->task_type == "Once"){
				$task = self::scheduleOneTimeTask($task);
			}
			// else{
			// 	// self::scheduleRecursiveTask($task);	
			// }
		}
		return $tasks;
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
}

?>