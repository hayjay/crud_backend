<?php 
namespace App\Interfaces;

interface TodoRepositoryInterface
{
	public function all();

	public function findById($todo);

	public function create($data);

	public function update($data);
}

 ?>