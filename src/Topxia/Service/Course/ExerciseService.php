<?php
namespace Topxia\Service\Course;

interface ExerciseService
{
	public function getExercise($id);

	public function CreateExercise($fields);
}